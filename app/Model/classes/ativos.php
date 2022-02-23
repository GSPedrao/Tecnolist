<?php

Class Ativos
{

    public function cadastrar_ativos($descricao, $id_tipo, $id_usuario, $id_localizacao, $patrimonio){
        
        global $cpdo; // Variável de conexao.php, onde faza conexão atravez do PDO
        global $msgErro;

        //verifica se já está cadastrado 
        $sql = $cpdo->prepare("SELECT id_ativo from ativo where patrimonio = :p"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":p", $patrimonio); // Recebe/Liga o valor correspondente
        $sql->execute(); 

        if($sql->rowCount() > 0)
        {
            $_SESSION['msg'] = '<div style="color: red; text-align: center;">Ativo já cadastrado!!</div>';
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $cpdo->prepare("INSERT INTO ativo (descricao, id_tipo, id_usuario, id_localizacao, patrimonio) 
             VALUES (:d, :t, :u, :l, :p)"); // Insere o valor nos seguinte campos e prepara
             // Insere o valor correspondete a variavel
            $sql->bindValue(":d", $descricao); 
            $sql->bindValue(":t",  $id_tipo);
            $sql->bindValue(":u", $id_usuario);
            $sql->bindValue(":l", $id_localizacao);
            $sql->bindValue(":p", $patrimonio);
            $sql->execute();
            $_SESSION['msg'] = '<div style="color: green; text-align: center;">Ativo cadastrado com sucesso!!</div>';

            return true;  // Cadastrado com sucesso, volta verdadeiro
        }
        
    }

}

?>