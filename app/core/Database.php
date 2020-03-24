<?php

class Database {

    private static $instance = null;

    protected $pdo;
    protected $query;
    protected $results;
    protected $error = false;
    protected $row_count;
    protected $lastInsertedId;


    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET names utf8");
        }catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Database;
        }

        return self::$instance;
    }

}