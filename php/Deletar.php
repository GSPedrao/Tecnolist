<?php



 if(!empty($_GET['id'])){  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 

    include_once('conecao.php');

     $id = $_GET['id'];

     $sql_select = "SELECT * FROM chamado WHERE id_chamado = $id";

     $sql_result = $conn->query($sql_select);

     if($sql_result->num_rows > 0) {

        $sql_delete = "DELETE FROM chamado WHERE id_chamado = $id";
        $result_delete = $conn->query($sql_delete);

     }
 }
 header('Location: Lista.php');
 ?>