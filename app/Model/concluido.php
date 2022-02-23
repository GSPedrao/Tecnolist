<?php

 if(!empty($_GET['status']))  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 
 {
     include_once('conexao.php'); // Inclui a conexão

     $id_chamado = $_GET['status']; // variável recebe o GET

     // Faz um update no status do chamado alterando para 2 e inserindo o horário/data de agora
     $update = "UPDATE chamado SET `status` = 2, data_fechamento = NOW() WHERE id_chamado = '$id_chamado' ";

     // Faz uma consulta no update
     if($query = $conn->query($update)){ 
         // Variavel global com mensagem de erro
         header('Location: ../View/pages/Lista.php'); // Volta para Lista
     }else{
         // Variavel global com mensagem de erro
         header('Location: ../View/pages/Lista.php'); // Volta para Lista
     }
    
 }
