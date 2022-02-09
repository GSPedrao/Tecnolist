<?php
      

    require_once('classes/usuarios.php');
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body style="background-color: #97BFEA">
    <div class="outside">
            <p>Login</p>
           
            <form method= "POST">     
            <div class="nome">        
                <input type="text" class="form-control" name="nome" placeholder="Digite seu nome" id="nome" required>
            </div>
            <br>
            <div class="senha">
                <input type="password" class="form-control" name="senha" placeholder="Digite sua senha" id="senha" required>
            </div>
                
            <br>
            <div class="botao">
            <div class="d-grid gap-2">
                <button style="border-radius: 30px; background-color: #124A86" class="btn btn-primary btn-lg" type="submit">Entrar</button>
            </div>
            </form>
    </div>
</body>
</html>
    
        <?php
         //Verificar se clicou no botao
         if(isset($_POST['nome']))
        {
             $nome = addslashes($_POST['nome']);
             $senha = addslashes($_POST['senha']);
             //verificar se está vazio
             if(!empty($nome) && !empty($senha))
            {
                $u->conectar("tecnolist","localhost","root",""); //conectar com o banco
                if ($u->msgErro == "") //verificar erro
                {
                    if(!$u->logar($nome, $senha));
                    {
                        echo "<script>alert('Nome e/ou senha incorretos'</script>";
                    }
                }
                else
                {
                    echo "Erro: " . $u->msgErro;  
                }
            }
            else
            {
                echo "<script>alert('Preencha todos os campos obrigatórios!!')</script>";
            }   
            
            
        }
        ?>
    	
</body>
</html>