<?php
require_once('../../Controller/nivel.php');
require_once('../../Model/conexao.php');
   
NivelAdm();

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
    <title>Lista de chamadas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
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
                    <th id="ordem">Ordem</th>
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
                echo "<td>" . $id_chamado . "</td>";
            
                $resultado_user = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario' ";
                $re_user = mysqli_query($conn, $resultado_user);
                while ($row_user = mysqli_fetch_assoc($re_user)) { ?>
                <td> <?php echo $row_user['nome']; ?> </td> <?php
                }
            
                echo "<td>" . $descricao . "</td>";

                echo "<td>" . $data_abertura . "</td>";
            
                echo "<td><button type='button' class='btn btn-outline-primary' onclick='visAtivo($id_chamado)' id='$id_chamado'>Visualizar</button></td>";

                 echo "<td>
            
            <a href='../../Model/deletar.php?id=$id_chamado' title='Deletar' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                </svg>
            
            </a>
            </td>";
            
                 echo "<td>
            <a href='../../Model/concluido.php?status=$id_chamado'>
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

    </div>

    <!--Bootstrap 4.1 js-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="../JS/delete.js"></script> 
        <script src="../JS/visAtivo.js"></script>
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