//preenchar campos ao sai do input cep
var App_sistema = function() {

    var envia_foto = function() {

        $(document).on('change', '[name="cont_foto"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="cont_foto"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('cont_foto', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/censo_previdenciario/upload_foto',
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

                        $('#box-foto-logo').html("<input type='hidden' name='logo_foto_troca' value='" + response.foto_nome + "' > <img src='" + BASE_URL + "uploads/paginas/censo_previdenciario/" + response.foto_nome + "' style='height: 150px; width: 100%; object-fit: contain'> ");
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

	var envia_pdf = function() {

        $(document).on('change', '[name="pdf_arquivo"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="pdf_arquivo"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('pdf_arquivo', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/censo_previdenciario/upload_pdf',
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
							"<input type='hidden' name='logo_foto_troca' value='" + response.foto_nome + "' >"+
							"<a href='" + BASE_URL + "uploads/paginas/censo_previdenciario/pdf/" + response.foto_nome + "'><i style='font-size: 25pt' class='far fa-file-pdf'></i></a>"+
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
            envia_foto();
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

    App_sistema.init();

});


$(document).ready(function () {

    // $('.card-footer').css('display', 'none');

    var max_fields = 15; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_faq"); //Add button ID
    //   alert('ok');

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var length = wrapper.find("input:text").length;

        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
					'<div class="form-group col-12">'+			
					'<label for="">Dúvida</label>'+
					'<input type="text" class="form-control mb-3" name="cep_titulo[]" />'+
					'<label for="">Resposta</label>'+
					'<textarea name="cep_texto[]" class="form-control texto_editor"></textarea>'+
					'<a href="#" class="btn btn-danger remove_seo mt-1">Remover</a>'+
					'</div>'
			)
        }
        //Fazendo com que cada uma escreva seu name
        // wrapper.find("input:text").each(function() {
        //   $(this).val($(this).attr('name'))
        // });
        wrapper.find("input:text").focus();
    });

    $(wrapper).on("click", ".remove_seo", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

});



