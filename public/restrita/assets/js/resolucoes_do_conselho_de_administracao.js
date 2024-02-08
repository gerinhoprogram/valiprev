//preenchar campos ao sai do input cep
var App_sistema = function() {

	var envia_pdf = function() {

        $(document).on('change', '[name="pdf_arquivo"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="pdf_arquivo"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('pdf_arquivo', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/resolucoes_do_conselho_de_administracao/upload_pdf_unico',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#logo_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando arquivo...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-logo').html(
							"<input type='hidden' name='foto_produto' value='" + response.foto_nome + "' >"+
							"<a href='" + BASE_URL + "uploads/paginas/resolucoes_do_conselho_de_administracao/pdf/" + response.foto_nome + "'><i style='font-size: 25pt' class='far fa-file-pdf'></i></a>"+
							"<input type='hidden' name='pdf_tamanho' value='"+response.tamanho+"'>"+
							"<br>Tamanho: <span class='badge badge-info'>"+response.tamanho+"</span>"
							);
                        $('#logo_foto_troca').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#logo_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                    }
                },

                error: function(response) {
                    $('#logo_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                }

            });

        });

    }

    return {
        init: function() {
			envia_pdf();
        }
    }

}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {

        // if (event.keyCode === 13) {

        //     event.preventDefault();
        //     return false;

        // }

    });

    $(document).on("input", "#titulo", function() {
        var limite = 150;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("input[name=titulo]").val();
            $("input[name=titulo]").val(comentario.substr(0, limite));
            $(".titulo").text("0 " + informativo);
        } else {
            $(".titulo").text("(" + caracteresRestantes + " " + informativo + ")");
        }
    });

    App_sistema.init();

});




