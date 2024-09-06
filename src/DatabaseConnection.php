<?php

class DatabaseConnection {
    private static string $HOSTNAME, $DATABASE, $USER, $PASSWORD;

    private static function initialize(): void {
        if (!isset(self::$HOSTNAME)) {
            self::$HOSTNAME = getenv('DATABASE_HOSTNAME');
            self::$DATABASE = getenv('DATABASE_NAME');
            self::$USER = getenv('DATABASE_USER');
            self::$PASSWORD = getenv('DATABASE_PASSWORD');
        }
    }

    public static function getConnection(): ?object {
        self::initialize();
        try {

            $conn = new PDO(
                'mysql:host=' . self::$HOSTNAME . ';dbname=' . self::$DATABASE,
                self::$USER,
                self::$PASSWORD
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}
