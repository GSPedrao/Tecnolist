$(document).ready(function () {

	$('a[data-confirm]').click(function (ev) { //verifica se clicou no link href
		var href = $(this).attr('href');

		if (!$('#confirm-delete').length) {
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-primary text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn text-white"  style="background-color: #66fa7f;" data-dismiss="modal">Cancelar</button><a class="btn text-white" id="dataComfirmOK" style="background-color: #4c026e;">Apagar</a></div></div></div></div>');
		}  //Janela modal bootstrap 4.1

		$('#dataComfirmOK').attr('href', href);
		$('#confirm-delete').modal({ show: true });

		return false;

	});
});










