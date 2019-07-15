<div id="container">
	<h1>Cadastrar Pessoa!</h1>

	<div id="body">
		<form method="post" action="<?php echo base_url('pessoa/add'); ?>">
			<?php foreach ($fields as $key => $value) {
				echo "<div class='form-group'>";
		    	echo "<label for='input$value'><b>$value</b></label>";
				echo "<input type='text' value='".(!empty($_POST[$value])?$_POST[$value]:'')."' placeholder='$value' name='$value' class='form-control $value' />";
			} ?>
			<br/>
			<input type="submit" value="Salvar" class="btn btn-primary pull-right" <?php empty($fields)?'disabled':''; ?>>
		</form>
	</div>
	<a href="<?php echo base_url('planilha'); ?>">Retornar a lista</a>
</div>