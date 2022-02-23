<?php
include_once('../Model/conexao.php');

$id_chamado = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!empty($id_chamado)){

    //Id chamado | Dados
    $query_usuario = "SELECT id_ativo FROM chamado WHERE id_chamado = $id_chamado LIMIT 1";
    $result = $cpdo->prepare($query_usuario);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

  //Dados da tabela ativo | posição 0
    $query_ativo = "SELECT id_ativo, descricao, id_tipo, id_localizacao, patrimonio FROM ativo WHERE id_ativo = '$row[id_ativo]'";
    $result1 = $cpdo->prepare($query_ativo);
    $result1->execute();
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);

    //Dados do tipo | posição 1
    $query_tipo = "SELECT descricao FROM tipo WHERE id_tipo = '$row1[id_tipo]'";
    $result2 = $cpdo->prepare($query_tipo);
    $result2->execute();
    $row2 = $result2->fetch(PDO::FETCH_ASSOC);

     //Dados da localização | posição 2
    $query_localizacao = "SELECT id_localizacao, descricao FROM localizacao WHERE id_localizacao = '$row1[id_localizacao]'";
    $result3 = $cpdo->prepare($query_localizacao);
    $result3->execute();
    $row3 = $result3->fetch(PDO::FETCH_ASSOC);  

    // Dados do chamado, buscando a data | posição 3
    $query_usuario = "SELECT data_abertura, data_fechamento FROM chamado WHERE id_chamado = $id_chamado LIMIT 1";
    $result = $cpdo->prepare($query_usuario);
    $result->execute();
    $row4 = $result->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row, $row1, $row2, $row3, $row4]; // Recebe uma array, com as determinadas posições

}else{
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERRO: Nenhum Ativo encontrado!</div>"];
}

echo json_encode($retorna); // Retorna .json
