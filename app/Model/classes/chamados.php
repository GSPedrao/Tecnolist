<?php
require_once('../../Controller/msg.php');

Class Chamado
{
    public function cadastrar_chamados($descricao, $id_ativo, $id_usuario){
        
       
        global $cpdo; // Variável de conexao.php, onde faza conexão atravez do PDO
        global $msgErro;
        //verifica se já está cadastrado 
        $sql = $cpdo->prepare("SELECT id_chamado from chamado where descricao = :d AND id_ativo = :ia"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":d", $descricao); // Recebe/Liga o valor correspondente
        $sql->bindValue(":ia", $id_ativo); // Recebe/Liga o valor correspondente
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $_SESSION['msg'] = '<div style="color: red; text-align: center;">Chamado Já realizado!!</div>';
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $cpdo->prepare("INSERT INTO chamado (descricao, data_abertura, id_ativo, id_usuario)
             VALUES (:d, NOW(), :a, :u)");  // Insere o valor nos seguinte campos e prepara
             // Insere o valor correspondete a variavel
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":a",  $id_ativo);
            $sql->bindValue(":u", $id_usuario);
            $sql->execute();
            $_SESSION['msg'] = '<div style="color: green; text-align: center;">Chamado enviado com sucesso!!</div>';

            return true;  // Cadastrado com sucesso, volta verdadeiro
        }
        
    }

}

?>