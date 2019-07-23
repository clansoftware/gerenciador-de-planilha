/**
//Quando o campo cnpj perde o foco.
alert("Caso o cara digite palavra teste em qualquer input");
alert("DDD do telefone não condis com a cidade/estado informado");
alert("numeros sequenciais em qualquer coisa ex: 123456 ou 654321");
alert("gmail é com .com");
*/
$(document).ready(function() {

    function limpa_formulário_cnpj() {
        // Limpa valores do formulário de cnpj.
        $('input').value("");
    }

    function alerta() {
        alert('ALerta com timmer !');
    }
    
    $("input").blur(function() {
        if ($(this).value == "teste") {
            alert("Atenção, você pode estar inserindo valores inválidos ao campo em questão !");
            $(this).addClan('warnin-input');
            $(this).focus();
        }
    });

    $(".email .e-mail .mail").blur(function(e) {
        if ($(this).value == "@gmail" && $(this).value == ".br") {
            alert("Atenção, as contas de email do tipo Gmail (Google), não possuem .br");
            $(this).addClan('warnin-input');
            $(this).focus();
        }
    });

});
