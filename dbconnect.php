<?php

class dbconnect {
    private $host ='localhost';
    private $dbName ='notesapp';
    private $user='mostafaazzam';
    private $pass='Mazzam#2021';

    public function connect(){

        try{

            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn ;
        }
        catch(PDOException $e){
        echo 'DataBase Error '.$e->getMessage();
        
        }
        

    }
    
}

$obj = new dbconnect;

$obj->connect();

?>