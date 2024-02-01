<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Registrar extends CI_Controller
{

    public function index()
    {

        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]|callback_valida_email');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|matches[password]');

        if ($this->form_validation->run()) {

            $username = $this->input->post('first_name');
            $password = $this->input->post('password');
            $email = $this->input->post('email');

            $additional_data = elements(
                array(
                    'first_name',
                ),
                $this->input->post()
            );

            $additional_data['active'] = 1;
            $additional_data['grupo_id'] = 3;
            $additional_data['user_url'] = url_amigavel($this->input->post('first_name'));

            $group = array('2');

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {

                $login = [
                    'tipo' => 2,
                    'acao' => $username . ' criou a conta: '. $email,
                ];
        
                insert_login($login);

                $this->session->set_flashdata('sucesso', 'Sua conta foi criada com sucesso');
                redirect('restrita/login');

            } else {

                $login = [
                    'tipo' => 5,
                    'acao' => $this->ion_auth->errors(),
                ];
        
                insert_login($login);

                $this->session->set_flashdata('erro', $this->ion_auth->errors());
                redirect($this->router->fetch_class());
                
            }
        } else {

            $login = [
                'tipo' => 1,
                'acao' => 'Entrou em registrar',
            ];
    
            insert_login($login);

            $data = array(
                'titulo' => 'Registrar conta',
                'styles' => array('assets/css/registrar.css'),
                'scripts' => array(
                    'assets/js/validacoes_registrar.js',
                ),
            );

            $this->load->view('web/layout/header', $data);
            $this->load->view('web/registrar/index');
            $this->load->view('web/layout/footer_registrar');
        }
    }

    public function url_amigavel($string = NULL)
    {
        $string = remove_acentos($string);
        return url_title($string, '-', TRUE);
    }

    public function remove_acentos($string = NULL)
    {
        $procurar = array('À', 'Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Õ', 'Ô', 'Ú', 'Ü', 'Ç', 'à', 'á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'õ', 'ô', 'ú', 'ü', 'ç');
        $substituir = array('a', 'a', 'a', 'a', 'e', 'r', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c');
        return str_replace($procurar, $substituir, $string);
    }


    public function valida_email($email)
    {


        $usuario_id = $this->input->post('usuario_id');


        if (!$usuario_id) {

            /*
             * Cadastrando
             */

            if ($this->core_model->get_by_id('users', array('email' => $email))) {

                $this->form_validation->set_message('valida_email', 'Este e-mail já existe');

                return false;
            } else {
                return true;
            }
        } else {

            /*
             * Editando
             */

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

        /*
         * Carregando a bibliote 'upload' pasando como parâmetro o $config
         */
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('user_foto_file')) {

            $data = array(
                'erro' => 0,
                'foto_enviada' => $this->upload->data(),
                'user_foto' => $this->upload->data('file_name'),
                'mensagem' => 'Foto foi enviada com sucesso',
            );
        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-white">', '</span>'),
            );
        }

        echo json_encode($data);
    }
}
