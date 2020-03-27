<?php

namespace Enway\App\Core;

class Model {

    protected $db;
    protected $table;
    protected $modelName;
    protected $columnNames = [];

    public $id;

    public function __construct() {
        $this->db = Database::getInstance();
        $path = explode('\\', get_class($this));
        $class = array_pop($path);
        $this->table = strtolower($class . 's');
        $this->modelName = "Enway\\App\\Models\\" . str_replace(' ', '', ucwords(str_replace('_', ' ', rtrim($this->table, 's'))));
        $this->columnNames = $this->setTableColumns();
    }


    
    
    public function find($params = []) {
        $resultQuery =  $this->db->find($this->table, $params);
        $results = [];
        
        foreach($resultQuery as $result) {
            $obj = new $this->modelName;
            $obj->_populateObjDatas($result);
            $results[] = $obj;
        }
        
        return $results;
    }
    
    public function findFirst($params = []) {
        $resultQuery = $this->db->findFirst($this->table, $params);
        $result = new $this->modelName;
        $result->_populateObjDatas($resultQuery);
        
        return $result;
    }


    public function setTableColumns() {
        $columns = $this->getColumns();
        foreach($columns as $column) {
            $this->columnNames[] = $column->Field;
        }
    }

    public function getColumns() {
        return $this->db->show_columns($this->table);
    }

    private function _populateObjDatas($datas) {
        foreach($datas as $key => $val) {
            $this->$key = $val;
        }
    }

}