<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Sms extends MY_Controller {

	public static $arquivo = 'sms';

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

	/**
	 *@see:Zenvia Exemplo de como enviar um sms pela API módulo de sms
	 *@author: Santos L. Victor
	 *@date: 2013-03-14
	 *@referencia: _http://doc.directcallsoft.com/pages/viewpage.action?pageId=524534
	*/
	public static function enviaSMSZenvia($cellphone, $msg = null, $aux = null, $aluno_id, $sistemica)
	{
		try {

			/*BUILD OBECT FOR PERSISTENCE*/
			$sms = new SmsEnvio();

			$sms->aluno_id = $aluno_id;
			$sms->to_numero = '55'.$cellphone;
			$sms->msg = $msg;
			$sms->servico = 'zenvia360';
			$sms->tipo = $aux ;//'token prova';
			$sms->data_envio = date('Y-m-d H:i:s');
			$datetime = DateTime::createFromFormat(DateTime::ISO8601, date("c"));
			
			if( $sms->save() ) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://api-rest.zenvia360.com.br/services/send-sms");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);

				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds

				curl_setopt($ch, CURLOPT_POSTFIELDS, "{
				  \"sendSmsRequest\": {
				    \"from\": \"".$aux."\",
				    \"to\": \"55".$cellphone."\",
				    \"schedule\": \"".date('Y-m-d\TH:i:s')."\",
				    \"msg\": \"".$msg."\",
				    \"callbackOption\": \"ALL\",
				    \"id\": \"".$sms->getPrimaryKey()."\",
				    \"aggregateId\": \"".$aluno_id."\"
				  }
				}");

				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Content-Type: application/json",
					"Authorization: Basic TokenBasicConnect==",
					"Accept: application/json"
				));

				$response = curl_exec($ch);
				$sms->retorno = $response;
				$sms->save();
				
				$response = json_decode($response);

				if(curl_error($ch))
				{
					$sms->retorno = json_encode( curl_error($ch) );
					$sms->save();
				}
				curl_close($ch);

			    if( (isset($response->sendSmsResponse->statusCode) && $response->sendSmsResponse->statusCode=="00") || 
			    	(isset($response->sendSmsResponse->statusCode) && $response->sendSmsResponse->statusDescription=="Ok") ) 
			    {
					$sms->status = 1;
					if($sistemica) {
						$this->saveSmsSistemica($sms , $response->sendSmsResponse->statusCode);
					}
					$sms->save();
			    	return true;
			    } else {
					return false;
			    }
			} else {
				var_dump($sms->errors);
				return false;
			}
		} catch (Exception $e) {
			die($e->getMessage());	
		}
	}
	
	/**
	 *@see:MobiPronto Exemplo de como enviar um sms pela API módulo de sms
	 *@author: 
	 *@date: 2013-03-14
	 *@referencia: https://www.mpgateway.com/v_3_00/sms/smspush/enviasms.aspx
	*/
	public function enviaSMSMobi($cellphone, $msg = null, $aux = null, $aluno_id, $sistemica)
	{
		try {
			/*BUILD OBECT FOR PERSISTENCE*/
			$sms = new SmsEnvio();
			$sms->aluno_id = $aluno_id;
			$sms->to_numero = "55".$cellphone;
			$sms->msg = $msg;
			$sms->servico = 'Mobipronto_v3';
			$sms->tipo = $aux;//'token prova';
			$sms->data_envio = date('Y-m-d H:i:s');
			
			if( $sms->save() ) {
		        $credencial= URLEncode(""); //**Credencial da Conta 40 caracteres
		        $token= URLEncode(""); //**Token da Conta 6 caracteres
		        $principal = URLEncode("");  //* SEU CODIGO PARA CONTROLE, não colocar e-mail
		        $auxuser = URLEncode($aux); //* SEU CODIGO PARA CONTROLE, não colocar e-mail
		        $mobile= URLEncode("55".$cellphone); //* Numero do telefone  FORMATO: PAÍS+DDD(DOIS DÍGITOS)+NÚMERO
		        $sendproj = URLEncode("N"); //* S = Envia o SenderId antes da mensagem , N = Não envia o SenderId
		        $msg=mb_convert_encoding($msg, "UTF-8"); // Converte a mensagem para não ocorrer erros com caracteres semi-gráficos
		        $msg = URLEncode($msg); 
		        $url = "https://www.mpgateway.com/v_3_00/sms/smspush/enviasms.aspx?CREDENCIAL=".$credencial."&TOKEN=".$token."&PRINCIPAL_USER=".$principal."&AUX_USER=".$auxuser."&MOBILE=".$mobile."&SEND_PROJECT=".$sendproj."&MESSAGE=".$msg;
		        $response =fopen($url,"r");
		        $status_code= fgets($response,4);
				$sms->retorno = json_encode((string)$status_code);
				$sms->save();

				if($status_code=='000') {
					$sms->status = 1;
					if($sistemica)
						$this->saveSmsSistemica($sms, $status_code);
					$sms->save();
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} catch (Exception $e) {
			die($e->getMessage());	
		}
	}

}