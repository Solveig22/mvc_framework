<?php

namespace Enway\App\Core;

use PDO;
use PDOException;

class Database {

    private static $_instance = null;

    protected $pdo;
    protected $query;
    protected $results;
    protected $error = false;
    protected $rowCount;
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
        if(!isset(self::$_instance)) {
            self::$_instance = new Database;
        }

        return self::$_instance;
    }


    public function query($sql, $binds = array()) {
        $this->error = false;

        if($this->query = $this->pdo->prepare($sql)) {
            if(!empty($binds)) {
                $x = 1;
                foreach($binds as $bind) {
                    $this->query->bindValue($x++, $bind);
                }
            }
        }

        if($this->query->execute()) {
            $this->results = $this->query;
            $this->rowCount = $this->results->rowCount();
            $this->lastInsertedId = $this->pdo->lastInsertId();
        }else {
            $this->error = true;
        }

        return $this;

    }

    private function _read($table, $params = array()) {

        $conditionString = '';
        $binds = [];
        $group = '';
        $order = '';
        $limit = '';

        if(!empty($params)) {
            if(key_exists('conditions', $params)) {
                $conditionString .= " WHERE ";
                if(is_array($params['conditions'])) {
                    foreach($params['conditions'] as $key => $value) {
                        $conditionString .= $key . ' = \'' . $value . '\' AND ';
                    }

                    $conditionString = rtrim($conditionString, ' AND ');

                }else {
                    $conditionString .= $params['conditions'];
                }
            }

            if(key_exists('bind', $params)) {
                $binds = $params['bind'];
            }

            if(key_exists('group', $params)) {
                $group = " GROUP BY ";
                $group .= $params['group'];
            }

            if(key_exists('order', $params)) {
                $order = " ORER BY ";
                $order .= $params['order'];
            }

            if(key_exists('limit', $params)) {
                $limit = " LIMIT ";
                $limit .= $params['limit'];
            }            
        }
        
        $sql = "SELECT * FROM {$table}{$conditionString}{$group}{$order}{$limit}";
        
        return $this->query($sql, $binds);

    }

    public function find($table, $params = array()) {
        return ($this->_read($table, $params)) ? $this->results()->fetchAll(PDO::FETCH_OBJ) : false;
    }

    public function findFirst($table, $params = array()) {
        return ($this->_read($table, $params)->rowCount()) ? $this->results()->fetchAll(PDO::FETCH_OBJ)[0] : false;
    }


    public function insert($table, array $params) {

        $fields = '';
        $values = '';
        $binds = [];

        foreach($params as $field => $value) {
            $fields .= '`' . $field . '`, ';
            $values .= '?, ';
            $binds[] = $value;
        }
 
        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');

        $sql = "INSERT INTO {$table} ($fields) VALUES ($values)";
        return !$this->query($sql, $binds)->error();
    }

    public function update($table, $id, $params) {

        $set = '';
        $binds = [];

        foreach($params as $field => $value) {
            $set .= '`' . $field . '` = ?, ';
            $binds[] = $value;
        }

        $set = rtrim($set, ', ');


        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        return !$this->query($sql, $binds)->error();

    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        
        return !$this->query($sql)->error();
    }

    public function show_columns($table) {
        return $this->query("SHOW COLUMNS FROM {$table}")->results()->fetchAll(PDO::FETCH_OBJ);
    }

    public function results() {
        return $this->results;
    }

    public function rowCount() {
        return $this->rowCount;
    }

    public function lastInsertId() {
        return $this->lastInsertedId;
    }

    public function error() {
        return $this->error;
    }

}