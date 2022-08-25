<?php
class Permissions extends model{

    private $group;
    private $permissions;

    public function setGroup($id){
        $this->group=$id;
        $this->permissions = array();
                                                                                            //id_permissions no utilizador   
        $sql=$this->db->prepare("SELECT params from permissions_groups WHERE idpermissions = :idpermissions");
        $sql->bindValue(":idpermissions",$id);
        $sql->execute();

        if($sql->rowCount()>0){
            $row = $sql->fetch();
            
            if(empty($row['params'])){
                $row['params'] = '0';
            }

            $idpermparams = $row['params'];

            $sql = $this->db->prepare("SELECT name FROM permissions_params where idpermissionsparams IN ($idpermparams)");
            $sql->execute();

            if($sql->rowCount()>0){
                foreach($sql->fetchAll() as $parametros){
                    $this->permissions[] = $parametros['name'];
                }
            }
        }
      
    }



    public function hasPermission($name){
        if(in_array($name, $this->permissions)){
            return true;
        }else{
            return false;
        }
    }


    /**
     * Pegar toda a lista de permissoes do sistema
     */

    public function getListaPermissoes(){

        $array = array();
        $sql=$this->db->prepare("SELECT * from permissions_params");
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }

        return $array;
    }


    /**
     * Pegar lista de grupos de permissoes
     * 
     */

    public function getListaGruposPermissoes(){
        $array = array();
        $sql=$this->db->prepare("SELECT * from permissions_groups");
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }

        return $array;

    }

    /**
     * Adicionar novas permissoes ao sistema
     * 
    */

    public function addPerms($nomeperm){
        $sql= $this->db->prepare("INSERT INTO permissions_params (name) values(:name)");
        $sql->bindValue(":name", $nomeperm);
        $sql->execute();
    }


    /**
     * Remover  permissoes do sistema
     * 
    */


    public function deletePermis($idpermparams){
        $sql=$this->db->prepare("DELETE  FROM permissions_params where idpermissionsparams =:idpermparams");
        $sql->bindValue(":idpermparams", $idpermparams);
        $sql->execute();
    }


    /**
     * Adicionar grupos de permissoes ao sistema
     * 
    */

    public function addPermGroups($nomegroup, $params){
        $parametros = implode(',',$params);
        $sql= $this->db->prepare("INSERT INTO permissions_groups (name, params) values (:name, :params)");
        $sql->bindValue(":name", $nomegroup);
        $sql->bindValue(":params", $parametros);
        $sql->execute();  
    } 


    /**
     * Remover  grupos de permissoes do sistema
     * 
    */


    public function deletePermGroups($idpermgroups){
        $array = array();
        $utilizadores = new Utilizador();
        $resposta = $utilizadores->existeAssociadoAoGrupo($idpermgroups);
        //resposta:false: nao existe nenhum associado ao grupo e podemos remover
        //resposta:true: existe pelo menos um associado ao grupo e nao podemos remover
       
        if($resposta==false){

            $sql=$this->db->prepare("DELETE  FROM permissions_groups where idpermissions =:idpermissions");
            $sql->bindValue(":idpermissions", $idpermgroups);
            $sql->execute();

            $array['resp'] = 'success';

        }elseif($resposta==true){

            $array['resp'] = 'error';

        }

        return $array;
       
    }


    /**
     * Remover  grupos de permissoes do sistema
     * 
    */

    public function getPermissionGroupToEdit($idpermgroup){
        $array = array();
        $sql=$this->db->prepare("SELECT * from permissions_groups where idpermissions=:idpermissions");
        $sql->bindValue(":idpermissions",$idpermgroup);
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetch();
            $array['params'] = explode(",", $array['params'] );
        }

        return $array;

    }


    public function editPermGroups($nomegroup, $params, $idgroup){
        $parametros = implode(',',$params);
        $sql= $this->db->prepare("UPDATE permissions_groups set name=:name, params=:params WHERE idpermissions=:idpermissions;");
        $sql->bindValue(":idpermissions", $idgroup);
        $sql->bindValue(":name", $nomegroup);
        $sql->bindValue(":params", $parametros);
        $sql->execute();  
    }






}