<?php
require_once("../../Model/classes/usuarios.php");
include_once("../../Model/conexao.php");
require_once('../../Controller/nivel.php');
require_once("../../Controller/msg.php");

$u = new Usuario;
  
// Chama nivel de acesso
NivelAdm(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar um usuário</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/cadastraUser.css"> <!--Css-->
    <link rel="shortcut icon" href="../images/thumbnail_TecnoListLogo.png" type="image/x-icon"> <!--Logo-->
</head>
<body style="background-color: #97BFEA">
<!--Botão de voltar-->
<button onclick="(function(){ window.open('Lista.php', '_self');})()"  id="sair" style="border-radius: 30px;">Voltar</button>
    <div class="cadastreSe">
        <h1>Cadastre um usuário</h1>
        <!--Formulário-->
            <form method="POST" class="row g-0">
                <!--Nome-->
                <div class="col-md-5">
                    <label for="text" id="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="meno"> 
                </div>
                <!--Senha-->
                <div class="col-md-5">
                    <label for="password" id="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="sen"> 
                </div>
                <!--Confirmar senha-->
                <div class="col-md-5">
                    <label for="password" id="confirsenha">Confirma senha</label>
                    <input type="password" class="form-control" name="csenha" id="confirma"> 
                </div>
                <!--Selecionar Grupo-->
                <div class="col-md-5">
                    <label for="text" id="grup">Grupo de usuários</label>
            <select class="form-select" id="select" name="selecionaGrupo"  aria-label="Default select example">
                <option></option>
                <?php
                    // Mostra o nome dos grupos de usuário e recebe o id_usuario
                    $resultadoGrupo = "SELECT * FROM grupo_de_usuario"; 
                    $re_grupo = mysqli_query($conn, $resultadoGrupo);
                    while($row_grupo = mysqli_fetch_assoc($re_grupo)){ ?>
                         <option value="<?php echo $row_grupo['id_grupo']?>">
                         <?php echo $row_grupo['nome_grupo']; ?>
                         </option> <?php
                    }
                ?>
            </select>
            <br>
            <!--Botão-->
            <div class="botao">
            <input style="border-radius: 30px; background-color: #124A86;  width: 150px;" class="btn btn-primary" type="submit" value="Salvar">
            </div>
        
        </form>

    </div>
</body>
</html>


<?php
   //vereficar se clicou no nome
   if(isset($_POST['nome'])){
       // Determinados campos recebe valor das inputs
       $nome = addslashes($_POST['nome']);
       $senha = addslashes($_POST['senha']);
       $csenha = addslashes($_POST['csenha']);
       $grupo = addslashes($_POST['selecionaGrupo']);
       // addslashes = A função addslashes foi por algum tempo uma solução eficaz para escapar determinados caracteres na inserção de dados em banco de dados
   
       // Se o usuário não preencheu esses campos
      if(!empty($nome) && !empty($senha) && !empty($csenha) && !empty($grupo)){
          $u->conectar("tecnolist", "localhost", "root", ""); // Faz conexão com o banco
              
          if($u->msgErro == ""){ // Se erro não receber nada

              if($senha == $csenha){ // Se senha for igual a confirmar senha

                  if($u->cadastrar($nome, $senha, $grupo)){ // Se Variável chamar função cadastrar
                      msgErro();
                   }else{
                       msgErro();
                    }

               }else{ 
               echo "<script>alert('Senha e confirmar senha não correspondem!');</script>";
               }
           
            }else{ // Senão mostrar erro
           echo "Erro: " . $u->msgErro;
           }
        
        
   
        }else{ 
           echo "<script>alert('Preencha todos os campos!');</script>";
        }
   }
?>