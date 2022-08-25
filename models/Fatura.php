<?php
class Fatura extends model{

     //metodo auxiliar que pega numero de contador o qual sera registado uma leitura
     private function pegarIdContador($nr_contador){

        $array = array();
        $array['response']="not_empty";

        $sql = $this->db->prepare("SELECT * from contador where nr_contador =:nr_contador");
        $sql->bindValue(":nr_contador", $nr_contador);
        $sql->execute();
        
        if($sql->rowCount()>0){
            $row=$sql->fetch();
            $array['idcontador'] = $row['idcontador'];
        }else{
            $array['response'] = "empty";
        }
        return $array;
      }


    
      

     
    /*

    sql -busca de ultima leitura de contador associada a a ultima factura 

    SELECT l.leitura from leitura as l join factura as f on f.id_leitura = l.idleitura where l.id_contador=1 order by l.leitura DESC limit 1; lti

    sql- busca de  ultima leitura de contador nao associada a a nenhuma fatura

    SELECT leitura from leitura where idleitura not in (SELECT id_leitura from factura) ORDER BY leitura DESC limit 1;


    pegar um cliente e contrato via idcontador para associar a factura no submit event...
    select con.*, cli.nome,cli.apelido, cont.* from contrato con join cliente cli on cli.idcliente = con.id_cliente join contador cont on cont.idcontador = con.id_contador where cont.idcontador =1; 


    */





