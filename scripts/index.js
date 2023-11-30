$(document).ready(function () {
    
    $.fn.maskInput();

    $("#botaoConsulta").on('click', function(){
        $('#campo_erro').removeClass('bg-warning');
        let data = {acao: $(this).data().acao, numeroCNJ: $('#numeroCNJ').val()};
        $.ajax({
            type: "POST",
            url: `acao.php`,
            dataType: "",
            data: data,
        })
        .done(function(result) {
            console.log('resultado: ');
            console.log(result);
            if (result.match('Erro')) {
                console.log('entrou no if')
                $('#campo_erro').addClass('bg-warning');
                $('#campo_erro').html(result);
            } else {
                $('#resultadoProcesso').html(result);
            }
        });
    });

    
});


$.fn.maskInput = function( options ){
    var settings = $.extend({
        mask: '9999999-99.9999.9.99.9999',
    }, options );

    $.each($('#numeroCNJ'), function(index, val){

        $(this).maskMoney('destroy');

        $(this).inputmask({mask: settings.mask, keepStatic: true});
        
    });

};

