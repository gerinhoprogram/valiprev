<?php

defined('BASEPATH') or exit('Ação não permitida');

class Pregao extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
		$this->url_pagina = 'pregao';
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
			'pregao' => $this->core_model->get_all('pregao'),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/pregao/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($pre_id = null)
	{

		$area = areas();

		$pre_id = (int) $pre_id;

		if (!$pre_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('pre_titulo', 'Nome', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('pre_modalidade', 'Modalidade', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('pre_processo', 'Processo de comprar/administração', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('pre_modalidade', 'Modalidade', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('pre_objetivo', 'Objetivo', 'trim|required|max_length[900]');
				$this->form_validation->set_rules('pre_entrega', 'Entrega dos envelopes', 'trim|required|max_length[150]');
				$this->form_validation->set_rules('pre_estado', 'Estado', 'trim|required|max_length[150]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'pre_titulo',
							'pre_processo',
							'pre_modalidade',
							'pre_objetivo',
							'pre_entrega',
							'pre_tipo',
							'pre_estado'
						),
						$this->input->post()
					);

					$data = html_escape($data);

					$this->core_model->insert('pregao', $data, true);
					$last_id = $this->core_model->get_by_id('pregao', array('pre_id' => $this->session->userdata('last_id')));

						$titulo = $this->input->post('predoc_titulo');
						$arquivo = $this->input->post('predoc_arquivo');
						$tamanho = $this->input->post('predoc_tamanho');

						$total = count($arquivo);

						for ($i = 0; $i < $total; $i++) {

							$data = array(
								'predoc_pregao_id' => $last_id->pre_id,
								'predoc_titulo' => $titulo[$i],
								'predoc_arquivo' => $arquivo[$i],
								'predoc_tamanho' => $tamanho[$i]
							);
							$this->core_model->insert('pregao_doc', $data);
						}

					$login = [
						'tipo' => 2,
						'acao' => 'Cadastrou servidor: ' . $last_id->pre_titulo
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
					$this->load->view('restrita/pregao/core');
					$this->load->view('restrita/layout/footer');
				}
			} else {
				$this->redirecionar();
			}
		} else {

			if ($area->editar) {

				if (!$pregao = $this->core_model->get_by_id('pregao', array('pre_id' => $pre_id))) {
					$this->session->set_flashdata('erro', 'Servidor não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('pre_titulo', 'Nome', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('pre_modalidade', 'Modalidade', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('pre_processo', 'Processo de comprar/administração', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('pre_modalidade', 'Modalidade', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('pre_objetivo', 'Objetivo', 'trim|required|min_length[2]|max_length[255]');
					$this->form_validation->set_rules('pre_entrega', 'Entrega dos envelopes', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('pre_estado', 'Estado', 'trim|required|min_length[2]|max_length[150]');

					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'pre_titulo',
								'pre_status',
								'pre_processo',
								'pre_modalidade',
								'pre_objetivo',
								'pre_entrega',
								'pre_tipo',
								'pre_estado'
							),
							$this->input->post()
						);

						$data = html_escape($data);

						$this->core_model->update('pregao', $data, array('pre_id' => $pregao->pre_id));

						$log_query_delete = $this->core_model->delete('pregao_doc', array('predoc_pregao_id' => $pregao->pre_id));

						$titulo = $this->input->post('predoc_titulo');
						$arquivo = $this->input->post('predoc_arquivo');
						$tamanho = $this->input->post('predoc_tamanho');

						$cont = 0;
						foreach($arquivo as $a){
							$cont++;
						}

						if($cont >= 1){
							for ($i = 0; $i < $cont; $i++) {

								$data = array(
									'predoc_pregao_id' => $pregao->pre_id,
									'predoc_titulo' => $titulo[$i],
									'predoc_arquivo' => $arquivo[$i],
									'predoc_tamanho' => $tamanho[$i]
								);
								$this->core_model->insert('pregao_doc', $data);
							}
						}

						$login = [
							'tipo' => 3,
							'acao' => 'Editou pregões: ' . $pregao->pre_titulo
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar pregões: ' . $pregao->pre_titulo
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar pregão: ' . $pregao->pre_titulo . '</span>',
							'servidor' => $pregao,
							'pdf' => $this->core_model->get_all('pregao_doc', array('predoc_pregao_id' => $pregao->pre_id)),
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
						$this->load->view('restrita/pregao/core');
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

		$config['upload_path'] = './uploads/paginas/pregao';
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

	public function delete($pre_id = null)
	{

		$pre_id = (int) $pre_id;

		if (!$pre_id || !$pregao = $this->core_model->get_by_id('pregao', array('pre_id' => $pre_id))) {
			$this->session->set_flashdata('erro', 'Servidor não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete('pregao', array('pre_id' => $pregao->pre_id));

		$this->core_model->delete('pregao_doc', array('predoc_pregao_id' => $pregao->pre_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou servidor: ' . $pregao->pre_titulo
		];

		insert_login($login);
		
		redirect('restrita/' . $this->router->fetch_class());
	}
}
