var App_sistema = function() {

    var banner_banner = function() {

        $(document).on('change', '[name="banner_site"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="banner_site"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('banner_site', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/banners_site/upload_editar',
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

                        $('#box-foto-banner').html("<input type='hidden' name='banner_imagem' value='" + response.banner_nome + "' > <img src='" + BASE_URL + "uploads/banners_site/" + response.banner_nome + "' alt='' style='height: 250px; width: 100%; object-fit: contain' class='img-thumbnail'> <input type='text' readonly class='form-control mt-2' name='banner_tipo' value='" + response.tipo + "' ><input type='text' readonly class='form-control mt-2' name='banner_tamanho' value='" + response.tamanho + "' ><input type='text' readonly class='form-control mt-2' name='banner_medida' value='" + response.medida + "' >");
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

    return {
        init: function() {
            banner_banner();
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