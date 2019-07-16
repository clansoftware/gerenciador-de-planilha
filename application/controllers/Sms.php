<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Sms extends MY_Controller {

	public static $arquivo = 'configuracao';

	/**
		* @see Responsável por receber o envio e disparar
	*/
	public function enviar () {
		$data = array(
			'type' => 'danger',
			'msg' => 'Ação indevída !'
			);

		if (isset($_POST['numero']) && !empty($_POST['numero'])
			&&
			isset($_POST['msg']) && !empty($_POST['msg'])
			) {
			$data = array(
				'type' => 'danger',
				'msg' => 'Ação indevída !'
				);
			if (isset($_SESSION['sendSMS']) && $_SESSION['sendSMS']==1) {
				$i = 0;
				do {
					switch ($services[$i]) {
						case 'paposms':
							$data = $this->sendPapo($_POST['numero'], $_POST['msg']);
							$i = $data['type']=='success'?count($service);
							break;
						
						case 'mobipromo':
							$data = $this->sendMobi($_POST['numero'], $_POST['msg']);
							$i = $data['type']=='success'?count($service);
							break;

						default:
							$data = array(
								'type' => 'warning',
								'msg' => 'Atenção, não foi possível enviar SMS, favor contactar o suporte [Erro:C'.__LINE__.'E]!'
								);
							$i = count($service);
							break;
					}
				} while($i != count($service));
			}
		}

		return $data;
	}

	public function sendPapo($numero, $sms) {
		$data = array(
			'type' => 'danger',
			'msg' => 'Ação indevida !'
			);
		if ($this->validNumber($numero) && !empty($msg)) {
			$data = array(
				'type' => 'info',
				'msg' => 'SMS não enviada pelo método !'.__FUNCTION__
			);

			try {
				
			} catch (Exception $e) {
				$data = array(
					'type' => 'danger',
					'msg' => $e->getMessage()
				);
			}
		}
		return $data;
	}

	public function sendMobi($numero, $sms) {
		$data = array(
			'type' => 'danger',
			'msg' => 'Ação indevida !'
			);
		if ($this->validNumber($numero) && !empty($msg)) {
			$data = array(
				'type' => 'info',
				'msg' => 'SMS não enviada pelo método !'.__FUNCTION__
			);

			try {
				
			} catch (Exception $e) {
				$data = array(
					'type' => 'danger',
					'msg' => $e->getMessage()
				);
			}
		}
		return $data;
	}

	/**
	* @see recebe um número e valida se é um número de celular válido
	*/
	public function validNumber ($numero) {
		$isValid = false;
		if (!empty($numero)) {
			if (strlen($numero) >= 8) { // se o nono digito
				if ($numero[0] > '8' && in_array($numero[0], array('0', '9'))) {
					$isValid = true;
				} else if (strlen($numero) == 8) {
					$isValid = true;
				}
			}
		}
		return $isValid;
	}
}