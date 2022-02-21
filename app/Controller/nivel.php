<?php

$nivel = session_start(); if (!isset($_SESSION['id_usuario'])) { header("location: ../../../index.php"); exit; }  else if($_SESSION['ativo'] != 1) { header("location: ../../../index.php");  exit; } else if($_SESSION['nivel'] != 2) {  header("location: ../index.php");    exit; }
/* if (!isset($_SESSION['id_usuario'])) { 
    header("location: ../../index.php");
    exit;
}  else if($_SESSION['ativo'] != 1) {
    header("location: ../../index.php");
    exit;
} else if($_SESSION['nivel'] != 2) {
    header("location: ../../index.php");
    exit;

}
 */ 