<div class="container" ng-app="ngAnimate">
    <div class="stepwizard">
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
        </div>
    </div>
    <form action="<?php echo base_url('configuracao/add'); ?>" method="post" enctype="multipart/form-data">    
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Configurações Gerais</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Diretório das planilha</label>
                    <input name="diretorio_planilha" type="file" required="required" class="btn btn-block btn-outline-warning" placeholder="Diretório das Planilhas" />
                </div>
                <div class="form-group">
                    <label class="control-label">Nome do Sistema</label>
                    <input name="nome_sistema" maxlength="60" value="CSV++" type="text" required="required" class="form-control" placeholder="Nome do Sistema" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Avançar</button>
            </div>
        </div>
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Funções Externas</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label">Habilitar envio de Email? </label><br>
                    <input type="checkbox" class="custom-control-input" name="email" ng-model="checked_mail" aria-label="Toggle ngShow">
                    Habilitar envio de Email's aos possíveis emails identificados, através do Host:

                    <div class="check-element animate-show-hide" ng-show="checked_mail">
                        <div class="form-inline" id="list_email">
                            <div class="row">
                                <div class="col-auto">
                                    <select class="form-control form-control-sm service_email" onclick="show_hide_filed($(this))" name="service_email[]">
                                        <option value="ses">SES</option>
                                        <option value="gmail">Gmail</option>
                                        <option value="hotmail">Hotmail</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <div class="ses row">
                                        <input class="form-control form-control-sm" type="text" name="credenciais_email[]" placeholder="Credencial" value="" />
                                        <input class="form-control form-control-sm" type="text" name="token_email[]" placeholder="Token" value="" />
                                        <input class="form-control form-control-sm" type="text" name="email_email[]" placeholder="Email" value="" />
                                        <input type="button" class="btn btn-outline-success btn-sm" value="Validar" />
                                        <input onclick="remove_this($(this));" type="button" class="btn btn-outline-danger btn-sm" value="Excluir" />
                                    </div>
                                    <div class="mail row d-none">
                                        <input class="form-control form-control-sm" type="text" name="email_email[]" placeholder="Email" value="" />
                                        <input class="form-control form-control-sm" type="password" name="senha_email[]" placeholder="senha" value="" />
                                        <input type="button" class="btn btn-outline-success btn-sm" value="Validar" />
                                        <input onclick="remove_this($(this));" type="button" class="btn btn-outline-danger btn-sm" value="Excluir" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <br/>
                            <input onclick="add_more_list_email();" type="button" class="btn btn-outline-secondary btn-block btn-sm" value=" + Adicionar outra opção" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Habilitar envio de SMS? </label><br>
                    <input type="checkbox" class="custom-control-input" name="sms" ng-model="checked_sms" aria-label="Toggle ngShow">
                    Habilitar enviar SMS aos possíveis números de celular identificados, através da API de envio:
                    <div class="check-element animate-show-hide" ng-show="checked_sms">
                        <div class="form-inline" id="list_sms">
                            <div class="row">
                                <div class="col-auto">
                                    <select class="form-control form-control-sm" name="service_sms[]">
                                        <option value="mobipromo">Mobipromo</option>
                                        <option value="paposms">PapoSMS</option>
                                        <option value="zenvia">Zenvia</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <input class="form-control form-control-sm" type="text" name="username_sms[]" placeholder="Credencial" value="" />
                               
                                    <input class="form-control form-control-sm" type="text" name="password_sms[]" placeholder="Token" value="" />
                                
                                    <input class="form-control form-control-sm" type="text" name="controle_sms[]" placeholder="Controle Principal" value="" />

                                    <input type="button" class="btn btn-outline-success btn-sm" value="Validar" />
                                    <input type="button" class="btn btn-outline-danger btn-sm" value="Excluir" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <br/>
                            <input onclick="add_more_list_sms()" type="button" class="btn btn-outline-secondary btn-block btn-sm" value=" + Adicionar outra opção" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Habilitar envio de Whattsapp?</label><br>
                 <input type="checkbox" class="custom-control-input" name="sendWhattsapp" />
                 Habilitar envio de Whattsapp, a partir de uma aba logada externa.
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
                    <label class="control-label">Conectar a um Banco de Dados</label><br/>
                    <input type="checkbox" class="custom-control-input" name="banco_de_dados" ng-model="checked_db_connect" aria-label="Toggle ngShow"/>
                    Habilitar Conexão a Base de Dados através do Host:
                    <div class="check-element animate-show-hide" ng-show="checked_db_connect">
                        <div class="form-inline" id="list_db">                    
                            <div class="row">
                                <div class="col-auto">
                                    <select class="form-control form-control-sm" name="service_db[]">
                                        <option valu="mysql">MySQL</option>
                                        <option value="postgres">Postgres</option>
                                        <option value="firebase">Firebase</option>
                                        <option value="mongo">Mongo</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm" type="text" name="host_db[]" placeholder="Host" value="" />
                                    <input class="form-control form-control-sm" type="text" name="porta_db[]" placeholder="Porta" value="" />
                                    <input class="form-control form-control-sm" type="text" name="data_base_db[]" placeholder="Data Base" value="" />
                                    <input class="form-control form-control-sm" type="text" name="usuario_db[]" placeholder="Usuário" value="" />
                                    <input class="form-control form-control-sm" type="password" name="senha_db[]" placeholder="Senha" value="" />
                                    <input type="button" class="btn btn-outline-success btn-sm" value="Validar" />
                                    <input type="button" class="btn btn-outline-danger btn-sm" value="Excluir" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <br/>
                            <input onclick="add_more_list_db()" type="button" class="btn btn-outline-secondary btn-block btn-sm" value=" + Adicionar outra opção" />
                        </div>
                    </div>  
                </div>

                <div class="form-group">
                    <label class="control-label">Habilitar cobrança de valores? </label><br>
                    <input type="checkbox" class="custom-control-input" name="pagamento" ng-model="checked_pagamento" aria-label="Toggle ngShow">
                    Habilitar o envio de cobrança com pagamento:
                    <div class="check-element animate-show-hide" ng-show="checked_pagamento">
                        <div class="form-inline" id="list_pag">
                            <div class="row">
                                <div class="col-auto">
                                    <select class="form-control form-control-sm" name="service_pagamento[]">
                                        <option value="mobipromo">CIELO</option>
                                        <option value="paposms">PagSeguro</option>
                                        <option value="zenvia">Paypal</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <input class="form-control form-control-sm" type="text" name="token_pagamento[]" placeholder="Token" value="" />
                               
                                    <input class="form-control form-control-sm" type="text" name="password_pagamento[]" placeholder="senha" value="" />
                                
                                    <input class="form-control form-control-sm" type="text" name="usuario_pagamento[]" placeholder="Usuário" value="" />

                                    <input type="button" class="btn btn-outline-success btn-sm" value="Validar" />
                                    <input type="button" class="btn btn-outline-danger btn-sm" value="Excluir" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <br/>
                            <input onclick="add_more_list_pag()" type="button" class="btn btn-outline-secondary btn-block btn-sm" value=" + Adicionar outra opção" />
                        </div>
                    </div>
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
                    <input type="checkbox" class="custom-control-input" name="controlle_acesso" ng-model="checked_control_acess" aria-label="Toggle ngShow"/>
                    Habilitar tela de login para acessar o sistema
                </div>
                <div class="check-element animate-show-hide" ng-show="checked_control_acess">
                    <div class="form-inline" id="list_user">                    
                        <div class="col-auto">
                            <div class="row">
                                <input class="form-control form-control-sm" type="text" name="login[]" placeholder="Login/Email" value="" />
                                <input class="form-control form-control-sm" type="text" name="senha[]" placeholder="Senha" value="" />
                                <label class="form-check-label">
                                    <input type="checkbox" class="custom-control-input" name="isAdmin[]" /> Administrador
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <br/>
                        <input onclick="add_more_list_user()" type="button" class="btn btn-outline-secondary btn-block btn-sm" value=" + Adicionar outra opção" />
                    </div>
                </div>
                <br />
                <input type="submit" class="btn btn-success pull-right" value="Finalizar!">
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