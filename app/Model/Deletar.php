<?php


 if(!empty($_GET['id'])){  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 

    include_once('conexao.php'); // Inclui a conexão

     $id = $_GET['id']; // Variável recebe o Get

     // Seleciona todos do chamando onde id = get[id]
     $sql_select = "SELECT * FROM chamado WHERE id_chamado = $id";

     $sql_result = $conn->query($sql_select); // Faz uma busca na Variável

     if($sql_result->num_rows > 0) { // Se receber algo

      // Delete chamado onde id = get[id]
        $sql_delete = "DELETE FROM chamado WHERE id_chamado = $id";
        $result_delete = $conn->query($sql_delete);

     }
 }
      // Se for técnico Vai para Lista, se nao Hchamado
      if($_SESSION['ativo'] == 2){
         header('Location: ../View/pages/Lista.php');
      }else{
         header('location: ../View/pages/Hchamado.php');
      }
 ?>