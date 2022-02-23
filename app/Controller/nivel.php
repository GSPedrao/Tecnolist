<?php
// Inicia a sessão em todas as paginas referente a essa
session_start(); 

// Nivel de acesso para o técnico
function NivelAdm() {
   if (!isset($_SESSION['id_usuario'])) {  // Se usuario não estiver logado
        header("location: ../../../index.php");
        exit;
    } else if ($_SESSION['ativo'] != 1) { // Senão se usuario estiver inativo
        header("location: ../../../index.php");
        exit;
    } else if ($_SESSION['nivel'] != 2) { // Senão for colaborador
        header("location: ../../../index.php");
        exit;
    }
}

// Nivel de acesso para o colaborador
function Nivel() {
    if (!isset($_SESSION['id_usuario'])) {  // Se usuario não estiver logado
        header("location: ../../../index.php");
        exit;
    }  else if($_SESSION['ativo'] != 1) { // Senão se usuario estiver inativo
        header("location: ../../../index.php");
        exit;
    }else if ($_SESSION['nivel'] != 3) {  // Senão for colaborador
        header("location: ../../../index.php");
        exit;
    }
}

