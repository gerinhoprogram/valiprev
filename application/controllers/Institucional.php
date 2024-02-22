<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Institucional extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('aux_artigos_categoria');
	}

	public function footer_header()
	{
		return $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
	}

	public function menu_principal()
	{
		return $this->menu_principal_model->get_all();
	}

	public function index()
	{

		$data = array(
			'titulo' => 'Institucional',
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'menu_principal' => $this->menu_principal(),
			'paginas' => $this->core_model->get_all('paginas', array('pag_menu_id' => 1, 'pag_status' => 1, 'pag_nivel_1' => 1)),

		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / Institucional";

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/index');
		$this->load->view('web/layout/footer');
	}

	public function o_valiprev()
	{

		$data = array(
			'titulo' => 'O Valiprev',
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / <a href='" . base_url('institucional') . "'> Institucional </a> / " . $data['titulo'];

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/o_valiprev');
		$this->load->view('web/layout/footer');
	}

	public function presidencia()
	{

		$data = array(
			'titulo' => 'Presidência',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('presidencia'),
			'info_sistema' => $this->footer_header(),
		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / <a href='" . base_url('institucional') . "'> Institucional </a> / " . $data['titulo'];


		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/presidencia');
		$this->load->view('web/layout/footer');
	}

	public function diretoria($url = null)
	{

		$menu = $this->menu_principal_model->get_pagina_url('diretoria');

		if ($url && $pagina = $this->menu_principal_model->get_pagina_url($url)) {

			$data = array(
				'titulo' => $pagina->pag_nome,
				'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / <a href='" . base_url('institucional/diretoria') . "'>Diretoria</a> / $pagina->pag_nome",
				'menu_principal' => $this->menu_principal(),
				'info_sistema' => $this->footer_header(),
				'pagina' => $pagina,
			);

			$this->load->view('web/layout/header', $data);
			$this->load->view("web/institucional/diretoria");
			$this->load->view('web/layout/footer');
		} else {

			$data = array(
				'titulo' => $menu->pag_nome,
				'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / <a href='" . base_url('institucional/diretoria/') . "'>Diretoria</a>",
				'menu_principal' => $this->menu_principal(),
				'menu' => $menu,
				'info_sistema' => $this->footer_header(),
				'paginas' => $this->core_model->get_all('paginas', array('pag_pai' => $menu->pag_id))
			);

			$this->load->view('web/layout/header', $data);
			$this->load->view("web/institucional/diretoria");
			$this->load->view('web/layout/footer');
		}
	}

	public function censo_previdenciario()
	{

		$data = array(
			'titulo' => 'Censo Previdenciário',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('censo-previdenciario'),
			'faq' => $this->core_model->get_all('faq_censo_previdenciario'),
			'pdfs' => $this->core_model->get_all('pdf_censo_previdenciario'),
			'info_sistema' => $this->footer_header(),
		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / " . $data['titulo'];

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/censo_previdenciario');
		$this->load->view('web/layout/footer');
	}

	public function capacitacao_servidores()
	{

		$data = array(
			'titulo' => 'Capacitação de servidores',
			'menu_principal' => $this->menu_principal(),
			'pagina' => $this->menu_principal_model->get_pagina_url('censo-previdenciario'),
			'servidores' => $this->core_model->get_all('capacitacao_servidores'),
			'pdfs' => $this->core_model->get_all('pdf_capacitacao_servidores'),
			'info_sistema' => $this->footer_header(),
		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / " . $data['titulo'];

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/capacitacao_servidores');
		$this->load->view('web/layout/footer');
	}

	public function conselhos()
	{

		$menu = $this->menu_principal_model->get_pagina_url('conselhos');

		$data = array(
			'titulo' => 'Conselhos',
			'menu_principal' => $this->menu_principal(),
			'menu' => $menu,
			'paginas' => $this->core_model->get_all('paginas', array('pag_status' => 1, 'pag_pai' => $menu->pag_id)),
			'info_sistema' => $this->footer_header(),
		);

		$data['breadcrumb'] = "<a href='" . base_url() . "'><i class='fas fa-home'></i></a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / " . $data['titulo'];

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/institucional/conselhos/index');
		$this->load->view('web/layout/footer');
	}

	public function conselho_administrativo($url = null)
	{

		$menu = $this->menu_principal_model->get_pagina_url('conselho-administrativo');

		if ($url == 'mandatos') {
			$data = array(
				'titulo' => 'Mandatos',
				'menu_principal' => $this->menu_principal(),
				'menu' => $menu,
				'mandatos' => $this->core_model->get_all('mandatos', array('man_pagina_id' => $menu->pag_id)),

				'info_sistema' => $this->footer_header(),
			);

			$data['membros'] = $this->core_model->get_all('mandatos_membros', array('membros_mandato_id' => $menu->pag_id));

			$data['breadcrumb'] = "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / <a href='" . base_url('institucional/conselhos') . "'>Conselhos</a> / <a href='" . base_url('institucional/conselhos/' . $menu->pag_link) . "'>$menu->pag_nome </a>/ Conselheiros";

			$this->load->view('web/layout/header', $data);
			$this->load->view('web/institucional/conselhos/conselho_administrativo/mandatos');
			$this->load->view('web/layout/footer');
		} else {
			if ($url && $pagina = $this->core_model->get_all('conselheiros', array('con_pagina_id' => $menu->pag_id))) {

				$data = array(
					'titulo' => $menu->pag_nome,
					'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / <a href='" . base_url('institucional/conselhos') . "'>Conselhos</a> / <a href='" . base_url('institucional/conselhos/' . $menu->pag_link) . "'>$menu->pag_nome </a>/ Conselheiros",
					'menu_principal' => $this->menu_principal(),
					'pagina' => $pagina,
					'info_sistema' => $this->footer_header(),
					'regimentos' => $this->core_model->get_all('regimentos_internos', array('reg_pagina_id' => $menu->pag_id)),
					'atas' => $this->core_model->get_all('atas', array('ata_pagina_id' => $menu->pag_id)),

					'styles' => array(
						'assets/css/conselhos.css',
					),
					'scripts' => array(
						'assets/js/app.min.js',
						'assets/bundles/datatables/datatables.min.js',
						'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
						'assets/js/page/datatables.js'
					),
				);

				$this->load->view('web/layout/header', $data);
				$this->load->view("web/institucional/conselhos/conselho_administrativo/index");
				$this->load->view('web/layout/footer');
			} else {

				$data = array(
					'titulo' => $menu->pag_nome,
					'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('institucional/') . "'>Institucional</a> / <a href='" . base_url('institucional/conselhos/') . "'>Conselhos</a> / $menu->pag_nome",
					'menu_principal' => $this->menu_principal(),
					'menu' => $menu,
					'info_sistema' => $this->footer_header(),
					'paginas' => $this->core_model->get_all('paginas', array('pag_pai_2' => $menu->pag_id))
				);

				$this->load->view('web/layout/header', $data);
				$this->load->view("web/institucional/conselhos/conselho_administrativo/index");
				$this->load->view('web/layout/footer');
			}
		}
	}
}
