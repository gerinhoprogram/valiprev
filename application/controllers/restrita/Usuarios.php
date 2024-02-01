<?php

/*
 * Controller responsável por gerenciar os usuários
 */

defined('BASEPATH') or exit('Ação não permitida');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        if(!$area = areas()){
            redirect('restrita');
        }

        $this->load->model('aux_artigos_categoria');
        $this->load->model('categorias_model');

    }

    public function redirecionar(){
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index()
    {

        $login = [
            'tipo' => 1,
            'acao' => 'Entrou em usuários',
        ];

        insert_login($login);

        if(!$area = areas()){
            redirect('restrita');
        }

        $data = array(
            'titulo' => 'Usuários cadastrados',
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
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
            'usuarios' => $this->usuarios_model->get_all()
        );


        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/usuarios/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($usuario_id = null)
    {

        $usuario_id = (int) $usuario_id;

        if (!$usuario = $this->core_model->get_by_id('users', array('id' => $usuario_id))) {

            $this->session->set_flashdata('erro', 'Usuário não foi encontrado');
            $this->redirecionar();
        } else {

            if ($usuario_id == $_SESSION['user_id']) {

                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]|callback_valida_email');
              

                if ($this->form_validation->run()) {

                    $data = elements(
                        array(
                            'first_name',
                            'email',
                            'user_foto',
                        ),
                        $this->input->post()
                    );

                    $id = $usuario->id;

                    if ($this->ion_auth->update($id, $data)) {

                        $login = [
                            
                            'tipo' => 3,
                            'acao' => 'Atualizou perfil',
                            
                            
                        ];
                
                        insert_login($login);

                        $this->session->set_flashdata('sucesso', 'Seu perfil foi atualizado com sucesso!');

                    } else {

                        $this->session->set_flashdata('erro', $this->ion_auth->errors());
                    }

                    redirect('restrita/usuarios/core/' . $usuario->id);
                } else {

                    $login = [
                        
                        'tipo' => 1,
                        'acao' => 'Entrou para editar perfil',
                        
                        
                    ];
            
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-warning"><i class="fas fa-user-edit"></i>&nbsp; Editar seu perfil</span>',
                        'scripts' => array(
                            'assets/mask/jquery.mask.min.js',
                            'assets/mask/custom.js',
                            'assets/js/usuarios.js',
                        ),
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth->get_users_groups($usuario->id)->row(),
                        'grupos' => $this->ion_auth->groups()->result(),
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
                }
            } else {
                $this->redirecionar();
            }
        }
    }

    public function password($usuario_id = null)
    {

        $usuario_id = (int) $usuario_id;

        if (!$usuario_id) {

            $this->session->set_flashdata('erro', 'Usuário não cadastro no sistema!');
            $this->redirecionar();

        } else {

            if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {

                $this->session->set_flashdata('erro', 'Usuário não cadastro no sistema!');
                $this->redirecionar();

            } else {

                if ($usuario->id == $_SESSION['user_id']) {

                    $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[4]|max_length[20]');
                    $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|required|min_length[4]|max_length[20]|matches[password]');

                    if ($this->form_validation->run()) {

                        $data = elements(
                            array(
                                'password',
                            ),
                            $this->input->post()
                        );

                        $id = $usuario->id;

                        if ($this->ion_auth->update($id, $data)) {

                            $login = [
                                'login' => $_SESSION['email'],
                                'tipo' => 3,
                                'acao' => 'Editou senha',
                            ];
                    
                            insert_login($login);

                            $this->session->set_flashdata('sucesso', 'Senha alterada com sucesso!');

                        } else {

                            $login = [
                                'login' => $_SESSION['email'],
                                'tipo' => 6,
                                'acao' => $this->ion_auth->errors(),
                            ];
                    
                            insert_login($login);

                            $this->session->set_flashdata('erro', $this->ion_auth->errors());
                        }

                        $this->redirecionar();
                        // $this->index();

                    } else {

                        $login = [
                            'login' => $_SESSION['email'],
                            'tipo' => 1,
                            'acao' => 'Entrou para editar senha',
                        ];
                
                        insert_login($login);

                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-lock"></i>&nbsp; Alterar sua senha</span>',
                            'usuario' => $usuario
                        );

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/usuarios/senha');
                        $this->load->view('restrita/layout/footer');
                    }

                } else {

                    $this->session->set_flashdata('erro', 'Usuário não cadastro no sistema!');
                    $this->redirecionar();

                }
            }
        }
    }

    public function logs($usuario_id = null)
    {

        $usuario_id = (int) $usuario_id;

        // verifica se usuário existe
        if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {

            $login = [
                
                'tipo' => 1,
                'acao' => 'Entrou em logs'
            ];
    
            insert_login($login);
    
    
            $data = array(
                'titulo' => 'Logs no sistema',
                'style' => array(
                    'assets/bundles/datatables/datatables.min.css', 
                    'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'
                    
                ),
                'scripts' => array( 
                    'assets/bundles/datatables/datatables.min.js', 
                    'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                    'assets/bundles/datatables/export-tables/dataTables.buttons.min.js',
                    'assets/bundles/datatables/export-tables/buttons.flash.min.js',
                    'assets/bundles/datatables/export-tables/jszip.min.js',
                    'assets/bundles/datatables/export-tables/pdfmake.min.js',
                    'assets/bundles/datatables/export-tables/vfs_fonts.js',
                    'assets/bundles/datatables/export-tables/buttons.print.min.js',
                    'assets/bundles/jquery-ui/jquery-ui.min.js',
                    'assets/js/page/datatables.js'
                ),
                'logs' => $this->core_model->get_all('logs', array('log_lixeira'=>1)),
               
            );
    
            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/usuarios/logs');
            $this->load->view('restrita/layout/footer');

        } else {

            $login = [
                
                'tipo' => 1,
                'acao' => 'Entrou em logs de: '.$usuario->first_name
            ];
    
            insert_login($login);
    
    
            $data = array(
                'titulo' => 'Logs do usuário: '.$usuario->first_name,
                'style' => array(
                    'assets/bundles/datatables/datatables.min.css', 
                    'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'
                    
                ),
                'scripts' => array( 
                    'assets/bundles/datatables/datatables.min.js', 
                    'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                    'assets/bundles/datatables/export-tables/dataTables.buttons.min.js',
                    'assets/bundles/datatables/export-tables/buttons.flash.min.js',
                    'assets/bundles/datatables/export-tables/jszip.min.js',
                    'assets/bundles/datatables/export-tables/pdfmake.min.js',
                    'assets/bundles/datatables/export-tables/vfs_fonts.js',
                    'assets/bundles/datatables/export-tables/buttons.print.min.js',
                    'assets/bundles/jquery-ui/jquery-ui.min.js',
                    'assets/js/page/datatables.js'
                ),
                'logs' => $this->core_model->get_all('logs', array('login' => $usuario->email, 'log_lixeira' => 1)),
                'usuario' => $usuario,
            );
    
            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/usuarios/logs');
            $this->load->view('restrita/layout/footer');

        }

        
    }

    public function core_adm($usuario_id = null)
    {

        $area = areas();

        if ($area->editar) {

            $usuario_id = (int) $usuario_id;

            if (!$usuario = $this->core_model->get_by_id('users', array('id' => $usuario_id))) {

                $login = [
                    
                    'tipo' => 5,
                    'acao' => 'Usuário não encontrado',
                    
                    
                ];
        
                insert_login($login);

                $this->session->set_flashdata('erro', 'Usuário não foi encontrado');
                $this->redirecionar();

            } else {

                if ($this->input->post('active') || $this->input->post('grupo_id')) {

                    $data = elements(
                        array(
                            'active',
                            'grupo_id',
                            'setor_id',
                        ),
                        $this->input->post()
                    );

                    $id = $usuario->id;

                    $login = [
                        
                        'tipo' => 3,
                        'acao' => 'Editou usuário: '.$usuario->email,
                        
                        
                    ];
            
                    insert_login($login);

                    $this->core_model->update('users', $data, array('id' => $usuario->id));

                    redirect('restrita/usuarios');

                } else {

                    $login = [
                        
                        'tipo' => 1,
                        'acao' => 'Entrou para editar usuário: '. $usuario->email,
                        
                        
                    ];
            
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-warning"><i class="fas fa-user-edit"></i>&nbsp; Editar usuário: '.$usuario->email.'</span>',
                        'usuario' => $usuario,
                        'grupos' => $this->core_model->get_all('groups'),
                        'setores' => $this->core_model->get_all('setores_empresa'),
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core_adm');
                    $this->load->view('restrita/layout/footer');
                }
            }
        } else {
            redirect('restrita/');
        }
    }

    public function valida_email($email)
    {

        $usuario_id = $this->input->post('usuario_id');

        if (!$usuario_id) {

            if ($this->core_model->get_by_id('users', array('email' => $email))) {

                $this->form_validation->set_message('valida_email', 'Este e-mail já existe');

                return false;
            } else {
                return true;
            }
        } else {

            if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {

                $this->form_validation->set_message('valida_email', 'Este e-mail já existe');

                return false;
            } else {
                return true;
            }
        }
    }

    public function upload_file()
    {

        $config['upload_path'] = './uploads/usuarios/';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
        $config['encrypt_name'] = true;
        $config['max_size'] = 2000; //Max 1M
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('user_foto_file')) {

            $data = array(
                'erro' => 0,
                'foto_enviada' => $this->upload->data(),
                'user_foto' => $this->upload->data('file_name'),
                'mensagem' => 'Foto enviada com sucesso',
            );
        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-white">', '</span>'),
            );
        }

        echo json_encode($data);
    }

    public function delete($usuario_id = NULL)
    {

        $area = areas();

        if ($area->excluir) {
            $usuario_id = (int) $usuario_id;

            if (!$usuario_id || !$usuario = $this->ion_auth->user($usuario_id)->row()) {
                $this->session->set_flashdata('erro', 'Usuário não foi encontrado');
                $this->redirecionar();
            }

            if ($this->ion_auth->delete_user($usuario->id)) {

                $user_foto = $usuario->user_foto;

                $imagem_grande = FCPATH . 'uploads/usuarios/' . $user_foto;

                if (file_exists($imagem_grande)) {
                    unlink($imagem_grande);
                }

                $login = [
                    
                    'tipo' => 4,
                    'acao' => 'Excluiu usuário: '. $usuario->email,
                    
                    
                ];
        
                insert_login($login);


                $this->session->set_flashdata('sucesso', 'Usuário excluído com sucesso!');

            } else {

                $login = [
                    
                    'tipo' => 5,
                    'acao' => $this->ion_auth->errors(),
                    
                    
                ];
        
                insert_login($login);


                $this->session->set_flashdata('erro', $this->ion_auth->errors());
            }
        }


        $this->redirecionar();
    }

    public function artigos($usuario_id = null)
    {

        $usuario_id = (int) $usuario_id;

        $usuario = $this->core_model->get_by_id('users', array('id' => $usuario_id));

        if (!$area = areas()) {
            redirect('restrita');
        }

        $login = [

            'tipo' => 1,
            'acao' => 'Entrou em artigos do usuário: '.$usuario->first_name
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Artigos do: '.$usuario->first_name,
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
            'subcategorias' => $this->aux_artigos_categoria->get_all(),
            'excluir' => $area->excluir,
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'usuario' => $usuario
        );

        $data['artigos'] = $this->artigos_model->get_all($usuario->id);

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/usuarios/artigos');
        $this->load->view('restrita/layout/footer');
    }

    
    public function delete_artigo($artigo_id = null, $usuario_id = null)
    {

        $area = areas();

        if ($area->excluir) {

            $artigo_id = (int) $artigo_id;
            $usuario_id = (int) $usuario_id;

            if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
                $this->session->set_flashdata('erro', 'Artigo não encontrado');
                redirect('restrita/'.$this->router->fetch_class() . '/artigos');
            }

            $fotos_artigo = $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id));

            $this->core_model->delete('artigos', array('artigo_id' => $artigo->artigo_id));
            $this->core_model->delete('artigos_banner_cta', array('aux_artigo_id' => $artigo->artigo_id));
            $this->core_model->delete('aux_categoria_artigos', array('ca_id_artigo' => $artigo->artigo_id));

            if ($fotos_artigo) {

                foreach ($fotos_artigo as $foto) {

                    $foto_grande = FCPATH . 'uploads/artigos/' . $foto->foto_nome;

                    if (file_exists($foto_grande)) {
                        unlink($foto_grande);
                    }
                }
            }
            redirect('restrita/' . $this->router->fetch_class() . '/artigos/'.$usuario_id);
        }

        $this->redirecionar();
    }

    public function situacao($artigo_id = null, $usuario_id = null)
    {

        $area = areas();

        if ($area->editar) {

            $artigo_id = (int) $artigo_id;
            $usuario_id = (int) $usuario_id;

            if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
                $this->session->set_flashdata('erro', 'Artigo não encontrado');
                redirect('restrita/' . $this->router->fetch_class() . '/artigos');
            }

            if ($artigo->artigo_publicado == 1) {

                $login = [

                    'tipo' => 3,
                    'acao' => 'Alterou para inativo o artigo: ' . $artigo->artigo_titulo
                ];
                insert_login($login);

                $data =
                    array(
                        'artigo_publicado' => 0,
                    );
            } else {

                $login = [

                    'tipo' => 3,
                    'acao' => 'Alterou para ativo o artigo: ' . $artigo->artigo_titulo
                ];
                insert_login($login);

                $data =
                    array(
                        'artigo_publicado' => 1,
                    );
            }

            $this->core_model->update('artigos', $data, array('artigo_id' => $artigo->artigo_id));

            redirect('restrita/' . $this->router->fetch_class() . '/artigos/'.$usuario_id);
        }

        $this->redirecionar();
    }

}
