<?php
require_once('../../Controller/nivel.php');
require_once('../../Model/conexao.php');
   
NivelAdm();

if (!empty($_GET['search'])) {
    $data = $_GET['search'];

    $sql = "SELECT * FROM chamado cha INNER JOIN usuario usr ON cha.id_usuario=usr.id_usuario
    WHERE cha.id_chamado LIKE '%$data%' or cha.descricao LIKE '%$data%' or usr.nome LIKE '%$data%' 
    AND cha.status = 1
    ORDER BY cha.id_chamado DESC";
} else {
    $sql = "SELECT * FROM  chamado WHERE `status` = 1 ORDER BY id_chamado DESC";
}


$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de chamadas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4b8fc74479.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/listas.css">

</head>

<body>
    <!--modal-->
    <div id="ativoModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <dl>
            <h2 id="MMpatri">Patrimônio:</h2>
            <dd><span id="MPatrimonio"></span></dd>
              
            <h2 id="MMdesc">Descrição:</h2>
            <dd><span id="MDescricao"></span></dd>

            <h2 id="MMtipo">Tipo:</h2>
            <dd><span id="MTipo"></span></dd>

            <h2 id="MMlocal">Localização:</h2>
            <dd><span id="MLocalizacao"></span></dd>
        </dl>
      </div>
      <div class="modal-footer" id="change_datail">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>


    <header style="background-color: #97BFEA;"><button onclick="(function(){ window.open('../../Controller/sair.php', '_self');})()"  id="sair" style="border-radius: 30px;">Sair</button></header>
    <nav> 
        <!--Campo de pesquisa-->
      <div class="col-md-2">
        <input type="text" class="form-control" name="pesquisa" id="pesquisar">
      </div>
          <button onclick="searchData()" class="botao0" type="submit"></button>
          

        <div class="bioma">
            <div class="d-grid gap-4">
             <button onclick="(function(){ window.open('Gusuarios.php', '_self');})()"  id="botao7"  style="border-radius: 30px; background-color: #124A86;" class="btn btn-primary" type="submit">Gerenciar usuário</button>
            </div>
        </div>
        <div class="botao">
            <div class="d-grid gap-4">
             <button onclick="(function(){ window.open('Cadativo.php', '_self');})()"  id="botao1"  style="border-radius: 30px; background-color: #124A86" class="btn btn-primary" type="submit">Cadastrar Ativo</button>
            </div>
        </div>
        <div class="botao2">
            <div class="d-grid gap-4">
                 <button onclick="(function(){ window.open('cadastrese.php', '_self');})()" style="border-radius: 30px; background-color: #124A86" class="btn btn-primary" type="submit">Cadastrar Usuário</button>
            </div>
        </div>
        </nav>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th id="colaborador">Colaborador</th>
                    <th id="chamado">Chamado</th>
                    <th id="data">Data</th>
                    <th id="ativo">Ativo</th>
                    <th id="status">Ações</th>
                  </tr>
                    <tbody>
            <?php
            while($chamado_data = $result->fetch_assoc()) //enquanto chamada_data receber o result e retornar matriz associativa
            {
                //var_dump($chamado_data);
                extract($chamado_data); //extrair o chamado_data
                echo "<tr>";
            
                $resultado_user = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario' ";
                $re_user = mysqli_query($conn, $resultado_user);
                while ($row_user = mysqli_fetch_assoc($re_user)) { ?>
                <td> <?php echo $row_user['nome']; ?> </td> <?php
                }
            
                echo "<td>" . $descricao . "</td>";

                echo "<td>" . $data_abertura . "</td>";
            
                echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                 echo "<td>
            
            <a href='../../Model/deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?' style='text-decoration:none;' >
            <i class='fa-solid fa-trash'></i>
            </a>
            ";
            
            echo "|";
                 echo "
            <a href='../../Model/concluido.php?status=$id_chamado' ok-confirm='Tem certeza de que deseja Concluir este item?'>
            <i class='fa-solid fa-bookmark'></i>
           
            </a>
                 </td>";
                
                echo "</tr>";
            }
            
            
            ?>
                    </tbody>
                </table>
        </div>
        </div>

    </div>

    <!--Bootstrap 4.1 js-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="../JS/delete.js"></script> 
        <script src="../JS/visAtivo.js"></script>
        <script src="../JS//concluir.js"></script>
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