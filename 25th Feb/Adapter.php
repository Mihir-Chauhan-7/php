<?php

class Adapter{
    protected $connect;
    protected $config = [
        'host' => 'localhost',
        'dbName' => 'project',
        'user' => 'root',
        'password' => ''
    ];
   
    public function setConfig($config){
        if(!is_array($config)){
            throw new Exception("Config Must be An Array.");
        }
        $this->config = array_merge($this->config,$config);
        return $this;
    }

    public function getConfig(){
        return $this->config;
    }

    public function isConnected(){
        if(!$this->getConnect()){
            return false;
        }
        return true;
    }
    
    public function connect(){
        $config = $this->getConfig();
        $connect = mysqli_connect($config['host'],$config['user'],$config['password']
            ,$config['dbName']);
        $this->setConnect($connect);
    }
    
    public function setConnect($connect){
        $this->connect = $connect;
        return $this;
    }
    
    public function getConnect(){
        return $this->connect;
    }

    public function setQuery($query){
        $this->query = $query;
        return $this;
    }

    public function getQuery(){
        return $this->query;
    }

    public function insert($query){
        $result = $this->query($query);
        if($result){
            return $this->getConnect()->insert_id;               
        }
        else{
            return null;
        }
        
    }

    public function update($query){
        $result = $this->query($query);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function delete($query){
        $result = $this->query($query);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function query($query){
        if(!$this->isConnected()){
            $this->connect();
        }
        $this->setQuery($query);
        return $this->getConnect()->query($this->getQuery());
    }
    
    public function fetchAll($query){
        $result = $this->query($query);
        return $result->fetch_All(MYSQLI_ASSOC);
    }

    public function fetchRow($query){
        $result = $this->query($query);
        return $result->fetch_assoc();
    }
    
    public function fetchOne($query){
        $result = $this->query($query);
        return $result->fetch_row()[0];
    }
    
    public function fetchPairs($query){
        $result = $this->query($query);
        $result = $result->fetch_all();
        foreach($result as $singleRow){
             $keys[] = $singleRow[0];
             $values[] = $singleRow[1];
        }
        return array_combine($keys,$values);
    }
}

$config = [
    'host' => 'localhost',
    'dbName' => 'project',
    'user' => 'root',
    'password' => ''
];

 $adapter = new Adapter();
// $adapter->setConfig($config)->connect();
// $adapter->insert("INSERT INTO `users` (`fname`,`lname`,`email`
//    ,`password`,`contact`) VALUES('Abc','abcd','abc@gmail.com','abc',123)");
// $adapter->update("UPDATE `users` SET `fname`='abc1',`lname`='abcd1' WHERE `user_id`=1");
// var_dump($adapter->delete("DELETE FROM `users` WHERE `user_id`=30"));
// echo "<pre>";
// print_r($adapter->fetchPairs("SELECT `user_id`,`fname` FROM `users`"));
// echo "Count : ".$adapter->fetchOne("SELECT count(`user_id`) FROM `users`");


?>