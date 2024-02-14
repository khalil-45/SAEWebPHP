<?php

namespace Model;
class Connection_BD {
    private static $instance;

    private function __construct() {
        // Connexion à la base de données SQLite
        try {
            self::$instance = new \PDO("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "../../" . DIRECTORY_SEPARATOR . "php_music.db");

        } catch (\PDOException $e) {
            throw new \Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            new self();
        }
        return self::$instance;
    }
}