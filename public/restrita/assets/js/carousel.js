var App_sistema = function() {

    var banner_banner = function() {

        $(document).on('change', '[name="foto_banner"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="foto_banner"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('foto_banner', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/carousel/upload',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#banner_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-banner').html("<input type='hidden' name='banner_foto_troca' value='" + response.foto_nome + "' > <img src='" + BASE_URL + "uploads/sistema/carousel/" + response.foto_nome + "' alt='' style='height: 250px; width: 100%; object-fit: contain' class='img-thumbnail'> ");
                        $('#banner_foto_troca').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#banner_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                    }
                },

                error: function(response) {
                    $('#banner_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                }

            });

        });

    }

    var ativar_carousel = function() {

        $(document).on('change', '[name="ativar"]', function() {

            var valor = $('.ativar').val();

            // alert(valor);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/carousel/ativar',
                dataType: 'json',
                data: {

                    valor: valor,

                },

                beforeSend: function() {
                    $('#aguarde').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg" width="20"> Aguarde...</div>');
                },

                success: function(data) {
                    // alert('sucesso');
                    if(valor == 1){
                        $('[name="ativar"]').removeClass('text-danger');
                        $('[name="ativar"]').addClass('text-success');

                    }else{
                        $('[name="ativar"]').removeClass('text-success');
                        $('[name="ativar"]').addClass('text-danger');
                    }
                    $('#aguarde').html('<div class="p-1 mt-1 rounded bg-success text-white">Alterado com sucesso!</div>');

                },

                error: function(data) {
                    $('#aguarde').html('<div class="p-1 mt-1 rounded bg-danger text-white">Erro na alteração! Tente novamente.</div>');
                }

            });



        });

    }

    return {
        init: function() {
            banner_banner();
            ativar_carousel();
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