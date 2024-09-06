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
                "isDone" => false,
            ];
    
        } catch (PDOException $e) {
            http_response_code(500);
            return ['message' =>  $e->getMessage()];
        }
    }

    // cRud
    public static function getTodoList(): array {
        self::initializeConnection();
        
        $stmt = self::$conn->query('SELECT id, task_name, isDone FROM todo');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    // crUd
    public static function patchTodo(string $id, bool $isDone): array {
        self::initializeConnection();
        // Use self::$conn to perform database operations
        // Example:
        // $stmt = self::$conn->prepare("UPDATE todo_list SET is_done = ? WHERE id = ?");
        // $stmt->execute([$isDone, $id]);
        // return [ 'status' => 'success' ];
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

            http_response_code(200);
            return ["message" => "Successfully deleted"];
    
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            // return false;
        }
        // Use self::$conn to perform database operations
        // Example:
        // $stmt = self::$conn->prepare("DELETE FROM todo_list WHERE id = ?");
        // $stmt->execute([$id]);
        // return [ 'status' => 'success' ];
    }
}