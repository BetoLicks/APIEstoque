<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set("America/Sao_Paulo");

require_once "classes/Estoque.php";

class Rest{
   public static function abrirUrl($req){
      $path = explode('/', $req['path']);
      $classe = $path[0];
      array_shift($path);
      $metodo = $path[0];
      array_shift($path);
      $parametros = array();
      $parametros = $path;

      try{
         if (class_exists($classe)){
            if (method_exists($classe,$metodo)){
               $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);         
               return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
            } else {
               return json_encode(array('status' => 'erro', 'dados' => 'Método existente.'));
            }
         } else {
            return json_encode(array('status' => 'erro', 'dados' => 'Classe existente.'));
         }   
      } catch (Exception $erro){
         return json_encode(array('status' => 'erro', 'dados' => $erro->getMessage()));
      }
   }
}

if (isset($_REQUEST)){
   echo Rest::abrirUrl($_REQUEST);
}













/// https://www.youtube.com/watch?v=pa6QwLWG12Q