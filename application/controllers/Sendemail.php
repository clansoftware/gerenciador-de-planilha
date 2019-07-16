<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	* @author Santos L. Victor
	* @see 
*/
class Sendemail extends MY_Controller {

    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
      	require_once(APPPATH.'third_party/PHPMailer/src/PHPMailer.php');
        require_once(APPPATH.'third_party/PHPMailer/src/SMTP.php');

        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
    }
    /**
		* @see Responsável por enviar email's
    */
    public function send() {
    	$data = array(
    		'type' => 'dange',
    		'msg' => 'Entrada inválida'
    	);

    	if (isset($_GET['email']) && isset($_GET['mensagem'])) { // verifica se existe o GET de email e mensagem
	    	$data = array(
	    		'type' => 'warning',
	    		'msg' => 'Parâmetros inválidos',
	    		'data' => $_GET
	    	);
	    	if (!empty($_GET['email']) && !empty($_GET['mensagem'])) { // verifica se o GET de email e mensagem são diferentes de vázio
		    	$data = array(
		    		'type' => 'info',
		    		'msg' => 'Não foi possível enviar o email',
		    		'data' => $_GET
		    	);
		    	$mail = $this->load();

				// SMTP configuration
				$mail->isSMTP();
				$mail->Host     = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = GMAIL;
				$mail->Password = GSENHA;
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom(GMAIL, 'CSV++');
				// $mail->addReplyTo('info@example.com', 'CodexWorld');

				// Add a recipient
				$mail->addAddress($_GET['email']);

				// Add cc or bcc 
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				// Email subject
				$mail->Subject = 'Contato do sistema CSV++';

				// Set email format to HTML
				$mail->isHTML(true);

				// Email body content
				$mailContent = $_GET['mensagem'];
				$mail->Body = $mailContent;

				// Send email
				if(!$mail->send()){
			    	$data = array(
			    		'type' => 'danger',
			    		'msg' => 'Email enviado com sucesso \nMailer Error: ' . $mail->ErrorInfo,
			    		'data' => $_GET
			    	);
				}else{
			    	$data = array(
			    		'type' => 'success',
			    		'msg' => 'Email enviado com sucesso',
			    		'data' => $_GET
			    	);
				}
	    	}
    	}
    }
}