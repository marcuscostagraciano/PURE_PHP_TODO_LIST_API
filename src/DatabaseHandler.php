<?php

class DatabaseHandler {
    private static ?object $conn = null;

    public static function initializeConnection(): void {
        if (!isset(self::$conn)) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }

    // Crud
    public static function postTodo(string $task_name): array {
        self::initializeConnection();

        $sql = 'INSERT INTO todo (task_name) VALUES (:task_name)';

        try {
            self::$conn->beginTransaction();

            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
            $stmt->execute();

            $last_id = self::$conn->lastInsertId();
            self::$conn->commit();

            return [
                "id" => (int) $last_id,
                "task_name" => $task_name,
                "isDone" => $isDone,
            ];
    
        } catch (PDOException $e) {
            return self::returnResponse(500, $e->getMessage());    
        }
    }

    // cRud
    public static function getTodoList(): array {
        self::initializeConnection();
        
        $stmt = self::$conn->query('SELECT id, task_name, isDone FROM todo');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$row) {
            $row['isDone'] = (bool) $row['isDone'];
        }
        
        return $result;
    }

    // crUd
    public static function patchTodo(string $id, string $newIsDoneStatus): array {
        self::initializeConnection();
        $newIsDoneStatus = $newIsDoneStatus === "true" ? 1 : 0;
        
        $sql = 'UPDATE todo SET isDone=:isDone WHERE id=:id';
        
        try {
            self::$conn->beginTransaction();
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':isDone', $newIsDoneStatus, PDO::PARAM_BOOL);
            $stmt->execute();

            self::$conn->commit();
            return self::returnResponse(200, "Successfully patched");    
        } catch (PDOException $e) {
            return self::returnResponse(500, $e->getMessage());    
        }
    }

    // cruD
    public static function deleteTodo(string $id) {
        self::initializeConnection();

        $sql = 'DELETE FROM todo WHERE id = :id';

        try {
            self::$conn->beginTransaction();

            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            self::$conn->commit();
            return self::returnResponse(200, "Successfully deleted");    
        } catch (PDOException $e) {
            return self::returnResponse(500, $e->getMessage());    
        }
    }

    private static function returnResponse(int $responseCode, string $responseMsg): array {
        http_response_code($responseCode);
        return [
            'status' => $responseCode,
            'message' => $responseMsg];
    }
}