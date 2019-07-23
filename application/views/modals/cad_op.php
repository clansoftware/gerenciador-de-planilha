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
            <input type="checkbox" name="bg_op" checked="true"> Executar em segundo plano
            <label>Assunto</label>
            <input type="text" class="form-control" placeholder="Assunto do email"/>
            <label>Conteúdo</label>
            <textarea class="form-control" placeholder="Conteúdo do email" rows="1"></textarea>

            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Email</th>
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

<div id="sendCielo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de Cielo</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="input-group">
                Token de Saída:
                <select class="custom-select">
                    <?php foreach ($pyapal_accounts as $key => $value) {
                        echo "<option value='$value'>$value</option>";
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
                        <th>Validade</th>
                        <th>Vencimento</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_paypal">

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
            <div lcass="pull-left left">
                Executar em segundo plano:
                <input type="checkbox" name="bg_op" checked="true">
            </div>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>

<div id="sendPagSeguro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Envio de PagSeguro</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            Token de Saída:
            <select class="form-controll">
                <?php foreach ($pyapal_accounts as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                } ?>
            </select>
            Executar em segundo plano:
            <input type="checkbox" name="bg_op" checked="true">
            <label>Custo Unitário</label>
            <input type="text" class="form-control dinheiro" value="" min="1" />
            <label>Total Previsionado</label>
            <input type="text" class="form-control dinheiro" value="0,00" />

            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Cartão</th>
                        <th>Validade</th>
                        <th>Vencimento</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_paypal">

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
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>

<div id="sendPaypal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Envio de PayPal</h6>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            Token de Saída:
            <select class="form-controll">
                <?php foreach ($pyapal_accounts as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                } ?>
            </select>
            Executar em segundo plano:
            <input type="checkbox" name="bg_op" checked="true">
            <label>Custo Unitário</label>
            <input type="text" class="form-control dinheiro" value="" min="1" />
            <label>Total Previsionado</label>
            <input type="text" class="form-control dinheiro" value="0,00" />

            <table class="table table-sm table-hover table-striped table-bordered table-borderless display">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Cartão</th>
                        <th>Validade</th>
                        <th>Vencimento</th>
                    </tr>
                </thead>
                <tbody class="list_seleted_paypal">

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
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-warning btn-sm">Iniciar</button>
          </div>
        </div>
    </div>
</div>