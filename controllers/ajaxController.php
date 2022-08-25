<?php
require ('libraries/mpesapi/vendor/autoload.php');
use Karson\MpesaPhpSdk\Mpesa;
class ajaxController extends controller {

   
    //use Karson\MpesaPhpSdk\Mpesa;

    public function __construct(){
        $utilizador = new Utilizador();
        if($utilizador->isLogged()==false){
            header("location: ".BASE_URL."/login");
            exit;
        }
    }

    public function index(){$dados=array();}

    public function pagarFactura(){
       
        if(isset($_POST['telefone']) && !empty($_POST['telefone'])){


            // require ('libraries/mpesapi/vendor/autoload.php');
            $mpesa = new Mpesa();
            $mpesa->setApiKey('rp1zxvs2gsa00elcfr4yjb1bre4s88x3');
            $mpesa->setPublicKey('MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==');
            $mpesa->setEnv('test');// 'live' production environment 
    
            //This creates transaction between an M-Pesa short code to a phone number registered on M-Pesa.

            $telefone = $_POST['telefone'];
            $idInvoice = $_REQUEST['facturid'];
            $valor_pagar = $_REQUEST['valor'];
            
    
            $result = $mpesa->c2b('T12344C', '258'.$telefone, $valor_pagar, 'E2A6RO', '171717');
    
            $status=$result->status;


            if($status==200 || $status==201 ){

                $factura = new Fatura();

                $factura->efectuarPagamentodefactura($idInvoice);

                $dados['respon'] = "success";


            //armazenar todas as respostas no dados e mandar via json encode...
            }elseif($status==409){
                echo "Parece que esta Transacao é duplicada, por favor espere pelo menos 10 minutos e volte a tentar!";
                exit;
            }

            echo json_encode($dados);
        }   

    }




    /**
     * Emitir factura
     */

    public function emitirFactura(){
       
        if(isset($_POST['valor_pagar']) && !empty($_POST['valor_pagar'])){
            
            $factura = new Fatura();

            $id_leitura_act = $_REQUEST['id_leitura_act'];
            $id_cliente = $_REQUEST['id_cliente'];
            $valorPagar = $_POST['valor_pagar'];
            $consumo = $_POST['consumo'];
            $leitura_anterior = $_POST['leitura_anterior'];
                
            $factura->emitirFatura($valorPagar, $leitura_anterior, $consumo, $id_leitura_act, $id_cliente);

        }

    }


    /**
     * Busca de informacoes do cliente para facturar
     */
    public function buscarDadosPraFatura(){
        $dados = array();

        if(isset($_REQUEST['nr_contador']) && !empty($_REQUEST['nr_contador'])){
            $nr_contador = $_REQUEST['nr_contador'];
            $fatura = new Fatura();
            $dados['dados_factura'] = $fatura->buscarDadosPraFaturar($nr_contador);

            echo json_encode($dados);
        }
       
    }








    /**
     * Registar leitura de contador
     */

     public function registarLeitura(){
        $utilizador = new Utilizador();
        $leitura = new Fatura();
        $agente = new Agente();

        $utilizador->setLoggedUser($_SESSION['id_userlogado']);
        $id_utilizador = $_SESSION['id_userlogado'];
        $id_agente = $agente->pegarIdAgente($id_utilizador);

        $leitura->registarLeituraContador($id_agente);
     }


    //

     /**
     * Cadastrar contadores
     */
    public function celebrarContract(){
        $contrato = new Contrato();
        $contrato->celebrarContrato();

        if(isset($_POST['contador']) && !empty($_POST['contador'])){
            $id_cliente = addslashes($_POST['cliente']);
            $id_contador = addslashes($_POST['contador']);
            //id do agente por padrao 2,  depois mudar pra receber id do agente pois ele eh que vai executar a accao
            $contrato->gerarLeituraEFacturaNoContrato($id_contador, $id_cliente, 2);

        }
        
    }




    /**
     * Cadastrar contadores
     */
    public function cadastrarContador(){
        $dados=array();
        $contador = new Contador();
        $dados = $contador->cadastrarContadores();

        echo json_encode($dados);
    }



    /**
     * Gerar codigo de barras
     */

     public function gerarBarcode(){
        $dados = array();
        $barcode = new Contador();
        $dados = $barcode->generateBarcode();
        
        echo json_encode($dados);
     }

    /**
     * Cadastrar agente
     */

    public function cadastrarAgent(){
        $agente = new Agente();
        $agente->cadastrarAgente();
    }




    /**
     * Cadastrar cliente
     */

    public function cadastrarClient(){
        $cliente = new Cliente();
        $cliente->cadastrarCliente();
    }


    /**
     * Adicionar permissoes
     */
    public function addPermisions(){
        $permissoes = new Permissions();
        if(isset($_POST['nomeperm']) && !empty($_POST['nomeperm'])){
            $nomeperm = addslashes($_POST['nomeperm']);
            $permissoes->addPerms($nomeperm);
        }
    }

    /**
     * remover permissoes
     */

    public function deletePermissions(){
       
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            $idpermparams=$_REQUEST['id'];
            $permissoes = new Permissions();
            $permissoes->deletePermis($idpermparams);

        }
     
    }

    /**
     * adicionar grupos de  permissoes
    */


    public function addPermissionsGroups(){

        if(isset($_POST['params']) && !empty($_POST['params'])){
            $params = $_POST['params'];
            $nomegroup = addslashes($_POST['nomegroup']);
            $groups = new Permissions();
            $groups->addPermGroups($nomegroup, $params);
        }
    }

    /**
     * remover grupos permissoes
    */

    public function deletePermissionsGroups(){

        $dados= array(
            "status"=>array()
        );

        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            $idpermgroups=$_REQUEST['id'];
            $permissoes = new Permissions();
            $dados['resp'] =  $permissoes->deletePermGroups($idpermgroups);
         
            echo json_encode($dados);
        }
     
    }

    /**
     * editar grupos de  permissoes
    */


    public function editPermissionsGroups(){

        if(isset($_POST['params']) && !empty($_POST['params'])){
            $params = $_POST['params'];
            $nomegroup = addslashes($_POST['nomegroup']);
            $idgroup = addslashes($_REQUEST['idgrupo']);
            $groups = new Permissions();
            $groups->editPermGroups($nomegroup, $params, $idgroup);
        }
    }



}
?>