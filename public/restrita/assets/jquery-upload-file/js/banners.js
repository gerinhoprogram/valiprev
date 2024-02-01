$(document).ready(function() {
    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Carregando banners...</div>');

    });
    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/banners_cta/upload",
        fileName: "foto_cta",
        returnType: "json",

        onSuccess: function(files, data) {

            if (data.erro === 0) {
                $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-success text-white"><i class="fa fa-check" aria-hidden="true"></i> Banners carregados com sucesso!</div>');
                $("#uploaded_image").append('<div class="form-group col-md-3"><div class="p-2 border"><img src="' + BASE_URL + 'uploads/banners_cta/' + data.uploaded_data['file_name'] + '" style="height: 150px; width: 100%; object-fit: contain" class="img-thumbnail"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_nome + '"><label class="mt-1 mb-0">Url</label><input class="form-control" type="text" name="cta_url[]"><label class="mt-1 mb-0">Título</label><input class="form-control" type="text" name="cta_titulo[]"><input class="form-control" type="hidden" name="cta_imagem[]" value="' + data.uploaded_data['file_name'] + '"><button class="btn btn-danger btn-remove" style="width: 45px; margin: 10px auto">X</button></div></div>');
                $("#erro_uploaded").html();
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