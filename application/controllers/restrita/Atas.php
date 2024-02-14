<?php

defined('BASEPATH') or exit('Ação não permitida');

class Atas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
		$this->load->model('conselho_model');

		$this->url_pagina = 'atas';
		$this->pagina_titulo = 'Atas';
		$this->tabela_banco = 'atas';
		$this->view_folder = 'atas';
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
			'atas' => $this->conselho_model->get_all_atas(),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view("restrita/$this->view_folder/index");
		$this->load->view('restrita/layout/footer');
	}

	public function core($ata_id = null)
	{

		$area = areas();

		$pagina = $this->menu_principal_model->get_pagina_url($this->url_pagina);

		$ata_id = (int) $ata_id;

		if (!$ata_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('ata_nome', 'Nome', 'trim|required|min_length[2]|max_length[150]');
				$this->form_validation->set_rules('ata_pagina_id', 'Página', 'trim|required');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'ata_nome',
							'ata_pagina_id',
						),
						$this->input->post()
					);

					$data['ata_foto'] = $this->input->post('logo_foto_troca');
					$data['ata_tamanho'] = $this->input->post('ata_tamanho');

					$data = html_escape($data);

					$this->core_model->insert($this->tabela_banco, $data, true);
					$last_id = $this->core_model->get_by_id($this->tabela_banco, array('ata_id' => $this->session->userdata('last_id')));


					$login = [
						'tipo' => 2,
						'acao' => 'Adicionou conselheiro: ' . $last_id->ata_nome
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
						'scripts' => array(
							'assets/js/atas.js',
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

				if (!$ata = $this->core_model->get_by_id($this->tabela_banco, array('ata_id' => $ata_id))) {
					$this->session->set_flashdata('erro', 'PDF não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('ata_nome', 'Nome', 'trim|required|min_length[2]|max_length[150]');
					$this->form_validation->set_rules('ata_pagina_id', 'Página', 'trim|required');

					if (!$this->input->post('foto_produto')) {
						$this->form_validation->set_rules('ata_foto', 'Arquivo', 'trim|required');
					}

					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'ata_nome',
								'ata_pagina_id',
							),
							$this->input->post()
						);

						$data['ata_foto'] = $this->input->post('foto_produto');

						$data = html_escape($data);

						$this->core_model->update($this->tabela_banco, $data, array('ata_id' => $ata->ata_id));

						$login = [
							'tipo' => 3,
							'acao' => 'Editou PDF: ' . $ata->ata_nome
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar ' . $ata->ata_nome
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar : ' . $ata->ata_nome . '</span>',
							'regimento' => $ata,
							'scripts' => array(
								'assets/js/regimentos_internos.js',
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

	public function upload_foto()
	{

		$config['upload_path'] = './uploads/paginas/conselhos/atas';
		$config['allowed_types'] = 'PDF|pdf|png|jpg';
		$config['encrypt_name'] = false;
		$config['max_size'] = 9000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('ata_foto')) {

			$data = array(
				'erro' => 0,
				'uploaded_data' => $this->upload->data(),
				'foto_nome' => $this->upload->data('file_name'),
				'mensagem' => 'Arquivo enviado com sucesso',
				'tamanho' => $this->upload->data('file_size') . ' KB',
				'nome' => $this->upload->data('client_name'),
				'tipo' => $this->upload->data('file_ext')
			);
		} else {

			$data = array(
				'erro' => 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}

		echo json_encode($data);
	}

	public function delete($ata_id = null)
	{

		$ata_id = (int) $ata_id;

		if (!$ata_id || !$ata = $this->core_model->get_by_id($this->tabela_banco, array('ata_id' => $ata_id))) {
			$this->session->set_flashdata('erro', 'PDF não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete($this->tabela_banco, array('ata_id' => $ata->ata_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou PDF: ' . $ata->ata_nome
		];

		insert_login($login);

		redirect('restrita/' . $this->router->fetch_class());
	}
}
