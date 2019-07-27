<div id="container">
	<h1>Adiciona Registro/Linha!</h1>

	<div id="body">
		<form method="post" action="<?php echo base_url('planilha/add'); ?>">
			<?php foreach ($fields as $key => $value) { $value=utf8_decode($value);
				echo "<div class='form-group'>";
		    	echo "<label for='input$value'><b>$value</b></label>";
				echo "<input type='text' value='".(!empty($_POST[$value])?$_POST[$value]:'')."' placeholder='$value' name='$value' class='form-control ".strtolower(MY_Controller::tirarAcentos($value))."' />";
			} ?>
			<br/>
			<a class="pull-left" href="<?php echo base_url('planilha'); ?>">Retornar a lista</a>
			<input type="submit" value="Salvar" class="btn btn-primary right" <?php empty($fields)?'disabled':''; ?>>
		</form>
	</div>
</div>