<?php
 class model {
     protected $db;
     protected $conexao;

     public function __construct(){
        global $config;

        try{
            $this->conexao="mysql:dbname=".$config['dbname'].";host=".$config['host'];
            $this->db = new PDO($this->conexao,$config['dbuser'],$config['dbpass']);
        }catch(PDOException $exc){
            $this->db->rollback();
            echo "erro ".$exc->getMessage();
        }


     }
 }


?>