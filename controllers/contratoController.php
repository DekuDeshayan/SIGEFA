<?php
 class contratoController extends controller {

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
            "contador"=>array(),
            "cliente"=>array()
        );

        $utilizador = new Utilizador();
        $contador = new Contador();
        $cliente = new Cliente();

        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;//Objecto para imprimir nome de utilizador logado no template
        $dados["user"] = $utilizador;//Objecto para verificar permissoes no template
        
        if($utilizador->hasPermission('administrar')) {
           //Metodo celebrar contrato mandado pro ajaxController...            

           //dados de contadores que ainda nao estao associados a clientes(contrato ainda nao foi celebrado);
            $dados['contador'] = $contador->buscarContadorSemContrato();

            //dados de clientes para celebrar o contrato
            $dados['cliente'] = $cliente->buscarCliente();

            $this->loadTemplate('contrato',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }
   

}
?>

