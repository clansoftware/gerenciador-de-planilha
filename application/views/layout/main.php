<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo SISTEM_NAME; ?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css?v='.VERSSION); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.min.css?v='.VERSSION); ?>">

	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.js?v='.VERSSION); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js?v='.VERSSION); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js?v='.VERSSION); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js?v='.VERSSION); ?>"></script>
</head>
<body>
   <header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#"><?php echo SISTEM_NAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url('pessoa'); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('pessoa/add'); ?>">Cadastrar</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<br/>
<br/>
<br/>
<main role="main">
	<?php
		$this->load->view($view);
	?>
</main>
</body>
</html>