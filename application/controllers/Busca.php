<?php

defined('BASEPATH') or exit('Ação não permitida');

class Busca extends CI_Controller
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

		$busca = $this->input->post('busca');

		$data = array(
			'titulo' => 'Resultados da pesquisa: ' . $busca,
			'informacao_busca' => 'Termo digitado ' . $busca,
			'menu_principal' => $this->menu_principal(),
			'info_sistema' => $this->footer_header(),
		);


		$this->load->view('web/layout/header', $data);
		$this->load->view('web/home/busca');
		$this->load->view('web/layout/footer');
	}


	public function busca_ajax()
	{


		if (!$this->input->is_ajax_request()) {
			exit('Ação não permitida');
		}

		$busca = $this->input->post('busca');


		if (!$busca) {
			redirect('/');
		} else {


			$pesquisa = $this->core_model->get_all_by_busca($busca);


			$data['response'] = 'false';


			if ($pesquisa) {


				$data['response'] = 'true';
				$data['message'] = array();


				foreach ($pesquisa as $artigo) {

					$data['message'][] = array(
						'value' => $artigo->pag_nome,
					);
				}
			}
			echo json_encode($data);
		}
	}
}
