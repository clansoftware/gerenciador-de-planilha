$(document).ready(function() {

    function limpa_formulário_cnpj() {
        // Limpa valores do formulário de cnpj.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cnpj perde o foco.
    $(".cnpj").blur(function() {

        //Nova variável "cnpj" somente com dígitos.
        var cnpj = $(this).val().replace(/\D/g, '');

        //Verifica se campo cnpj possui valor informado.
        if (cnpj != "") {

            //Expressão regular para validar o cnpj.
            var validacnpj = /^[0-9]{8}$/;

            //Valida o formato do cnpj.
            if(validacnpj.test(cnpj)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $(".rua").val("...");
                $(".bairro").val("...");
                $(".cidade").val("...");
                $(".uf").val("...");
                $(".ibge").val("...");

                //Consulta o webservice viacnpj.com.br/
                $.getJSON("https://viacnpj.com.br/ws/"+ cnpj +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $(".rua").val(dados.logradouro);
                        $(".bairro").val(dados.bairro);
                        $(".cidade").val(dados.localidade);
                        $(".uf").val(dados.uf);
                        $(".ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //cnpj pesquisado não foi encontrado.
                        limpa_formulário_cnpj();
                        alert("CNPJ não encontrado.");
                    }
                });
            } //end if.
            else {
                //cnpj é inválido.
                limpa_formulário_cnpj();
                alert("Formato de CNPJ inválido.");
            }
        } //end if.
        else {
            //cnpj sem valor, limpa formulário.
            limpa_formulário_cnpj();
        }
    });
});
