<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transparencia extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
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
			'titulo' => 'Transparência',
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'paginas' => $this->core_model->get_all('paginas', array('pag_menu_id' => 2, 'pag_status' => 1, 'pag_nivel_1' => 1)),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / Transparência",

		);


		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/index');
		$this->load->view('web/layout/footer');
	}

	public function juridico()
	{
		$data = array(
			'titulo' => 'Jurídico',
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Jurídico",
			'menu_principal' => $this->menu_principal(),
			'paginas' => $this->core_model->get_all('paginas', array('pag_pai' => 10))
		);

		$this->load->view('web/layout/header', $data);
		$this->load->view("web/transparencia/juridico/index");
		$this->load->view('web/layout/footer');
	}

	public function resolucoes($url = null)
	{

		$menu = $this->menu_principal_model->get_pagina_url('resolucoes');

		if ($url && $pagina = $this->menu_principal_model->get_pagina_url($url)) {

			$data = array(
				'titulo' => $pagina->pag_nome,
				'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / <a href='" . base_url('transparencia/juridico') . "'>Jurídico</a> / <a href='" . base_url('transparencia/juridico/' . $menu->pag_link) . "'>$menu->pag_nome </a>/ $pagina->pag_nome",
				'menu_principal' => $this->menu_principal(),
				'pagina' => $pagina,
				'pdfs' => $this->core_model->get_all('pdf_resolucoes_do_conselho_de_administracao', array('pdf_pagina_id' => $pagina->pag_id))
			);

			$this->load->view('web/layout/header', $data);
			$this->load->view("web/transparencia/juridico/resolucoes/index");
			$this->load->view('web/layout/footer');
		} else {

			$data = array(
				'titulo' => $menu->pag_nome,
				'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / <a href='" . base_url('transparencia/juridico/') . "'>Jurídico</a> / $menu->pag_nome",
				'menu_principal' => $this->menu_principal(),
				'menu' => $menu,
				'paginas' => $this->core_model->get_all('paginas', array('pag_pai_2' => $menu->pag_id))
			);

			$this->load->view('web/layout/header', $data);
			$this->load->view("web/transparencia/juridico/resolucoes/index");
			$this->load->view('web/layout/footer');
		}
	}

	public function portais()
	{

		$data = array(
			'titulo' => 'Portais',
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
			'menu_principal' => $this->menu_principal(),
			'sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Portais",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/juridico/portais/index');
		$this->load->view('web/layout/footer');
	}

	public function certidoes()
	{

		$data = array(
			'titulo' => 'CERTIDÕES / CRP',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Certidões / CRP",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/certidoes');
		$this->load->view('web/layout/footer');
	}

	public function contratos()
	{

		$data = array(
			'titulo' => 'Contratos',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Contratos",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/certidoes');
		$this->load->view('web/layout/footer');
	}

	public function planos_de_capacitacao()
	{

		$data = array(
			'titulo' => 'Planos de capacitação',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Planos de capacitação",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/planos-de-capacitacao');
		$this->load->view('web/layout/footer');
	}

	public function relatorio_de_governanca_corporativa()
	{

		$data = array(
			'titulo' => 'Relatório de governança corporativa',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Relatório de governança corporativa",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/relatorio-de-governanca-corporativa');
		$this->load->view('web/layout/footer');
	}

	public function controle_interno()
	{

		$data = array(
			'titulo' => 'Controle interno',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Controle interno",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/controle-interno');
		$this->load->view('web/layout/footer');
	}

	public function tce()
	{

		$data = array(
			'titulo' => 'TCE-SP',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / TCE-SP",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/tce');
		$this->load->view('web/layout/footer');
	}

	public function dacao_em_pagamento()
	{

		$data = array(
			'titulo' => 'Dação em pagamento - Aporte',
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
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
			'breadcrumb' => "<a href='" . base_url() . "'>Home</a> / <a href='" . base_url('transparencia/') . "'>Transparência</a> / Dação em pagamento - Aporte",

		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/transparencia/dacao-em-pagamento');
		$this->load->view('web/layout/footer');
	}
}
