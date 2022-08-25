<?php
 class permissionsController extends controller {


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
            "lista_de_permissoes"=>array(),
            "lista_de_grupos_de_permissoes"=>array(),
            "user"=>array()
        );

        $utilizador = new Utilizador();
        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;
        $dados["user"] = $utilizador;
        
    
        if($utilizador->hasPermission('verpermissoes')) {
            
            $permissoes = new Permissions();
            $dados['lista_de_permissoes'] = $permissoes->getListaPermissoes();
            $dados['lista_de_grupos_de_permissoes'] =$permissoes->getListaGruposPermissoes();
            $this->loadTemplate('permissions',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }























 }
?>

