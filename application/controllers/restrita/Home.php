<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }
        
    }

    public function index() {

        // $area = areas();

        $data = array(
            'titulo' => 'Área restrita',
            'styles' => array(
                'assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
                'assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
            ),
            'scripts' => array(
                'assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
                'assets/js/page/widget-data.js',
            ),
            'areas_acesso' => sidebar_sistema($_SESSION['grupo_id']->grupo_id),
            'user' => $this->ion_auth->user()->row(),
        );

    
        
            // $data['setor'] = $data['areas_acesso'][0]->name;
            // $data['artigos'] = $this->artigos_model->get_all($this->session->userdata('user_id'));
            // $data['artigos_publicados'] = $this->core_model->count_all_results('artigos', array('artigo_user_id' => $_SESSION['user_id']));
      
            // $data['artigos_publicados'] = $this->core_model->count_all_results();
            // $data['artigos'] = $this->artigos_model->get_all();
            // $data['total_redatores'] = $this->core_model->count_all_results('users_groups', array('group_id' => 2));
            // $data['redatores'] = $this->ion_auth->users()->result();
            // $data['contas_bloqueadas'] = $this->core_model->count_all_results('users', array('active' => 0));
            // $data['artigos_nao_auditados'] = $this->core_model->count_all_results('artigos', array('artigo_publicado' => 0));
    

      


        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/home/index');
        $this->load->view('restrita/layout/footer');
    }

}
