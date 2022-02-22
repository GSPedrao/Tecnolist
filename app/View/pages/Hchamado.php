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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de chamada</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Hchamado.css">
    <script src="https://kit.fontawesome.com/4b8fc74479.js" crossorigin="anonymous"></script>
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
                        
                        <h2 id="MMData">Data de abertura:</h2>
                        <dd><span id="MData"></span></dd>

                        <h2 id="MMData">Data de fechamento:</h2>
                        <dd><span id="MDataF"></span></dd>
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
                    <table class="table" id="tabela1">
                        <thead>
                            <tr>
                                <th>Chamado</th>
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

                                echo "<td>" . $descricao . "</td>";

                                echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                                echo "<td>
                    
                                <a href='../../Model/Deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                                <i class='fa-solid fa-trash'></i>
                                
                                </a>
                                </td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>

                </div>
                
                    <h2 id="cFechada">Chamados Fechados</h2>
                    <div class="table-responsive">
                        <table class="table" id="tabela2">
                            <thead>
                                    <tr>
                                        <th>Chamado</th>
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

                                    echo "<td>" . $descricao . "</td>";

                                    echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                                    echo "<td>
                    
                                    <a href='../../Model/Deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                                    <i class='fa-solid fa-trash'></i>
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

    <!--Bootstrap 4.1 js-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="../JS/visAtivo.js"></script>       
    <script src="../JS/delete.js"></script>

</body>

</html>