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
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario (nome, senha, id_grupo) VALUES (:n, :s, :g)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":s",md5($senha)); //md5 : Criptografa a senha
            $sql->bindValue(":g", $grupo);
            $sql->execute();

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
              $_SESSION['id_usuario'] = $dado['id_usuario'];
             
              
 
              //nivel de acesso
              $verificar = $pdo->query("SELECT * FROM usuario"); //procura coluna para nivel de acesso
              while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)){ //enquanto 
                 if($linha['nome'] == $nome){   //se variavel linha for igual ao nome
                  $nivel = $linha['id_grupo']; // linha recebe valor da coluna nivel
                  $ativo = $linha['ativo']; // Recebe o valor da coluna ativo

                  switch ($nivel && $ativo) {
                    case ($nivel == 2 && $ativo == 1):
                        header("location: ./php/Lista.php");   
                    break;

                    case ($nivel == 2 && $ativo == 2):
                        echo "Erro";
                    break;

                    case ($nivel == 3 && $ativo == 1):
                        header("location: ./php/form.php");
                    break;

                    case ($nivel == 3 && $ativo == 2):
                        echo "Erro";
                    break;

                     default:
                    echo "Usuario sem acesso";
                    break;
                   }  


                   $_SESSION['ativo'] = $ativo;
                   $_SESSION['nivel'] = $nivel;
                   
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