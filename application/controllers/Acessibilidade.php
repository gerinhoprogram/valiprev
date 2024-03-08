<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acessibilidade extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

	public function escuro()
	{
		

		$_SESSION['body'] = 'black';
		$_SESSION['font_color'] = '#fff';
		$_SESSION['b_direito'] = 'black';

		$data = $_SESSION['body'];

		echo json_encode($data);
		
	}
		
	public function claro()
	{

		$_SESSION['body'] = '#fff';
		$_SESSION['font_color'] = '#332663';
		$_SESSION['b_direito'] = '#f3f3f3';

		$data = $_SESSION['font_color'];

		echo json_encode($data);
		
	}

	public function preto_e_branco()
	{

		if($_SESSION['preto_e_branco'] == 'filter:grayscale(100%)'){
			$_SESSION['preto_e_branco'] = 'filter:inherit';
		}else{
			$_SESSION['preto_e_branco'] = 'filter:grayscale(100%)';
		}

		

		$data = $_SESSION['preto_e_branco'];

		echo json_encode($data);
		
	}


}
