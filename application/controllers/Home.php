<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

		//echo CI_VERSION;

        $data = array(
			'titulo' => 'Home',
            // 'styles' => array(
            //     'assets/css/estilo.css',
            // ),
            'scripts' => array(
				// 'assets/js/banner_web.js',
            ),
            'info_sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
			'menu_principal' => $this->menu_principal_model->get_all(),
			'menu_home' => $this->core_model->get_all_asc('menu_home', array('hom_status' => 1)),
			'links_uteis' => $this->core_model->get_all_asc('links_uteis', array('link_status' => 1)),
        );


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/home/index');
        $this->load->view('web/layout/footer');
    }


}
