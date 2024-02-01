<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Censo_previdenciario extends CI_Controller {

    public function __construct() {
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

    public function index() {

			$pagina = $this->menu_principal_model->get_pagina_url('censo-previdenciario');

			$login = [
				'tipo' => 1,
				'acao' => 'Acessou a página: '.$pagina->pag_nome
			];

			insert_login($login);

			$this->form_validation->set_rules('cont_titulo', 'Título', 'trim|required|max_length[150]');
            $this->form_validation->set_rules('cont_subtitulo', 'Subtitulo', 'trim|max_length[150]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'cont_titulo',
                            'cont_subtitulo',
                        ), $this->input->post()
                );

                $data['cont_foto'] = $this->input->post('logo_foto_troca');

                $log_query_update = $this->core_model->update('paginas_nivel2', $data, array('cont_pagina_id' => $pagina->pag_id));

				$log_query_delete = $this->core_model->delete('faq_censo_previdenciario', array('cep_pagina_id' => $pagina->pag_id));

				// inserindo fotos
				$titulo = $this->input->post('cep_titulo');
				$texto = $this->input->post('cep_texto');

				$total = count($titulo);

				for ($i = 0; $i < $total; $i++) {

					$data = array(
						'cep_pagina_id' => $pagina->pag_id,
						'cep_titulo' => $titulo[$i],
						'cep_texto' => $texto[$i],
					);
					$this->core_model->insert('faq_censo_previdenciario', $data);
				}

				$login = [
					'tipo' => 1,
					'acao' => 'Atualizou a página: '.$pagina->pag_nome,
					'log_query_update' => $log_query_update,
					'log_query_delete' => $log_query_delete
				];
	
				insert_login($login);

                redirect('restrita/' . $this->router->fetch_class());

            } else {

				$data = array(
					'titulo' => 'Editar página: '.$pagina->pag_nome,
					'pagina' => $pagina,
					'faq' => $this->core_model->get_all('faq_censo_previdenciario', array('cep_pagina_id' => $pagina->pag_id)),
					'scripts' => array(
						'assets/js/censo_previdenciario.js'
					),
				);
		
				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/censo_previdenciario/index');
				$this->load->view('restrita/layout/footer');
                
            }

    }

    public function upload_foto() {

        $mensagem_upload = "No máximo 3000 x 3000 pixels";

        $this->session->set_userdata('mensagem_upload', $mensagem_upload);

        $config['upload_path'] = './uploads/paginas/censo_previdenciario';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
        $config['encrypt_name'] = false;
        $config['max_size'] = 4000; //Max 2M
        $config['max_width'] = 3000;
        $config['max_height'] = 3000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('cont_foto')) {

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'foto_nome' => $this->upload->data('file_name'),
                'mensagem' => 'Foto foi enviada com sucesso',
            );

        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);
    }


	public function pdf_pagina($pag_id = null)
    {

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
            'titulo' => 'PDFs e documentos da página: '.$pagina->pag_nome,
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
            'excluir' => $area->excluir,
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/censo_previdenciario/pdf');
        $this->load->view('restrita/layout/footer');
    }


}
