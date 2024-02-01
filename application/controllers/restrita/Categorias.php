<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        $this->load->model('categorias_model');
        $this->load->model('aux_artigos_categoria');
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
            'acao' => 'Entrou em categorias'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Categorias cadastradas',
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
            'categorias' => $this->categorias_model->get_all_categorias(),
            'excluir' => $area->excluir,
            'adicionar' => $area->adicionar,
            'editar' => $area->editar
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/categorias/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_id = null) {

        $area = areas();

        $categoria_id = (int) $categoria_id;

        if (!$categoria_id) {

            if($area->adicionar){

                $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[3]|max_length[100]|callback_valida_nome_categoria');
                $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');

                if ($this->form_validation->run()) {

                    $data = elements(
                            array(
                                'categoria_nome',
                                'categoria_pai_id',
                                'categoria_ativa',
                            ), $this->input->post()
                    );

                    $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

                    $data = html_escape($data);

                    $this->core_model->insert('categorias', $data, true);

                    $last_id = $this->core_model->get_by_id('categorias', array('categoria_id' => $this->session->userdata('last_id')));


                    $login = [
                        'tipo' => 2,
                        'acao' => 'Cadastrou categoria: '.$last_id->categoria_nome
                    ];
            
                    insert_login($login);

                    $this->redirecionar();

                } else {

                    $login = [
                        'tipo' => 1,
                        'acao' => 'Entrou para cadastrar nova categoria'
                    ];
            
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>Cadastrar categoria</span>',
                        'styles' => array(
                            'assets/bundles/select2/dist/css/select2.min.css',
                        ),
                        'scripts' => array(
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                            'assets/js/subcategorias.js', 
                        ),
                        'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/categorias/core');
                    $this->load->view('restrita/layout/footer');
                }

            }else{
                $this->redirecionar();
            }

        } else {

            if($area->editar){

                if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
                    $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
                    $this->redirecionar();
                } else {
    
                    $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[3]|max_length[150]|callback_valida_nome_categoria');
                    $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');
    
                    if ($this->form_validation->run()) {
    
                        $data = elements(
                                array(
                                    'categoria_nome',
                                    'categoria_pai_id',
                                    'categoria_ativa',
                                ), $this->input->post()
                        );
    
                        $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);
    
                        $data = html_escape($data);
    
                        $this->core_model->update('categorias', $data, array('categoria_id' => $categoria->categoria_id));
                       
                        $login = [
                            'tipo' => 3,
                            'acao' => 'Editou categoria: '.$categoria->categoria_nome
                        ];
                
                        insert_login($login);
                        $this->redirecionar();
    
                    } else {

                        $login = [
                            'tipo' => 1,
                            'acao' => 'Entrou para editar categoria: '.$categoria->categoria_nome
                        ];
                
                        insert_login($login);
    
                        $data = array(
                            'titulo' => 'Editar categoria',
                            'styles' => array(
                                'assets/bundles/select2/dist/css/select2.min.css',
                            ),
                            'scripts' => array(
                                'assets/bundles/select2/dist/js/select2.full.min.js',
                                'assets/js/subcategorias.js', 
                            ),
                            'categoria' => $categoria,
                            'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
                        );
    
                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/categorias/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }

            }else{
                $this->redirecionar();
            }

            
        }
    }

    public function valida_nome_categoria($categoria_nome) {

        $categoria_id = $this->input->post('categoria_id');

        if (!$categoria_id) {

            /*
             * cadastro...
             */

            if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))) {

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
                return false;
            } else {

                return true;
            }
        } else {

            /*
             * Editando...
             */


            if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))) {

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($categoria_id = null) {

        $area = areas();

        if($area->excluir){

            $categoria_id = (int) $categoria_id;


            if (!$categoria_id || !$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
                $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
                $this->redirecionar();
            }


            if ($categoria->categoria_ativa == 1) {
                $this->session->set_flashdata('erro', 'Não é permitido excluir uma Categoria que esteja ativa');
                $this->redirecionar();
            }

            $cont = $this->aux_artigos_categoria->get_all_categorias_count(array('ca_id_subcategoria' => $categoria_id));
            
            if ($cont[0]->quantidade_artigos > 0 ) {
                $this->session->set_flashdata('erro', 'Não é permetido deletar categoria com artigo vinculado.');
                $this->redirecionar();
            }


            $this->core_model->delete('categorias', array('categoria_id' => $categoria->categoria_id));

        }

        $this->redirecionar();
    }

}
