<?php
/* PHP Class for filtering and retriving information from forms
 * AUTHOR: Antony Acosta
 * LAST EDIT: 2018-11-22
 */
namespace App;

class Form{
    
    private $data = array();
    private $files = array();
    private $fields;
    private $filters;
    private $method;
    
    public function __construct(array $fields = [], array $filters = [], $method = INPUT_POST)
    {
        $this->fields   = $fields;
        $this->filters  = $filters;
        $this->method   = $method;
    }
    
    public function getFilteredData()
    {
        if(!$this->data){
            foreach($this->fields as $field){
                $this->data[$field] = filter_input($this->method, $field, $this->filters[$field]);
                if($this->data[$field] === ""){
                    $this->data[$field] = null;
                }
            }
        }
        return $this->data;
    }
    
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }
    
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    public function getFileName($index = 0)
    {
        return $this->files[0]['name'];
    }
    
    public function checkEmptyFields()
    {
        return (in_array(null,$this->data)) ? true : false;
    }
    
    public function filterSingleFile($fieldname, array $validformats, $maxsize = 1048576)// 1MB
    {
        $file = $_FILES[$fieldname];
        $isValidFormat   = in_array($file['type'], $validformats);
        $isValidSize     = ($file['size'] <= $maxsize) ? true : false; 
        $error           = $file['error'];
        if($isValidFormat && $isValidSize && !$error){
               $file['name'] = filter_var($file['name'], FILTER_SANITIZE_STRING);
               $this->files[] = $file;
               return true;
        }
        return false;
    }
    
    //files needs to be filtered first
    public function saveUploadedFiles($dir)
    {
        try{
            if(!$this->files){
                throw new Exception("There are no files, have you filtered them?");
            }
            $dir = (strrpos($dir,"/") === strlen($dir)-1) ? $dir : $dir."/";
            foreach($this->files as $file){
                echo  $dir.$file['name'];
                $done[] = move_uploaded_file($file['tmp_name'], $dir.$file['name']);
            }
            return $done;
        }catch(Exception $e){
            echo "Error: ".$e->getMessage();
        }
        
    }
}