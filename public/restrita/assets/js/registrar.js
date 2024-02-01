var App_registrar = function() {



    var envia_imagem_usuario = function() {


        $(document).on('change', '[name="user_foto_file"]', function() {


            var file_data = $('[name="user_foto_file"]').prop('files')[0];

            var form_data = new FormData();


            form_data.append('user_foto_file', file_data);


            $.ajax({

                type: 'post',
                url: BASE_URL + 'registrar/upload_file',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {

                    $('#user_foto').html('<div class="p-1 mt-1 rounded bg-warning text-dark">Carregando foto...</div>');

                },
                success: function(response) {

                    if (response.erro === 0) {


                        $('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='" + response.user_foto + "'> <img width='100' alt='Usuário image' src='" + BASE_URL + "/uploads/usuarios/" + response.user_foto + "' class='rounded'>");

                        $('#user_foto').html('<div class="p-1 mt-1 rounded bg-success text-dark">' + response.mensagem + '</div>');

                    } else {

                        $('#user_foto').html('<div class="p-1 mt-1 rounded bg-danger text-dark">' + response.mensagem + '</div>');

                    }

                },

                error: function(response) {

                    $('#user_foto').html('<div class="p-1 mt-1 rounded bg-danger text-dark">' + response.mensagem + '</div>');

                }


            });



        });



    }






    return {

        init: function() {

            envia_imagem_usuario();

        }

    }




}(); //Inicializa ao carregar a view



jQuery(document).ready(function() {

    $(window).keydown(function(event) {


        if (event.keyCode == 13) {

            event.preventDefault();
            return false;

        }


    });

    App_registrar.init();

});