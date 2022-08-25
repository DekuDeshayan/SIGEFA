<?php
 class editargruposController extends controller {

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
            "user"=>array(),
            "lista_de_permissoes"=>array(),
            "groupinfo"=>array()
        );

        $utilizador = new Utilizador();
        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;
        $dados["user"] = $utilizador;
        
        if($utilizador->hasPermission('verpermissoes')) {
            $permissoes = new Permissions();
            $dados['lista_de_permissoes'] = $permissoes->getListaPermissoes();

            if(isset($_GET['idgroup']) && !empty($_GET['idgroup'])){
                $idgroup = addslashes($_GET['idgroup']);
                $dados['groupinfo'] = $permissoes->getPermissionGroupToEdit($idgroup);
            }
        
            $this->loadTemplate('editargrupos',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }


   

}
?>

