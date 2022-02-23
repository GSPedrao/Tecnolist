<?php
include_once('../../Model/conexao.php');
include_once('../../Model/classes/ativos.php');
include_once('../../Model/classes/usuarios.php');
require_once('../../Controller/nivel.php');
require_once('../../Controller/msg.php');

// Chama nivel de acesso
NivelAdm();

// Faz consulta com a tabela usuario onde o id deste mesmo seja igual a coluna id_usuario 
$nameResult = "SELECT * from usuario WHERE '$_SESSION[id_usuario]' = id_usuario";
$resultado_nome = mysqli_query($conn, $nameResult);
$LNome = mysqli_fetch_assoc($resultado_nome);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar um ativo</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/cadastrarAtivo.css"> <!--Css-->
    <link rel="shortcut icon" href="../images/thumbnail_TecnoListLogo.png" type="image/x-icon"> <!--Logo-->
</head>

<body style="background-color: #97BFEA">
<!--Voltar-->
<button onclick="(function(){ window.open('Lista.php', '_self');})()"  id="sair" style="border-radius: 30px;">Voltar</button>
    <div class="ativo">
        <h1>Cadastre um ativo</h1>
        <form method="POST" class="row g-0">

            <!--Técnico-->
            <div class="col-md-5">
            <label id="nome">Colaborador</label>
            <input readonly type="text" id="name" class="form-control" name="nome" value="<?php echo $LNome['nome']; ?>">
            </div>

            <!--Localização-->
            <div class="col-md-5">
                <label id="localidade">localização</label>
                <select name="localizacao" id="localizacao" class="form-control">
                    <option></option>
                    <?php
                    $resultadoLoc = "SELECT * FROM localizacao";
                    $re_loc = mysqli_query($conn, $resultadoLoc);
                    while ($row_loc = mysqli_fetch_assoc($re_loc)) { ?>
                        <option value="<?php echo $row_loc['id_localizacao'] ?>">
                            <?php echo $row_loc['descricao']; ?>
                        </option> <?php
                                }
                                    ?>
                </select>
            </div>

            <div class="col-md-5">
                <!--Tipo-->
                <label id="topo">Tipo</label>
                <select name="tipo" id="tipinho" class="form-control">
                    <option></option>
                    <?php
                    $resultadoAtivo = "SELECT * FROM tipo";
                    $re_ativo = mysqli_query($conn, $resultadoAtivo);
                    while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
                        <option value="<?php echo $row_ativo['id_tipo'] ?>">
                            <?php echo $row_ativo['descricao']; ?>
                        </option> <?php
                                }
                                    ?>
                </select>
            </div>

                <!--Descrição-->
            <div class="col-md-5">
                <label for="text" id="descreva">Descrição</label>
                <textarea for="text" class="form-control" name="descricao" id="acai"></textarea>
            </div>
                <!-- -FIM- -->
                
                <!--Patrimônio-->
            <div class="col-md-5">
                <label for="text" id="patrimonio">Patrimônio</label>
                <input type="text" class="form-control" name="patrimonio" id="patri">
            </div>

                <!--Botão- -->
            <div class="botao">
                <button type="submit" style="border-radius: 30px; background-color: #124A86" class="btn btn-primary" >Salvar</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
$a = new Ativos;


//vereficar se clicou no nome
if (isset($_POST['nome'])) {
    // Determinados campos recebe valor das inputs
    $descricao = addslashes($_POST['descricao']);
    $id_tipo = addslashes($_POST['tipo']);
    $id_usuario = addslashes($_POST['nome']);
    $id_localizacao = addslashes($_POST['localizacao']);
    $patrimonio = addslashes($_POST['patrimonio']);
    // addslashes = A função addslashes foi por algum tempo uma solução eficaz para escapar determinados caracteres na inserção de dados em banco de dados
    
    // id_usuario recebe Variável global
    $id_usuario = $_SESSION['id_usuario'];

     // Se o usuário não preencheu esses campos
    if (!empty($descricao) && !empty($id_tipo) && !empty($id_usuario) && !empty($id_localizacao)) {

        if (@$a->msgErro == "") { // Se erro não receber nada

             // Se Variável chamar função cadastrar_ativos
            if ($a->cadastrar_ativos($descricao, $id_tipo, $id_usuario, $id_localizacao, $patrimonio)) { 
                msgErro();
            } else {
                msgErro();
            }
        } else {
            echo "Erro: " . $a->msgErro;
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>