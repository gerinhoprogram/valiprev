//preenchar campos ao sai do input cep
var App_sistema = function() {

    var envia_foto = function() {

        $(document).on('change', '[name="reg_foto"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="reg_foto"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('reg_foto', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/conselheiros/upload_foto',
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

                        $('#box-foto-logo').html("<input type='hidden' name='logo_foto_troca' value='" + response.foto_nome + "' > <img src='" + BASE_URL + "uploads/paginas/conselhos/conselheiros/" + response.foto_nome + "' style='height: 150px; width: 100%; object-fit: contain'> ");
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

});
