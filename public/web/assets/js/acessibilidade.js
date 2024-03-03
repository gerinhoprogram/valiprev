//preenchar campos ao sai do input cep
var App_sistema = function() {

	var escuro = function() {

        $(".escuro").click(function () {

			var form_data = 'escuro';

            $.ajax({

                type: 'post',
                url: BASE_URL + 'acessibilidade/escuro',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                },

                success: function(response) {

					location.reload();

                },

                error: function(response) {
                }

            });

        });

    }

	var claro = function() {


        $(".claro").click(function () {

			var form_data = 'claro';

            $.ajax({

                type: 'post',
                url: BASE_URL + 'acessibilidade/claro',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                },

                success: function(response) {

                    location.reload();
                },

                error: function(response) {
                }

            });

        });

    }

    return {
        init: function() {
			escuro();
			claro();
        }
    }

}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {


    });


    App_sistema.init();

});




