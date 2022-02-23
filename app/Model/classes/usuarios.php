<?php

Class Usuario
{
    private $pdo;  // oque fará acesso ao banco de dados
    public $msgErro = ""; 
   

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try{
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha); //Parâmetros exigidos pelo PDO
        } catch (PDOException $e) {
        $msgErro = $e->getMessage(); //caso de erro
        }
    }   


    public function cadastrar($nome, $senha, $grupo){
        
        //verifica se já está cadastrado 
        global $pdo; 
        global $msgErro;

        $sql = $pdo->prepare("SELECT id_usuario from usuario where nome = :n"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":n", $nome);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $_SESSION['msg'] = '<div style="color: red; text-align: center;">Usuário já cadastrado!!</div>';
            return false; //já cadastrado
    
        }else{
            //se não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario (nome, senha, id_grupo) VALUES (:n, :s, :g)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":s",md5($senha)); //md5 : Criptografa a senha
            $sql->bindValue(":g", $grupo);
            $sql->execute();
            $_SESSION['msg'] = '<div style="color: green; text-align: center;">Usuário cadastrado com sucesso!!</div>';

            return true;  
        }
        
    }

    
    public function logar($nome, $senha)
    {
        global $pdo;
         //verificar se já está cadastrado
         $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE nome = :n AND senha = :s"); 
         $sql->bindValue(":n", $nome);
         $sql->bindValue(":s",md5($senha));  //md5 : Criptografa a senha
         $sql->execute();
         if($sql->rowCount() > 0)
         {  
              //Entrar
              $dado = $sql->fetch(); 
              session_start();  
              $_SESSION['id_usuario'] = $dado['id_usuario']; // Guarda id_usuario em uma sessão
             
              
 
              //nivel de acesso
              $verificar = $pdo->query("SELECT * FROM usuario"); // Consulta coluna para nivel de acesso
              while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)){ // enquanto variável Busca atravez do PDO
                 if($linha['nome'] == $nome){   // Se variavel linha for igual ao nome
                  $nivel = $linha['id_grupo']; // Linha recebe valor da coluna nivel
                  $ativo = $linha['ativo']; // Recebe o valor da coluna ativo

                  switch ($nivel && $ativo) {  
                    case ($nivel == 2 && $ativo == 1): // Caso for técnico e ativo
                        header("location: ./app/View/pages/Lista.php");   
                    break;

                    case ($nivel == 2 && $ativo == 2): // Caso for técnico e inativo
                        echo "Erro";
                    break;

                    case ($nivel == 3 && $ativo == 1): // Caso for colaborador e ativo
                        header("location: ./app/View/pages/Hchamado.php");
                    break;

                    case ($nivel == 3 && $ativo == 2): // Caso for colaborador e inativo
                        echo "Erro";
                    break;

                     default: // Caso nenhum
                    echo "Usuario sem acesso";
                    break;
                   }  


                   $_SESSION['ativo'] = $ativo; // Guarda ativo em uma sessão
                   $_SESSION['nivel'] = $nivel; // Guarda nivel em uma sessão
                   
                  }
                }
                
               

              
              return true; //Logado com sucesso
         }
         else
         {
             return false; //Não conseguiu logar
         }

        
    }

}


?>