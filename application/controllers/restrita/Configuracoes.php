<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Configuracoes extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        $this->load->model('core_model');
    }

    public function index(){

            $this->form_validation->set_rules('con_sidebar_cor', 'Cor fundo', 'trim|required');
            $this->form_validation->set_rules('con_sidebar_cor_fonte', 'Cor fonte', 'trim|required');
            $this->form_validation->set_rules('con_sidebar_cor_hover', 'Mouse hover', 'trim|required');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'con_sidebar_cor_hover',
                        'con_sidebar_cor_fonte',
                        'con_sidebar_cor',
                        'con_sidebar_padrao',                 
                    ), $this->input->post()
                );

                if($this->input->post('con_sidebar_padrão')){
                    $data['con_sidebar_cor_hover'] = 1;
                    $data['con_sidebar_cor_fonte'] = 1;
                    $data['con_sidebar_cor'] = 1;
                    $data['con_sidebar_padrao'] = 1;

                }

                //limpa codigo js dos inputs
                //precisa colocar como TRUE em config.php $config['global_xss_filtering'] = TRUE;
                $data = html_escape($data);

                //atualiza na tabela sistema com id igual a 1
                $this->core_model->update('configuracoes', $data, array('con_id' => 1));

                redirect('restrita/' . $this->router->fetch_class());

                }else{

                    $data = array(
                        'titulo' => 'Configurações do sistema',
                        'sistema' => $this->core_model->get_by_id('configuracoes', array('con_id' => 1)),
                        'scripts' => array(
                            'assets/js/configuracoes.js'
                        ),
                    );

                    // echo"<pre>";
                    // print_r($data);
                    // exit;

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/configuracoes/index');
                    $this->load->view('restrita/layout/footer');

                }

            
        }

}
