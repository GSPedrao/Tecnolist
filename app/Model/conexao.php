<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$dataBase = "tecnolist";

 // Varíavel de conexão com o banco
$conn = mysqli_connect($host, $usuario, $senha, $dataBase);

if($conn->connect_errno){
    echo "Falha na conexão: (" . $conn->connect_errno . ")" . $conn->connect_error;
}

    //conexão com PDO
    try{
    
        $cpdo = new PDO("mysql::host=$host;dbname=" . $dataBase, $usuario, $senha);
        
        //echo "Conexão do banco realizado com sucesso!";
    }catch(PDOException $err){
        echo "Erro: Conexão com banco de dados não foi realizado com sucesso!";
    }

?>