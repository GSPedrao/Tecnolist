<?php

 if(!empty($_GET['status']))  //$_GET um array associativo que trata os dados recebidos através de HTTP, recebe os dados depois do '?' 
 {
     include_once('conexao.php');

     $id_chamado = $_GET['status'];

     $update = "UPDATE chamado SET `status` = 2, data_fechamento = NOW() WHERE id_chamado = '$id_chamado' ";

     if($query = $conn->query($update)){
         echo "Deu Bom";    
         header('Location: ../View/pages/Lista.php');
     }else{
         echo "Deu ruin";
         header('Location: ../View/pages/Lista.php');
     }
    
 }
