//preenchar campos ao sai do input cep
var App_sistema = function() {

    var envia_foto = function() {

        $(document).on('change', '[name="ata_foto"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="ata_foto"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('ata_foto', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/atas/upload_pdf',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#logo_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

						$('#box-foto-logo').html(
							"<input type='hidden' name='logo_foto_troca' value='" + response.foto_nome + "' >"+
							"<a target='_blank' href='" + BASE_URL + "uploads/paginas/conselhos/atas/" + response.foto_nome + "'>"+
							"<span class='badge badge-info'>Documento</span> </a>"+
							"<input type='text' class='form-control mt-1' readonly name='ata_tamanho' value='" + response.tamanho + "' >"
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
            envia_foto();
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

    App_sistema.init();


		$(window).keydown(function() {
	
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

		$(document).on("input", "#ata_ano", function() {
			var limite = 4;
			var informativo = "caracteres restantes.";
			var caracteresDigitados = $(this).val().length;
			var caracteresRestantes = limite - caracteresDigitados;
	
			if (caracteresRestantes <= 0) {
				var comentario = $("input[name=ata_ano]").val();
				$("input[name=ata_ano]").val(comentario.substr(0, limite));
				$(".ata_ano").text("0 " + informativo);
			} else {
				$(".ata_ano").text("(" + caracteresRestantes + " " + informativo + ")");
			}
		});
	
		App_categorias.init();


});
