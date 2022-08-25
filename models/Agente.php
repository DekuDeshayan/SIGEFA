<?php
class Agente extends model{

     /*
      * Metodo de cadastro de agentes
      *@author Ralph Buraimo
      */

     public function cadastrarAgente(){

        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $perfil ="AGENTE";//perfil default do agente
            $id_permissions = 27;//grupo de permissoes default do agente
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
                $id_utilizador = $this->db->lastInsertId();//chave estrangeira que irá para tabela agente de modo a identifica-lo como utilizador


                ////Insercao na tabela agente
                $sql=$this->db->prepare("INSERT INTO agente (nome, apelido, sexo, nacionalidade, data_nascimento, nuit, bi, nr_casa, quarteirao, bairro, cidade, telefone1, telefone2, data_inicio, id_utilizador)  values (:nome, :apelido, :sexo, :nacionalidade, :data_nascimento, :nuit, :bi, :nr_casa, :quarteirao, :bairro, :cidade, :telefone1, :telefone2, :data_inicio, :id_utilizador) ");

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



     public function pegarIdAgente($id_utilizador){
         $idagente = 0;

         $sql=$this->db->prepare("SELECT idagente from agente WHERE id_utilizador =:id_utilizador");
         $sql->bindValue(":id_utilizador", $id_utilizador);
         $sql->execute();

         if($sql->rowCount()>0){
             $row = $sql->fetch();
             $idagente = $row['idagente'];
         }
         return $idagente;
     }

 


}

?>























