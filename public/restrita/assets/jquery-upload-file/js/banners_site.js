$(document).ready(function() {

    $('.card-footer').css('visibility', 'hidden');

    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Carregando banners...</div>');

    });

    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/banners_site/upload",
        fileName: "banners",
        returnType: "json",

        onSuccess: function(files, data) {

            if (data.erro === 0) {
                $('.card-footer').css('visibility', 'visible');
                $('#carregando').html('<div class="p-1 mt-1 rounded bg-success text-white"><i class="fa fa-check" aria-hidden="true"></i> Banners carregados com sucesso!</div>');
                $("#uploaded_image").append('<div class="form-group col-md-3"><div class="p-2 border"><img src="' + BASE_URL + 'uploads/banners_site/' + data.uploaded_data['file_name'] + '" style="height: 200px; width: 100%; object-fit: contain" class="img-thumbnail mb-2"><input type="hidden" name="banner_foto[]" value="' + data.banner_titulo + '"><label>Nome</label><br><input value="' + data.nome + '" class="form-control mb-2" type="text" name="banner_titulo[]"><label>URL/link</label><input placeholder="Cole aqui link para o banner" class="form-control mb-2" type="text" name="banner_url[]"><label>Dimensões</label><br><input readonly value="' + data.medida + '" class="form-control mb-2" type="text" name="banner_medida[]"><label>Extensão</label><br><input readonly value="' + data.tipo + '" class="form-control mb-2" type="text" name="banner_tipo[]"><labe>Tamanho</label><br><input readonly value="' + data.tamanho + '" class="form-control mb-2" type="text" name="banner_tamanho[]"></div><button class="btn btn-danger btn-remove" style="width: 45px; margin: 10px auto">X</button></div>');
                $("#erro_uploaded").html('');
            } else {

                $("#erro_uploaded").html(data.mensagem);
            }

        },
    });


    $('#uploaded_image').on('click', '.btn-remove', function(event) {

        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-danger text-white ml-2',
                cancelButton: 'btn bg-primary text-white mr-20'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Tem certeza da exclusão?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;Excluir!',
            cancelButtonText: '<i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(this).parent().remove();
            } else {
                return false;
            }
        })
    });

});

// <div class="form-group col-md-3">
//     <div class="p-2 border">

//         <img src="' + BASE_URL + 'uploads/banners_site/' + data.uploaded_data['file_name'] + '" style="height: 200px; width: 100%; object-fit: contain" class="img-thumbnail mb-2">
//         <input type="hidden" name="banner_foto[]" value="' + data.banner_titulo + '">

//         <label>Nome</label><br>
//         <input value="' + data.nome + '" class="form-control mb-2" type="text" name="banner_titulo[]">

//         <label>URL/link</label><br>
//         <input placeholder="Cole aqui link para o banner" class="form-control mb-2" type="text" name="banner_url[]">

//         <label>Dimensões</label><br>
//         <input readonly value="' + data.medida + '" class="form-control mb-2" type="text" name="banner_medida[]">

//         <label>Extensão</label><br>
//         <input readonly value="' + data.tipo + '" class="form-control mb-2" type="text" name="banner_tipo[]">

//         <labe>Tamanho</label><br>
//         <input readonly value="' + data.tamanho + '" class="form-control mb-2" type="text" name="banner_tamanho[]">

//     </div>
// </div>