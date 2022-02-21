<?php
require_once('../../Controller/nivel.php');
require_once('../../Model/conexao.php');

Nivel();

$sql =   "SELECT * FROM chamado WHERE id_usuario = '$_SESSION[id_usuario]' AND `status` = 1 ORDER BY id_chamado Desc";
$result = $conn->query($sql);

$fechado = "SELECT * FROM chamado WHERE id_usuario = '$_SESSION[id_usuario]' AND `status` = 2 ORDER BY id_chamado Desc";
$result2 =  $conn->query($fechado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de chamada</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Hchamado.css">
</head>

<body>

    <!--modal-->
    <div id="ativoModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <dl>
                        <h2 id="MMpatri">Patrimônio:</h2>
                        <dd><span id="MPatrimonio"></span></dd>

                        <h2 id="MMdesc">Descrição:</h2>
                        <dd><span id="MDescricao"></span></dd>

                        <h2 id="MMtipo">Tipo:</h2>
                        <dd><span id="MTipo"></span></dd>

                        <h2 id="MMlocal">Localização:</h2>
                        <dd><span id="MLocalizacao"></span></dd>
                    </dl>
                </div>
                <div class="modal-footer" id="change_datail">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <header style="background-color: #97BFEA;"><button onclick="(function(){ window.open('../../Controller/sair.php', '_self');})()" id="sair" style="border-radius: 30px;">Sair</button></header>
    <h1>Histórico de chamada</h1>
    <div class="container">
        <h2 id='cAberto'>Chamados em aberto</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ordem</th>
                        <th>Chamado</th>
                        <th>Data</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>

                <tbody>
                    <?php
                    while ($chamado_data = $result->fetch_assoc()) //enquanto chamada_data receber o result e retornar matriz associativa
                    {
                        //var_dump($chamado_data);
                        extract($chamado_data); //extrair o chamado_data
                        echo "<tr>";
                        echo "<td>" . $id_chamado . "</td>";

                        echo "<td>" . $descricao . "</td>";

                        echo "<td>" . $data_abertura . "</td>";

                        echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                        echo "<td>
            
                        <a href='../../Model/deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        
                        </a>
                        </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>

            <div class="container">
                <h2 id="cFechada">Chamados Fechados</h2>
                <div class="table-responsive"></div>
                <table class="table">
                    <thead>
                            <tr>
                                <th>Ordem</th>
                                <th>Chamado</th>
                                <th>Data de fechamento</th>
                                <th>Ativo</th>
                                <th>Ações</th>
                            </tr>   
                    </thead>
                    <tbody>
                        <?php
                        while ($chamado_data2 = $result2->fetch_assoc()) //enquanto chamada_data receber o result e retornar matriz associativa
                        {
                            //var_dump($chamado_data2);
                            extract($chamado_data2); //extrair o chamado_data
                            echo "<tr>";
                            echo "<td>" . $id_chamado . "</td>";

                            echo "<td>" . $descricao . "</td>";

                            echo "<td>" . $data_fechamento . "</td>";

                            echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                            echo "<td>
            
                            <a href='../../Model/deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            
                            </a>
                            </td>";

                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
                </div>
            </div>

            <div class="botao">
                <button button onclick="(function(){ window.open('form.php', '_self');})()" type="submit" id="NewCall" style="border-radius: 30px; background-color: #124A86" class="btn btn-primary">Nova chamada</button>
            </div>
        </div>
    </div>

    <!--Bootstrap 4.1 js-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="../JS/visAtivo.js"></script>

</body>

</html>