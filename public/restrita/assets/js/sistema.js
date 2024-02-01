//preenchar campos ao sai do input cep
var App_sistema = function() {

    var envia_imagem_logo = function() {

        $(document).on('change', '[name="sistema_logo"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_logo"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_logo', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_logo',
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

                        $('#box-foto-logo').html("<input type='hidden' name='logo_foto_troca' value='" + response.logo_foto_troca + "' > <img src='" + BASE_URL + "uploads/sistema/logo/" + response.logo_foto_troca + "' style='height: 150px; width: 100%; object-fit: contain'> ");
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

    var envia_imagem_logo_2 = function() {

        $(document).on('change', '[name="sistema_logo_2"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_logo_2"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_logo_2', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_logo_2',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#logo_foto_troca_2').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-logo_2').html("<input type='hidden' name='logo_foto_troca_2' value='" + response.logo_foto_troca_2 + "' > <img src='" + BASE_URL + "uploads/sistema/logo/" + response.logo_foto_troca_2 + "' style='height: 150px; width: 100%; object-fit: contain'> ");
                        $('#logo_foto_troca_2').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#logo_foto_troca_2').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                    }
                },

                error: function(response) {
                    $('#logo_foto_troca_2').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                }

            });

        });

    }

    var envia_imagem_icon = function() {

        $(document).on('change', '[name="sistema_icon"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_icon"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_icon', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_icon',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#icon_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-icon').html("<input type='hidden' name='icon_foto_troca' value='" + response.icon_foto_troca + "' > <img src='" + BASE_URL + "uploads/sistema/icone/" + response.icon_foto_troca + "' alt='' width='150' class='img-thumbnail'> ");
                        $('#icon_foto_troca').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#icon_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');

                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#icon_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');

                }

            });

        });

    }

    var envia_imagem_gif = function() {

        $(document).on('change', '[name="sistema_gif"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_gif"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_gif', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_gif',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#gif_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-gif').html("<input type='hidden' name='gif_foto_troca' value='" + response.gif_foto_troca + "' > <img src='" + BASE_URL + "uploads/sistema/gif/" + response.gif_foto_troca + "' style='height: 150px; width: 100%; object-fit: contain'> ");
                        $('#gif_foto_troca').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#gif_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');

                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#gif_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');

                }

            });

        });

    }

    var banner_propaganda = function() {

        $("input[name=banner]").change(function() {

            var valor = $(this).val();

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/trocar_banner',
                dataType: 'json',
                data: {

                    valor: valor,

                },

                beforeSend: function() {
                    iziToast.warning({
                        title: 'Aguarde!',
                        message: 'Estamos salvando os dados',
                        position: 'topCenter'
                    });
                },

                success: function(data) {
                    iziToast.success({
                        title: 'Tudo ok!',
                        message: 'Banner alterado!',
                        position: 'topCenter'
                    });
                },

                error: function(data) {
                    iziToast.error({
                        title: 'Erro!',
                        message: 'Não foi possível alterar!',
                        position: 'topCenter'
                    });
                }

            });



        });

    }

    var artigo_destaque = function() {

        $("input[name=artigos]").change(function() {

            var valor = $(this).val();

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/artigo_destaque',
                dataType: 'json',
                data: {

                    valor: valor,

                },

                beforeSend: function() {
                    iziToast.warning({
                        title: 'Aguarde!',
                        message: 'Estamos salvando os dados',
                        position: 'topCenter'
                    });
                },

                success: function(data) {
                    iziToast.success({
                        title: 'Tudo ok!',
                        message: 'Artigo destacado com sucesso!',
                        position: 'topCenter'
                    });

                    $('.card_artigos').removeClass('card-warning');
                    $('.card_artigos').addClass('card-primary');

                    $('.card_artigos a').removeClass('btn-warning');
                    $('.card_artigos a').addClass('btn-primary');

                    $('#card_' + valor).removeClass('card-primary');
                    $('#card_' + valor).addClass('card-warning');

                    $('#card_' + valor + ' a').removeClass('btn-primary');
                    $('#card_' + valor + ' a').addClass('btn-warning');



                },

                error: function(data) {
                    iziToast.error({
                        title: 'Erro!',
                        message: 'Não foi possível alterar!',
                        position: 'topCenter'
                    });
                }

            });



        });

    }

    return {
        init: function() {
            envia_imagem_logo();
            envia_imagem_logo_2();
            envia_imagem_icon();
            envia_imagem_gif();
            banner_propaganda();
            artigo_destaque();
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