<?php
class Utilizador extends model{

    private $info;
    private $permissions;
    
    /*
    *Metodo que verifica se utilizador está logado
    *
    */
    public function isLogged(){
        if( isset($_SESSION['id_userlogado']) && !empty($_SESSION['id_userlogado'])){
            return true;
        }else{
            return false;
        }
    }

    /*
    *Metodo efectuar login
    *
    */
    public function doLogin ($email, $palavra_passe){
        $sql=$this->db->prepare("SELECT * FROM utilizador WHERE email = :email AND palavra_passe = :palavra_passe");
        $sql->bindValue(":email",$email);
        $sql->bindValue(":palavra_passe",md5($palavra_passe));
        $sql->execute();

        if($sql->rowCount()>0){
            $row=$sql->fetch();
            $_SESSION['id_userlogado']=$row['idutilizador'];
            return true;
        }else{
            return false;
        }
    }


     /*
    *Metodo para setar o utilizador logado
    *
    */
    public function setLoggedUser($iduser){
        $sql=$this->db->prepare("SELECT * FROM utilizador where idutilizador = :idutilizador");
        $sql->bindValue(":idutilizador",$iduser);
        $sql->execute();

        if($sql->rowCount()>0){
            $this->info = $sql->fetch();
            $this->permissions = new Permissions();
            $this->permissions->setGroup($this->info['id_permissions']);
        }
    }


    /*
    *Metodo para pegar o utilizador logado
    *
    */

    public function getLoggedUser(){
        return $this->info['username'];
    }


    /*
    *Metodo para verificar se o utilizador logado tem determinadas permissoes
    *Parâmetros $name = string=nome da permissao
    *
    */
    public function hasPermission($name){
        return $this->permissions->hasPermission($name);
    }


    /*
    *Metodo auxiliar para verificar se um grupo de utilizadores esta associado a um ou mais utilizadores antes de o eliminar, pois nao se elimina grupos associados a utilizadores.
    *Parâmetros $id_permissions = id do grupo da permissao
    *
    */

    public function existeAssociadoAoGrupo($id_permissions){
        $sql=$this->db->prepare("SELECT COUNT(*) AS associados FROM utilizador WHERE id_permissions = :id_permissions");
        $sql->bindValue(":id_permissions",$id_permissions);
        $sql->execute();
        $row = $sql->fetch();

        if($row['associados']==0){
            return false;
        }
        return true;
    }











   /*
    *Metodo para pegar efectuar logout
    *
    */

    public function dologout(){
        unset($_SESSION['id_userlogado']);
    }





}

?>























