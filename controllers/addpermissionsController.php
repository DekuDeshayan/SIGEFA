<?php
 class addpermissionsController extends controller {

    public function __construct(){
        $utilizador = new Utilizador();
        if($utilizador->isLogged()==false){
            header("location: ".BASE_URL."/login");
			exit;
        }   
    }
 

    public function index(){
        $dados=array(
            "info"=>array(),
            "user"=>array()
        );

        $utilizador = new Utilizador();
        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;
        $dados["user"] = $utilizador;
        //addpermissions e deletepermissions está no ajaxController
        if($utilizador->hasPermission('verpermissoes')) {
            $this->loadTemplate('addpermissions',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }


   

}
?>

