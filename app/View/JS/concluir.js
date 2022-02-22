$(document).ready(function () {

	$('a[ok-confirm]').click(function (ev) { //verifica se clicou no link href
		var href = $(this).attr('href');

		if (!$('#confirm-concluido').length) {
			$('body').append('<div class="modal fade" id="confirm-concluido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-primary text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja concluir este item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button><a class="btn btn-success text-white" id="okComfirmOK">Concluir</a></div></div></div></div>');
		}  //Janela modal bootstrap 4.1

		$('#okComfirmOK').attr('href', href);
		$('#confirm-concluido').modal({ show: true });

		return false;

	});
});










