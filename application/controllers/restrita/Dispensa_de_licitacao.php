<?php

defined('BASEPATH') or exit('Ação não permitida');

class Dispensa_de_licitacao extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
		$this->url_pagina = 'dispenca-de-licitacao';
	}

	public function redirecionar()
	{
		redirect('restrita/' . $this->router->fetch_class());
	}

	public function index()
	{

		$pagina = $this->menu_principal_model->get_pagina_url($this->url_pagina);

		if (!$area = areas()) {
			redirect('restrita');
		}

		$login = [
			'tipo' => 1,
			'acao' => 'Acessou pagina: pregões'
		];

		insert_login($login);

		$data = array(
			'titulo' => '<span class="text-info"><i class="fas fa-edit"></i>Pregão</span>',
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
			'dispensa' => $this->core_model->get_all('dispensa_de_licitacao'),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/dispensa/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($dis_id = null)
	{

		$area = areas();

		$dis_id = (int) $dis_id;

		if (!$dis_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('dis_titulo', 'Nome', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('dis_modalidade', 'Modalidade', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('dis_processo', 'Processo de comprar/administração', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('dis_objetivo', 'Objetivo', 'trim|required|max_length[900]');
				$this->form_validation->set_rules('dis_entrega', 'Entrega dos envelopes', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('dis_estado', 'Estado', 'trim|required|max_length[150]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'dis_titulo',
							'dis_processo',
							'dis_modalidade',
							'dis_objetivo',
						),
						$this->input->post()
					);

					$data = html_escape($data);

					$this->core_model->insert('dispensa_de_licitacao', $data, true);
					$last_id = $this->core_model->get_by_id('dispensa_de_licitacao', array('dis_id' => $this->session->userdata('last_id')));

						$titulo = $this->input->post('disdoc_titulo');
						$arquivo = $this->input->post('disdoc_arquivo');
						$tamanho = $this->input->post('disdoc_tamanho');

						$total = count($arquivo);

						for ($i = 0; $i < $total; $i++) {

							$data = array(
								'disdoc_pregao_id' => $last_id->dis_id,
								'disdoc_titulo' => $titulo[$i],
								'disdoc_arquivo' => $arquivo[$i],
								'disdoc_tamanho' => $tamanho[$i]
							);
							$this->core_model->insert('dispensa_de_licitacao_doc', $data);
						}

					$login = [
						'tipo' => 2,
						'acao' => 'Cadastrou servidor: ' . $last_id->dis_titulo
					];

					insert_login($login);

					$this->redirecionar();
				} else {

					$login = [
						'tipo' => 1,
						'acao' => 'Entrou para cadastrar nova capacitação de servidor'
					];

					insert_login($login);

					$data = array(
						'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Novo Pregão</span>',
						'styles' => array(
							'assets/jquery-upload-file/css/uploadfile.css',
							'assets/bundles/select2/dist/css/select2.min.css',
						),

						'scripts' => array(
							'assets/sweetalert2/sweetalert2.all.min.js',
							'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
							'assets/jquery-upload-file/js/pregao.js',
							'assets/bundles/select2/dist/js/select2.full.min.js',
						),
					

					);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/dispensa_de_licitacao/core');
					$this->load->view('restrita/layout/footer');
				}
			} else {
				$this->redirecionar();
			}
		} else {

			if ($area->editar) {

				if (!$dispensa = $this->core_model->get_by_id('dispensa_de_licitacao', array('dis_id' => $dis_id))) {
					$this->session->set_flashdata('erro', 'Servidor não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('dis_titulo', 'Nome', 'trim|required|max_length[150]');
					$this->form_validation->set_rules('dis_modalidade', 'Modalidade', 'trim|required|max_length[150]');
					$this->form_validation->set_rules('dis_processo', 'Processo de comprar/administração', 'trim|required|max_length[150]');
					$this->form_validation->set_rules('dis_objetivo', 'Objetivo', 'trim|required|max_length[900]');
					
					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'dis_titulo',
								'dis_processo',
								'dis_modalidade',
								'dis_objetivo',
							),
							$this->input->post()
						);

						$data = html_escape($data);

						$this->core_model->update('dispensa_de_licitacao', $data, array('dis_id' => $dispensa->dis_id));

						$this->core_model->delete('dispensa_de_licitacao_doc', array('disdoc_dispensa_id' => $dispensa->dis_id));

						$titulo = $this->input->post('disdoc_titulo');
						$arquivo = $this->input->post('disdoc_arquivo');
						$tamanho = $this->input->post('disdoc_tamanho');

						$cont = 0;
						foreach($arquivo as $a){
							$cont++;
						}

						if($cont >= 1){
							for ($i = 0; $i < $cont; $i++) {

								$data = array(
									'disdoc_pregao_id' => $dispensa->dis_id,
									'disdoc_titulo' => $titulo[$i],
									'disdoc_arquivo' => $arquivo[$i],
									'disdoc_tamanho' => $tamanho[$i]
								);
								$this->core_model->insert('pregao_doc', $data);
							}
						}

						$login = [
							'tipo' => 3,
							'acao' => 'Editou pregões: ' . $dispensa->dis_titulo
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar pregões: ' . $dispensa->dis_titulo
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar Dispensa: ' . $dispensa->dis_titulo . '</span>',
							'dispensa' => $dispensa,
							'pdf' => $this->core_model->get_all('dispensa_de_licitacao_doc', array('disdoc_pregao_id' => $dispensa->dis_id)),
							'styles' => array(
								'assets/jquery-upload-file/css/uploadfile.css',
								'assets/bundles/select2/dist/css/select2.min.css',
							),

							'scripts' => array(
								'assets/sweetalert2/sweetalert2.all.min.js',
								'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
								'assets/jquery-upload-file/js/dispensa.js',
								'assets/bundles/select2/dist/js/select2.full.min.js',
							),
						);

						$this->load->view('restrita/layout/header', $data);
						$this->load->view('restrita/dispensa/core');
						$this->load->view('restrita/layout/footer');
					}
				}
			} else {
				$this->redirecionar();
			}
		}
	}

	public function upload_pdf()
	{

		$config['upload_path'] = './uploads/paginas/dispensa_de_licitacao';
		$config['allowed_types'] = 'PDF|pdf';
		$config['encrypt_name'] = false;
		$config['max_size'] = 9000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_produto')) {

			$data = array(
				'erro' => 0,
				'uploaded_data' => $this->upload->data(),
				'foto_nome' => $this->upload->data('file_name'),
				'mensagem' => 'Foto foi enviada com sucesso',
				'tamanho' => $this->upload->data('file_size') . ' KB',
				'nome' => $this->upload->data('raw_name')
			);
		} else {

			$data = array(
				'erro' => 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}

		echo json_encode($data);
	}

	public function delete($dis_id = null)
	{

		$dis_id = (int) $dis_id;

		if (!$dis_id || !$dispensa = $this->core_model->get_by_id('pregao', array('dis_id' => $dis_id))) {
			$this->session->set_flashdata('erro', 'Servidor não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete('pregao', array('dis_id' => $dispensa->dis_id));

		$this->core_model->delete('pregao_doc', array('disdoc_pregao_id' => $dispensa->dis_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou servidor: ' . $dispensa->dis_titulo
		];

		insert_login($login);
		
		redirect('restrita/' . $this->router->fetch_class());
	}
}
