<div id="container" class="containes">
	<h1>Seja bem vindo ao CSV++!</h1>

	<div id="body" class="row">
    	<div class="col-sm">
			<table class="table table-sm table-hover table-striped table-bordered table-borderless display pull-left">
				<thead>
					<th colspan="2" align="center">
						<img class="pull-left" src="<?php echo base_url('assets/readme/csv_48.png'); ?>" />
						<h3>CSV++</h3>
					</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<img src="<?php echo base_url('assets/readme/tick.png'); ?>" width="18px"/>
						</td>
						<td>
							Controle de acesso via credenciais de login e senha
						</td>
					</tr>
					<tr>
						<td>
							<img src="<?php echo base_url('assets/readme/tick.png'); ?>" width="18px"/>
						</td>
						<td>
							Persistência dos registros em base dados, caso não haja uma planilha para tal, ocorre a criação da mesma com as configurações escolhidas pelo usuário
						</td>
					</tr>
					<tr>
						<td>
							<img src="<?php echo base_url('assets/readme/tick.png'); ?>" width="18px"/>
						</td>
						<td>
							Envio de Email massivo, a todos os registro de email localizados na planilha, via email privado ou API de disparo de email
						</td>
					</tr>
					<tr>
						<td>
							<img src="<?php echo base_url('assets/readme/tick.png'); ?>" width="18px"/>
						</td>
						<td>
							Envio de SMS massivo com integração a API: papoSMS ou Mobipromo
						</td>
					</tr>
					<tr>
						<td>
							<img src="<?php echo base_url('assets/readme/tick.png'); ?>" width="18px"/>
						</td>
						<td>
							Envio de Whats massivo a todos os números de celulares identificados com whattsapp
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm">
			<br/>
			<p>Esta é a página inicial do seu sistema gerenciador de planilhas CSV++.</p>

			<p>Se você precisar alterar alguma configuração, utilize o link a baixo:</p>
			<code>application/views/welcome_message.php</code>

			<p>Caso tenha dúvidas, utilize o link a baixo:</p>
			<code>application/controllers/Welcome.php</code>

			<p>Esta é uma versão <font>gratuita<font> do sistema, para obter a versão completa  <a href="user_guide/">Clique Aqui</a>.</p>
		</div>
	</div>

	<p class="footer">Tempo de execução <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'Versão Atual: <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>