$(document).ready(function() {

    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Aguarde o carregamento da(s) foto(s)...</div>');

    });

    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/dispensa_de_licitacao/upload_pdf",
        fileName: "foto_produto",
        returnType: "json",
        onSuccess: function(files, data) {
            if (data.erro === 0) {
                $('.salvar_artigo').css('pointer-events', 'auto');
                $('.erro_imagem').html('');
                // $('#uploaded_image').html('');
                $("#erro_uploaded").html('');
                $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-success text-white"><i class="fa fa-check" aria-hidden="true"></i> Arquivos carregados com sucesso!</div>');

                $("#uploaded_image").append(
					'<div class="form-group col-md-6">'+
					'<a href="' + BASE_URL + 'uploads/paginas/dispensa_de_licitacao/' + data.uploaded_data['file_name'] + '" target="_blank"><i style="font-size: 25pt" class="far fa-file-pdf"></i></a>'+
					'<input type="text" class="form-control mt-2" value="' + data.nome + '" name="disdoc_titulo[]">'+
					'<input type="text" class="form-control mt-2" readonly value="'+data.tamanho+'" name="disdoc_tamanho[]">'+
					'<input type="hidden" name="disdoc_arquivo[]" value="' + data.foto_nome + '">'+
					'<button type="button" class="btn btn-danger btn-remove mt-1" style="width: 45px">X</button>'+
					'</div>');

            } else {
                $('#carregando').html('');
                $("#erro_uploaded").html(data.mensagem);
            }

        },
    });

	
	$('#uploaded_image').on('click', '.btn-remove', function(event) {

		event.preventDefault();

		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn bg-danger text-white ml-2',
				cancelButton: 'btn bg-primary text-white mr-20'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Tem certeza da exclusão?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: '<i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;Excluir!',
			cancelButtonText: '<i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$(this).parent().remove();
				$('#carregando').html('');
			} else {
				return false;
			}
		})
		});

	$(document).on("input", "#dis_titulo", function() {
		var limite = 150;
		var informativo = "caracteres restantes.";
		var caracteresDigitados = $(this).val().length;
		var caracteresRestantes = limite - caracteresDigitados;

		if (caracteresRestantes <= 0) {
			var comentario = $("input[name=dis_titulo]").val();
			$("input[name=dis_titulo]").val(comentario.substr(0, limite));
			$(".titudis_titulolo").text("0 " + informativo);
		} else {
			$(".dis_titulo").text("(" + caracteresRestantes + " " + informativo + ")");
		}
	});

	$(document).on("input", "#dis_processo", function() {
		var limite = 50;
		var informativo = "caracteres restantes.";
		var caracteresDigitados = $(this).val().length;
		var caracteresRestantes = limite - caracteresDigitados;

		if (caracteresRestantes <= 0) {
			var comentario = $("input[name=dis_processo]").val();
			$("input[name=dis_processo]").val(comentario.substr(0, limite));
			$(".dis_processo").text("0 " + informativo);
		} else {
			$(".dis_processo").text("(" + caracteresRestantes + " " + informativo + ")");
		}
	});

	$(document).on("input", "#dis_objetivo", function() {
		var limite = 500;
		var informativo = "caracteres restantes.";
		var caracteresDigitados = $(this).val().length;
		var caracteresRestantes = limite - caracteresDigitados;

		if (caracteresRestantes <= 0) {
			var comentario = $("input[name=dis_objetivo]").val();
			$("input[name=dis_objetivo]").val(comentario.substr(0, limite));
			$(".dis_objetivo").text("0 " + informativo);
		} else {
			$(".dis_objetivo").text("(" + caracteresRestantes + " " + informativo + ")");
		}
	});

});
