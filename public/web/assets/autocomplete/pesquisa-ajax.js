$(document).ready(function() {
    $('#busca').autocomplete({

        source: function(request, response) {

            $.ajax({

                url: BASE_URL + 'busca/busca_ajax',
                type: 'post',
                dataType: 'json',
                data: 'busca=' + request.term,
                beforeSend: function() {
                    $('#carregar').html('<img src="' + BASE_URL + 'public/restrita/assets/img/spinner.svg">');
                },
                success: function(data) {

                    if (data.response == "false") {

                        var result = [{

                            label: 'Resultados não encontrados!',
                            value: response.term

                        }];

                        $('#carregar').html('');

                        response(result);

                    } else {

                        $('#carregar').html('');
                        response(data.message);

                    }


                }, // fim success

            }); //fim $.ajax



        }, // fim source
        minLength: 1,
        select: function(event, ui) {

            if (ui.item.value === 'Resultados não encontrados!') {
                $('#carregar').html('');
                return false;
            } else {

                $('#busca').val(ui.item.value);
                $('#carregar').html('');
                $(event.target.form).submit(); //Submete o formulário ao clicar em uma opção o select do autocomplete

            }



        }, // fim select




    }); // fim #busca


}); // fim document