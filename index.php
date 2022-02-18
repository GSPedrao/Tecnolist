<?php
    require_once('app/View/pages/index.html');
    require_once('app/Model/classes/usuarios.php');
    $u = new Usuario;

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