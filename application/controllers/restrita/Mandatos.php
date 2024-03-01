<?php

defined('BASEPATH') or exit('Ação não permitida');

class Mandatos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
		$this->load->model('conselho_model');

		$this->url_pagina = 'mandatos';
		$this->pagina_titulo = 'Mandatos';
		$this->tabela_banco = 'mandatos';
		$this->view_folder = 'mandatos';
	}

	public function redirecionar()
	{
		redirect('restrita/' . $this->router->fetch_class());
	}

	public function index()
	{

		if (!$area = areas()) {
			redirect('restrita');
		}

		$pagina = $this->menu_principal_model->get_pagina_url($this->url_pagina);

		$login = [
			'tipo' => 1,
			'acao' => "Acessou a página: $this->pagina_titulo"
		];

		insert_login($login);

		$data = array(
			'titulo' => "<span class='text-info'>$this->pagina_titulo</span>",
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
			'mandatos' => $this->conselho_model->get_all_mandatos(),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view("restrita/$this->view_folder/index");
		$this->load->view('restrita/layout/footer');
	}

	public function core($man_id = null)
	{

		// echo "<pre>";
		// print_r($this->input->post());
		// exit;

		$area = areas();

		$man_id = (int) $man_id;

		if (!$man_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('man_titulo', 'Título', 'trim|required|min_length[2]|max_length[150]');
				$this->form_validation->set_rules('man_decreto', 'Decreto', 'trim|required|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('man_posse', 'Posse', 'trim|required|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('man_pagina_id', 'Página', 'trim|required');

				$this->form_validation->set_rules('prefeito_titulares_indicados_1', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('prefeito_titulares_indicados_2', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('prefeito_titulares_indicados_3', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('prefeito_suplentes_indicados_1', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('prefeito_suplentes_indicados_2', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('prefeito_suplentes_indicados_3', 'Membro', 'trim|min_length[2]|max_length[255]');

				$this->form_validation->set_rules('servidores_titulares_indicados_1', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('servidores_titulares_indicados_2', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('servidores_titulares_indicados_3', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('servidores_suplentes_indicados_1', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('servidores_suplentes_indicados_2', 'Membro', 'trim|min_length[2]|max_length[255]');
				$this->form_validation->set_rules('servidores_suplentes_indicados_3', 'Membro', 'trim|min_length[2]|max_length[255]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'man_titulo',
							'man_pagina_id',
							'man_decreto',
							'man_posse'
						),
						$this->input->post()
					);

					$data = html_escape($data);

					$this->core_model->insert($this->tabela_banco, $data, true);
					$last_id = $this->core_model->get_by_id($this->tabela_banco, array('man_id' => $this->session->userdata('last_id')));

					for ($i = 1; $i <= 3; $i++) {

						$membro = $this->input->post("prefeito_suplentes_indicados_$i");
						if($membro){

							$data_prefeito = array(
								'membros_nome' => $this->input->post("prefeito_titulares_indicados_$i"),
								'membros_eleitos' => 'Indicado livremente pelo Prefeito Municipal',
								'membros_tipo' => 'Titulares',
								'membros_mandato_id' => $last_id->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->insert('mandatos_membros', $data_prefeito, true);
						}
					}

					for ($i = 1; $i <= 3; $i++) {
						$membro = $this->input->post("prefeito_suplentes_indicados_$i");
						if($membro){
							$data_prefeito = array(
								'membros_nome' => $this->input->post("prefeito_suplentes_indicados_$i"),
								'membros_eleitos' => 'Indicado livremente pelo Prefeito Municipal',
								'membros_tipo' => 'Suplentes',
								'membros_mandato_id' => $last_id->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->insert('mandatos_membros', $data_prefeito, true);
						}
					}

					for ($i = 1; $i <= 3; $i++) {
						$membro = $this->input->post("servidores_titulares_indicados_$i");
						if($membro){
							$data_servidores = array(
								'membros_nome' => $this->input->post("servidores_titulares_indicados_$i"),
								'membros_eleitos' => 'Eleito pelos servidores municipais efetivos ativos e inativos',
								'membros_tipo' => 'Titulares',
								'membros_mandato_id' => $last_id->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->insert('mandatos_membros', $data_servidores, true);
						}
					}

					for ($i = 1; $i <= 3; $i++) {
						$membro = $this->input->post("servidores_suplentes_indicados_$i");
						if($membro){
							$data_servidores = array(
								'membros_nome' => $this->input->post("servidores_suplentes_indicados_$i"),
								'membros_eleitos' => 'Eleito pelos servidores municipais efetivos ativos e inativos',
								'membros_tipo' => 'Suplentes',
								'membros_mandato_id' => $last_id->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->insert('mandatos_membros', $data_servidores, true);
						}
					}


					$login = [
						'tipo' => 2,
						'acao' => 'Adicionou conselheiro: ' . $last_id->man_titulo
					];

					insert_login($login);

					$this->redirecionar();
				} else {

					$login = [
						'tipo' => 1,
						'acao' => 'Entrou para adicionar novo conselheiro.'
					];

					insert_login($login);

					$data = array(
						'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Adicionar novo Mandato</span>',

						'scripts' => array(
							'assets/js/mandatos.js'
						),
					);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view("restrita/$this->view_folder/core");
					$this->load->view('restrita/layout/footer');
				}
			} else {
				$this->redirecionar();
			}
		} else {

			if ($area->editar) {

				if (!$mandato = $this->core_model->get_by_id($this->tabela_banco, array('man_id' => $man_id))) {
					$this->session->set_flashdata('erro', 'PDF não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('man_titulo', 'Título', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('man_decreto', 'Decreto', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('man_posse', 'Posse', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('man_pagina_id', 'Página', 'trim|required');

					$this->form_validation->set_rules('prefeito_titulares_indicados_1', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('prefeito_titulares_indicados_2', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('prefeito_titulares_indicados_3', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('prefeito_suplentes_indicados_1', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('prefeito_suplentes_indicados_2', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('prefeito_suplentes_indicados_3', 'Membro', 'trim|required|min_length[2]|max_length[255]');

					$this->form_validation->set_rules('servidores_titulares_indicados_1', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('servidores_titulares_indicados_2', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('servidores_titulares_indicados_3', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('servidores_suplentes_indicados_1', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('servidores_suplentes_indicados_2', 'Membro', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('servidores_suplentes_indicados_3', 'Membro', 'trim|required|min_length[2]|max_length[255]');


					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'man_titulo',
								'man_pagina_id',
								'man_decreto',
								'man_posse'
							),
							$this->input->post()
						);

						$data = html_escape($data);

						$this->core_model->update($this->tabela_banco, $data, array('man_id' => $mandato->man_id));

						for ($i = 1; $i <= 3; $i++) {
							$data_prefeito = array(
								'membros_nome' => $this->input->post("prefeito_titulares_indicados_$i"),
								'membros_eleitos' => 'Indicado livremente pelo Prefeito Municipal',
								'membros_tipo' => 'Titulares',
								'membros_mandato_id' => $mandato->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->update('mandatos_membros', $data_prefeito, array('membros_id' => $this->input->post("prefeito_titulares_indicados_id_$i")));
						}

						for ($i = 1; $i <= 3; $i++) {
							$data_prefeito = array(
								'membros_nome' => $this->input->post("prefeito_suplentes_indicados_$i"),
								'membros_eleitos' => 'Indicado livremente pelo Prefeito Municipal',
								'membros_tipo' => 'Suplentes',
								'membros_mandato_id' => $mandato->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->update('mandatos_membros', $data_prefeito, array('membros_id' => $this->input->post("prefeito_suplentes_indicados_id_$i")));
						}

						for ($i = 1; $i <= 3; $i++) {
							$data_servidores = array(
								'membros_nome' => $this->input->post("servidores_titulares_indicados_$i"),
								'membros_eleitos' => 'Eleito pelos servidores municipais efetivos ativos e inativos',
								'membros_tipo' => 'Titulares',
								'membros_mandato_id' => $mandato->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->update('mandatos_membros', $data_servidores, array('membros_id' => $this->input->post("servidores_titulares_indicados_id_$i")));
						}

						for ($i = 1; $i <= 3; $i++) {
							$data_servidores = array(
								'membros_nome' => $this->input->post("servidores_suplentes_indicados_$i"),
								'membros_eleitos' => 'Eleito pelos servidores municipais efetivos ativos e inativos',
								'membros_tipo' => 'Suplentes',
								'membros_mandato_id' => $mandato->man_id,
								'membros_ordem' => $i
							);

							$this->core_model->update('mandatos_membros', $data_servidores, array('membros_id' => $this->input->post("servidores_suplentes_indicados_id_$i")));
						}

						$login = [
							'tipo' => 3,
							'acao' => 'Editou PDF: ' . $mandato->man_titulo
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar ' . $mandato->man_titulo
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar : ' . $mandato->man_titulo . '</span>',
							'mandato' => $mandato,
							'membros_suplentes_prefeito' => $this->conselho_model->get_prefeito('Suplentes', $mandato->man_id),
							'membros_titulares_prefeito' => $this->conselho_model->get_prefeito('Titulares', $mandato->man_id),
							'membros_titulares_servidores' => $this->conselho_model->get_servidores('Titulares', $mandato->man_id),
							'membros_suplentes_servidores' => $this->conselho_model->get_servidores('Suplentes', $mandato->man_id),

							'scripts' => array(
								'assets/js/mandatos.js'
							),
						);

						$this->load->view('restrita/layout/header', $data);
						$this->load->view("restrita/$this->view_folder/core");
						$this->load->view('restrita/layout/footer');
					}
				}
			} else {
				$this->redirecionar();
			}
		}
	}

	public function delete($man_id = null)
	{

		$man_id = (int) $man_id;

		if (!$man_id || !$mandato = $this->core_model->get_by_id($this->tabela_banco, array('man_id' => $man_id))) {
			$this->session->set_flashdata('erro', 'PDF não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete($this->tabela_banco, array('man_id' => $mandato->man_id));
		$this->core_model->delete('mandatos_membros', array('membros_mandato_id' => $mandato->man_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou PDF: ' . $mandato->man_titulo
		];

		insert_login($login);

		redirect('restrita/' . $this->router->fetch_class());
	}
}
