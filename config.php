<?php
require 'environment.php';

global $config;
$config = array();
//Se o ambiente for desenvolvimento os dados serao do servidor local
if(ENVIRONMENT == "development"){
    $config['dbname']='SIGEFA';
    $config['host']='localhost';
    $config['dbuser']='root';
    $config['dbpass']='';
//Se o ambiente for producao os dados serao do servidor externo
}else{
    $config['dbname']='SIGEFA';
    $config['host']='localhost';
    $config['dbuser']='root';
    $config['dbpass']='';
}

//NB:OS DADOS DO LOCALHOST E DO EXTERN HOST SAO DIFERENTES

?>



