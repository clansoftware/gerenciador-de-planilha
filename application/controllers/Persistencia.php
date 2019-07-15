<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	* @author Santos L. victor
*/

class Persistencia extends MY_Controller {

	public function list_tables() {

		$data = array(
			'type' => 'danger',
			'msg' => 'Ação Indevida'
			);

		if (isset($_SESSION['']) && !empty($_SESSION[''])) {
			$data = array(
				'type' => 'warning',
				'msg' => 'Ação Incorreta',
				'data' => $_SESSION['']
			);

			$result = $this->
			if (!empty($result)) {
				$data = array(
							'type' => 'warning',
							'msg' => 'Ação Incorreta',
							'data' => $_SESSION['']
						);
			} else {
				$data = array(
							'type' => 'info',
							'msg' => 'Ação Incorreta',
							'data' => json_encode($result)
						);
			}
		}

		return json_encode($data);
	}

	public function list_columns() {

		$data = array(
			'type' => 'danger',
			'msg' => 'Ação Indevida'
			);

		if (isset($_POST['table']) && !empty($_POST['table'])) {
			$data = array(
				'type' => 'warning',
				'msg' => 'Ação Incorreta',
				'data' => json_encode($_POST)
				);


		}

		return json_encode($data);
	}
}