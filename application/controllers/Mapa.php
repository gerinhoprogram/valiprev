<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

		//echo CI_VERSION;

        $data = array(
			'titulo' => 'Mapa do site',
            'info_sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
			'menu_principal' => $this->menu_principal_model->get_all(),

        );


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/mapa/index');
        $this->load->view('web/layout/footer');
    }


}
