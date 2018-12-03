<?php
/* PHP Class for storing database Tables structure
 * AUTHOR Antony Acosta
 * LAST EDIT: 2018-11-08
 */
namespace App\Models;

class Table {
    
    public $name;
    private $primarykey;
    public $foreignkeys = [];   
    public $fields = [];
    public function __construct($tablename, $primarykey = null, $foreignkeys = [], $fields = [])
    {
        $this->name = $tablename;
        $this->primarykey = $primarykey;
        $this->foreignkeys = $foreignkeys;
        $this->fields = $fields;
    }
    
    public function setFields(array $fields)
    {
        $this->fields = array_filter($fields,function($e){
            return $e !== $this->primarykey;
        });
    }
    
    public function field($field)
    {
        return array_search($field,$this->fields);
    }
    
    public function setPk(string $pk)
    {
        $this->primarykey = $pk;
        return $this;
    }
    
    public function setFks(array $fks)
    {   
        $this->foreignkeys = $fks;
        return $this;
    }
    
    public function pk()
    {
        return $this->primarykey;
    }
    
    public function fk(string $searchterm = "")
    {
        if($searchterm)
        {
            return array_search($searchterm, $this->foreignkeys);
        }
        return $this->foreignkeys;
    }
}
