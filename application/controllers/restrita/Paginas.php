<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Paginas extends CI_Controller {

    public function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }
        
    }

    public function redirecionar(){
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index() {

        if(!$area = areas()){
            redirect('restrita');
        }

        $login = [
            'tipo' => 1,
            'acao' => 'Acessou paginas'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Listagem das páginas do site',
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
            'paginas' => $this->core_model->get_all('paginas'),
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/paginas/index');
        $this->load->view('restrita/layout/footer');
    }

	public function situacao($pag_id = null)
	{

		$area = areas();

		if ($area->editar) {

			$pag_id = (int) $pag_id;


			if (!$pag_id || !$pagina = $this->core_model->get_by_id('paginas', array('pag_id' => $pag_id))) {
				$this->session->set_flashdata('erro', 'Página não encontrada');
				redirect('restrita/' . $this->router->fetch_class());
			}

			if ($pagina->pag_status == 1) {

				$login = [

					'tipo' => 3,
					'acao' => 'Alterou para inativo a página: ' . $pagina->pag_nome
				];
				insert_login($login);

				$data =
					array(
						'pag_status' => 0,
					);
			} else {

				$login = [

					'tipo' => 3,
					'acao' => 'Alterou para ativo a página: ' . $pagina->pag_nome
				];
				insert_login($login);

				$data =
					array(
						'pag_status' => 1,
					);
			}

			$this->core_model->update('paginas', $data, array('pag_id' => $pagina->pag_id));
		}

		redirect('restrita/' . $this->router->fetch_class());
	}

	public function pdf_pagina($pag_id = null)
    {

		exit($pag_id);

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
