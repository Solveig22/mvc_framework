<?php

class Model {

    protected $db;
    protected $table;
    protected $modelName;
    protected $columnNames = [];

    public $id;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->table = strtolower(get_class($this)) . 's';
        $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', rtrim($this->table, 's'))));
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

    public function setTableColumns() {
        $columns = $this->getColumns();
        foreach($columns as $column) {
            $this->columnNames[] .= $column->Field;
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