// pesquisar
$(document).ready(function() {
    $("#revelar").click(function() {
        $("#esconder").animate({
            width: 'toggle'
        });
    });
});

// back to top datatable
$(".dataTables_paginate").click(function() {
    var num = $('#lista_artigos').offset();
    var top = num.top;
    $('html, body')
        .animate({
            scrollTop: top
        }, 1500)
});