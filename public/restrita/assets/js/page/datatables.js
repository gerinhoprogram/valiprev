"use strict";

// TRADUÇÃO DATABLE
const DATATABLE_PTBR = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoThousands": ".",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "sAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    },
    "sSelect": {
        "rows": {
            "_": "Selecionado %d linhas",
            "0": "Nenhuma linha selecionada",
            "1": "Selecionado 1 linha"
        },
        "1": "%d linha selecionada",
        "_": "%d linhas selecionadas",
        "cells": {
            "1": "1 célula selecionada",
            "_": "%d células selecionadas"
        },
        "columns": {
            "1": "1 coluna selecionada",
            "_": "%d colunas selecionadas"
        }
    },
    "sButtons": {
        "sSopySuccess": {
            "1": "Uma linha copiada com sucesso",
            "_": "%d linhas copiadas com sucesso"
        },
        "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
        "colvis": "Visibilidade da Coluna",
        "colvisRestore": "Restaurar Visibilidade",
        "copy": "Copiar",
        "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
        "copyTitle": "Copiar para a Área de Transferência",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todos os registros",
            "1": "Mostrar 1 registro",
            "_": "Mostrar %d registros"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Preencher todas as células com",
        "fillHorizontal": "Preencher células horizontalmente",
        "fillVertical": "Preencher células verticalmente"
    },
    "sLengthMenu": "Exibir _MENU_ resultados por página",
    "searchBuilder": {
        "add": "Adicionar Condição",
        "button": {
            "0": "Construtor de Pesquisa",
            "_": "Construtor de Pesquisa (%d)"
        },
        "clearAll": "Limpar Tudo",
        "condition": "Condição",
        "conditions": {
            "date": {
                "after": "Depois",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
            },
            "number": {
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "gt": "Maior Que",
                "gte": "Maior ou Igual a",
                "lt": "Menor Que",
                "lte": "Menor ou Igual a",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
            },
            "string": {
                "contains": "Contém",
                "empty": "Vazio",
                "endsWith": "Termina Com",
                "equals": "Igual",
                "not": "Não",
                "notEmpty": "Não Vazio",
                "startsWith": "Começa Com"
            }
        },
        "data": "Data",
        "deleteTitle": "Excluir regra de filtragem",
        "logicAnd": "E",
        "logicOr": "Ou",
        "title": {
            "0": "Construtor de Pesquisa",
            "_": "Construtor de Pesquisa (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Limpar Tudo",
        "collapse": {
            "0": "Painéis de Pesquisa",
            "_": "Painéis de Pesquisa (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Nenhum Painel de Pesquisa",
        "loadMessage": "Carregando Painéis de Pesquisa...",
        "title": "Filtros Ativos"
    },
    "searchPlaceholder": "Digite um termo para pesquisar",
    "thousands": "."
}



$('#tableExport').DataTable({
    oLanguage: DATATABLE_PTBR,
    "lengthMenu": [
        [50, 100, 200, -1],
        [50, 100, 200, "Todos"]
    ],
    "order": [],
    "pagingType": "simple",
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});


$(".data-table").dataTable({

    "order": [], //Remove a ordenação padrão do plguin

    "columnDefs": [
        { "sortable": false, "targets": ['nosort'] }
    ]
});



$(".artigos-home").dataTable({

    'oLanguage': DATATABLE_PTBR,

    "searching": false,

    "order": [],

    "pagingType": "simple",

    "columnDefs": [
        { "sortable": false, "targets": ['nosort'] }
    ]
});


$(".table-artigos").dataTable({

    'oLanguage': DATATABLE_PTBR,

    "order": [],

    "lengthMenu": [
        [30, 50, 100, -1],
        [30, 50, 100, "Todos"]
    ],

    deferRender: true,

    "columnDefs": [
        { "sortable": false, "targets": ['nosort'] }
    ]
});


$(".table-home").dataTable({

    'oLanguage': DATATABLE_PTBR,
    "order": [], //Remove a ordenação padrão do plugin

    "lengthMenu": [
        [5, 20, 50, -1],
        [5, 20, 50, "Todos"]
    ],
    "columnDefs": [
        { "sortable": false, "targets": ['nosort'] }
    ]
});