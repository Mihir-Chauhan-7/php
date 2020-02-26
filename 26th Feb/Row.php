<?php

    require_once 'Adapter.php';

class Row{
    protected $tableName = NULL;
    protected $primaryKey = NULL;
    protected $rowChanged = false;
    protected $adapter = NULL;
    protected $data = [];

    public function __construct()
    {   
        $this->setAdapter();
    }
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

    public function setRowChanged($value = false){
        $this->rowChanged = $value;
        return $this;
    }

    public function getRowChanged(){
        return $this->rowChanged;
    }

    public function setData($data){
        if(!is_array($data)){
            throw new Exception("Data Must Be Array.");
        }
        $this->data = $data;
        return $this;
    }

    public function getData(){
        return $this->data;
    }

    public function unsetData($key = NULL){
        $data = $this->getData();
        if($key != NULL){
            unset($data[$key]);
            $this->setData($data);
            return $this;
        }

        $data = [];
        $this->setData($data);
        return $this;
    }

    public function __set($key, $value)
    {
        $data = $this->getData();
        $this->setData(array_merge($data,[$key => $value]));
        $this->setRowChanged(true);

        return $this;
    }

    public function __get($key)
    {
        $data = $this->getData();
        return key_exists($key,$data) ? $data[$key] : NULL;
    }
    
    public function setAdapter($adapter = NULL){
        if($adapter == NULL){
            $this->adapter = new Adapter();
            return $this;
        }

        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter(){
        return $this->adapter;
    }

    

    public function insertData(){

        if(!$this->getRowChange()){
            throw new Exception("Please Insert Atleast One Value");
        }

        $this->unsetData('id');
        $data = $this->getData();
        $keys = array_keys($data);
        $values = (array_map(function ($value){
            $this->getAdapter()->connect();
            return $this->getAdapter()->getConnect()->real_escape_string($value);
        },array_values($data)));

        $this->load($this->getAdapter()->insert("INSERT 
        INTO `".$this->getTable()."` 
        (".implode(',',$keys).") 
        VALUES('".implode("','",$values)."')"));
        $this->setRowChanged(false);
    }

    public function updateData(){
        $this->getAdapter()->connect();

        if(!$this->getRowChanged()){
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
            $fields .= $pre . $key . "='" . 
                $this->getAdapter()->getConnect()->real_escape_string($value) ."'";
            $i++;
        }

        $result = $this->getAdapter()->update("UPDATE
        {$this->getTable()} SET
        {$fields}
        WHERE {$this->getPrimaryKey()} = $id");
        $this->setRowChanged(false);
        $this->load($id);
        return $result;
        
    }

    public function deleteData(){
        if(!$this->getRowChange()){
            throw new Exception("Please Provide Id to Delete");
        }
        $id = $this->id;
        return $this->getAdapter()->delete("DELETE 
        FROM {$this->getTable()} 
        WHERE {$this->getPrimaryKey()} = $id");
    }

    public function load($id){
        $this->setData($this->getAdapter()->fetchRow("SELECT * 
            FROM {$this->getTable()} 
            WHERE {$this->getPrimaryKey()} = $id"));
        $this->setRowChanged(false);
    }

    public function fetchAll(){

    }

    public function fetchRow($query){
        if(!$result = $this->getAdapter()->query($query)->fetch_assoc()){
            return null;    
        }
        $this->setData($result);
        return $this;
    }

}
echo "<pre>";
$row =new Row();
$row->setTable('products');
$row->setPrimaryKey('id');
//$row->setRowChanged();
$row->id = 1;
$row->name = "Product 1";
$row->price = 1000;
$row->stock = 100;
$row->sku = 10;

//$row->insertData();
//$row->updateData();
print_r($row->fetchRow("SELECT * FROM products WHERE id=55"));
//$row->deleteData();
print_r($row);
?>
