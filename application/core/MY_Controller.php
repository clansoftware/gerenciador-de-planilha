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
		
		$data = $this->ler_arquivo('configuracao', 1, -1);

		/* verifica-se as configurações se houver */
		foreach ($data['data'][1] as $key => $value) {
			if($data['data'][2][$key] != 0 && $data['data'][2][$key]!= '') {
				$_SESSION[$value] = $data['data'][2][$key];
			}
		}
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
