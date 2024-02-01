// calcula tempo de leitura
function readingRate(textContainerID) {
    // Validação
    if (typeof textContainerID !== "string" || textContainerID.length === 0)
        throw new Error("Parametro 'textContainerID' inválido");

    let readingRateInSeconds = 0;
    // Recuperando elemento HTML
    const textContainer = window.document.getElementById(textContainerID);
    // Pegando todos os textos
    const content = textContainer.innerText;
    // Quantidade de palavras do texto
    const wordCount = content.split(" ").length;
    // Processando o tempo de leitura
    readingRateInSeconds = (wordCount * 60) / 120;

    return readingRateInSeconds;
}

var tempo = readingRate("content");

// converte segundos 
function convertHMS(tempo) {
    const sec = parseInt(tempo, 10); // convert value to number if it's string
    let hours = Math.floor(sec / 3600); // get hours
    let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
    let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds
    // add 0 if value < 10; Example: 2 => 02
    if (hours < 10) { hours = "0" + hours; }
    if (minutes < 10) { minutes = "0" + minutes; }
    if (seconds < 10) { seconds = "0" + seconds; }

    if (hours > 0) {
        return hours + 'h ' + minutes + 'm ' + seconds + 's ';
    } else if (minutes > 0) {
        return minutes + 'm ' + seconds + 's';
    } else {
        return seconds + 's';
    }

}

var horas = convertHMS(tempo);

document.querySelector("[name='artigo_tempo_leitura']").value = horas;

$(document).ready(function() {

    // salva o tempo de leitura em ajax
    var artigo_leitura = $('#artigo_leitura').val();
    var artigo_id = $('#artigo_id').val();

    $.ajax({

        type: 'POST',
        url: BASE_URL + 'restrita/artigos/salva_leitura',
        dataType: 'json',
        data: {

            artigo_leitura: artigo_leitura,
            artigo_id: artigo_id,

        },
        beforeSend: function() {

        },
        success: function(response) {

            if (response.erro === 0) {


            } else {


            }

        },
        error: function() {

        }
    });

});