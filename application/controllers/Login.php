<?php

/*
 * Controller responsável pela Login na área web
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index() {

        $data = array(
            'titulo' => 'Login na área do anunciante',
        );
        $data['sistema'] = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/login/index');
        $this->load->view('web/layout/footer');
    }

    public function auth() {


        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember' ? TRUE : FALSE));


        if ($this->ion_auth->login($identity, $password, $remember)) {

            /*
             * Só permitiremos que um administrador faça login na área restrita
             */
            if ($this->ion_auth->is_admin()) {
                redirect('restrita');
            } else {

                /*
                 * Redirecionamos o anunciante para a div #pergunta na view index de detalhes
                 */
                if ($this->session->userdata('url_anterior')) {
                    redirect($this->session->userdata('url_anterior') . '#pergunta');
                }


                redirect('/');
            }
        } else {

            /*
             * Erro de login
             */
            $this->session->set_flashdata('erro', 'Verifique suas ceredenciais de acesso');
            redirect($this->router->fetch_class());
        }
    }

    public function logout() {

        $this->ion_auth->logout();
        redirect($this->router->fetch_class());
    }

    

}
