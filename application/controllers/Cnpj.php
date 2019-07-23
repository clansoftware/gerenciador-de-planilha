<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Cnpj extends MY_Controller {

	public static $arquivo = strtolower(__CLASS__);

    /**
     * @see Consulta informações sobre um determinado cnpj no site receitaWS
     * @param [Integer] $cnpj
     */
    function consulta()
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$_GET['cnpj']);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        $arr = json_decode($output);
        // close curl resource to free up system resources
        curl_close($ch);


        if( $arr->status == "ERROR") {
          $data = array(
            'type' => 'danger',
            'msg' => $arr->message
            );
        } else {   
	        $data = array(
	            'cartao' => $cartao,
	            'arr' => $arr,
	            'type' => 'success',
	            'msg' => 'Cartão CNPJ importado com sucesso !'
	            );
		}
        die(json_encode($data));
    }
}