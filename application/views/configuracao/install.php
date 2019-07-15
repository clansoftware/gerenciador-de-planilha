<div class="container">
    <div class="stepwizard">
        <img src="<?php echo base_url('assets/readme/csv_128.png'); ?>" />
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p class="mr-5"><small>Configuração Geral</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Funções Externas</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Funções Internas</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Comlpementos</small></p>
            </div>
             <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Controlles</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" method="POST" action="<?php echo base_url(); ?>">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Configurações Gerais</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Diretório das planilha</label>
                    <input name="diretorio_planilha" type="file" required="required" class="form-control" placeholder="Diretório das Planilhas" />
                </div>
                <div class="form-group">
                    <label class="control-label">Nome do Sistema</label>
                    <input name="nome_sistema" maxlength="200" type="text" required="required" class="form-control" placeholder="Nome do Sistema" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
            </div>
        </div>
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Funções Externas</h3>
            </div>
            <div class="panel-body" ng-controller="myController">
                <div class="form-group">
                    <label class="control-label">Habilitar envio de SMS? </label><br>
                 <input maxlength="100" type="checkbox" name="sendSMS" ng-model="hideSalary">
                 Habilitar enviar SMS aos possíveis números de celular identificados, através da API de envio:
                 <div ng-hide="hideSalary">
                   
                </div>

                </div>

                <div class="form-group">
                    <label class="control-label">Habilitar envio de Whattsapp? </label><br>
                 <input maxlength="100" type="checkbox" name="sendWhattsapp" />
                 Habilitar envio de Whattsapp, a partir de uma aba logada externa.
                </div>

                <div class="form-group">
                    <label class="control-label">Habilitar envio de Email? </label><br>
                 <input maxlength="100" type="checkbox" name="sendemail" />
                 Habilitar envio de Email's aos possíveis emails identificados, através do Host:
                </div>

                <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
            </div>
        </div>

        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Funções Internas</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Conectar a um Banco de Dados</label>
                    <input type="checkbox" name="banco_de_dados" />
                    Habilitar Conexão a Base de Dados através do Host:
                    <input name="bd_host" maxlength="200" type="text" class="form-control" placeholder="Host" />
                    <input name="bd_porta" maxlength="200" type="text" class="form-control" placeholder="Porta" />
                    <input name="bd_banco" maxlength="200" type="text" class="form-control" placeholder="Data Base" />
                    <input name="bd_usuario" maxlength="200" type="text" class="form-control" placeholder="Usuário" />
                    <input name="bd_senha" maxlength="200" type="password" class="form-control" placeholder="Senha" />
                </div>
                <div class="form-group">
                    <label class="control-label">Mapa Set</label>
                    <input type="file" class="disable" placeholder="" readonly="true" disable="true"/>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Controlles</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Controllar acesso via login</label>
                    <br/>
                    <input type="checkbox" name="controlle_acesso" />
                    Habilitar tela de login para acessar o sistema
                </div>

                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="yourmail@example.com" name="email" type="text">
                    </div>
                    <div class="form-group">
                        <input name="usuario_senha[]" maxlength="200" type="text" required="required" class="form-control" placeholder="Senha" />
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="usuario_nivel" type="checkbox" value="Remember Me"> Administrador, ou seja, pode gerenciar usuários
                        </label>
                    </div>
                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                </fieldset>
                
                <button class="btn btn-success pull-right" type="submit">Finalizar!</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>