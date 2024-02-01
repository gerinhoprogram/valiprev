<?php


defined('BASEPATH') or exit('Ação não permitida');

class Setores extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        if (!$area = areas()) {
            redirect('restrita');
        }
    }

    private function redirecionar()
    {
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index()
    {

        $login = [
            
            'tipo' => 1,
            'acao' => 'Entrou em setores e permissões'
        ];

        insert_login($login);

        $area = areas();

        $data = array(
            'titulo' => 'Setores e suas permissões de acesso',
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
            'setores' => $this->core_model->get_all('groups'),
            'acessos_areas' => $this->areas_model->get_all_areas(),
            'excluir' => $area->excluir,
            'adicionar' => $area->adicionar,
            'editar' => $area->editar
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/setores/index');
        $this->load->view('restrita/layout/footer');
    }

    public function editar($setor_id = null)
    {

        $area = areas();

        if ($area->editar) {

            if (!$setor = $this->core_model->get_by_id('groups', array('id' => $setor_id))) {

                $login = [
                    
                    'tipo' => 6,
                    'acao' => 'Tentou editar setor com setor não cadastrado'
                ];

                insert_login($login);

                $this->session->set_flashdata('erro', 'Setor não foi encontrado!');
                $this->redirecionar();
            } else {

                $login = [
                    
                    'tipo' => 1,
                    'acao' => 'Entrou em permisões do setor: '.$setor->name
                ];

                insert_login($login);

                $data = array(
                    'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Selecione as permissões do setor: ' . $setor->name . '</span>',
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
                    'setor' => $this->core_model->get_by_id('groups', array('id' => $setor->id)),
                    'acessos_areas' => $this->areas_model->get_all_areas(array('area_grupo_id' => $setor->id)),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/permissoes/core');
                $this->load->view('restrita/layout/footer');
            }
        } else {
            $this->redirecionar();
        }
    }

    public function permissoes()
    {

        $area = areas();

        $setor_id = (int) $this->input->post('setor_id');

        if(!$setor = $this->core_model->get_by_id('groups', array('id' => $setor_id))){
            $login = [
                
                'tipo' => 6,
                'acao' => 'Tentou acessar permissões sem um formulário',
            ];

            insert_login($login);
            $this->redirecionar();
        }else{

            if ($area->editar) {
            
                $excluir = $this->input->post('excluir');
                $editar = $this->input->post('editar');
                $adicionar = $this->input->post('adicionar');
    
                $this->core_model->delete('areas_acessos', array('area_grupo_id' => $setor->id));
                $areas = $this->input->post('areas');
                if ($areas) {
    
                    $total = 0;
                    foreach ($areas as $area) {
                        $total++;
                    }
                    $msn='';
    
                    for ($i = 0; $i < $total; $i++) {
    
                        if (isset($areas[$i])) {
                            $areas_data = array(
                                'area_grupo_id' => $setor->id,
                                'area_id' => $areas[$i],
                                'permissao' => 1,
                                'excluir' => (isset($excluir[$i]) ? 1 : 0),
                                'editar' => (isset($editar[$i]) ? 1 : 0),
                                'adicionar' => (isset($adicionar[$i]) ? 1 : 0),
                            );
    
                            $this->core_model->insert('areas_acessos', $areas_data);
                            $area_atual = $this->core_model->get_by_id('areas', array('area_id' => $areas[$i]));

                            $msn .= '(' . $area_atual->area_nome. ' - ' . (isset($excluir[$i]) ? ' Excluir ' : '').(isset($editar[$i]) ? ' Editar ' : '').(isset($adicionar[$i]) ? ' Adicionar ' : '').') <br>';
                        }
                    }
    
                    $login = [
                        
                        'tipo' => 3,
                        'acao' => 'Editou permissões de acesso do setor: '.$setor->name.'<br> '.$msn,
                    ];
    
                    insert_login($login);
                }
                $this->redirecionar();
            } else {
    
                $this->redirecionar();
            }

        }
    }

    public function core($setor_id = null)
    {

        $area = areas();

        $setor_id = (int) $setor_id;

        if (!$setor_id) {

            if ($area->adicionar) {

                $this->form_validation->set_rules('name', 'Nome do setor', 'trim|required|min_length[2]|max_length[150]|callback_valida_nome_setor');
                $this->form_validation->set_rules('description', 'Descrição', 'trim|max_length[220]');

                $areas = $this->input->post('areas');
                if (!$areas) {
                    $this->form_validation->set_rules('areas', 'Área', 'trim|required');
                }

                if ($this->form_validation->run()) {

                    $data = elements(
                        array(
                            'name',
                            'description',
                        ),
                        $this->input->post()
                    );


                    $data = html_escape($data);

                    $this->core_model->insert('groups', $data, true);
                    $last_id = $this->core_model->get_by_id('groups', array('id' => $this->session->userdata('last_id')));

                    $areas = $this->input->post('areas');
                    if ($areas) {
                        $total = count($areas);
                        $msn = '';

                        for ($i = 0; $i < $total; $i++) {

                            if ($areas[$i]) {
                                $areas_data = array(
                                    'area_grupo_id' => $last_id->id,
                                    'area_id' => $areas[$i],
                                    'permissao' => 1,
                                    'excluir' => 0,
                                    'editar' => 0,
                                    'adicionar' => 0,
                                );

                                $this->core_model->insert('areas_acessos', $areas_data, true);
                                $area_atual = $this->core_model->get_by_id('areas', array('area_id' => $areas[$i]));
                                $msn .= ' - '.$area_atual->area_nome.'<br>';

                            }
                        }

                        $login = [
                            
                            'tipo' => 2,
                            'acao' => 'Adicionou setor: ' . $last_id->name . ' <br><b>Acessos: </b><br>' .$msn,
                        ];
    
                        insert_login($login);

                        $this->session->set_flashdata('sucesso', 'Setor '.$last_id->name.' criado com sucesso! selecione agora as permissões de acesso.');
                        redirect('restrita/' . $this->router->fetch_class() . '/editar/' . $last_id->id);
                    } else {

                        $this->redirecionar();
                    }
                } else {

                    $login = [
                            
                            'tipo' => 1,
                            'acao' => 'Entrou para adicionar setor',
                        ];
    
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Adicionar novo setor</span>',
                        'areas' => $this->core_model->get_all('areas', array('area_nome !=' => 'Dashboard')),
                        'scripts' => array(
                            'assets/js/setores.js'
                        ),
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/setores/core');
                    $this->load->view('restrita/layout/footer');
                }
            } else {
                $this->redirecionar();
            }
        } else {

            if ($area->editar) {

                if (!$setor = $this->core_model->get_by_id('groups', array('id' => $setor_id))) {

                    $this->session->set_flashdata('erro', 'Setor não foi encontrado!');
                    $this->redirecionar();
                } else {

                    $this->form_validation->set_rules('name', 'Nome do setor', 'trim|required|min_length[2]|max_length[150]|callback_valida_nome_setor');
                    $this->form_validation->set_rules('description', 'Descrição', 'trim|max_length[220]');

                    $areas = $this->input->post('areas');
                    if (!$areas) {
                        $this->form_validation->set_rules('areas', 'Área', 'trim|required');
                    }

                    if ($this->form_validation->run()) {

                        $data = elements(
                            array(
                                'name',
                                'description',
                            ),
                            $this->input->post()
                        );


                        $data = html_escape($data);

                        $this->core_model->update('groups', $data, array('id' => $setor->id));

                        $this->core_model->delete('areas_acessos', array('area_grupo_id' => $setor->id));
                        $areas = $this->input->post('areas');
                        $total = count($areas);

                        $excluir = $this->input->post('excluir');
                        $editar = $this->input->post('editar');
                        $adicionar = $this->input->post('adicionar');
                        $msn='';

                        for ($i = 0; $i < $total; $i++) {

                            if ($areas[$i]) {
                                $areas_data = array(
                                    'area_grupo_id' => $setor->id,
                                    'area_id' => $areas[$i],
                                    'permissao' => 1,
                                    'editar' => (isset($editar[$i]) ? ($editar[$i] ? 1 : 0) : 0),
                                    'excluir' => (isset($excluir[$i]) ? ($excluir[$i] ? 1 : 0) : 0),
                                    'adicionar' => (isset($adicionar[$i]) ? ($adicionar[$i] ? 1 : 0) : 0),
                                );

                                $this->core_model->insert('areas_acessos', $areas_data);
                                $area_atual = $this->core_model->get_by_id('areas', array('area_id' => $areas[$i]));

                                $msn .= ' - '.$area_atual->area_nome.'<br>';
                            }
                        }

                        $login = [
                            
                            'tipo' => 2,
                            'acao' => 'Editou setor: ' . $setor->name . ' <br><b>Acessos: </b><br>' .$msn,
                        ];
    
                        insert_login($login);

                        redirect('restrita/'.$this->router->fetch_class().'/editar/'.$setor->id);

                    } else {

                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar setor: '.$setor->name.'</span>',
                            'setor' => $setor,
                            'scripts' => array(
                                'assets/js/setores.js'
                            ),
                            'areas_acesso' => $this->areas_model->get_all(array('area_grupo_id' => $setor->id, 'permissao' => 1)),
                        );

                        $data['areas'] = $this->areas_model->get_all_restantes($data['areas_acesso']);

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/setores/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }
            } else {
                $this->redirecionar();
            }
        }
    }


    public function valida_nome_setor($name)
    {

        $setor_id = $this->input->post('setor_id');
        $mensagem = mensagem_padrao($name);

        if (!$setor_id) {

            if ($this->core_model->get_by_id('groups', array('name' => $name))) {

                insert_padrao($name);

                $this->form_validation->set_message('valida_nome_setor', $mensagem);
                return false;
            } else {

                return true;
            }
        } else {


            if ($this->core_model->get_by_id('groups', array('name' => $name, 'id !=' => $setor_id))) {

                insert_padrao($name);

                $this->form_validation->set_message('valida_nome_setor', $mensagem);
                return false;
            } else {

                return true;
            }
        }
    }

    public function delete($setor_id = null)
    {

        $area = areas();

        if ($area->excluir) {

            $setor_id = (int) $setor_id;


            if (!$setor_id || !$setor = $this->core_model->get_by_id('groups', array('id' => $setor_id))) {
                
                $login = [
                    
                    'tipo' => 6,
                    'acao' => 'Tentou acessar deletar com setor não cadastrado',
                ];
    
                insert_login($login);
                
                $this->session->set_flashdata('erro', 'Setor não foi encontrado');
                $this->redirecionar();
            }

           

            if($this->core_model->get_all('users', array('grupo_id' => $setor->id))){
                $login = [
                    
                    'tipo' => 6,
                    'acao' => 'Tentou deletar grupo com usuário vinculado',
                ];
    
                insert_login($login);
                
                $this->session->set_flashdata('erro', 'Não possível deletar grupo com usuário vinculado');
                $this->redirecionar();
            }

            $this->core_model->delete('areas_acessos', array('area_grupo_id' => $setor->id));
            $this->core_model->delete('groups', array('id' => $setor->id));

            $login = [
                
                'tipo' => 4,
                'acao' => 'Deletou setor: '.$setor->name,
            ];

            insert_login($login);

           
        } 

        $this->redirecionar();
        
    }
}
