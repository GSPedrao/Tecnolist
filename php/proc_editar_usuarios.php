<?php
// Inicia a sessão
session_start();
//Limpa o buffer evitando problemas de redirecionamento
ob_start();
// Incluir conexão
include_once('conecao.php');
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
     header("location: Gusuarios.php");


} else {
    // Variavel global com mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario não foi possível editar</p>";
    // Redirecionamento
    header("location: Gusuarios.php");
}
