<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Diferencial extends MY_Controller {

	public static $arquivo = 'configuracao';

	/**
		* @see Responsável por converter uma tabela no banco em CSV local
	*/
	public function get_csv_from_table() {
		header( 'Content-type: application/csv' );   
		header( 'Content-Disposition: attachment; filename=file.csv' );   
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Pragma: no-cache');

		$pdo = new PDO( 'mysql:host=localhost;dbname=banco', 'root', '123456' );
		$stmt = $pdo->prepare( 'SELECT * FROM cadastro' );   
		$stmt->execute();
		$results = $stmt->fetchAll( PDO::FETCH_ASSOC );

		$out = fopen( 'php://output', 'w' );
		foreach ( $results as $result ) 
		{
		   fputcsv( $out, $result );
		}
		fclose( $out );

	}
}