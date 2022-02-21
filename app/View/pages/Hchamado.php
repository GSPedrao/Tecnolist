<?php
require_once('../../Controller/nivel.php');
require_once('../../Model/conexao.php');

Nivel();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de chamada</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../css/Hchamado.css">
</head>
<body>
    <header style="background-color: #97BFEA;"><button onclick="(function(){ window.open('../../Controller/sair.php', '_self');})()"  id="sair" style="border-radius: 30px;">Sair</button></header>
        <h1>Histórico de chamada</h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th id="cAberto">Chamadas em aberto</th>
                                <th id="cFechada">Chamadas fechadas</th>
                            </tr>

                            <tbody>

                            
                            </tbody>
                    </table>
                    <div class="botao">
                        <button button onclick="(function(){ window.open('form.php', '_self');})()" type="submit" id="NewCall" style="border-radius: 30px; background-color: #124A86" class="btn btn-primary">Nova chamada</button>
                    </div>
                </div>
            </div>
        
</body>
</html>