     public function buscarDadosPraFaturar($nr_contador){
            $array = array();
            $dadosIdContador = array();
            //metodo auxiliar para chamar id do contador em causa
            $dadosIdContador = $this->pegarIdContador($nr_contador);

            if($dadosIdContador['response']=='empty'){
                $array['resultado'] ='void';
            }else{
                
                $id_contador = $dadosIdContador['idcontador'];
           


                //busca de ultima leitura de contador associada a uma factura de modo que se faca a diferenca para gerar  consumo
                $sql1= $this->db->prepare("SELECT l.leitura from
                                            leitura as l join factura as f 
                                            on f.id_leitura = l.idleitura 
                                            where l.id_contador = :id_contador
                                            order by l.leitura DESC limit 1");
                $sql1->bindvalue(":id_contador", $id_contador);
                $sql1->execute();

                if($sql1->rowCount()>0){
                    $row = $sql1->fetch();
                    $array['ultima_associada'] = $row['leitura'];
                }


                // busca de  ultima leitura de contador nao associada a nenhuma fatura de modo que se possa gerar uma nova factura da mesma(leitura)

                $sql2= $this->db->prepare("SELECT leitura,idleitura from leitura where idleitura not in (SELECT id_leitura from factura) and id_contador=:id_contador  ORDER BY leitura DESC limit 1");
                $sql2->bindvalue(":id_contador", $id_contador);
                $sql2->execute();

                if($sql2->rowCount()>0){
                    $row2 = $sql2->fetch();
                    $array['ultima_n_associada'] = $row2['leitura'];
                    $array['ultima_n_associada_id'] = $row2['idleitura'];
                }

                //idcontrato 	data_inicio 	id_cliente 	id_contador 	id_enderec
                //pegar um cliente e seu contrato via idcontador para associar a factura no submit event...
                //endereco 	nr_casa 	quarteirao 	bairro 	avenida 	cidade 	
                $sql3 = $this->db->prepare("SELECT contra.idcontrato, contra.data_inicio as contraDataInic, cli.idcliente, cli.nome, cli.nuit, cli.apelido, cli.bairro as cliBairro, cli.nr_casa as cliNrcasa, cli.quarteirao as cliQuarte, cli.data_inicio as cliDataInic, cli.telefone1, contad.nr_contador, contad.idcontador, endcontr.nr_casa as endcontrNrcasa, endcontr.quarteirao as endcontrQuarte, endcontr.bairro as endcontrBairro, endcontr.avenida, endcontr.cidade from
                                            contrato as contra 
                                            join cliente as cli
                                            on cli.idcliente = contra.id_cliente 
                                            join contador as contad 
                                            on contad.idcontador = contra.id_contador
                                            join endereco_do_contrato as endcontr
                                            on endcontr.idendereco = contra.id_endereco
                                            where contad.idcontador =:id_contador");
                 $sql3->bindvalue(":id_contador", $id_contador);
                 $sql3->execute();
 
                 if($sql3->rowCount()>0){
                    $array['info_cliente_contrato']  = $sql3->fetch();
                 }


            }


            return $array;

        }

       
    
    



    /*
     * Metodo para emissão de faturas
     */

     
     public function emitirFatura($valorPagar, $leitura_anterior, $consumo, $id_leitura, $id_cliente ){
           
        $sql = $this->db->prepare("INSERT INTO factura (valor_pagar, data_emissao, data_limite, leitura_anterior, consumo,id_leitura, id_cliente) values (:valor_pagar, curdate(), adddate(curdate(),14), :leitura_anterior, :consumo, :id_leitura, :id_cliente)");

        $sql->bindValue(":valor_pagar",$valorPagar);
        $sql->bindValue(":leitura_anterior",$leitura_anterior);
        $sql->bindValue(":consumo",$consumo);
        $sql->bindValue(":id_leitura",$id_leitura);
        $sql->bindValue(":id_cliente",$id_cliente);
        $sql->execute();
     }



    
    
    /**
     * Metodo para registo de leituras
     */

     public function registarLeituraContador($id_agente){
        
        $id_cont=array();
        
        if(isset($_POST['nr_contador']) && !empty($_POST['nr_contador'])){

            $nr_contador = addslashes($_POST['nr_contador']);
            $leitura = addslashes($_POST['leitura']);
            $id_cont = $this->pegarIdContador($nr_contador);
            $id_contador = $id_cont['idcontador'];


            $sql = $this->db->prepare("INSERT INTO leitura (leitura, data_leitura, id_agente, id_contador) values (:leitura, CURDATE(), :id_agente, :id_contador)");
            $sql->bindValue(":leitura", $leitura);
            $sql->bindValue(":id_agente", $id_agente);
            $sql->bindValue(":id_contador", $id_contador);
            $sql->execute();

        }

      }

     

     /**
      * Metodo que atribui uma leitura na abertura de contrato
      */

      public function atribuirLeituraNocontrato($id_agente, $id_contador, $leitura){

        $sql = $this->db->prepare("INSERT INTO leitura (leitura, data_leitura, id_agente, id_contador) values (:leitura, CURDATE(), :id_agente, :id_contador)");
        $sql->bindValue(":leitura", $leitura);
        $sql->bindValue(":id_agente", $id_agente);
        $sql->bindValue(":id_contador", $id_contador);
        $sql->execute();

    
     }

     /**
      * Metodo que gera  uma factura paga na abertura de contrato
      */

     public function emitirFaturaNocontrato($valorPagar, $leitura_anterior, $consumo, $id_leitura, $id_cliente){
           
        $sql = $this->db->prepare("INSERT INTO factura (valor_pagar, data_emissao, data_limite, leitura_anterior, consumo,id_leitura, id_cliente,status_pagamento) values (:valor_pagar, curdate(), adddate(curdate(),0), :leitura_anterior, :consumo, :id_leitura, :id_cliente, 1)");

        $sql->bindValue(":valor_pagar",$valorPagar);
        $sql->bindValue(":leitura_anterior",$leitura_anterior);
        $sql->bindValue(":consumo",$consumo);
        $sql->bindValue(":id_leitura",$id_leitura);
        $sql->bindValue(":id_cliente",$id_cliente);
        $sql->execute();
     }




    //VIEWS

    public function visualizarfacturas($id_cliente){
        $array = array();
        $sql= $this->db->prepare("SELECT * FROM factura WHERE id_cliente = :id_cliente");
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->execute();


        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    /**
     * Metodo para pegar uma factura especifica de um cliente para que se possa gerar o seu pdf ou efectuar o pagamento
     */


    public function pegarFacturaPorId($idfactura){
        $array = array();
        $sql= $this->db->prepare("SELECT * FROM factura WHERE idfactura = :idfactura");
        $sql->bindValue(":idfactura", $idfactura);
        $sql->execute();


        if($sql->rowCount()>0){
            $array = $sql->fetch();
        }

        return $array;
    }

    
	
     /**
     * METODO QUE PEGA A LEITURA  ACTUAL E O RESPECTIVO CONTADOR
     */


    private function pegarleitura($idleitura){
        $resultado=array();
        $sql = $this->db->prepare("SELECT leitura, idleitura, id_contador from leitura where idleitura =:idleitura");
        $sql->bindValue(":idleitura", $idleitura);
        $sql->execute();

        if($sql->rowCount()>0){
            $row = $sql->fetch();
            $resultado['leitura'] = $row['leitura'];
            $resultado['id_contador'] = $row['id_contador'];
                
         }


         return $resultado; 
    }



    private function pegarDadosDoClienteEContrato($idcontador){
        $array = array();
        $sql3 = $this->db->prepare("SELECT contra.idcontrato, contra.data_inicio as contraDataInic, cli.idcliente, cli.nome, cli.nuit, cli.apelido, cli.bairro as cliBairro, cli.nr_casa as cliNrcasa, cli.quarteirao as cliQuarte, cli.data_inicio as cliDataInic, cli.telefone1, contad.nr_contador, contad.idcontador, endcontr.nr_casa as endcontrNrcasa, endcontr.quarteirao as endcontrQuarte, endcontr.bairro as endcontrBairro, endcontr.avenida, endcontr.cidade from
                                    contrato as contra 
                                    join cliente as cli
                                    on cli.idcliente = contra.id_cliente 
                                    join contador as contad 
                                    on contad.idcontador = contra.id_contador
                                    join endereco_do_contrato as endcontr
                                    on endcontr.idendereco = contra.id_endereco
                                    where contad.idcontador =:id_contador");
        $sql3->bindvalue(":id_contador", $idcontador);
        $sql3->execute();

        if($sql3->rowCount()>0){
            $array = $sql3->fetch();
        }

        return $array;

    }


     /**
     * METODO QUE GERA PDF DE FACTURAS
     */


    

    /**
     * METODO QUE GERA PDF DE FACTURAS
     */


     public function gerarPDFfactura($idfactura){
        
        $factura = array();
        $leitura = array();
        $info_cliente_contrato = array();

        $factura = $this->pegarFacturaPorId($idfactura);

        $leitura = $this->pegarleitura($factura['id_leitura']);

        $info_cliente_contrato = $this->pegarDadosDoClienteEContrato($leitura['id_contador']);

       
      
         //chamada do ficheiro contendo a classe classe fpdf
         require ('libraries/fpdf/fpdf.php');

         $pdf = new FPDF('P','mm','A4');
         $pdf->AddPage();
         $pdf->SetTitle(utf8_decode("Factura de água"));
 
         //primeira fileira superior
         $pdf->SetFont('Arial','B',30);
         $pdf->Cell(10,5,utf8_decode('FACTURA'));
         $pdf->Image(BASE_URL. '/assets/images/faucet2.png', 160,10,30,30);
         $pdf->Ln(10);

         //dados da empresa
         $pdf->SetFont('Arial','B',10);
         $pdf->Cell(20,5, "Empresa",0,1,"L");

         $pdf->SetFont('Arial','B',10);
         $pdf->Cell(20,5, utf8_decode("Furo água da vida, Inc."),0,1,"L");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(20,5, utf8_decode("Matola, Machava Bedene"),0,1,"L");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(20,5, utf8_decode("Avenida 3 de fevereiro, quarteirao 678"),0,1,"L");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(20,5, utf8_decode("Cell- (258) 84xxxxxxxx"),0,1,"L");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(20,5, utf8_decode("EMAIL- jonaschivite@sigefa.com"),0,1,"L");
         //fim da primeira fileira


         $pdf->Ln(10);//salto para segunda fileira
       
         $pdf->SetFont('Arial','B',15);
         $pdf->Cell(60,5, utf8_decode("Dados do contrato"),0,1,"L");

         $pdf->Ln(5);//espacamento

         $pdf->SetFont('Arial','B',10);
         $pdf->Cell(60,5, utf8_decode("Cliente"),"BTL",0,"L");

         $pdf->SetFont('Arial','B',10);
         $pdf->Cell(60,5, utf8_decode("Contador"),"BT",0,"L");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(70,5, utf8_decode("Endereco do contrato"),"BTR",0,"L");
                
         

         $pdf->Ln(5);//salto de cada linha dos detalhes

         $pdf->SetFont('Arial','',10);
         
         $pdf->Cell(60,5, utf8_decode("Nome: ".$info_cliente_contrato['nome']),0,0,"L");

         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Nr: ".$info_cliente_contrato['nr_contador']),0,0,"L");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(60,5, utf8_decode("Bairro: ".$info_cliente_contrato['endcontrBairro'].", ".$info_cliente_contrato['avenida']),0,0,"L");

         $pdf->Ln(5);//salto de cada linha dos detalhes

         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Apelido: ".$info_cliente_contrato['apelido']),0,0,"L");
         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Inicio do contrato: ".$info_cliente_contrato['contraDataInic']),0,0,"L");
         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(60,5, utf8_decode("Quarteirao: ".$info_cliente_contrato['endcontrQuarte']),0,0,"L");

         $pdf->Ln(5);//salto de cada linha dos detalhes

         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Nuit: ".$info_cliente_contrato['nuit']),0,0,"L");
         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Contrato Nr: ".$info_cliente_contrato['idcontrato']),0,0,"L");
         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(60,5, utf8_decode("Cidade: ".$info_cliente_contrato['cidade']),0,0,"L");

         
         $pdf->Ln(5);//salto de cada linha dos detalhes

         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode("Telefone #(+258)".$info_cliente_contrato['telefone1']),0,0,"L");
         $pdf->SetFont('Arial','',10);
         $pdf->Cell(60,5, utf8_decode(""),0,0,"L");
         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(60,5, utf8_decode("Casa Nr: ".$info_cliente_contrato['endcontrNrcasa']),0,0,"L");




        //fim da segunda fileira

     
         $pdf->Ln(30);//salto para terceira fileira

      
         // terceira fileira 
         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(40,10, utf8_decode("Factura Número"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(45,10, utf8_decode("Leitura anterior m³"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("Leitura atual m³"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("preco unitario"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("Consumo m³"),1,0,"C");

         $pdf->Ln(10);//salto para quarta fileira

         //info da base de dados
         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(40,10, utf8_decode($factura['idfactura']),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(45,10, utf8_decode($factura['leitura_anterior']),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10, utf8_decode($leitura['leitura']),1,0,"C"); // criar um metodo buscar leitura por idleitura que se encontrara na mesma factura...

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10, utf8_decode(60),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10, utf8_decode($factura['consumo']),1,0,"C");
         //fim da terceira fileira


         $pdf->Ln(20);//salto para quarta fileira


        //querta fileira
         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(40,10, utf8_decode("Data de emissão"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(45,10, utf8_decode("Data limite de pagamento"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("Valor a pagar"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("Multa"),1,0,"C");

         $pdf->SetFont('Arial',"B",10);
         $pdf->Cell(35,10, utf8_decode("Total a pagar"),1,0,"C");

         //dados da bd

         $pdf->Ln(10);//salto para quarta fileira

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(40,10, utf8_decode($factura['data_emissao']),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(45,10, utf8_decode($factura['data_limite']),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10,utf8_decode(number_format($factura['valor_pagar'], 2)." MZN"),1,0,"C");

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10, utf8_decode(0.0),1,0,"C"); // rever as multas

         $pdf->SetFont('Arial',"",10);
         $pdf->Cell(35,10, utf8_decode(number_format($factura['valor_pagar']+0, 2)." MZN"),1,0,"C");
         //fim da querta fileira



         $pdf->Output('D',uniqid('factura_').'.pdf');//impressao da factura: concatenar o nome da factura com o nome do cliente


     }


     /**
      * Metodo que pega detalhes de pagamento
      */
     public function pegardetalhesParaPagamento($idfactura){

        $factura = array();
        $leitura = array();
        $info_cliente_contrato = array();

        $factura = $this->pegarFacturaPorId($idfactura);

        $leitura = $this->pegarleitura($factura['id_leitura']);

        $info_cliente_contrato = $this->pegarDadosDoClienteEContrato($leitura['id_contador']);


        return $info_cliente_contrato;
     }

     /**
      * Metodo que efectua pagamentos via mpesa
      */


     public function efectuarPagamentodefactura($id_factura){
        $id_metodopag = 1; //mpesa
        $sql = $this->db->prepare("INSERT INTO pagamento (data_pagamento, id_factura, id_metodopag) VALUES (CURDATE(), :id_factura, :id_metodopag)");
        $sql->bindValue(":id_factura",$id_factura);
        $sql->bindValue(":id_metodopag",$id_metodopag);
        $sql->execute();

        $sql2 = $this->db->prepare("UPDATE factura SET status_pagamento = 1 WHERE idfactura = :idfactura");
        $sql2->bindValue(":idfactura", $id_factura);
        $sql2->execute();
        
    }



    





}


?>























