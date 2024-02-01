var categoria_filha = $('#categoria_filha').val();
if (categoria_filha) {
    $('.salvar_sub').css('pointer-events', 'auto');

} else {
    $('.salvar_sub').css('pointer-events', 'none');
}
$("#categoria_filha").keyup(function() {
    var categoria_filha = $(this).val();
    $('.error_nome_categoria').html('');
    if (categoria_filha) {
        $('.salvar_sub').css('pointer-events', 'auto');
        $('.error_nome_categoria').html('');
    } else {
        $('.error_nome_categoria').html("<p class='text-danger'>Título da categoria é obrigatório.</p>");
        $('.salvar_sub').css('pointer-events', 'none');

    }
});

function verificar_subcategoria() {
    var categoria_filha = $('#categoria_filha').val();
    if (categoria_filha) {
        $('.error_nome_categoria').html('');
    } else {
        $('.error_nome_categoria').html("<p class='text-danger'>Título da categoria é obrigatório.</p>");
        $('.salvar').css('pointer-events', 'none');

    }
}