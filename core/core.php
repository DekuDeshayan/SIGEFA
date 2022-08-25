<?php
//A primeira coisa eh identificar oque o usuario acedeu
class Core{

    public function run(){

    

        $url=explode("index.php",$_SERVER['PHP_SELF']);
        $url =end($url);
        $params=array();
        if(!empty($url)){
            $url = explode('/',$url);
            array_shift($url);

            $currentController= $url[0]."Controller";

            if(!class_exists($currentController)){
                require_once 'notFound.php';
                exit;
            }

            array_shift($url);

            if(isset($url[0])){

                $currentAction = $url[0];

                array_shift($url);
            }else{
                $currentAction='index';
            }

            if(count($url)>0){
                $params=$url;
            }

        }else{
            $currentController="homeController";
            $currentAction='index';
        }



        require_once 'core/controller.php';

        $control= new $currentController();

        call_user_func_array(array($control,$currentAction),$params);


        /*
        if($currentAction!='index'){
                require_once 'notFound.php';
                exit;
            }else{
                require_once 'core/controller.php';

                $control= new $currentController();
        
                call_user_func_array(array($control,$currentAction),$params);

            }
        */


    }


}

?>