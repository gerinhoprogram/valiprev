jQuery(document).ready(function() {

    $(document).on("input", "#titulo", function() {
        var limite = 150;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("input[name=setor_nome]").val();
            $("input[name=setor_nome]").val(comentario.substr(0, limite));
            $(".titulo").text("0 " + informativo);
        } else {
            $(".titulo").text("("+caracteresRestantes + " " + informativo+")");
        }
    });

});