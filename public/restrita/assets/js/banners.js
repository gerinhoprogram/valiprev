var App_sistema = function() {

    var cta_banner = function() {

        $(document).on('change', '[name="foto_cta"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="foto_cta"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('foto_cta', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/banners_cta/upload',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    $('#cta_foto_troca').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-cta').html("<input type='hidden' name='cta_foto_troca' value='" + response.foto_nome + "' > <img src='" + BASE_URL + "uploads/banners_cta/" + response.foto_nome + "' alt='' style='height: 250px; width: 100%; object-fit: contain' class='img-thumbnail'> ");
                        $('#cta_foto_troca').html('<div class="p-1 mt-1 rounded bg-success text-white">' + response.mensagem + '</div>');

                    } else {
                        $('#cta_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                    }
                },

                error: function(response) {
                    $('#cta_foto_troca').html('<div class="p-1 mt-1 rounded bg-danger text-white">' + response.mensagem + '</div>');
                }

            });

        });

    }

    return {
        init: function() {
            cta_banner();
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