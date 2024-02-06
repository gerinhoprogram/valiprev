$(document).ready(function() {

    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Aguarde o carregamento da(s) foto(s)...</div>');

    });

    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/resolucoes_do_conselho_de_administracao/upload_pdf",
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
					'<a href="' + BASE_URL + 'uploads/paginas/resolucoes_do_conselho_de_administracao/pdf/' + data.uploaded_data['file_name'] + '" target="_blank"><i style="font-size: 25pt" class="far fa-file-pdf"></i></a>'+
					'<input type="text" class="form-control mt-2" value="' + data.nome + '" name="pdf_titulo[]">'+
					'<input type="text" class="form-control mt-2" readonly value="'+data.tamanho+'" name="pdf_tamanho[]">'+
					'<input type="hidden" name="pdf_arquivo[]" value="' + data.foto_nome + '">'+
					'<button type="button" class="btn btn-danger btn-remove mt-1" style="width: 45px">X</button>'+
					'</div>');

            } else {
                $('#carregando').html('');
                $("#erro_uploaded").html(data.mensagem);
            }

        },
    });

});
