<?php

 if(!empty($_GET['id'])){  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 

    include_once('conexao.php'); // Inclui a conexão

     $id = $_GET['id']; // Variável recebe o Get

     // Seleciona todos de usuario onde id = get[id]
     $sql_select = "SELECT * FROM usuario WHERE id_usuario = $id";

     $sql_result = $conn->query($sql_select); // Faz uma busca pelo BD

     if($sql_result->num_rows > 0) { // Se houver algo

      // Deleta usuario onde id = get[id]
        $sql_delete = "DELETE FROM usuario WHERE id_usuario = $id"; 
        $result_delete = $conn->query($sql_delete);

     }
 }
 header('Location: ../View/pages/Gusuarios.php'); // Volta para Gerenciar usuarios
 ?>