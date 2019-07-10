<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Pessoa extends CI_Controller {

	public static $arquivo = "pessoas";

	/**
		* @see Responsável por listar~os registros do excel .csv
	*/
	public function index() {
		$fields = $this->ler_arquivo(self::$arquivo, 0, -1, 0);
		$data = array(
			'view' => 'pessoa/index',
			'data' => $this->ler_arquivo(self::$arquivo),
			'fields' => $fields['data'][0]
			);

		$this->load->view('layout/main', $data);
	}

	public function add() {
		$data = array('view' => 'pessoa/add');
		$fields = $this->ler_arquivo(self::$arquivo, 0, -1, 0);
		$data['fields'] = $fields['data'][0];


		if (isset($_POST) && !empty($_POST)) {
			$errors = array();
			if(empty($errors)) {
				$data = array(
					'view' => 'pessoa/add',
					'type' => 'success',
					'msg' => 'Pessoa cadastrada com sucesso'
					);
			} else {
				$data['type'] = 'warning';
				$data['msg'] = $errors;
				$data['data'] = $_POST;
			}
		}

		$this->load->view('layout/main', $data);
	}

	public function ler_arquivo($arquivo, $linha = 0, $init = 0, $limit = 0) {
		$data = array(
			'type' => 'danger',
			'msg' => 'Arquivo não encontrado!<br/>'
			);

		if (($handle = fopen(base_url('assets/data/'.$arquivo.".csv"), "r")) !== FALSE) {
			$data = array(
				'type' => 'warning',
				'msg' => 'Arquivo vazio!<br>',
				'data' => array(),
				'rows' => 0
				);

			while (($content = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($content);
				if ($linha > $init && (count($data['data']) <= $limit || $limit >= 0)) {
					for ($c=0; $c < $num; $c++) {
						$data['data'][$linha][] = utf8_encode($content[$c]);
					}
				}
				$linha++;
			}

			if (isset($data['data']) && !empty($data['data'])) {
				$data['type'] = 'success';
				$data['msg'] = 'Arquivo carregado com sucesso!<br>';
				$data['rows'] = $linha;
			}
			fclose($handle);
		}
		return $data;
	}

	/**
	* @param [String] $arquivo file name
	* @param [array] $line is an array of string values here
	*/
	public function inserir($arquivo, $line) {
		$handle = fopen( base_url('assets/data/'.$arquivo.".csv"), "a");
		fputcsv($handle, $line);
		fclose($handle);
		return true;
	}

}