<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Menu_principal extends CI_Controller {

    public function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        $this->load->model('categorias_model');
        
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
            'acao' => 'Acessou listagem do menu principais'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Listagem do menu principal',
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
            'menus' => $this->core_model->get_all('paginas_menu'),
			'menu_qtd' => $this->core_model->count_all_results('paginas_menu', array('men_status' => 1)),
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/menu_principal/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($men_id = null) {

        $area = areas();

        $men_id = (int) $men_id;

        if (!$men_id) {

            if($area->adicionar){

                $this->form_validation->set_rules('men_nome', 'Nome', 'trim|required|min_length[5]|max_length[25]|callback_valida_nome_menu');
				$this->form_validation->set_rules('men_status', 'Status', 'trim|required');
				$this->form_validation->set_rules('men_ordem', 'Ordenação', 'trim|required');
				$this->form_validation->set_rules('men_tem_submenu', 'Submenu', 'trim|required');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
							'men_nome',
                            'men_status',
                            'men_ordem',
							'men_tem_submenu'
                        ), $this->input->post()
                );

                $data['men_url'] = url_amigavel($data['men_nome']);
				$data['men_criador'] = $_SESSION['login'];

                $data = html_escape($data);

                $log_query = $this->core_model->insert('paginas_menu', $data, true);
                $last_id = $this->core_model->get_by_id('paginas_menu', array('men_id' => $this->session->userdata('last_id')));


                $login = [
                    'tipo' => 2,
                    'acao' => 'Cadastrou menu principal: '.$last_id->men_nome,
					'log_query' => $log_query
                ];
        
                insert_login($login);

                $this->redirecionar();

            } else {

                $login = [
                    'tipo' => 1,
                    'acao' => 'Entrou para cadastrar novo menu principal'
                ];
        
                insert_login($login);

                $data = array(
                    'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Cadastrar novo menu principal</span>',
                    'scripts' => array(
                        'assets/js/menu_principal.js', 
                    ),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/menu_principal/core');
                $this->load->view('restrita/layout/footer');
            }

            }else{
                $this->redirecionar();
            }

            
        } else {

            if($area->editar){

                if (!$menu = $this->core_model->get_by_id('paginas_menu', array('men_id' => $men_id))) {
                    $this->session->set_flashdata('erro', 'Menu não foi encontrado!');
                    $this->redirecionar();
                } else {
    
                    $this->form_validation->set_rules('men_nome', 'Nome', 'trim|required|min_length[5]|max_length[25]|callback_valida_nome_menu');
					$this->form_validation->set_rules('men_status', 'Status', 'trim|required');
					$this->form_validation->set_rules('men_ordem', 'Ordenação', 'trim|required');
					$this->form_validation->set_rules('men_tem_submenu', 'Submenu', 'trim|required');

                    if ($this->form_validation->run()) {
    
                        $data = elements(
                            array(
                                'men_status',
                                'men_ordem',
								'men_tem_submenu'
                            ), $this->input->post()
                    	);

						if(!$menu->men_criador == 'sistema'){
							$data['men_nome'] = $this->input->post('men_nome');
							$data['men_url'] = url_amigavel($data['men_nome']);
						}
    
                        
    
                        $data = html_escape($data);
    
                        $log_query = $this->core_model->update('paginas_menu', $data, array('men_id' => $menu->men_id));
                       
                        $login = [
                            'tipo' => 3,
                            'acao' => 'Editou menu principal: '.$menu->men_nome,
							'log_query' => $log_query
                        ];
                
                        insert_login($login);

                        $this->redirecionar();
    
                    } else {

                        $login = [
                            'tipo' => 1,
                            'acao' => 'Entrou para editar categoria principal: '.$menu->men_nome
                        ];
                
                        insert_login($login);
    
                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar menu principal: '.$menu->men_nome.'</span>',
                            'menu' => $menu,
                            'scripts' => array(
                                'assets/js/menu_principal.js', 
                            ),
                        );
                    
    
                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/menu_principal/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }

            }else{
                $this->redirecionar();
            }

            
        }
    }

    public function valida_nome_menu($men_nome) {

        $men_id = $this->input->post('men_id');
        $mensagem = mensagem_padrao($men_nome);

        if (!$men_id) {

            if ($this->core_model->get_by_id('paginas_menu', array('men_nome' => $men_nome))) {

                insert_padrao($men_nome);
                $this->form_validation->set_message('valida_nome_menu', $mensagem);
                return false;
            } else {

                return true;
            }
        } else {

            if ($this->core_model->get_by_id('paginas_menu', array('men_nome' => $men_nome, 'men_id !=' => $men_id))) {

                insert_padrao($men_nome);
                $this->form_validation->set_message('valida_nome_menu', $mensagem);
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($men_id = null) {

        $men_id = (int) $men_id;


        if (!$men_id || !$menu = $this->core_model->get_by_id('paginas_menu', array('men_id' => $men_id))) {
            $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
            $this->redirecionar();
        }

        $cont = $this->artigos_model->get_all_paginas_menu(array('artigo_men_id' => $men_id));
        if ($cont[0]->quantidade_artigos > 0 ) {
            $login = [
                'tipo' => 5,
                'acao' => 'Não é permetido deletar categoria com artigo vinculado'
            ];
    
            insert_login($login);
            $this->session->set_flashdata('erro', 'Não é permetido deletar categoria com artigo vinculado.');
            $this->redirecionar();
        }

        $login = [
            'tipo' => 4,
            'acao' => 'Deletou categoria principal: '.$menu->men_nome
        ];

        insert_login($login);


        $this->core_model->delete('paginas_menu', array('men_id' => $menu->men_id));
        $this->redirecionar();
    }

}
