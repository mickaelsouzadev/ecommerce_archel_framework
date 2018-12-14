<?php
/* PHP Class for managing queries and connecting to database, part of MVC Framework
 * AUTHOR: Antony Acosta, Modified by Mickael Souza
 * LAST EDIT: 2018-12-02
 */

namespace App\Models;
use App\Models\Connection;
use App\Models\QueryBuilder;

class Model 
{
    
    private $builder;
    private $connection;
    
    public function __construct($config = null, $table = null) {
        if(!$config){
           $config = parse_ini_file("config.ini");
        }
        $this->connection = new Connection($config['user'],
                $config['password'],
                $config['dbname'],
                $config['host'],
                $config['charset']
                );
        if($table){
            $this->setTable($table);
        }
    }
    
    public function run($callback, $params = null){
        // var_dump($params);
        return $this->connection->exec($this->builder->query,$callback,$params);
    }
    
    
    public function select(array $fields = []){
        $this->builder->select($fields);
        return $this;
    }
    
    public function insert(array $data = []){ //array assoc as $field=>$value
        $validfields = $this->builder->insert(array_keys($data));
        $validfields = array_flip($validfields);
        $data = array_intersect_key($data, $validfields);
        return $this;
    }
    
    public function delete($id){
        $this->builder->delete()->where($this->builder->tables[0]->pk(),$id);
        return $this;
        
    }
    
    public function update(array $data, $id){ //array_assoc as $field=>$value
        $this->builder->update(array_keys($data));
        
        $this->builder->where($this->builder->tables[0]->pk(),$id);
        
        return $this;
    }

    public function setTable($table){
        
        $this->builder = new QueryBuilder($table);
        
        $cols = $this->run("fetchAll");
        
        $pk = array_filter($cols,function($e){
            return $e["Key"] == "PRI";
        });
        
        $this->builder->tables[0]->setPk($pk[0]['Field']);
           
        $this->builder->tables[0]->setFields(array_map(function($e){
            return $e["Field"];
        }, $cols));
        
        $this->builder->getFks(0);
        
        $cols = $this->run("fetchAll");
        
        $fkskeys = array_map(function($e){
            return $e["COLUMN_NAME"];
        },$cols);
        
        $fksvalues = array_map(function($e){
            return $e["REFERENCED_TABLE_NAME"];
        },$cols);
        
        $this->builder->tables[0]->setFks(array_combine($fkskeys,$fksvalues));
        
        return $this;
        
        
    }
    public function addTable(string $table){
        $index = $this->builder->addTable($table);
        
        $cols = $this->run("fetchAll");
        
        $pk = array_filter($cols,function($e){
            return $e["Key"] == "PRI";
        });
        
        $this->builder->tables[$index]->setPk($pk[0]["Field"]);
        $this->builder->tables[$index]->setFields(array_map(function($e){
            return $e["Field"];
        }, $cols));
        
        $this->builder->getFks($index);
        
        $cols = $this->run("fetchAll");
        
        $fkskeys = array_map(function($e){
            return $e["COLUMN_NAME"];
        },$cols);
        
        $fksvalues = array_map(function($e){
            return $e["REFERENCED_TABLE_NAME"];
        },$cols);
        
        $this->builder->tables[$index]->setFks(array_combine($fkskeys,$fksvalues));
        
        return $index;
    }
    
    public function join(array $fields, string $type = "inner"){ //fields is an array assoc in format tablename=>Array[fields]
        
        $this->builder->select($fields);
        array_shift($fields);
        foreach(array_keys($fields) as $t){
            $this->builder->join($type, $t);
        }
        return $this;
        
    }
    
    public function where($field, $val, $table = 0, $operator = "=", $concatenator = "AND")
    {
        $this->builder->where($field, $val, $table, $operator, $concatenator);        
        return $this;
    }
    
}