<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('aux_artigos_categoria');

    }

    public function index() {

		//echo CI_VERSION;

        $data = array(
            // 'styles' => array(
            //     'assets/css/estilo.css',
            // ),
            'scripts' => array(
                
            ),
            'info_sistema' => $this->core_model->get_all('sistema', array('sistema_id' => 1)),
			'menu_principal' => $this->menu_principal_model->get_all(),
        );


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/valiprev/index');
        $this->load->view('web/layout/footer');
    }

    public function todos_artigos() {

        $data = array(
            'titulo' => 'Seja bem vindo(a)!',
            'pag_detalhe' => false,
            'carousel_home' => false,
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css',
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
        );


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/home/nossos-artigos');
        $this->load->view('web/layout/footer');
    }

}
