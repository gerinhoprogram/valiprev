<?php

defined('BASEPATH') or exit('Ação não permitida');

class Capacitacao_de_servidores extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}

		$this->load->model('menu_principal_model');
	}

	public function redirecionar()
	{
		redirect('restrita/' . $this->router->fetch_class());
	}

	public function index()
	{

		$pagina = $this->menu_principal_model->get_pagina_url('capacitacao-de-servidores');

		if (!$area = areas()) {
			redirect('restrita');
		}

		$login = [
			'tipo' => 1,
			'acao' => 'Acessou pagina: Capacitação de servidores'
		];

		insert_login($login);

		$data = array(
			'titulo' => 'Listagem dos servidores',
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
			'servidores' => $this->core_model->get_all('capacitacao_servidores'),
			'pagina' => $pagina,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
			'excluir' => $area->excluir,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/capacitacao_de_servidores/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($serv_id = null)
	{

		$area = areas();

		$serv_id = (int) $serv_id;

		if (!$serv_id) {

			if ($area->adicionar) {

				$this->form_validation->set_rules('serv_nome', 'Nome', 'trim|required|min_length[2]|max_length[150]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'serv_nome',
							'serv_status'
						),
						$this->input->post()
					);

					$data = html_escape($data);

					$this->core_model->insert('capacitacao_servidores', $data, true);
					$last_id = $this->core_model->get_by_id('capacitacao_servidores', array('serv_id' => $this->session->userdata('last_id')));

						$titulo = $this->input->post('pdf_titulo');
						$arquivo = $this->input->post('pdf_arquivo');
						$tamanho = $this->input->post('pdf_tamanho');

						$total = count($arquivo);

						for ($i = 0; $i < $total; $i++) {

							$data = array(
								'pdf_pagina_id' => $last_id->serv_id,
								'pdf_titulo' => $titulo[$i],
								'pdf_arquivo' => $arquivo[$i],
								'pdf_tamanho' => $tamanho[$i],
								'pdf_user' => $_SESSION['login']
							);
							$this->core_model->insert('pdf_capacitacao_servidores', $data);
						}

					$login = [
						'tipo' => 2,
						'acao' => 'Cadastrou servidor: ' . $last_id->serv_nome
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
						'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Nova capacitação de servidor</span>',
						'styles' => array(
							'assets/jquery-upload-file/css/uploadfile.css',
							'assets/bundles/select2/dist/css/select2.min.css',
						),

						'scripts' => array(
							'assets/sweetalert2/sweetalert2.all.min.js',
							'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
							'assets/jquery-upload-file/js/capacitacao_de_servidores.js',
							'assets/bundles/select2/dist/js/select2.full.min.js',
						),

					);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/capacitacao_de_servidores/core');
					$this->load->view('restrita/layout/footer');
				}
			} else {
				$this->redirecionar();
			}
		} else {

			if ($area->editar) {

				if (!$servidor = $this->core_model->get_by_id('capacitacao_servidores', array('serv_id' => $serv_id))) {
					$this->session->set_flashdata('erro', 'Servidor não foi encontrado!');
					$this->redirecionar();
				} else {

					$this->form_validation->set_rules('serv_nome', 'Nome', 'trim|required|min_length[2]|max_length[150]');

					if ($this->form_validation->run()) {

						$data = elements(
							array(
								'serv_nome',
								'serv_status'
							),
							$this->input->post()
						);

						$data = html_escape($data);

						$this->core_model->update('capacitacao_servidores', $data, array('serv_id' => $servidor->serv_id));

						$log_query_delete = $this->core_model->delete('pdf_capacitacao_servidores', array('pdf_pagina_id' => $servidor->serv_id));

						$titulo = $this->input->post('pdf_titulo');
						$arquivo = $this->input->post('pdf_arquivo');
						$tamanho = $this->input->post('pdf_tamanho');

						$cont = 0;
						foreach($arquivo as $a){
							$cont++;
						}

						if($cont >= 1){
							for ($i = 0; $i < $cont; $i++) {

								$data = array(
									'pdf_pagina_id' => $servidor->serv_id,
									'pdf_titulo' => $titulo[$i],
									'pdf_arquivo' => $arquivo[$i],
									'pdf_tamanho' => $tamanho[$i],
									'pdf_user' => $_SESSION['login']
								);
								$this->core_model->insert('pdf_capacitacao_servidores', $data);
							}
						}

						$login = [
							'tipo' => 3,
							'acao' => 'Editou capacitação de servidores: ' . $servidor->serv_nome
						];

						insert_login($login);

						$this->redirecionar();
					} else {

						$login = [
							'tipo' => 1,
							'acao' => 'Entrou para editar capacitação de servidores: ' . $servidor->serv_nome
						];

						insert_login($login);

						$data = array(
							'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar categoria: ' . $servidor->serv_nome . '</span>',
							'servidor' => $servidor,
							'pdf' => $this->core_model->get_all('pdf_capacitacao_servidores', array('pdf_pagina_id' => $servidor->serv_id)),
							'styles' => array(
								'assets/jquery-upload-file/css/uploadfile.css',
								'assets/bundles/select2/dist/css/select2.min.css',
							),

							'scripts' => array(
								'assets/sweetalert2/sweetalert2.all.min.js',
								'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
								'assets/jquery-upload-file/js/capacitacao_de_servidores.js',
								'assets/bundles/select2/dist/js/select2.full.min.js',
							),
						);

						$this->load->view('restrita/layout/header', $data);
						$this->load->view('restrita/capacitacao_de_servidores/core');
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

		$config['upload_path'] = './uploads/paginas/capacitacao-de-servidores/pdf';
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

	// public function upload_foto()
	// {

	// 	$mensagem_upload = "No máximo 3000 x 3000 pixels";

	// 	$this->session->set_userdata('mensagem_upload', $mensagem_upload);

	// 	$config['upload_path'] = './uploads/paginas/censo_previdenciario';
	// 	$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
	// 	$config['encrypt_name'] = false;
	// 	$config['max_size'] = 4000; //Max 2M
	// 	$config['max_width'] = 3000;
	// 	$config['max_height'] = 3000;

	// 	$this->load->library('upload', $config);

	// 	if ($this->upload->do_upload('cont_foto')) {

	// 		$data = array(
	// 			'erro' => 0,
	// 			'uploaded_data' => $this->upload->data(),
	// 			'foto_nome' => $this->upload->data('file_name'),
	// 			'mensagem' => 'Foto foi enviada com sucesso',
	// 		);
	// 	} else {

	// 		$data = array(
	// 			'erro' => 3,
	// 			'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
	// 		);
	// 	}

	// 	echo json_encode($data);
	// }

	// public function upload_pdf()
	// {

	// 	$mensagem_upload = "No máximo 3000 x 3000 pixels";

	// 	$this->session->set_userdata('mensagem_upload', $mensagem_upload);

	// 	$config['upload_path'] = './uploads/paginas/censo_previdenciario/pdf';
	// 	$config['allowed_types'] = 'PDF|pdf';
	// 	$config['encrypt_name'] = false;
	// 	$config['max_size'] = 9000;

	// 	$this->load->library('upload', $config);

	// 	if ($this->upload->do_upload('pdf_arquivo')) {

	// 		$data = array(
	// 			'erro' => 0,
	// 			'uploaded_data' => $this->upload->data(),
	// 			'foto_nome' => $this->upload->data('file_name'),
	// 			'mensagem' => 'Arquivo enviado com sucesso',
	// 			'tamanho' => $this->upload->data('file_size') . ' KB',
	// 		);
	// 	} else {

	// 		$data = array(
	// 			'erro' => 3,
	// 			'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
	// 		);
	// 	}

	// 	echo json_encode($data);
	// }


	public function pdf_listagem($pag_id = null)
	{

		// echo"<pre>";
		// print_r($_SESSION);
		// exit;

		if (!$area = areas()) {
			redirect('restrita');
		}

		if (!$pag_id || !$pagina = $this->core_model->get_by_id('paginas', array('pag_id' => $pag_id))) {
			$this->session->set_flashdata('erro', 'Página não encontrada');
			redirect('restrita/' . $this->router->fetch_class());
		}

		$login = [

			'tipo' => 1,
			'acao' => 'Entrou em PDFs página'
		];

		insert_login($login);

		$data = array(
			'titulo' => 'PDFs e documentos da página: ' . $pagina->pag_nome,
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
			'pdfs' => $this->core_model->get_all('pdf_censo_previdenciario'),
			'pagina' => $pagina,
			'excluir' => $area->excluir,
			'editar' => $area->editar,
			'adicionar' => $area->adicionar,
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/censo_previdenciario/pdf_listagem');
		$this->load->view('restrita/layout/footer');
	}

	public function pdf_adicionar($pag_id = null)
	{

		$pag_id = (int) $pag_id;

		if (!$pag_id || !$pagina = $this->core_model->get_by_id('paginas', array('pag_id' => $pag_id))) {

			$this->session->set_flashdata('erro', 'Página não encontrada');
			redirect('restrita/' . $this->router->fetch_class());
		}

		$this->form_validation->set_rules('pdf_titulo', 'Título', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('pdf_arquivo', 'Arquivo', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('pdf_descricao', 'Descrição', 'trim|max_length[150]');

		if ($this->form_validation->run()) {

			$data = elements(
				array(
					'pdf_titulo',
					'pdf_descricao',
					'pdf_status',
					'pdf_tamanho'
				),
				$this->input->post()
			);

			$data['pdf_arquivo'] = $this->input->post('logo_foto_troca');
			$data['pdf_pagina_id'] = $pagina->pag_id;
			$data['pdf_user'] = $_SESSION['login'];

			$this->core_model->insert('pdf_censo_previdenciario', $data);

			redirect('restrita/' . $this->router->fetch_class() . '/pdf_listagem/' . $pagina->pag_id);
		}

		$data = array(
			'titulo' => 'Adicionar PDF para a página: ' . $pagina->pag_nome,
			'pagina' => $pagina,
			'scripts' => array(
				'assets/js/censo_previdenciario.js'
			),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/censo_previdenciario/pdf_core');
		$this->load->view('restrita/layout/footer');
	}

	public function pdf_editar($pag_id = null, $pdf_id = null)
	{

		$pag_id = (int) $pag_id;
		$pdf_id = (int) $pdf_id;

		if (!$pag_id || !$pagina = $this->core_model->get_by_id('paginas', array('pag_id' => $pag_id))) {

			$this->session->set_flashdata('erro', 'Página não encontrada');
			redirect('restrita/' . $this->router->fetch_class());
		}

		if (!$pdf_id || !$pdf = $this->core_model->get_by_id('pdf_censo_previdenciario', array('pdf_id' => $pdf_id))) {

			$this->session->set_flashdata('erro', 'PDF não encontrado');
			redirect('restrita/' . $this->router->fetch_class());
		}

		$this->form_validation->set_rules('pdf_titulo', 'Título', 'trim|required|max_length[150]');

		if (!$this->input->post('logo_foto_troca')) {
			$this->form_validation->set_rules('pdf_arquivo', 'Arquivo', 'trim|required|max_length[150]');
		}

		$this->form_validation->set_rules('pdf_descricao', 'Descrição', 'trim|max_length[150]');

		if ($this->form_validation->run()) {

			$data = elements(
				array(
					'pdf_titulo',
					'pdf_descricao',
					'pdf_status',
					'pdf_tamanho'
				),
				$this->input->post()
			);

			$data['pdf_arquivo'] = $this->input->post('logo_foto_troca');
			$data['pdf_pagina_id'] = $pagina->pag_id;
			$data['pdf_user_update'] = $_SESSION['login'];

			$this->core_model->update('pdf_censo_previdenciario', $data, array('pdf_id' => $pdf->pdf_id));

			redirect('restrita/' . $this->router->fetch_class() . '/pdf_listagem/' . $pagina->pag_id);
		}

		$data = array(
			'titulo' => 'Editar PDF:' . $pdf->pdf_titulo . ' da página: ' . $pagina->pag_nome,
			'pagina' => $pagina,
			'pdf' => $pdf,
			'scripts' => array(
				'assets/js/censo_previdenciario.js'
			),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/censo_previdenciario/pdf_core');
		$this->load->view('restrita/layout/footer');
	}

	public function delete($serv_id = null)
	{

		$serv_id = (int) $serv_id;

		if (!$serv_id || !$servidor = $this->core_model->get_by_id('capacitacao_servidores', array('serv_id' => $serv_id))) {
			$this->session->set_flashdata('erro', 'Servidor não foi encontrado');
			$this->redirecionar();
		}

		$this->core_model->delete('capacitacao_servidores', array('serv_id' => $servidor->serv_id));

		$this->core_model->delete('pdf_capacitacao_servidores', array('pdf_pagina_id' => $servidor->serv_id));

		$login = [
			'tipo' => 4,
			'acao' => 'Deletou servidor: ' . $servidor->serv_nome
		];

		insert_login($login);
		
		redirect('restrita/' . $this->router->fetch_class());
	}
}
