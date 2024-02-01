<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Master extends CI_Controller {

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
            'acao' => 'Entrou em categorias principais'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Categorias principais',
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
            'masters' => $this->artigos_model->get_all_categorias_pai(),
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/master/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_pai_id = null) {

        $area = areas();

        $categoria_pai_id = (int) $categoria_pai_id;

        if (!$categoria_pai_id) {

            if($area->adicionar){

                $this->form_validation->set_rules('categoria_pai_classe_icone', 'Ícone', 'trim|required');
                $this->form_validation->set_rules('categoria_pai_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[150]|callback_valida_nome_categoria');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'categoria_pai_nome',
                            'categoria_pai_ativa',
                            'categoria_pai_classe_icone'
                        ), $this->input->post()
                );

                $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                $data = html_escape($data);

                $this->core_model->insert('categorias_pai', $data, true);
                $last_id = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $this->session->userdata('last_id')));


                $login = [
                    'tipo' => 2,
                    'acao' => 'Cadastrou categoria principal: '.$last_id->categoria_pai_nome
                ];
        
                insert_login($login);

                $this->redirecionar();

            } else {

                $login = [
                    'tipo' => 1,
                    'acao' => 'Entrou para cadastrar nova categoria principal'
                ];
        
                insert_login($login);

                $data = array(
                    'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Nova categoria principal</span>',
                    'scripts' => array(
                        'assets/js/categorias.js', 
                    ),
                );
				
				$data['icones'] = $this->core_model->get_all('icones');

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/master/core');
                $this->load->view('restrita/layout/footer');
            }

            }else{
                $this->redirecionar();
            }

            
        } else {

            if($area->editar){

                if (!$categoria = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {
                    $this->session->set_flashdata('erro', 'Categoria não foi encontrada!');
                    $this->redirecionar();
                } else {
    
                    $this->form_validation->set_rules('categoria_pai_classe_icone', 'Ícone', 'trim|required');
                    $this->form_validation->set_rules('categoria_pai_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[150]|callback_valida_nome_categoria');
    
                    if ($this->form_validation->run()) {
    
                        $data = elements(
                            array(
                                'categoria_pai_nome',
                                'categoria_pai_ativa',
                                'categoria_pai_classe_icone'
                            ), $this->input->post()
                    );
    
                        $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);
    
                        $data = html_escape($data);
    
                        $this->core_model->update('categorias_pai', $data, array('categoria_pai_id' => $categoria->categoria_pai_id));
                       
                        $login = [
                            'tipo' => 3,
                            'acao' => 'Editou categoria principal: '.$categoria->categoria_pai_nome
                        ];
                
                        insert_login($login);

                        $this->redirecionar();
    
                    } else {

                        $login = [
                            'tipo' => 1,
                            'acao' => 'Entrou para editar categoria principal: '.$categoria->categoria_pai_nome
                        ];
                
                        insert_login($login);
    
                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar categoria: '.$categoria->categoria_pai_nome.'</span>',
                            'categoria' => $categoria,
                            'scripts' => array(
                                'assets/js/categorias.js', 
                            ),
                        );
                        
                        $data['icones'] = $this->categorias_model->get_all_icones('icones', true);
    
                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/master/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }

            }else{
                $this->redirecionar();
            }

            
        }
    }

    public function valida_nome_categoria($categoria_pai_nome) {

        $categoria_pai_id = $this->input->post('categoria_pai_id');
        $mensagem = mensagem_padrao($categoria_pai_nome);

        if (!$categoria_pai_id) {

            if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome))) {

                insert_padrao($categoria_pai_nome);
                $this->form_validation->set_message('valida_nome_categoria', $mensagem);
                return false;
            } else {

                return true;
            }
        } else {

            if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id !=' => $categoria_pai_id))) {

                insert_padrao($categoria_pai_nome);
                $this->form_validation->set_message('valida_nome_categoria', $mensagem);
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($categoria_pai_id = null) {

        $categoria_pai_id = (int) $categoria_pai_id;


        if (!$categoria_pai_id || !$categoria = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {
            $this->session->set_flashdata('erro', 'Categoria não foi encontrada');
            $this->redirecionar();
        }

        $cont = $this->artigos_model->get_all_categorias_pai(array('artigo_categoria_pai_id' => $categoria_pai_id));
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
            'acao' => 'Deletou categoria principal: '.$categoria->categoria_pai_nome
        ];

        insert_login($login);


        $this->core_model->delete('categorias_pai', array('categoria_pai_id' => $categoria->categoria_pai_id));
        $this->redirecionar();
    }

}
