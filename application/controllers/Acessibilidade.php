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

		$data = $_SESSION['body'];

		echo json_encode($data);
		
	}
		


	public function claro()
	{

		$_SESSION['body'] = '#fff';
		$_SESSION['font_color'] = '#332663';

		$data = $_SESSION['font_color'];

		echo json_encode($data);
		
	}


}
