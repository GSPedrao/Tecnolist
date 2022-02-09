<?php
require_once('conecao.php');


session_start();    
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}

if (!empty($_GET['search'])) {
    $data = $_GET['search'];

    $sql = "SELECT * FROM chamado cha INNER JOIN usuario usr ON cha.id_usuario=usr.id_usuario
    WHERE cha.id_chamado LIKE '%$data%' or cha.descricao LIKE '%$data%' or usr.nome LIKE '%$data%'
    ORDER BY cha.id_chamado DESC"; 
} else {
    $sql = "SELECT * FROM  chamado ORDER BY id_chamado DESC";
}


$result = $conn->query($sql);

 

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
    <link rel="stylesheet" href="./cadastraUser.css">
</head>
<body style="background-color: #97BFEA">
    <div class="cadastreSe">
        <h1>Cadastre um usuário</h1>
            <form  class="row g-0">
                <div class="col-md-5">
                    <label for="text" id="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="meno">
                </div>
                <div class="col-md-5">
                    <label for="password" id="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="sen">
                </div>
                <div class="col-md-5">
                    <label for="password" id="confirsenha">Confirma senha</label>
                    <input type="password" class="form-control" name="confirsenha" id="confirma">
                </div>
                <div class="col-md-5">
                    <label for="text" id="grup">Grupo de usuários</label>
                    <select class="form-select" id="select">
                        <option value="1">Técnico</option>
                        <option value="2">Colaborador</option>
                    </select>
                </div>
                <div class="botao">
                    <button type="button" style="border-radius: 30px; background-color: #124A86" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            <?php
while($chamado_data = $result->fetch_assoc()) //enquanto chamada_data receber o result e retornar matriz associativa
{
    //var_dump($chamado_data);
    extract($chamado_data); //extrair o chamado_data
    echo "<tr>";
    echo "<td>" . $id_chamado . "</td>";

    $resultado_user = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario' ";
    $re_user = mysqli_query($conn, $resultado_user);
    while ($row_user = mysqli_fetch_assoc($re_user)) { ?>
    <td> <?php echo $row_user['nome']; ?> </td> <?php
    }

    echo "<td>" . $descricao . "</td>";

    $resultado_ativo = "SELECT * FROM ativo WHERE '$id_ativo' = id_ativo";
    $re_ativo = mysqli_query($conn, $resultado_ativo);
    while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
    <td> <?php echo $row_ativo['patrimonio']; ?> </td> <?php
    }

    echo "<td>" . $data_abertura . "</td>";

    if ($status == 1) {
        echo "<td>Em andamento</td>";
    }else{
        echo "<td>Concluído</td>";

    }

     echo "<td>
                                                                            
        <a href='deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
            </svg>
                        
        </a>
        </td>";

     echo "<td>
        <a href='concluido.php?status=$id_chamado'> 
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bookmark-check' viewBox='0 0 16 16'>
        <  path fill-rule='evenodd' d='M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
          <path d='M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z'/>
          </svg>
        </a>
     </td>";
    
    echo "</tr>";
}


?>  
                </tbody>
            </table>
        </div>

    </div>

    <!--Bootstrap 4.1 js-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="../JS/delete.js"></script> 
</body>
<script>
    var search = document.getElementById('pesquisar')

    search.addEventListener("Keydown", function(event) { //pega a variavel e analisa a tecla que você clicou
        if (event.key === "Enter") // se for Enter ele chama a função
        {
            searchData();
        }
    });


    function searchData() {
        window.location = 'Lista.php?search=' + search.value;
    }
</script>

</html>
    </div>
</body>
</html>