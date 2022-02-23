<?php

session_start(); 

function NivelAdm() {
   if (!isset($_SESSION['id_usuario'])) {
        header("location: ../../../index.php");
        exit;
    } else if ($_SESSION['ativo'] != 1) {
        header("location: ../../../index.php");
        exit;
    } else if ($_SESSION['nivel'] != 2) {
        header("location: ../../../index.php");
        exit;
    }
}


function Nivel() {
    if (!isset($_SESSION['id_usuario'])) { 
        header("location: ../../../index.php");
        exit;
    }  else if($_SESSION['ativo'] != 1) {
        header("location: ../../../index.php");
        exit;
    }else if ($_SESSION['nivel'] != 3) {
        header("location: ../../../index.php");
        exit;
    }
}

