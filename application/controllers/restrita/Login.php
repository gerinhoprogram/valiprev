<?php

defined('BASEPATH') or exit('Ação não permitida');

/*
1 - ver
2 - cadastrar
3 - editar
4 - excluir
5 - info
6 - erro de acesso
*/

class Login extends CI_Controller
{

    public function index()
    {
    
        $login = [
            'login' => 'Anônimo',
            'tipo' => 1,
            'acao' => 'Entrou na tela de login'
        ];

        insert_login($login);



        $data = array(
            'titulo' => 'Login na área restrita',
            'sistema' => info_header_footer(),
        );
        $data['sistema'] = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/login/index');
        $this->load->view('restrita/layout/footer');
    }

    public function erro_email($token = null)
    {

        $token = $token;

        if (!$token) {
            $token = $this->input->post('token');
        }

        if($usuario = $this->core_model->get_by_id('users', array('token' => $token))){

            $data_token['token'] = null;
            $data_token['token_expira_em'] = null;

            $this->core_model->update_token('users', $data_token, array('id' => $usuario->id));

            $login = [
                'login' => 'Anônimo',
                'tipo' => 5,
                'acao' => 'Erro ao enviar e-mail para recuperação de login'
            ];
    
            insert_login($login);
    
            $this->session->set_flashdata('erro', 'Erro ao enviar e-mail');
    
            $data = array(
                'titulo' => 'Login na área restrita',
                'sistema' => info_header_footer(),
            );
            $data['sistema'] = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
    
            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/login/index');
            $this->load->view('restrita/layout/footer');

        }else{
            $this->redirecionar();
        }

    
    }


    
    public function redirecionar()
    {
        redirect('restrita/' . $this->router->fetch_class());
        // $this->index();
    }


    public function auth()
    {

        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember' ? TRUE : FALSE));

        if ($this->ion_auth->is_max_login_attempts_exceeded($identity)) {
            $login = [
                'login' => $identity,
                'tipo' => 6,
                'acao' => 'Ultrapassou limite de tentativas de login'
            ];

            insert_login($login);

            $this->session->set_flashdata('erro', 'Você ultrapassou o número de tentativas de login! Aguarde 10 minutos.');
            $this->redirecionar();
        }


        if ($this->ion_auth->login($identity, $password, $remember)) {

            $_SESSION['grupo_id'] = $this->usuarios_model->get_all_group($_SESSION['user_id']);
            $_SESSION['ip_usuario'] = get_client_ip();
            $_SESSION['login'] = $identity;

            $usuario = $this->core_model->get_by_id('users', array('id' => $_SESSION['user_id']));

            $login = [
                'tipo' => 5,
                'acao' => 'Acessou o sistema'
            ];

            insert_login($login);

            $this->session->set_flashdata('sucesso', 'Bem-vindo (a), ' . $usuario->first_name);
            redirect('restrita');

        } else {

            $login = [
                'login' => $identity,
                'tipo' => 6,
                'acao' => 'Tentativa errada de senha ou e-mail'
            ];

            insert_login($login);

            $this->session->set_flashdata('erro', 'Verifique suas ceredenciais de acesso');
            $this->redirecionar();
        }
    }


    /**
     * Logout do sistema
     */
    public function logout()
    {

        if (isset($_SESSION['login'])) {
            $login = [
                'tipo' => 5,
                'acao' => 'Saiu do sistema'
            ];
            insert_login($login);
        }

        $this->ion_auth->logout();
        $this->redirecionar();
    }


    public function redirecionar_parametro($parametro = null)
    {
        redirect('restrita/' . $this->router->fetch_class().'/'.$parametro);

    }

    
    /**
     * 1° passo para recuperar senha
     */
    public function recupera_login(){

        $login = [
            'tipo' => 1,
            'acao' => 'Acessou primeiro passo para recuperar senha'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Recupera senha.',
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/login/recupera_login');
        $this->load->view('restrita/layout/footer');

    }

    /**
     * 2° passo para recuperação de senha
     * verifia se o email enviado exite e se o usuário esta ativo
     * com tudo certo, será enviado um e-mail para o mesmo
     */
    public function envia_recupera_login(){

            $email = $this->input->post('email');

            if(isset($email) && $usuario = $this->core_model->get_by_id('users', array('email' => $email))){
                
                if($usuario->active){

                    /**
                     * Validação de dados
                     */
                    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]');
                    
                    if ($this->form_validation->run()) {

                            token($usuario->email);

                            /*
                            * Trecho de código para envio de e-mail do framework
                            */

                            // $retorno = envia_email_framework("Recupera login", "Olá, $usuario->nome. Acesse esse link para criar uma nova senha, <a href='".base_url('restrita/login/cria_novo_login/').$usuario->tpken."'>clique aqui para gerar sua senha.</a>", $usuario->email);

                            // if($retorno){

                            //     // e-mail enviado

                            //     $login = [
                            //         'tipo' => 1,
                            //         'acao' => 'Acessou tela recupera login com e-mail enviado'
                            //     ];
                
                            //     insert_login($login);

                            //     $this->redirecionar_parametro('recupera_login_enviado');

                            // }else{

                            //     //e-mail não enviado

                            //     $this->redirecionar_parametro('recupera_login');
                            // }

                            // fim do envio de e-mail


                            // apagar quando o envio de e-mail for pelo framework
                            // envio pelo PHP mailer
                            enviar('recupera_login', $usuario->id);
                            // ---

                            } else {

                                $login = [
                            
                                    'tipo' => 6,
                                    'acao' => 'Enviou recupera login com e-mail que não existe'
                                ];
                        
                                insert_login($login);
                    
                                $this->session->set_flashdata('erro', 'E-mail não cadastro no sistema!');
                                $this->redirecionar_parametro('recupera_login');
                                
                            }

                }else{

                        $login = [
                    
                            'tipo' => 6,
                            'acao' => 'Usuário inativo tentou recuperar senha'
                        ];
                
                        insert_login($login);
            
                        $this->session->set_flashdata('erro', 'E-mail não cadastro no sistema ou usuário intativo!');
                        $this->redirecionar_parametro('recupera_login');

                }

            }else{

                $login = [
                
                    'tipo' => 6,
                    'acao' => 'Enviou recupera login com e-mail que não existe'
                ];
        
                insert_login($login);
    
                $this->session->set_flashdata('erro', 'E-mail não cadastro no sistema!');
                $this->redirecionar_parametro('recupera_login');

            }
    }

