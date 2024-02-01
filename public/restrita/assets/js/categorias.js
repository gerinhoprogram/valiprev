//preenchar campos ao sai do input cep
var App_categorias = function() {

    var envia_imagem_banner = function() {

        $(document).on('change', '[name="banner"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="banner"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('banner', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/master/upload_banner',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#carregando_banner').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');

                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#carregando_banner').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');
                        $('#box-foto-banner').html("<input type='hidden' name='carregando_banner' value='" + response.carregando_banner + "' > <img src='" + BASE_URL + "uploads/categorias_pai/" + response.carregando_banner + "' alt='' class='img-thumbnail' width='250' >");

                    } else {
                        // $('#banner_foto_troca').html(response.mensagem);
                        $('#carregando_banner').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');

                    }
                },

                error: function(response) {
                    // alert('erro');
                    // $('#banner_foto_troca').html(response.mensagem);
                    $('#carregando_banner').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');


                }

            });

        });

    }

    return {
        init: function() {
            envia_imagem_banner();
        }
    }

}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {

    });

    $(document).on("input", "#categoria_pai_nome", function() {
        var limite = 150;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("input[name=categoria_pai_nome]").val();
            $("input[name=categoria_pai_nome]").val(comentario.substr(0, limite));
            $(".titulo").text("0 " + informativo);
        } else {
            $(".titulo").text("(" + caracteresRestantes + " " + informativo + ")");
        }
    });

    App_categorias.init();


});