<?php

Class Chamado
{
    public function cadastrar_chamados($descricao, $id_ativo, $id_usuario){
        
       
        global $cpdo; 
        global $msgErro;
        //verifica se já está cadastrado 
        $sql = $cpdo->prepare("SELECT id_chamado from chamado where descricao = :d"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":d", $descricao);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $cpdo->prepare("INSERT INTO chamado (descricao, data_abertura, id_ativo, id_usuario)
             VALUES (:d, NOW(), :a, :u)");
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":a",  $id_ativo);
            $sql->bindValue(":u", $id_usuario);
            $sql->execute();

            return true;  
        }
        
    }

}

?>