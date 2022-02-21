<?php
session_start();
include_once('../../Model/conexao.php');
include_once('../../Model/classes/chamados.php');
include('../../Model/classes/usuarios.php');




$nameResult = "SELECT * from usuario WHERE '$_SESSION[id_usuario]' = id_usuario";
$resultado_nome = mysqli_query($conn, $nameResult);
$LNome = mysqli_fetch_assoc($resultado_nome);

$resultadoTip = "SELECT * FROM tipo";
$re_tip = mysqli_query($conn, $resultadoTip);
$row_tip = mysqli_fetch_assoc($re_tip);
$rtip = $row_tip['descricao'];

$resultadoTi = "SELECT * FROM localizacao";
$re_ti = mysqli_query($conn, $resultadoTi);
$row_ti = mysqli_fetch_assoc($re_ti);
$rti = $row_ti['descricao'];
?>

<!DOCTYPE html>
<html lang="pt/br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="../css/solicitacao.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <header><button onclick="(function(){ window.open('Hchamado.php', '_self');})()" id="sair" style="border-radius: 30px;">Voltar</button></header>
    <h1>Formulario de pedidos</h1>
    <div class="container border border-2">
        <form method="POST" class="row g-0">
            <div class="col-md-5">
                <label for="text" id="colar">Colaborador</label>
                <input type="text" placeholder="Digite o seu nome" class="form-control" name="nome" id="nome" value="<?php echo $LNome['nome']; ?>" />
            </div>
            <div class="col-md-5">
                <label for="text" id="crias">Descrição</label>
                <textarea name="descricao" class="form-control" id="desc" cols="30" rows="2"></textarea>
            </div>
            <div class="col-md-5">
                <label for="text" id="ativa">Ativo</label>
                <select name="ativo" class="form-select" id="cativa">
                    <option>Descrição/Tipo/Lugar</option>
                    <?php
                    $resultadoTipo = "SELECT * FROM ativo";
                    $re_tipo = mysqli_query($conn, $resultadoTipo);
                    while ($row_tipo = mysqli_fetch_assoc($re_tipo)) { ?>
                        <option value="<?php echo $row_tipo['id_ativo'] ?>">
                            <?php echo "$row_tipo[descricao] - $rtip - $rti" ?>
                        </option> <?php
                                }
                                    ?>
                </select>

                <input id="butaozin" class="btn btn-primary" style="border-radius: 30px; background-color: #124A86" type="submit">
        </form>
    </div>
    <br>

</body>

</html>
<?php

$c = new Chamado;

//vereficar se clicou no nome
if (isset($_POST['nome'])) {
    $descricao = addslashes($_POST['descricao']);
    $id_ativo = addslashes($_POST['ativo']);
    $id_usuario = addslashes($_POST['nome']);

    $id_usuario = $_SESSION['id_usuario'];



    if (!empty($descricao) && !empty($id_ativo) && !empty($id_usuario)) {

            if ($c->cadastrar_chamados($descricao, $id_ativo, $id_usuario)) {
                echo "<script>alert('Chamado enviado com sucesso!!')</script>";
            } else {
                echo "<script>alert('Chamado já realizado!');</script>";
            }
        
        
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }       
}
?>