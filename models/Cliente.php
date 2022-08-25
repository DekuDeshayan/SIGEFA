<?php
class Cliente extends model{

     /*
      * Metodo de cadastro de clientes
      *@author Ralph Buraimo
      */

     public function cadastrarCliente(){

        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $perfil ="CLIENTE";//perfil default do cliente
            $id_permissions = 25;//grupo de permissoes default do cliente
            $nome = addslashes($_POST['nome']);
            $apelido = addslashes($_POST['apelido']);
            $sexo = addslashes($_POST['sexo']);
            $nacionalidade = addslashes($_POST['nacionalidade']);
            $data_nascimento = addslashes($_POST['data_nascimento']);
            $bi = addslashes($_POST['bi']);
            $nuit = addslashes($_POST['nuit']);
            $nr_casa = addslashes($_POST['nr_casa']);
            $quarteirao = addslashes($_POST['quarteirao']);
            $bairro = addslashes($_POST['bairro']);
            $cidade = addslashes($_POST['cidade']);
            $quarteirao = addslashes($_POST['quarteirao']);
            $cidade = addslashes($_POST['cidade']);
            $telefone1 = addslashes($_POST['telefone1']);
            $telefone2 = addslashes($_POST['telefone2']);
            $data_inicio = addslashes($_POST['data_inicio']);
            $username = addslashes($_POST['username']);
            $palavra_passe = addslashes($_POST['palavra_passe']);
            $email = addslashes($_POST['email']);

            //Inicio da transacao para insercao em tabelas distintas.
            $this->db->beginTransaction();


                //Insercao na tabela utilizador
                $sql=$this->db->prepare("INSERT INTO utilizador (username, email, palavra_passe, perfil, id_permissions) values(:username, :email, :palavra_passe,:perfil, :id_permissions) ");

                $sql->bindValue(":username",$username);
                $sql->bindValue(":email",$email);
                $sql->bindValue(":palavra_passe",MD5($palavra_passe));
                $sql->bindValue(":perfil",$perfil);
                $sql->bindValue(":id_permissions",$id_permissions);
                $sql->execute();
                $id_utilizador = $this->db->lastInsertId();//chave estrangeira que irá para tabela cliente de modo a identifica-lo como utilizador


                ////Insercao na tabela cliente
                $sql=$this->db->prepare("INSERT INTO cliente (nome, apelido, sexo, nacionalidade, data_nascimento, nuit, bi, nr_casa, quarteirao, bairro, cidade, telefone1, telefone2, data_inicio, id_utilizador)  values (:nome, :apelido, :sexo, :nacionalidade, :data_nascimento, :nuit, :bi, :nr_casa, :quarteirao, :bairro, :cidade, :telefone1, :telefone2, :data_inicio, :id_utilizador) ");

                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":apelido", $apelido);
                $sql->bindValue(":sexo", $sexo);
                $sql->bindValue(":nacionalidade", $nacionalidade);
                $sql->bindValue(":data_nascimento", $data_nascimento);
                $sql->bindValue(":nuit", $nuit);
                $sql->bindValue(":bi", $bi);
                $sql->bindValue(":nr_casa", $nr_casa);
                $sql->bindValue(":quarteirao", $quarteirao);
                $sql->bindValue(":bairro", $bairro);
                $sql->bindValue(":cidade", $cidade);
                $sql->bindValue(":telefone1", $telefone1);
                $sql->bindValue(":telefone2", $telefone2);
                $sql->bindValue(":data_inicio", $data_inicio);
                $sql->bindValue(":id_utilizador", $id_utilizador);
                $sql->execute();

            $this->db->commit();
            //Fim da transacao para insercao em tabelas distintas.
       

        }

     }



      /**
     * Metodo para busca de clientes
     */

    public function buscarCliente(){
        $array = array();

        $sql = $this->db->prepare("SELECT * from cliente");
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }

        return $array;

     }


     /**
      * Metodo de auxilio para buscar id do agente
      */

     public function pegarIdCliente($id_utilizador){
        $idcliente = 0;

        $sql=$this->db->prepare("SELECT idcliente from cliente WHERE id_utilizador =:id_utilizador");
        $sql->bindValue(":id_utilizador", $id_utilizador);
        $sql->execute();

        if($sql->rowCount()>0){
            $row = $sql->fetch();
            $idcliente = $row['idcliente'];
        }
        return $idcliente;
    }


 


}

?>























