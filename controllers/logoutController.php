<?php
 class logoutController extends controller {

    public function __construct(){
        $utilizador = new Utilizador();
        if($utilizador->isLogged()==false){
            header("location: ".BASE_URL."/login");
            exit;
        }
        
    }

    public function index(){
        $utilizador = new Utilizador();
        $utilizador->dologout();
        header("location: ".BASE_URL);
    }

 }
?>