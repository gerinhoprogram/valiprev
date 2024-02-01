<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Custom_404 extends CI_Controller {

	public function footer_header(){
		return $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
	}

	public function menu_principal(){
		return $this->menu_principal_model->get_all();
	}

    public function index() {


        $data = array(
            'titulo' => 'Página não encontrada',
            'pag_detalhe' => false,
        );


        if ($this->ion_auth->logged_in()) {

            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/custom_404_admin');
            $this->load->view('restrita/layout/footer');
            
        } else {

			$data['menu_principal'] = $this->menu_principal();
			$data['sistema'] = $this->footer_header();

            $this->load->view('web/layout/header', $data);
            $this->load->view('web/custom_404_web');
            $this->load->view('web/layout/footer');
        }
    }

}
