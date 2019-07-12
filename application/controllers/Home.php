<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	* @author Santos L. Victor
	* @see 
*/
class Home extends MY_Controller {

	public function index()
	{

		if($_SESSION['instalacao']==0) { // não foi instalado ainda
			$data = array(
				'view' => 'configuracao/install',
				'fields' => array()
				);


		} else {
			$data = array(
				'view' => 'home'
				);
		}

		$this->load->view('layout/main', $data);
	}
}
