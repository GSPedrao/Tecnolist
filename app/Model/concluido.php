<?php

 if(!empty($_GET['status']))  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 
 {
     include_once('conecao.php');

     $id = $_GET['status'];

     $sql_select = "SELECT * FROM chamado WHERE id_chamado = '$id'";

     $sql_result = $conn->query($sql_select);

     if($sql_result->num_rows > 0) {

        $sql_conclui = "UPDATE chamado SET `status` = 2 WHERE `status`";
        $result_delete = $conn->query($sql_conclui);

     }
 }
 header('Location: Lista.php');







?>