<?php
    require_once 'Adapter.php';

class Row{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $rowChanged = false;
    protected $data = [];

    public function setTable($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function getTable(){
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    public function setRowChange($value){
        $this->rowChanged = $value;
        return $this;
    }

    public function getRowChange(){
        return $this->rowChanged;
    }

    public function setData($data){
        $this->data = $data;
        return $this;
    }

    public function getData(){
        return $this->data;
    }

    public function unsetData($key = NULL){
        if($key != NULL){
            unset($this->data[$key]);
            return $this;
        }
        $this->data = [];
        return $this;
    }
    
    public function __set($key, $value)
    {
        $this->data = array_merge($this->getData(),[$key => $value]);
        $this->setRowChange(true);
        return $this;    
    }
    
    public function __get($key)
    {
        $data = $this->getData();
        return key_exists($key,$data) ? $data[$key] : NULL; 
    }

    public function insertData(){

        if(!$this->getRowChange()){
            throw new Exception("Please Insert Atleast One Value");
        }
        $this->unsetData('id');
        $data = $this->getData();
        $keys = array_keys($data);
        $values = array_values($data);

        $last_id = $this->execute()->insert("INSERT INTO ".$this->getTable()." (" 
            . implode(', ', $keys) . ") ". "VALUES ('" . implode("', '", $values) . "')");

        $this->unsetData();
        $this->load($last_id);
        return true;
    }


    public function updateData(){

        if(!$this->getRowChange()){
            throw new Exception("Please Change Atleast One Value");
        }

        $i = 0;
        $pre = '';
        $fields = '';
        $id = $this->id;
        $this->unsetData('id');
        $data = $this->getData();
        foreach($data as $key => $value){
            $i>0 ? $pre = "," : "";
            $fields .= $pre . $key . "='" . $value ."'";
            $i++;
        }

        $result = $this->execute()->update("UPDATE ".$this->getTable() . " SET $fields WHERE " .
            $this->getPrimaryKey() . " = $id");

        $this->unsetData();
        $this->load($id);
        return $result;
    }

    public function deleteData(){
        if(!$this->getRowChange()){
            throw new Exception("Please Provide Id to Delete");
        }

        $id = $this->id;
        $this->unsetData('id');
        
        return $this->execute()->delete("DELETE FROM ".$this->getTable() . " WHERE " .
            $this->getPrimaryKey() . " = $id");
    }

    public function load($id){
        $this->setData($this->execute()->fetchRow("SELECT * FROM " . $this->getTable()
            . " WHERE " . $this->getPrimaryKey() . " = $id"));
    }

    public function execute(){
        return $adapter = new Adapter();
    }

}
echo "<pre>";
$row = new Row();
//print_r($row);
$row->setTable('products');
$row->setPrimaryKey('id');

$row->id = 1;
$row->name = 'Product 1';
$row->price = 10000;
$row->stock = 12;
$row->sku = 100;
//$row->name='Product 2';
//$row->updateData();
//print_r($row->insertData());
//print_r($row->deleteData());
//var_dump($row->load(1));
print_r($row);
?>
