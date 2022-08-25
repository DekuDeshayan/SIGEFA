<?php
 class faturaController extends controller {

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
            "lista_de_permissoes"=>array()
        );

        $utilizador = new Utilizador();
        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;
        $dados["user"] = $utilizador;
        
        if($utilizador->hasPermission('EmitirFactura')) {

            
           
            $this->loadTemplate('fatura',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }



    //testes...
    public function gerar(){
        $fatura = new Fatura();

        $fatura->gerarPDFfactura();
    }
  
}
?>

