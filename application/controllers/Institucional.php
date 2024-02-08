<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institucional extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('aux_artigos_categoria');

    }

	public function footer_header(){
		return $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
	}

	public function menu_principal(){
		return $this->menu_principal_model->get_all();
	}

    public function index() {

		//echo CI_VERSION;

        $data = array(
			'titulo' => 'Home',
            // 'styles' => array(
            //     'assets/css/estilo.css',
            // ),
            'scripts' => array(
                
            ),
			'menu_principal' => $this->menu_principal(),
			'sistema' => $this->footer_header()
        );


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/index');
        $this->load->view('web/layout/footer');
    }

    public function o_valiprev() {

        $data = array(
			'titulo' => 'O Valiprev',
			'menu_principal' => $this->menu_principal(),
        );

		$data['breadcrumb'] = "<a href='".base_url()."'>Início</a> / ".$data['titulo'];

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/o_valiprev');
        $this->load->view('web/layout/footer');
    }

	public function presidencia() {

        $data = array(
			'titulo' => 'Presidência',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('presidencia'),
        );

		$data['breadcrumb'] = "<a href='".base_url()."'>Início</a> / ".$data['titulo'];

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/presidencia');
        $this->load->view('web/layout/footer');
    }

	public function diretoria($url = null) {

		if(!$pagina = $this->menu_principal_model->get_pagina_url($url)){
				exit('404');
		}

        $data = array(
			'titulo' => $pagina->pag_nome,
			'breadcrumb' => "<a href='".base_url()."'>Início</a> / Diretoria / $pagina->pag_nome",
			'menu_principal' => $this->menu_principal(),
			'pagina' => $pagina
        );

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/diretoria');
        $this->load->view('web/layout/footer');
    }

	public function censo_previdenciario() {

        $data = array(
			'titulo' => 'Censo Previdenciário',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('censo-previdenciario'),
			'faq' => $this->core_model->get_all('faq_censo_previdenciario'),
			'pdfs' => $this->core_model->get_all('pdf_censo_previdenciario'),
        );

		$data['breadcrumb'] = "<a href='".base_url()."'>Início</a> / ".$data['titulo'];

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/censo_previdenciario');
        $this->load->view('web/layout/footer');
    }

	public function capacitacao_servidores() {

        $data = array(
			'titulo' => 'Capacitação de servidores',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('censo-previdenciario'),
			'servidores' => $this->core_model->get_all('capacitacao_servidores'),
			'pdfs' => $this->core_model->get_all('pdf_capacitacao_servidores'),
        );

		$data['breadcrumb'] = "<a href='".base_url()."'>Início</a> / ".$data['titulo'];

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/capacitacao_servidores');
        $this->load->view('web/layout/footer');
    }

    public function juridico($url = null) {

        exit($url);

        if(!$pagina = $this->menu_principal_model->get_pagina_url($url)){
            exit('404');
        }

        $menu_principal = $this->menu_principal();

        $data = array(
			'titulo' => 'Resoluções do conselho de administração',
			'pagina' => $this->menu_principal_model->get_pagina_url('resolucoes-do-conselho-de-administracao'),
			'pdfs' => $this->core_model->get_all('pdf_resolucoes_do_conselho_de_administracao'),
        );

		$data['breadcrumb'] = "<a href='".base_url()."'>Início</a> / ".$data['titulo'];

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/institucional/resolucoes_do_conselho_de_administracao');
        $this->load->view('web/layout/footer');
    }

}
