$("body").click(function () {
    var categoria = $('#master').val();
    var titulo = $('#nome').val();
    var imagem = $('#imagem').val(); 

    if (titulo == '') {
        $('#artigo_titulo').html('<span class="erro_titulo text-danger"><i class="fa fa-exclamation-triangle"></i> Título inválido!</span>');
        $('.card-footer').css('display', 'none');
    }
    else {
        $('.erro_titulo').css('display','none'); 
    }

    if(categoria ==''){
        $('#artigo_categoria').html('<span class="erro_categoria text-danger"><i class="fa fa-exclamation-triangle"></i> Selecione uma categoria!</span');
        $('.card-footer').css('display', 'none');
    }
    else {
        $('.erro_categoria').css('display','none'); 
    }


    if(imagem == undefined){
        $('#uploaded_image').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Selecione ao menos uma imagem!</span');
        $('.card-footer').css('display', 'none');
    }

    if(titulo !='' && categoria !='' && imagem != undefined){
        $('.card-footer').css('display', 'block');
    }


});

$('#master').on('change', function () {

    var artigo_categoria_pai_id = $(this).val();

    if (artigo_categoria_pai_id) {

        $.ajax({

            type: 'POST',
            url: BASE_URL + 'restrita/artigos/get_categorias_filhas',
            dataType: 'json',
            data: {

                artigo_categoria_pai_id: artigo_categoria_pai_id,

            },
            beforeSend: function () {
                $('#artigo_categoria').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Carregando categorias...</div>');
            },
            success: function (data) {


                if (data) {
                    $('#artigo_categoria').html('<div class="p-1 mt-1 mb-3 rounded bg-success text-white"><i class="fas fa-check"></i> Selecione as categorias secundárias (Não é obrigatório)</div>');

                    $(data).each(function () {


                        $('#artigo_categoria').append('<div class="custom-control custom-radio custom-control-inline badge badge-info"><input type="checkbox" id="' + this.categoria_id + '" class="custom-control-input" value="' + this.categoria_id + '" name="artigo_categoria_id[]"><label class="custom-control-label" for="' + this.categoria_id + '">' + this.categoria_nome + '</label></div>');

                    });

                } else {

                    $('#artigo_categoria').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-white"><i class="fa fa-exclamation-triangle"></i> Não existe subcategorias para a categoria selecionada, mas você ainda pode cadastrar seu artigo!</div>');

                }

            }

        });

    } else {
        $('#artigo_categoria').html('<option value="">Escolha uma categoria principal</option>');
    }

});

$('#nome').on('keyup', function () {

    var titulo = $(this).val();
    var artigo_id = $('#artigo_id').val();

    if (titulo.length <= 0 || !titulo.trim()) {

        $('#artigo_titulo').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Título inválido!</div>');
        $('.card-footer').css('display', 'none');

    } else {

        $.ajax({

            type: 'POST',
            url: BASE_URL + 'restrita/artigos/get_artigos',
            dataType: 'json',
            data: {

                titulo: titulo,
                artigo_id: artigo_id

            },
            beforeSend: function () {
                $('#artigo_titulo').html('<span>Verificando...</span>');
            },
            success: function (data) {


                if (data) {
                    $('#artigo_titulo').html('<span class="text-success"><i class="fas fa-check"></i> Título ok</span>');
                    $('.card-footer').css('display', 'block');
                } else {

                    $('#artigo_titulo').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Este registro já existe!</div>');
                    $('.card-footer').css('display', 'none');
                }
            }

        });

    }

});

$(document).ready(function () {

    $('.card-footer').css('display', 'none');

    var max_fields = 15; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_seo"); //Add button ID
    //   alert('ok');

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var length = wrapper.find("input:text").length;

        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group col-md-2 p-1"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-hashtag text-info"></i></div></div><input type="text" class="form-control" name="artigo_seo[]" /></div><a href="#" class="btn btn-danger remove_seo mt-1">Remover</a></div>'); //add input box
        }
        //Fazendo com que cada uma escreva seu name
        // wrapper.find("input:text").each(function() {
        //   $(this).val($(this).attr('name'))
        // });
        wrapper.find("input:text").focus();
    });

    $(wrapper).on("click", ".remove_seo", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

});

// $('#nome').on({
//     blur: function () {
//         var titulo = $(this).val();
//         if (titulo.length <= 0) {
//             $('#artigo_titulo').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Título inválido!</div>');
//             $('.card-footer').css('display', 'none');
//         } else {
//             $('.card-footer').css('display', 'block');
//         }
//     }
// })


// var nome = $('#nome').val();
// var imagem = $('.imagem').val();
// if (nome && imagem) {
//     $('.salvar_artigo').css('pointer-events', 'auto');

// } else {
//     $('.salvar_artigo').css('pointer-events', 'none');
// }

// $("#nome").keyup(function() {
//     var nome = $(this).val();
//     var imagem = $('.imagem').val();
//     $('.erro_nome').html('');
//     if (nome && imagem) {
//         $('.salvar_artigo').css('pointer-events', 'auto');
//         $('.erro_nome').html('');
//         $('.erro_imagem').html('');
//     } else {
//         if (!nome) {
//             $('.erro_nome').html("Título do artigo é obrigatório.");
//             $('.salvar_artigo').css('pointer-events', 'none');
//         }

//         if (!imagem) {
//             $('.erro_foto').html("Foto do artigo é obrigatório.");
//             $('.salvar_artigo').css('pointer-events', 'none');
//         }
//     }
// });

// function verificar() {
//     var nome = $('#nome').val();
//     var imagem = $('.imagem').val();
//     if (nome && imagem) {
//         $('.erro_nome').html('');
//         $('.erro_imagem').html('');
//     } else {
//         if (!nome) {
//             $('.erro_nome').html("Título do artigo é obrigatório.");
//             $('.salvar_artigo').css('pointer-events', 'none');
//         }

//         if (!imagem) {
//             $('.erro_imagem').html("Foto do artigo é obrigatório.");
//             $('.salvar_artigo').css('pointer-events', 'none');
//         }
//     }
// }
