<?php
class Contador extends model{





    public function generateBarcode(){

        $array = array();

        if(isset($_POST['numerocontador'])){
            require ('libraries/barcode-generator/vendor/autoload.php');
            $redColor = [255, 0, 0];
            $generator = new Picqer\Barcode\BarcodeGeneratorJPG(); // Pixel based JPG
            $numerocontador = $_POST['numerocontador'];
            $array['barcode'] = '<center><img src="data:image/png;base64,' . base64_encode($generator->getBarcode($numerocontador, $generator::TYPE_CODE_128,1, 80)) . '"></center><center><span>'.$numerocontador.'</span></center>';
            $array['printUrl'] = "<button onclick='window.print()' id='imprimirBarcode' class='btn btn-sm btn-success hide-on-print'><i class='fa fa-print' aria-hidden='true'></i> Imprimir</button>";
        }

        return $array;
    }


    /**
     * Verificar existencia de contador
     */


    public function verificarExistenciadeContador($nr_contador){

        $array = array();
    
        $sql = $this->db->prepare("SELECT nr_contador from contador where nr_contador =:nr_contador");
        $sql->bindValue(":nr_contador", $nr_contador);
        $sql->execute();
        
        if($sql->rowCount()>0){
            $array['response']="exists";//existe
        }else{
            $array['response']="not_exists";
        }
        return $array;
      }

  
    
    /**
     * Metodo para cadastro de contadores
     */

    public function cadastrarContadores(){
        $array= array();
        $verificar=array();
                
        if(isset($_POST['numerocontador']) && !empty($_POST['numerocontador'])){
            $nr_contador = addslashes($_POST['numerocontador']);

            $verificar = $this->verificarExistenciadeContador($nr_contador);


            if($verificar['response']=="not_exists"){

                $sql= $this->db->prepare("INSERT INTO contador (nr_contador) VALUES (:nr_contador)");
                $sql->bindValue(":nr_contador", $nr_contador);
                $sql->execute();

                $array['info'] = "not_exists";
            }elseif($verificar['response']=="exists"){
                
                $array['info'] = "exists";

            }

           

        }


        return $array;
     
    }


    /**
     * Metodo para busca de contadores que nao estao associados a nenhum cliente(contrato nao foi ainda celebrado)
     */

     public function buscarContadorSemContrato(){
        $array = array();

        $sql = $this->db->prepare("SELECT * from contador where idcontador not in (select id_contador from contrato)");
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }

        return $array;

     }




}

?>























