$(document).ready(function() {

    $("#fileuploader").change(function() {
        $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-warning text-dark"><img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg"> Aguarde o carregamento da(s) foto(s)...</div>');

    });

    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/capacitacao_de_servidores/upload_pdf",
        fileName: "foto_produto",
        returnType: "json",
        onSuccess: function(files, data) {
            if (data.erro === 0) {
                $('.salvar_artigo').css('pointer-events', 'auto');
                $('.erro_imagem').html('');
                // $('#uploaded_image').html('');
                $("#erro_uploaded").html('');
                $('#carregando').html('<div class="p-1 mt-1 mb-1 rounded bg-success text-white"><i class="fa fa-check" aria-hidden="true"></i> Fotos carregadas com sucesso!</div>');

                $("#uploaded_image").append(
					'<div class="form-group col-md-3">'+
					'<a href="' + BASE_URL + 'uploads/paginas/capacitacao-de-servidores/pdf/' + data.uploaded_data['file_name'] + '" target="_blank"><i style="font-size: 25pt" class="far fa-file-pdf"></i></a><input type="text" class="form-control mt-2" placeholder="Título do documento" name="foto_titulo[]"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_nome + '"><button type="button" class="btn btn-danger btn-remove" style="width: 45px">X</button></div>');

            } else {
                $('#carregando').html('');
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
                $('#carregando').html('');
            } else {
                return false;
            }
        })
    });



    $(document).on("input", "#legenda", function() {
        var limite = 200;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("textarea[name=artigo_legenda]").val();
            $("textarea[name=artigo_legenda]").val(comentario.substr(0, limite));
            $(".legenda").text("0 " + informativo);
        } else {
            $(".legenda").text(caracteresRestantes + " " + informativo);
        }
    });

    $(document).on("input", "#nome", function() {
        var limite = 150;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("textarea[name=artigo_titulo]").val();
            $("textarea[name=artigo_titulo]").val(comentario.substr(0, limite));
            $(".titulo").text("0 " + informativo);
        } else {
            $(".titulo").text(caracteresRestantes + " " + informativo);
        }
    });

});
