<?php

 if(!empty($_GET['id'])){  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 

    include_once('conexao.php');

     $id = $_GET['id'];

     $sql_select = "SELECT * FROM usuario WHERE id_usuario = $id";

     $sql_result = $conn->query($sql_select);

     if($sql_result->num_rows > 0) {

        $sql_delete = "DELETE FROM usuario WHERE id_usuario = $id";
        $result_delete = $conn->query($sql_delete);

     }
 }
 header('Location: ../View/pages/Gusuarios.php');
 ?>