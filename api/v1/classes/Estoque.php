<?php

class Estoque{
   public static function mostrar(){
      $conexao = new PDO('mysql: host=localhost; dbname=apiestoque;','root','');
      $sql = "SELECT * FROM tab_estoque ORDER BY est_codigo";
      $sql = $conexao->prepare($sql);
      $sql->execute();
      $produtos = array();
      while($linhas = $sql->fetch(PDO::FETCH_ASSOC)){
         $produtos[] = $linhas;
      }

      if (!$produtos){
         throw new Exception("Estoque de produtos vazio.");
      } else {
         return $produtos;
      }
   }
}