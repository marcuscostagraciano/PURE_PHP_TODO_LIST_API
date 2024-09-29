<?php

class Todo
{
    private static ?object $conn = null;

    private static function initializeConnection(): void
    {
        if (!isset(self::$conn)) {
            self::$conn = DatabaseConnection::getConnection();
        }
    }

    // Crud
    private static function postTodo(string $taskName): array
    {
        $sql = 'INSERT INTO todo (task_name) VALUES (:task_name)';

        try {
            self::$conn->beginTransaction();

            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':task_name', $taskName, PDO::PARAM_STR);
            $stmt->execute();

            $last_id = self::$conn->lastInsertId();
            self::$conn->commit();

            return [
                "id" => $last_id,
                "task_name" => $taskName,
                "isDone" => false,
            ];
        } catch (PDOException $e) {
            return self::returnResponse(500, $e->getMessage());
        }
    }

    // cRud
    private static function getTodoList(): array
    {
        $stmt = self::$conn->query('SELECT id, task_name, isDone FROM todo');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$row) {
            $row['isDone'] = $row['isDone'];
        }

        return $result;
    }

    // crUd
    private static function patchTodo(int $id, int $newIsDoneStatus): array
    {
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
    private static function deleteTodo(int $id): array
    {
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

    private static function returnResponse(int $responseCode, string $responseMsg): array
    {
        http_response_code($responseCode);
        return [
            'status' => $responseCode,
            'message' => $responseMsg
        ];
    }

    public static function handleTodoRequest(array $request_info): array
    {
        self::initializeConnection();

        $method = $request_info['METHOD'];
        $idToConsult = $request_info['ID_TO_CONSULT'];
        $taskName = $request_info['BODY']['task_name'] ?? null;
        $isDone = $request_info['BODY']['isDone'] ?? null;

        switch ($method) {
            case 'POST':
                return self::postTodo($taskName);
            case 'GET':
                return self::getTodoList();
            case 'DELETE':
                return self::deleteTodo($idToConsult);
            case 'PATCH':
                return self::patchTodo($idToConsult, $isDone);
            default:
                http_response_code(405);
                return ["message" => "Method not allowed"];
        }
    }
}
