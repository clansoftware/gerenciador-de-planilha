<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		Application
 * @subpackage	Core
 * @category	Core
 * @author		Santos L. Victor
 */
class MY_Controller extends CI_Controller {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		/* inicia-se como se não tivesse instalado */
		$_SESSION['instalacao'] = 0;

		if(isset($_GET['acao']) && !empty($_GET['acao'])) {
			switch ($_GET['acao']) {
				case 'reset_config':
					@session_destroy();
					break;
				
				default:
					die('Nenhuma ação ativada');
					break;
			}
		}
		
		$data = $this->ler_arquivo('install', 1, -1);

		/* verifica-se as configurações se houver */
		if(!empty($data['data'])) {
			@session_destroy();
			foreach (json_decode($data['data'][1][0]) as $key => $value) {		
				if (is_array($value)) {
					$_SESSION[$key] = json_encode($value);
				} else {
					$_SESSION[$key] = $value;
				}
			}
			$_SESSION['instalacao'] = 1;
		}
	}

	public function ler_arquivo($arquivo, $linha = 0, $init = 0, $limit = 0) {
		$data = array(
			'type' => 'danger',
			'data' => array(),
			'msg' => 'Arquivo não encontrado!<br/>'
			);

		if(file_exists(__DIR__.'/../../assets/data/'.$arquivo.'.csv')) {
			if (($handle = fopen(base_url('assets/data/'.$arquivo.".csv"), "!r")) !== FALSE) {
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
		}
		return $data;
	}

	/**
	* @param [String] $arquivo file name
	* @param [array] $line is an array of string values here
	*/
	public function inserir($arquivo, $line) {
		if (empty($arquivo) || empty($line)) {
			return false;
		} else {
			$file = __DIR__.'/../../assets/data/'.$arquivo.".csv";
			if (!file_exists($file) || strtolower($arquivo)=='install') {
				$out = fopen($file, 'w');
			   	fputcsv($out, array(json_encode($line)));
				fclose($out);
				return true;
			} else {
				$handle = fopen($file, "wa");
				fputcsv($handle, $line);
				fclose($handle);
				return true;
			}
		}
	}

	/**
		* @see Responsável por validar um email
		* @author Santos L. Victor
		* @return [bool] boolean, true or false
	*/
	public static function isEmail($email) {
		if (!empty($email)) {
			$arr = explode('@', $email);
			if (count($arr) == 2) {
				$arr = explode('.com', $arr[1]);
				if (strlen($arr[0]) > 1 && count($arr) >= 1) {
					return true;
				}
			}
		}
		return false;
	}


	/**
		* @see Verifica se um determinado número tem whatsapp
		* @return [String] Retorna a url de envio da mensagem ou false se o número não for válido para o whattsapp
	*/
	public static function isWhattsapp($number) {
		if(!empty($number)) {
			$number = str_replace(array(' ','-','(',')','.',':'), '', $number);
			$validNumber = null;
			for ($i=0; $i < strlen($number); $i++) { 
				if($i < 11) {
					if ($i == 2 && $number[$i] != '9') { // verifica se esta no 9 digito e se ele é número 9
						$validNumber = $validNumber.'9'.$number[$i];
					} else {
						$validNumber = $validNumber.$number[$i];
					}
				}
			}
		} else {
			$validNumber = $number;	
		}
		return strlen($validNumber)>=11?'55'.$validNumber:false;
	}

	public static function get_next_key($cuttent_key, $list) {
		for ($i=$cuttent_key; $i < count($list); $i++) { 
			if(!empty($list[$i])) {
				return $i;
			}
		}
	}

}