    /**
     * 3° passo para recuperar senha
     * o usário recebe um link para criar uma nova senha
     */
    public function cria_novo_login($token = null){

        $token = $token;

        if (!$token) {
            $token = $this->input->post('token');
        }

        /**
         * verifica se token existe
         */
        if(!$token){
            $login = [
                'tipo' => 6,
                'acao' => 'Tentou acessar tela de recuperação de login sem token'
            ];

            insert_login($login);
            redirect('restrita/login');
        }

        /**
         * Existindo token, verifica se o mesmo é igual ao do banco de dados
         */
        if (!$usuario = $this->core_model->get_by_id('users', array('token' => $token))) {

            $login = [
                'tipo' => 6,
                'acao' => 'Tentou acessar tela de primeiro acesso com token inválido'
            ];

            insert_login($login);
            redirect('restrita/login');
        } 

        /**
         * verifica se o tempo limite do token foi ultrapassado
         */
        if($usuario->token_expira_em >= date('Y-m-d H:i:s')){

            /**
             * Validação de dados
             */
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|max_length[150]');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[4]|max_length[15]');
            $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|required|min_length[4]|max_length[15]|matches[password]');

            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'password',
                    ),
                    $this->input->post()
                );

                $data['token'] = null;
                $data['token_expira_em'] = null;
                $id = $usuario->id;

                if ($this->ion_auth->update($id, $data)) {

                    $login = [
                        'login' => $usuario->email,
                        'tipo' => 3,
                        'acao' => 'Alterou a senha em recuperação de senha'
                    ];

                    insert_login($login);

                    $this->session->set_flashdata('sucesso', 'Senha atualizada com sucesso!');

                    redirect('restrita/login');

                } else {

                    $login = [
                        'login' => $usuario->email,
                        'tipo' => 6,
                        'acao' => 'Erro ao alterar senha de primeiro acesso'
                    ];

                    insert_login($login);

                    $this->session->set_flashdata('erro', $this->ion_auth->errors());
                    $this->redirecionar();
                }
            } else {

                $login = [
                    'login' => $usuario->email,
                    'tipo' => 1,
                    'acao' => 'Acessou tela de recuperação de senha enviada por e-mail'
                ];

                insert_login($login);

                $data = array(
                    'titulo' => 'Recuperação de senha',
                    'usuario' => $usuario,
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/login/cria_novo_login');
                $this->load->view('restrita/layout/footer');
            }
            
        }else{
            $login = [
                'login' => 'Anônimo',
                'tipo' => 6,
                'acao' => 'Tempo limite de token ultrapassado'
            ];

            insert_login($login);
            redirect('restrita/login');
        }

    }

    /**
     * tela de mensagem e-mail de recuperação de senha enviado
     */
    public function recupera_login_enviado($token = null){

        $token = $token;

        if (!$token) {
            $token = $this->input->post('token');
        }

        /**
         * verifica se token existe
         */
        if(!$token){
            $login = [
                'tipo' => 6,
                'acao' => 'Tentou acessar tela de recuperação de login sem token'
            ];

            insert_login($login);
            redirect('restrita/login');
        }

        /**
         * Existindo token, verifica se o mesmo é igual ao do banco de dados
         */
        if (!$usuario = $this->core_model->get_by_id('users', array('token' => $token))) {
            
            $login = [
                'tipo' => 6,
                'acao' => 'Token inválido ou diferente ao da base de dados'
            ];
    
            insert_login($login);

            $this->redirecionar();

        }else{

            $login = [
                'tipo' => 1,
                'acao' => 'Acessou tela de mensagem envio de recuperação de senha'
            ];
    
            insert_login($login);
    
            $data = array(
                'usuario' => $usuario

            );
    
            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/login/recupera_login_enviado');
            $this->load->view('restrita/layout/footer');

        }

    }

}
