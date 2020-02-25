<?php

class Adapter{
    private $conn = null;
    private $dsn = 'mysql:host=localhost;dbname=vehicle';
    private $username = 'root';
    private $password = ''; 
    
    public function connect(){
        if($this->conn === null){
            try{
                $this->conn = new PDO($this->dsn,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "Connection Failed <br>" . $e->getMessage();
            }
            
        }
    }
    public function isConnected(){
        return $this->conn === null ? false : true;
    }
    public function fetchAll($tablename){
        if($this->isConnected()){
            try{
                $stmt = $this->conn->query("SELECT * FROM $tablename");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return sizeof($result) > 0  ? $result : null;
            }
            catch(PDOException $e){
                echo "Error <br>" . $e->getMessage(); 
            }
            
        }
        else{
            return null;
        }
        
    }
    public function fetchRow($tablename,$where){
        if($this->isConnected()){
            try{
                $stmt = $this->conn->query("SELECT * FROM $tablename WHERE $where LIMIT 1");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result : null;
            }
            catch(PDOException $e){
                echo "Error <br>" . $e->getMessage(); 
            }
            
        }
        else{
            return null;
        }
    }
    public function fetchOne($tablename,$where){
        if($this->isConnected()){
            try{
                $stmt = $this->conn->query("SELECT * FROM $tablename WHERE $where");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result : null;
            }
            catch(PDOException $e){
                echo "Error <br>" . $e->getMessage(); 
            }
            
        }
        else{
            return null;
        }

    }
    public function fetchPairs(){

    }
    public function insert($data,$tablename){
        $keys = array_keys($data);
        $values = array_values($data);
        
        $this->conn->exec("INSERT INTO $tablename (" . implode(', ', $keys) . ") "
            . "VALUES ('" . implode("', '", $values) . "')");
        return $this->conn->errorCode() == 00000 ? true : false;        
    }
    public function update($data,$tablename,$where){
        $i = 0;
        $pre = '';
        $fields = '';

        foreach($data as $key => $value){
            $i>0 ? $pre = "," : "";
            $fields .= $pre.$key."='".$value."'";
            $i++;
        }
        $this->conn->exec("Update $tablename SET $fields Where $where");
        return $this->conn->errorCode() == 00000 ? true : false;
    }
    public function delete($tablename,$where){
        $this->conn->exec("DELETE FROM $tablename WHERE $where");
        return $this->conn->errorCode() == 00000 ? true : false;
    }
}

$adapterObj = new Adapter();
$adapterObj->connect();
//var_dump($adapterObj->isConnected());
echo "<pre>";
//print_r($adapterObj->fetchAll("users"));
//print_r($adapterObj->fetchRow("users","user_id != 0"));
print_r($adapterObj->fetchOne("users","user_id = 1"));
echo "</pre>";
//var_dump($adapterObj->delete("users","user_id = 17"));
//var_dump($adapterObj->insert(['fname' => 'Abc' , 'lname' => 'Abcd' , 
//    'email' => 'abc@gmail.com' , 'password' => 'abc' , 'contact' => '123456'],"users"));
//var_dump($adapterObj->update(['fname' => 'Abc1' , 'lname' => 'Abcd1' , 
//    'email' => 'abc@gmail.com' , 'password' => 'abc' , 'contact' => '123456'],"users","user_id = 1"));
?>