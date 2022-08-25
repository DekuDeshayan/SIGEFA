<?php
 class loginController extends controller {

    public function index(){
        $dados=array();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email=addslashes($_POST['email']);
            $palavra_passe=addslashes($_POST['palavra_passe']);
            
            $utilizador = new Utilizador();
            if($utilizador->doLogin($email,$palavra_passe)){
                header("location: ".BASE_URL);
				exit;
            }else{
                $dados['erro']='Usuário ou Senha Incorretas!';
            }
        }

        $this->loadView('login',$dados);
    }
   
    
 }
?>

