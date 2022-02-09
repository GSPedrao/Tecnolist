<?php
session_start();    

include_once('conecao.php');

if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de Usuarios</h1>

    <?php
    // Verificar se existe a mensagem
    if (isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }



    //Recuperar os usuarios do banco de dados
    $query_usuario = "SELECT id_usuario, nome, ativo FROM usuario ORDER BY id_usuario DESC";
    //preparando a query
    $result_usuario = $cpdo->prepare($query_usuario);
    //executa a query
    $result_usuario->execute();
 

    //inicio do form
    echo "<form method='POST' action='form_editar_usuarios.php'>";

    //Ler os registros retornados do BD
    while($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) { //atribui o valor a matriz associativa
        //var_dump($row_usuario);
        extract($row_usuario); //(facilita, não precisa concatenar)
        echo "<input type='checkbox' name='usuario[$id_usuario]' value='$id_usuario'>";
        echo "ID: $id_usuario <br>";
        echo "Nome: $nome <br>";
        if($ativo == 1){
            echo "Status: Ativo";  
        }else{
            echo "Status: Inativo";
        } 
        echo "<hr>";
    }

    echo "<input type='submit'  value='Editar' name='editUsuarios'>";

    echo "</form>"; //fim do form
    ?>
    

</body>

</html>