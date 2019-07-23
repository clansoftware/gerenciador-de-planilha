<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>
    <?php 
      if(isset($_SESSION['nome_sistema']) && $_SESSION['nome_sistema'] != 0) {
        echo $_SESSION['nome_sistema'];
      } else {
        echo SISTEM_NAME;
      } ?>
  </title>
  <!-- for FF, Chrome, Opera -->
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/readme/csv_48.png'); ?>" sizes="16x16">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/readme/csv_48.png'); ?>" sizes="32x32">

  <!-- for IE -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/icon.ico'); ?>"/>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css?v='.VERSSION); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.min.css?v='.VERSSION); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.dataTables.min.css?v='.VERSSION); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select.dataTables.min.css?v='.VERSSION); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/buttons.dataTables.min.css?v='.VERSSION); ?>" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?v='.VERSSION); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/install.css?v='.VERSSION); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animations.css?v='.VERSSION); ?>">

  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-latest.min.js?v='.VERSSION); ?>"></script>
  <script src="<?php echo base_url('assets/js/angular.1.7.9.min.js?v='.VERSSION); ?>"></script>
  <script src="<?php echo base_url('assets/js/angular-animate.1.7.9.js?v='.VERSSION); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js?v='.VERSSION); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js?v='.VERSSION); ?>"></script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mask.min.js?v='.VERSSION); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.buttons.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.flash.min.js?v='.VERSSION); ?>"></script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.select.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.colVis.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jszip.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/pdfmake.min.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/vfs_fonts.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.html5.min.js?v='.VERSSION); ?> "></script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/cep.js?v='.VERSSION); ?>"></script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/app.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/install.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/todo.js?v='.VERSSION); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/functions_global.js?v='.VERSSION); ?>"></script>
</head>
<body>
   <header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#">
      <img src="<?php echo base_url('assets/img/csv_logo_w.png'); ?>" width="128px"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <?php if(isset($_SESSION['instalacao']) && $_SESSION['instalacao'] == 1) { ?>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('planilha'); ?>">Planilhar</a>
        </li>
        <li class="nav-item <?php echo (!isset($_SESSION['banco_de_dados']))?'d-none':'';?> ">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Persistir</a>
        </li>
        <li class="nav-item <?php echo (!isset($_SESSION['banco_de_dados']))?'d-none':'';?> ">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Diferencial</a>
        </li>
        <li class="nav-item <?php echo (!isset($_SESSION['banco_de_dados']))?'d-none':'';?> ">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Log</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('configuracao'); ?>">Configurações</a>
        </li>
      </ul>
      <?php } ?>
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

<?php 
  if (isset($_SESSION['banco_de_dados']) && $_SESSION['banco_de_dados']==1) {
    $this->load->view('modals/persistencia');
  }
?>
</body>
</html>