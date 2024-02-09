<?php

defined('BASEPATH') or exit('Ação não permitida');

class Regimentos_internos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
		$this->load->model('conselho_model');

		$this->url_pagina = 'regimentos_internos';
		$this->pagina_titulo = 'Regimentos internos';
		$this->tabela_banco = 'regimentos_internos';
		$this->view_folder = 'regimentos_internos';
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
			'regimentos' => $this->conselho_model->get_all_regimentos(),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view("restrita/$this->view_folder/index");
		$this->load->view('restrita/layout/footer');
	}

	public function core($reg_id = null)
	{

		$area = areas();

		$pagina = $this->menu_principal_model->get_pagina_url($this->url_pagina);

		$reg_id = (int) $reg_id;

		if (!$reg_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('reg_nome', 'Nome', 'trim|required|min_length[2]|max_length[150]');
				$this->form_validation->set_rules('reg_pagina_id', 'Página', 'trim|required');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'reg_nome',
							'reg_pagina_id',
						),
						$this->input->post()
					);

					$data['reg_foto'] = $this->input->post('logo_foto_troca');
					$data['reg_tamanho'] = $this->input->post('reg_tamanho');
					$data['reg_tipo_arquivo'] = $this->input->post('reg_tipo_arquivo');

					$data = html_escape($data);

					$this->core_model->insert($this->tabela_banco, $data, true);
					$last_id = $this->core_model->get_by_id($this->tabela_banco, array('reg_id' => $this->session->userdata('last_id')));


					$login = [
						'tipo' => 2,
						'acao' => 'Adicionou conselheiro: ' . $last_id->reg_nome
					];

					insert_login($login);

					$this->redirecionar();
				} else {

					$login = [
						'tipo' => 1,
						'acao' => 'Entrou para cadastrar: ' . $this->pagina_titulo
					];

					insert_login($login);

					$data = array(
						'titulo' => "<span class='text-success'><i class='fas fa-plus'></i>&nbsp; $this->pagina_titulo</span>",
						'styles' => array(
							'assets/jquery-upload-file/css/uploadfile.css',
							'assets/bundles/select2/dist/css/select2.min.css',
						),

						'scripts' => array(
							'assets/sweetalert2/sweetalert2.all.min.js',
							'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
							'assets/jquery-upload-file/js/resolucoes_do_presidente.js',
							'assets/bundles/select2/dist/js/select2.full.min.js',
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

				if (!$pdf = $this->core_model->get_by_id($this->tabela_banco, array('reg_id' => $reg_id))) {
					$this->session->set_flashdata('erro', 'PDF não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('pdf_titulo', 'Nome', 'trim|required|min_length[2]|max_length[150]');

					if (!$this->input->post('foto_produto')) {
						$this->form_validation->set_rules('pdf_arquivo', 'Arquivo', 'trim|required');
					}

					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'pdf_titulo',
								'pdf_arquivo'
							),
							$this->input->post()
						);

						$data['pdf_arquivo'] = $this->input->post('foto_produto');

						$data = html_escape($data);

						$this->core_model->update($this->tabela_banco, $data, array('reg_id' => $pdf->reg_id));

						$login = [
							'tipo' => 3,
							'acao' => 'Editou PDF: ' . $pdf->pdf_titulo
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar ' . $pdf->pdf_titulo
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar : ' . $pdf->pdf_titulo . '</span>',
							'pdf' => $pdf,
							'scripts' => array(
								'assets/js/resolucoes_do_presidente.js'
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

	public function upload_pdf()
	{

		$config['upload_path'] = './uploads/paginas/conselhos/regimentos_internos';
		$config['allowed_types'] = 'PDF|pdf|jpg|png';
		$config['encrypt_name'] = false;
		$config['max_size'] = 9000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('pdf_arquivo')) {

			$data = array(
				'erro' => 0,
				'uploaded_data' => $this->upload->data(),
				'foto_nome' => $this->upload->data('file_name'),
				'mensagem' => 'Arquivo enviado com sucesso',
				'tamanho' => $this->upload->data('file_size') . ' KB',
			);
		} else {

			$data = array(
				'erro' => 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}

		echo json_encode($data);
	}

	public function upload_pdf_unico()
	{

		$config['upload_path'] = './uploads/paginas/resolucoes_do_presidente/pdf';
		$config['allowed_types'] = 'PDF|pdf';
		$config['encrypt_name'] = false;
		$config['max_size'] = 9000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('pdf_arquivo')) {

			$data = array(
				'erro' => 0,
				'uploaded_data' => $this->upload->data(),
				'foto_nome' => $this->upload->data('file_name'),
				'mensagem' => 'Arquivo enviado com sucesso',
				'tamanho' => $this->upload->data('file_size') . ' KB',
				'nome' => $this->upload->data('client_name')
			);
		} else {

			$data = array(
				'erro' => 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}

		echo json_encode($data);
	}

	public function delete($reg_id = null)
	{

		$reg_id = (int) $reg_id;

		if (!$reg_id || !$pdf = $this->core_model->get_by_id($this->tabela_banco, array('reg_id' => $reg_id))) {
			$this->session->set_flashdata('erro', 'PDF não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete($this->tabela_banco, array('reg_id' => $pdf->reg_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou PDF: ' . $pdf->pdf_titulo
		];

		insert_login($login);

		redirect('restrita/' . $this->router->fetch_class());
	}
}
