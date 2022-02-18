<?php
session_start();
include_once('../View/pages/form.php');
include_once('../Model/conexao.php');
include_once('../Model/classes/chamados.php');
include('../Model/classes/usuarios.php');

if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}


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
