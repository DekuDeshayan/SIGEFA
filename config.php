<?php
require 'environment.php';

global $config;
$config = array();

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$active_group = 'default';
$query_builder = TRUE;

//Se o ambiente for desenvolvimento os dados serao do servidor local
if(ENVIRONMENT == "development"){
    $config['dbname']='SIGEFA';
    $config['host']='localhost';
    $config['dbuser']='root';
    $config['dbpass']='';
//Se o ambiente for producao os dados serao do servidor externo
}elseif(ENVIRONMENT == "production"){
    $config['dbname']= substr($cleardb_url["path"],1);
    $config['host']= $cleardb_url["host"];
    $config['dbuser']= $cleardb_url["user"];
    $config['dbpass']= $cleardb_url["pass"];
}

?>



