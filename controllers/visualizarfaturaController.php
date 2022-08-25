<?php
 class visualizarfaturaController extends controller {

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
            "facturas"=>array(),
            "infopayment"=>array()
        );

        $utilizador = new Utilizador();
        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $dados["info"] = $utilizador;
        $dados["user"] = $utilizador;
        
        if($utilizador->hasPermission('visualizarFactura')) {
            $cliente = new Cliente();
            $factura = new Fatura();

            $id_utilizador = $_SESSION['id_userlogado'];
            $id_cliente = $cliente->pegarIdCliente($id_utilizador);
            $dados['facturas'] = $factura->visualizarfacturas($id_cliente);

            $this->loadTemplate('visualizarfatura',$dados);
        }else{
            header("Location: ".BASE_URL);
        }
        
    }



    public function gerarPDF($idfactura){
        $fatura = new Fatura();

        $fatura->gerarPDFfactura($idfactura);
    }
  
}
?>

