var App_config = function() {

    var envia_configuracoes = function() {

        $(document).on('change', '[name="con_sidebar_cor"]', function() {

            var cor = $(this).val();
            $(".main-sidebar").css("background-color", cor, "!important");

        });

        $(document).on('change', '[name="con_sidebar_cor_fonte"]', function() {

            var cor_fonte = $(this).val();
            $(".main-sidebar li a").css("color", cor_fonte, "!important");

        });

        $(document).on('change', '[name="con_sidebar_cor_hover"]', function() {

            var cor_fonte = $(this).val();
            $(".sidebar-menu li:hover").css("background-color", cor_fonte, "!important");

        });

        // remover a data 
        $(document).on('click', '#remContato', function() {
            $(this).parents('.dias').remove();
            $('#btn_salvar').html("<input type='submit' value='Salvar' />");
        });

    }

    return {
        init: function() {
            envia_configuracoes();
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

    App_config.init();

});