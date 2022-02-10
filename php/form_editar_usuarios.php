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
    <link rel="stylesheet" href="../css/form_editar_usuarios.css">
</head>


<body>
    <header style="background-color: #97BFEA"><button onclick="(function(){ window.open('sair.php', '_self');})()"  id="sair" style="border-radius: 30px;">Sair</button></header>
    <h1>Editar usuários</h1>

    <div class="container border border-2">


        <?php
        // Inicia a sessão
        session_start();
        //Limpa o buffer evitando problemas de redirecionamento
        ob_start();

        include_once('conecao.php');

        // Receber os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($dados);

        if (!empty($dados['usuario'])) {
            // Recuperar os ID dos usuarios e converter em uma string
            $valor_pesq = implode(", ", $dados['usuario']);
            //var_dump($valor_pesq);

            // Recuperar os usuarios do banco de dados
            $query_usuario = "SELECT id_usuario, nome, ativo FROM usuario 
        WHERE id_usuario IN ($valor_pesq) ORDER BY id_usuario DESC";

            $result_usuario = $cpdo->prepare($query_usuario); // Preparando a query
            $result_usuario->execute(); // Executa a query


            // Inicio do form
            echo "<form method='POST' action='proc_editar_usuarios.php'>";

            // Ler os registros retornados do BD
            while ($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) { // Atribui o valor a matriz associativa
                //var_dump($row_usuarios);
                extract($row_usuario);
                echo "<input type='hidden' name='id_usuario[]' value='$id_usuario'>";
                echo "<label id='Lnome'>Nome</label> <input type='text' class='form-control' name='nome[]' value='$nome' placeholder='Nome do usuario'> <br><br>";
                if ($ativo == 1) {
                    echo "<label id='Lstatus'>Status</label>
                     <select name='ativo[]' id='InputStatus' class='form-select' value='$ativo'>";
                    echo "<option value='1' selected>Ativo</option>";
                    echo "<option value='2'>Inativo</option></select>";
                } else {
                    echo "<label id='Lstatus'>Status</label>
                     <select name='ativo[]' id='InputStatus' class='form-select' value='$ativo'>";
                    echo "<option value='1'>Ativo</option>";
                    echo "<option value='2' selected>Inativo</option></select>";
                }
            }
        ?>
    </div>
<?php

            echo "<input type='submit' id='tentando' style='border-radius: 30px; background-color: #124A86' class='btn btn-primary' value='Salvar' name='editUsuarios'>";

            // Fim do form
            echo "</form>";
        } else {
            // Variavel global com mensagem de erro
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario não foi possível editar</p>";
            // Redirecionamento
            header("location: Gusuarios.php");
        }

?>


</body>

</html>