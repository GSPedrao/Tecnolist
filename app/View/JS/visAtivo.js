const msgAlerta = document.getElementById("msgAlerta");

async function visAtivo(id_chamado){ //Função assíncronas == retorna como obejeto
   // console.log("Acessou" + id_chamado);
    const dados = await fetch('../../Model/visualizar.php?id=' + id_chamado); //Cria constante dados, aonde espera o Método Get passando id_chamado    
    const resposta = await dados.json(); // Espera os dados.json
    //console.log(resposta); 

    // Se resposta receber erro true mostra mensagem erro
    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    }else{
        // Senão Mostra Janeça modal no html
        $('#ativoModal').modal('show');

        // Recebe as determinadas posições 
        let posi0 = resposta['0'];
        let posi1 = resposta['1'];
        let posi2 = resposta['2'];
        let posi3 = resposta['3'];

        // Mostra na janela modal as posições recebidas
        document.getElementById('MPatrimonio').innerHTML = posi0['patrimonio'];
        document.getElementById('MDescricao').innerHTML = posi0['descricao'];
        document.getElementById('MTipo').innerHTML = posi1['descricao'];
        document.getElementById('MLocalizacao').innerHTML = posi2['descricao'];
        document.getElementById('MData').innerHTML = posi3['data_abertura']; 
        document.getElementById('MDataF').innerHTML = posi3['data_fechamento'];           
    }
}