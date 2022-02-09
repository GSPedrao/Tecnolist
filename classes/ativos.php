<?php

Class Ativos
{

    public function cadastrar_ativos($descricao, $id_tipo, $id_usuario, $id_localizacao, $patrimonio){
        
        //verifica se já está cadastrado 
        global $cpdo; 
        global $msgErro;

        $sql = $cpdo->prepare("SELECT id_ativo from ativo where patrimonio = :p"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":p", $patrimonio);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $cpdo->prepare("INSERT INTO ativo (descricao, id_tipo, id_usuario, id_localizacao, patrimonio)
             VALUES (:d, :t, :u, :l, :p)");
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":t",  $id_tipo);
            $sql->bindValue(":u", $id_usuario);
            $sql->bindValue(":l", $id_localizacao);
            $sql->bindValue(":p", $patrimonio);
            $sql->execute();

            return true;  
        }
        
    }

}

?>