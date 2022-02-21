<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar usuarios</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/Gusuarios.css">
</head>


<body>
    <header style="background-color: #97BFEA"></header>
    <h1>Lista de Usuarios</h1>

    <div class="container">
    </div>

<?php
// Inicia a sessão
session_start();
//Limpa o buffer evitando problemas de redirecionamento
ob_start();
// Incluir conexão
include_once('conexao.php');
// Receber os dados do form_editar_usuarios.php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

// Verificar se usuario clicou no botão
if (!empty($dados['editUsuarios'])) {

    //Ler os dados do formulário
    foreach ($dados['id_usuario'] as $chave => $id_usuario) { //chave recupera id_usuario
        /*echo "Chave: $chave <br>";
        echo "ID: " . $dados['id_usuario'][$chave] . "<br>";
        echo "Nome: " . $dados['nome'][$chave] . "<br>";
        echo "Status: " . $dados['ativo'][$chave] . "<br>";
        echo "<hr>";*/

        // Criar a Query editar no BD
        $query_usuario = "UPDATE usuario SET nome=:nome, ativo=:ativo WHERE id_usuario=:id_usuario";
        // Preparar a query
        $edit_usuario = $cpdo->prepare($query_usuario);
        // Substituir os links pelos valores que vem do formulário
        $edit_usuario->bindParam(':id_usuario', $dados['id_usuario'][$chave]);
        $edit_usuario->bindParam(':nome', $dados['nome'][$chave]);
        $edit_usuario->bindParam(':ativo', $dados['ativo'][$chave]);

        //Executar a query
       $edit_usuario->execute(); 
    }

     // Variavel global com mensagem de erro
     $_SESSION['msg'] = "<p style='color: green;'>Erro: Usuario editado com sucesso</p>";
     // Redirecionamento
     header("location: ../View/pages/Gusuarios.php");


} else {
    // Variavel global com mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario não foi possível editar</p>";
    // Redirecionamento
    header("location: ../View/pages/Gusuarios.php");
}
