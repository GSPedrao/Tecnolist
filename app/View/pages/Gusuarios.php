<?php
session_start();

include_once('../../Model/conexao.php');
require_once('../../Controller/nivel.php');

NivelAdm();
?>


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
    <header style="background-color: #97BFEA"><button onclick="(function(){ window.open('Lista.php', '_self');})()"  id="sair" style="border-radius: 30px;">Voltar</button></header>
    <h1>Gerenciar Usuários</h1>

    <div class="container">

        <?php
        // Verificar se existe a mensagem
        if (isset($_SESSION['msg'])) {
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
        ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th id="selecione">Selecione</th>
                        <th id="data">Nome</th>
                        <th id="status">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Ler os registros retornados do BD
                    while ($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)) { //atribui o valor a matriz associativa
                        //var_dump($row_usuario);
                        extract($row_usuario); //(facilita, não precisa concatenar)
                        echo "<tr>";
                        echo "<td><input type='checkbox' id='checkbox' name='usuario[$id_usuario]' value='$id_usuario'>";
                        echo "$id_usuario </td>";
                        echo "<td> $nome ";
                        if ($ativo == 1) {
                            echo "<td> Ativo</td>";
                        } else {
                            echo "<td> Inativo</td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php

    echo "<input type='submit' id='editar' style='border-radius: 30px; background-color: #124A86;' class='btn btn-primary' value='Editar' name='editUsuarios'>";

    echo "</form>"; //fim do form
    ?>


</body>

</html>