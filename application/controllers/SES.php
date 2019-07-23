<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * @author Santos L. victor
*/

// If necessary, modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

class Configuracao extends MY_Controller {

    public static $arquivo = 'ses';
    public $mail = new PHPMailer;



    public function send() {

        // Tell PHPMailer to use SMTP
        $mail->isSMTP();

        // Replace sender@example.com with your "From" address. 
        // This address must be verified with Amazon SES.
        $mail->setFrom('', '');

        // Replace recipient@example.com with a "To" address. If your account 
        // is still in the sandbox, this address must be verified.
        // Also note that you can include several addAddress() lines to send
        // email to multiple recipients.

        // Replace smtp_username with your Amazon SES SMTP user name.
        $mail->Username = '';

        // Replace smtp_password with your Amazon SES SMTP password.
        $mail->Password = '';
            
        // Specify a configuration set. If you do not want to use a configuration
        // set, comment or remove the next line.
        // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', '');
         
        // If you're using Amazon SES in a region other than Oeste dos EUA (Oregon), 
        // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP  
        // endpoint in the appropriate region.
        $mail->Host = '';

        $mail->addAddress($meial, $nome);

        $nome = explode(' ', $nome);
        $nome = empty($nome[0])?$nome[1]:$nome[0];

        // The subject line of the email
        $mail->Subject = 'Cupom de Desconto';

        // The HTML-formatted body of the email
        $conteudo = 'Modelo teste';

        $mail->Body = $conteudo;

        // Tells PHPMailer to use SMTP authentication
        $mail->SMTPAuth = true;

        // Enable TLS encryption over port 587
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Tells PHPMailer to send HTML-formatted email
        $mail->isHTML(true);

        // The alternative email body; this is only displayed when a recipient
        // opens the email in a non-HTML email client. The \r\n represents a 
        // line break.
        $mail->AltBody = $assunto;
        
        if(!$mail->send()) {
            echo "[".$id_reg."] Email not sent. " , $mail->ErrorInfo , PHP_EOL;
        } else {
            echo "[".$id_reg."] Email sent! <br/>" , PHP_EOL;
        }
    }
}