<?php  
/* PHP Class for building SQL queries
 * AUTHOR Mickael Braz de Souza, Modified by Antony Acosta 
 * LAST EDIT: 2018-11-26
 */
namespace App\Models;

class QueryBuilder 
{
    public $query = "";
    public $tables = [];
    
    public function __construct($primarytable)
    {
        if($primarytable instanceof Table){
            $this->tables[0] = $primarytable;
        }else{
            $this->tables[0] = new Table($primarytable);
        }
        
        $this->getFields(0);
    }
    public function getTableIndex($name)
    {
        for($i=0; $i<count($this->tables); $i++){
            if($this->tables[$i]->name == $name){
                return $i;
            }
        }
    }
        
    public function select(array $fields = []) //fields is a bidimensional array in format tableindex=>Array[fields] OR just array with field names of main table OR bidimensional array in format tablename=>Array[fields] 
    {   
        $currentTable = 0;
        $parsedfields = [];
        if($fields){
             foreach($fields as $table=>$field){
                if(is_string($table)){
                    $currentTable = $this->getTableIndex($table);
                }
                if(is_array($field)){
                    foreach($field as $f){
                        $parsedfields[] = "{$this->tables[$currentTable]->name}.{$f}";
                    }
                }else{
                    $parsedfields[] = "{$this->tables[0]->name}.{$field}";
                }
            }
            $stringfields = implode($parsedfields, ", ");
        }else{
            $stringfields = "*";
        }
        
        $this->query = "SELECT {$stringfields} FROM {$this->tables[0]->name}"; 
        //$this->tables[0] is always the main table
        //STILL NEEDS TO DO JOIN
        
        return $this;
    }
    
    public function insert(array $data, int $table = 0)
    {
        //check valid fields
        $data = array_intersect($this->tables[$table]->fields, $data);
        
        $this->query = "INSERT INTO {$this->tables[$table]->name} ";
        $this->query.="(".implode(", ", $data).")";
        $this->query.= " VALUES ";
        $doubledoot = array_map(function($e){
            return ":{$e}";
        }, $data);
        $this->query.="(".implode(", ", $doubledoot).")";
    
        return $data;
    }
    public function update(array $data, int $table = 0)
    {
        $this->query = "UPDATE {$this->tables[$table]->name} SET ";
        //check valid fields
        $fields = array_intersect($this->tables[$table]->fields, $data);
        
        foreach($fields as $field) {
                $this->query.="{$field} = :{$field}, ";
        }
        $this->query = substr($this->query, 0, -2);
        return $this;
    }
    public function delete(int $table = 0)
    {
        $this->query = "DELETE FROM {$this->tables[$table]->name}";
        return $this;
    }
    
    public function where($field, $value, int $table = 0, string $operator = "=", string $concatenator = "AND")
    {
        if(!$this->tables[$table]->field($field) && $this->tables[$table]->pk() !== $field)
        {  
            return false;
        }
        if(false === strpos($this->query,"WHERE")){
            $this->query.= " WHERE {$this->tables[$table]->name}.{$field} {$operator} '{$value}'";
        }else{
            $this->query.= "{$concatenator} {$this->tables[$table]->name}.{$field} {$operator} '{$value}'";
        }
        
        return $this;
    }
    
    public function join(string $type, $table2)
    {   //makes a $type join taking $table1's fk that references $table2's pk
        $type = strtoupper($type); 
        
        $table2 = (is_string($table2)) ? $this->getTableIndex($table2) : $table2;
        $table1 = 0;
        
        $fk = $this->tables[$table1]->name .".". $this->tables[$table1]->fk($this->tables[$table2]->name );
        
        $pk = $this->tables[$table2]->name .".". $this->tables[$table2]->pk();
        
        $this->query.= " {$type} JOIN {$this->tables[$table2]->name} ON {$fk} = {$pk}";
        
        return $this;
    }
    
    public function getFields(int $table) 
    {
        $this->query = "DESCRIBE {$this->tables[$table]->name}";     
        
        return $this;
    }
    
    public function getFks(int $table)
    {
            $this->query = "SELECT REFERENCED_TABLE_NAME, COLUMN_NAME "
            . "FROM information_schema.KEY_COLUMN_USAGE "
            . "WHERE REFERENCED_TABLE_SCHEMA = TABLE_SCHEMA AND TABLE_NAME = '{$this->tables[$table]->name}'";
            return $this;
    }
    
    public function addTable($tablename)
    {
        if($tablename instanceof Table){
            $this->tables[] = $tablename;
        }else{
            $this->tables[] = new Table($tablename);
        }
        $tableindex = count($this->tables)-1;
        $this->getFields($tableindex);
        
        return $tableindex;
    }
    
}