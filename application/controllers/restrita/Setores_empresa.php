<?php

defined('BASEPATH') or exit('Ação não permitida');

class Setores_empresa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }
    }

    public function redirecionar()
    {
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index()
    {

        $login = [
            
            'tipo' => 1,
            'acao' => 'Entrou em setores da empresa',
            
            
        ];

        insert_login($login);

        if(!$area = areas()){
            redirect('restrita');
        }

        $data = array(
            'titulo' => 'Setores da empresa',
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
            'setores' => $this->core_model->get_all('setores_empresa'),
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/setores_empresa/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($setor_id = null)
    {

        if(!$area = areas()){
            redirect('restrita');
        }

        $setor_id = (int) $setor_id;

        if (!$setor_id) {

            if ($area->adicionar) {

                $this->form_validation->set_rules('setor_nome', 'Nome', 'trim|required|min_length[2]|max_length[120]|callback_valida_nome_setor');

                if ($this->form_validation->run()) {

                    $data = elements(
                        array(
                            'setor_nome',
                        ),
                        $this->input->post()
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('setores_empresa', $data);

                    $login = [
                        
                        'tipo' => 2,
                        'acao' => 'Cadastrou novo setor',
                        
                        
                    ];
            
                    insert_login($login);

                    $this->redirecionar();

                } else {

                    $login = [
                        
                        'tipo' => 1,
                        'acao' => 'Entrou para cadastrar novo setor da empresa',
                        
                        
                    ];
            
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Adicionar novo setor da empresa</span>',
                        'scripts' => array(
                            'assets/js/setores_empresa.js',
                        ),
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/setores_empresa/core');
                    $this->load->view('restrita/layout/footer');
                }
            } else {
                $this->redirecionar();
            }
        } else {

            if ($area->editar) {

                if (!$setor = $this->core_model->get_by_id('setores_empresa', array('setor_id' => $setor_id))) {
                    $this->session->set_flashdata('erro', 'Setor não encontrado!');
                    $this->redirecionar();
                } else {

                    $this->form_validation->set_rules('setor_nome', 'Nome da categoria', 'trim|required|min_length[2]|max_length[120]|callback_valida_nome_setor');

                    if ($this->form_validation->run()) {

                        $data = elements(
                            array(
                                'setor_nome',
                            ),
                            $this->input->post()
                        );

                        $data = html_escape($data);

                        $login = [
                            
                            'tipo' => 3,
                            'acao' => 'Editou setor: '.$setor->setor_nome,
                            
                            
                        ];
                
                        insert_login($login);

                        $this->core_model->update('setores_empresa', $data, array('setor_id' => $setor->setor_id));

                        $this->redirecionar();
                    } else {

                        $login = [
                            
                            'tipo' => 1,
                            'acao' => 'Entrou para editar setor: '.$setor->setor_nome,
                            
                            
                        ];
                
                        insert_login($login);

                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>:&nbsp; Editar setor: '.$setor->setor_nome.'</span>',
                            'setor' => $setor,
                            'scripts' => array(
                                'assets/js/setores_empresa.js',
                            ),
                        );

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/setores_empresa/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }
            } else {
                $this->redirecionar();
            }
        }
    }


    public function valida_nome_setor($setor_nome)
    {

        $setor_id = $this->input->post('setor_id');

        if (!$setor_id) {

            if ($this->core_model->get_by_id('setores_empresa', array('setor_nome' => $setor_nome))) {

                $this->form_validation->set_message('valida_nome_setor', 'Esse setor já existe');
                return false;
            } else {

                return true;
            }
        } else {

            if ($this->core_model->get_by_id('setores_empresa', array('setor_nome' => $setor_nome, 'setor_id !=' => $setor_id))) {

                $this->form_validation->set_message('valida_nome_setor', 'Esse setor já existe');
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($setor_id = null)
    {

        if(!$area = areas()){
            redirect('restrita');
        }

        $setor_id = (int) $setor_id;

        if (!$setor_id || !$setor = $this->core_model->get_by_id('setores_empresa', array('setor_id' => $setor_id))) {
            $this->session->set_flashdata('erro', 'Setor não encontrado');
            $this->redirecionar();
        }


        if ($area->excluir) {

            $cont = $this->usuarios_model->get_all_usuarios_count(array('users.setor_id' => $setor_id));

            if ($cont[0]->qtd > 0) {
                
                $login = [
                    
                    'tipo' => 5,
                    'acao' => 'Não é permitido excluir setor com usuário vinculado',
                    
                    
                ];
        
                insert_login($login);

                $this->session->set_flashdata('erro', 'Existe usuário vinculado com esse setor.');
                $this->redirecionar();
            }


            $login = [
                
                'tipo' => 4,
                'acao' => 'Excluiu setor: '.$setor->setor_nome,
                
                
            ];
    
            insert_login($login);

            $this->core_model->delete('setores_empresa', array('setor_id' => $setor->setor_id));
            $this->redirecionar();

        } else {

            $this->redirecionar();
        }
    }
}
