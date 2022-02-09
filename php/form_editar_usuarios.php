<?php
// Inicia a sessão
session_start();
//Limpa o buffer evitando problemas de redirecionamento
ob_start();

include_once('conecao.php');

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

if(!empty($dados['usuario'])){
    // Recuperar os ID dos usuarios e converter em uma string
    $valor_pesq = implode(", ", $dados['usuario']);
    //var_dump($valor_pesq);

    // Recuperar os usuarios do banco de dados
   $query_usuario = "SELECT id_usuario, nome, ativo FROM usuario 
        WHERE id_usuario IN ($valor_pesq) ORDER BY id_usuario DESC";

    $result_usuario = $cpdo->prepare($query_usuario); // Preparando a query
    $result_usuario->execute(); // Executa a query

        echo "<h1>Editar os usuarios</h1>";

        // Inicio do form
        echo "<form method='POST' action='proc_editar_usuarios.php'>";

     // Ler os registros retornados do BD
    while($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) { // Atribui o valor a matriz associativa
        //var_dump($row_usuarios);
        extract($row_usuario);
        echo "<input type='hidden' name='id_usuario[]' value='$id_usuario'> <br><br>";
        echo "Nome: <input type='text' name='nome[]' value='$nome' placeholder='Nome do usuario'> <br><br>";
        if($ativo == 1) {
            echo "Status: <select name='ativo[]' value='$ativo'>";
            echo "<option value='1' selected>Ativo</option>";
            echo "<option value='2'>Inativo</option></select>";
        }else{
            echo "Status: <select name='ativo[]' value='$ativo'>";
            echo "<option value='1'>Ativo</option>";
            echo "<option value='2' selected>Inativo</option></select>";
        }
        echo "<hr>";
    }

    echo "<input type='submit'  value='Salvar' name='editUsuarios'>";

    // Fim do form
    echo "</form>";
}else{
    // Variavel global com mensagem de erro
   $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario não foi possível editar</p>";
    // Redirecionamento
   header("location: Gusuarios.php");
}


?>