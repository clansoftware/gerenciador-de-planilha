<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Planilha extends MY_Controller {

	public static $arquivo = "pessoas";

	/**
		* @see Responsável por listar os registros do excel .csv
	*/
	public function index() {
		$fields = MY_Controller::ler_arquivo(self::$arquivo, 0, -1, 0);
		$data = array(
			'view' => 'planilha/index',
			'data' => MY_Controller::ler_arquivo(self::$arquivo),
			'fields' => !empty($fields['data'][0])?$fields['data'][0]:array()
			);

		$data['filters'] = !empty($fields['data'][0])?$this->hasmap($fields['data'][0]):null;
		$this->load->view('layout/main', $data);
	}

	/**
		* @see responsável por salvar novos registros na planilha
	*/
	public function add() {
		$data = array('view' => 'planilha/add');
		$fields = MY_Controller::ler_arquivo(self::$arquivo, 0, -1, 0);
		$data['fields'] = $fields['data'][0];


		if (isset($_POST) && !empty($_POST)) {
			$errors = array();
			if(empty($errors)) {
				if (MY_Controller::inserir(self::$arquivo, $_POST)) {
					$fields = MY_Controller::ler_arquivo(self::$arquivo, 0, -1, 0);
					$data = array(
						'view' => 'planilha/index',
						'type' => 'success',
						'msg' => 'Pessoa cadastrada com sucesso',
						'data' => MY_Controller::ler_arquivo(self::$arquivo),
						'fields' => !empty($fields['data'][0])?$fields['data'][0]:array()
						);
					$data['filters'] = !empty($fields['data'][0])?$this->hasmap($fields['data'][0]):null;
				} else {
					$data = array(
						'view' => 'planilha/index',
						'type' => 'danger',
						'data' => $_POST,
						'msg' => 'Não foi possível inserir, tente novamente'
						);
				}
			} else {
				$data['type'] = 'warning';
				$data['msg'] = $errors;
				$data['data'] = $_POST;
			}
		}

		$this->load->view('layout/main', $data);
	}

	public function hasmap($fileds) {
		$data = array();
		foreach ($fileds as $key => $value) {
			$arr = explode(' ', $value);
			if(count($arr) > 1) {
				foreach ($arr as $k => $val) {
					if(strtolower($val)=='nascimento' || strtolower($val)=='nascimento') {
						$data['needAge'] = $key;
					}
				}
			} else {
				if(strtolower($value)=='nascimento' || strtolower($value)=='nascimento') {
					$data['needAge'] = $key;
				}
			}
		}
		return $data;
	}
}