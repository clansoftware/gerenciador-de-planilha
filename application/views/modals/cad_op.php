<!-- Modal's -->
<div id="sendWhats" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de Whattsapp</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>

<div id="sendSMS" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de SMS</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <div class="form-group row">
                <label for="inputSMS" class="col-sm-2 col-form-label">Serviço de Saída:</label>
                <select class="custom-select form-controll">
                    <?php foreach (json_decode($_SESSION['service_sms']) as $key => $value) {
                        echo "<option value='$value'>".strtoupper($value)."</option>";
                    } ?>
                </select>
                <input type="checkbox" name="bg_op" checked="true">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Executar em segundo plano</label>
            </div>

            <label>Chave/Controle</label>
            <input type="text" class="form-control" placeholder="Chave interna"/>
            <label>Conteúdo</label>
            <textarea class="form-control" placeholder="Conteúdo da SMS" rows="1"></textarea>

            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Número</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_paypal">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <b>Total:</b>
                            <font class="total_row">0</font>
                        </th>
                    </tr>
                </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>

<div id="sendEmail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de Email iuwsydua</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            Serviço de Saída:
            <select class="form-controll">
                <?php foreach (json_decode($_SESSION['service_email']) as $key => $value) {
                    $ind = MY_Controller::get_next_key($key, json_decode($_SESSION['email_email']));
                    echo "<option value='$value'>".strtoupper($value)." - ".json_decode($_SESSION['email_email'])[$ind]."</option>";
                } ?>
            </select>

            Modelo:
            <select class="form-controll">
                <?php for ($i=0; $i < 4; $i++) {
                    echo "<option value=99>99</option>";
                } ?>
            </select>

            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_mail">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <b>Total:</b>
                            <font class="total_row">0</font>
                        </th>
                    </tr>
                </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>

<div id="sendPag" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de Pagamento</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="input-group">
                Saída:
                <select class="form-controll">
                    <?php foreach (json_decode($_SESSION['service_pagamento']) as $key => $value) {
                        $ind = MY_Controller::get_next_key($key, json_decode($_SESSION['usuario_pagamento']));
                        echo "<option value='$value'>".strtoupper($value)." - ".json_decode($_SESSION['usuario_pagamento'])[$ind]."</option>";
                    } ?>
                </select>

                <div class="input-group-prepend">
                    <div class="input-group-text">Valor Unitário: R$</div>
                </div>
                <input type="text" class="form-control money" value="0,00" min="1" />

                <div class="input-group-prepend">
                    <div class="input-group-text">Total Previsionado: R$</div>
                </div>
                <input type="text" class="form-control money" value="0,00" min="1" readonly="true"/>
            </div>
            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Cartão</th>
                        <th>Bandeira</th>
                        <th>Validade</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_pag">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <b>Total:</b>
                            <font class="total_row">0</font>
                        </th>
                    </tr>
                </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <input type="checkbox" name="bg_op" checked="true"> Executar em segundo plano
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>