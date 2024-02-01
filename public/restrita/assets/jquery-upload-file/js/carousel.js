$(document).ready(function() {
    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Carregando banners...</div>');

    });
    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/carousel/upload",
        fileName: "foto_banner",
        returnType: "json",

        onSuccess: function(files, data) {

            if (data.erro === 0) {
                $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-success text-white"><i class="fa fa-check" aria-hidden="true"></i> Banners carregados com sucesso!</div>');
                $("#uploaded_image").append('<div class="form-group col-md-6"><div class="p-2 border"><img src="' + BASE_URL + 'uploads/sistema/carousel/' + data.uploaded_data['file_name'] + '" style="height: 200px; width: 100%; object-fit: contain" class="img-thumbnail"><label class="mt-3 mb-0">Link (opcional, Link ao clicar no banner)</label><input class="form-control" type="text" name="link[]"><label class="mt-3 mb-0">Título (opcional, para identificação interna no sistema)</label><input class="form-control" type="text" name="titulo[]"><label class="mt-1 mb-0">Texto (opcional, texto aparece sobre o banner no site/blog)</label><input class="form-control" type="text" name="texto[]"><div class="custom-control custom-radio"><input type="radio" class="mt-2 ml-2" name="foto_principal" id="' + data.foto_nome + '"><label for="' + data.foto_nome + '" class="mt-3 ml-2">Foto principal</label></div><div class="mt-3 mb-4 custom-control custom-radio"><input type="checkbox" name="ativo[]" id="'+ data.foto_nome +'" ><label for="'+ data.foto_nome +'" class="mt-3 ml-2">Ativo</label></div><input class="form-control" type="hidden" name="banner[]" value="' + data.uploaded_data['file_name'] + '"><button class="btn btn-danger btn-remove" style="width: 45px; margin: 10px auto">X</button></div></div>');
                $("#erro_uploaded").html();
            } else {

                $("#erro_uploaded").html(data.mensagem);
                $("#carregando").html('');
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