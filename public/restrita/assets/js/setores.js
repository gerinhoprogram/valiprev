$(document).ready(function() {

    $(document).on("input", "#titulo", function() {
        var limite = 150;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("input[name=name]").val();
            $("input[name=name]").val(comentario.substr(0, limite));
            $(".titulo").text("0 " + informativo);
        } else {
            $(".titulo").text("(" + caracteresRestantes + " " + informativo + ")");
        }
    });

    $(document).on("input", "#description", function() {
        var limite = 220;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("input[name=description]").val();
            $("input[name=description]").val(comentario.substr(0, limite));
            $(".description").text("0 " + informativo);
        } else {
            $(".description").text("(" + caracteresRestantes + " " + informativo + ")");
        }
    });

});