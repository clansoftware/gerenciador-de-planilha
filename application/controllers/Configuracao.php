<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Configuracao extends MY_Controller {

	public static $arquivo = 'configuracao';

	/**
		* @see Responsável por listar~os registros do excel .csv
	*/
	public function install() {

		if(isset($_SESSION['instalacao']) && $_SESSION['instalacao'] == 0) {
			$fields = $this->ler_arquivo(self::$arquivo, 0, -1, 0);
			$data = array(
				'view' => 'configuracao/install',
				'type' => 'success',
				'type' => 'Criando nova configuração',
				'data' => $this->ler_arquivo(self::$arquivo),
				'fields' => $fields['data'][0]
				);

			$this->load->view('layout/main', $data);
		} else {
			$data = array(
				'view' => 'configuracao/edit',
				'type' => 'danger',
				'type' => 'Atenção você já tem uma configuração !'
				);
			$this->load->view('layout/main', $data);
		}

	}

	/**
		* @see Responsável por listar~os registros do excel .csv
	*/
	public function view() {
		$fields = $this->ler_arquivo(self::$arquivo, 0, -1, 0);
		$data = array(
			'view' => 'configuracao/index',
			'data' => $this->ler_arquivo(self::$arquivo),
			'fields' => $fields['data'][0]
			);
		$this->load->view('layout/main', $data);
	}

	/**
		* @see Responsável por realizar upload do arquivo csv no diretório data, e salvar as configurações no arquivo install.csv
	*/
	public function add() {
		$target_dir = __DIR__.'/../../assets/data/';
		$target_file = $target_dir . basename($_FILES["diretorio_planilha"]["name"]);
		$uploadOk = 1;
		move_uploaded_file($_FILES["diretorio_planilha"]["tmp_name"], $target_file);
		$_POST['diretorio_planilha'] = $_FILES["diretorio_planilha"]["name"];

		$this->inserir('install', $_POST);
		header("Location: ".base_url());
	}
}