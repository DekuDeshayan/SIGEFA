<?php
class Contrato extends model{

  
    
    /**
     * Metodo para abertura de contratos
     */

    public function celebrarContrato(){

        if(isset($_POST['cliente']) && !empty($_POST['cliente']) && isset($_POST['contador']) && !empty($_POST['contador'])){

            $id_cliente = addslashes($_POST['cliente']);
            $id_contador = addslashes($_POST['contador']);
            $cidade = addslashes($_POST['cidade']);
            $nr_casa = addslashes($_POST['nr_casa']);
            $avenida = addslashes($_POST['avenida']);
            $bairro = addslashes($_POST['bairro']);
            $quarteirao = addslashes($_POST['quarteirao']);

            $id_agente = $_SESSION['id_userlogado'];

            
    
            $this->db->beginTransaction();

                $sql = $this->db->prepare("INSERT INTO endereco_do_contrato (nr_casa, quarteirao, bairro, avenida, cidade) values (:nr_casa, :quarteirao, :bairro, :avenida, :cidade) ");

                $sql->bindValue(":nr_casa", $nr_casa);
                $sql->bindValue(":quarteirao", $quarteirao);
                $sql->bindValue(":bairro", $bairro);
                $sql->bindValue(":avenida", $avenida);
                $sql->bindValue(":cidade", $cidade);
                $sql->execute();
                $id_endereco = $this->db->lastInsertId();//chave estrangeira do endereco do contrato que viajará para o contrato
        
                $sql = $this->db->prepare("INSERT INTO contrato(data_inicio,id_cliente, id_contador, id_endereco) values (CURDATE(),:id_cliente, :id_contador, :id_endereco)");
            
                $sql->bindValue(":id_cliente", $id_cliente);
                $sql->bindValue(":id_contador", $id_contador);
                $sql->bindValue(":id_endereco", $id_endereco);
                $sql->execute();


            $this->db->commit();

            


        }

    }




    public function gerarLeituraEFacturaNoContrato($id_contador, $id_cliente, $id_agente){

         //atribuicao de uma factura na abertura de um contrato
         $row=array();
         $fatura = new Fatura();

         //insercao de uma leitura
         $fatura->atribuirLeituraNocontrato($id_agente, $id_contador,1);

         //busca de ultima leitura nao associada  a nenhum contador de modo que se possa  atribuir a esta abertura de contrato
         $sql= $this->db->prepare("SELECT * from leitura where idleitura not in (SELECT id_leitura from factura) and id_contador=:id_contador  ORDER BY leitura DESC limit 1");
         $sql->bindvalue(":id_contador", $id_contador);
         $sql->execute();

         if($sql->rowCount()>0){
             $row = $sql->fetch();
             $ultima_n_associada_id = $row['idleitura'];
     
             $fatura->emitirFaturaNocontrato(60, 0, 1, $ultima_n_associada_id, $id_cliente);

             echo $ultima_n_associada_id."ok";
         }

        
    }


    



}

?>























