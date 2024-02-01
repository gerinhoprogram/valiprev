<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

    public function __construct(){
        parent:: __construct();

        if (!$this->ion_auth->logged_in())
        {
          redirect('restrita/login');
        }

        if(!$area = areas()){
            redirect('restrita');
        }

    }

	public function index()
	{
        $area = areas();

        
        $this->form_validation->set_rules('sistema_site_titulo', 'Título web site', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('sistema_descricao', 'Descrição', 'trim');
        $this->form_validation->set_rules('sistema_palavras_seo', 'SEO', 'trim');

        $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone', 'trim|exact_length[14]');
        $this->form_validation->set_rules('sistema_telefone_movel', 'Whatsap', 'trim|min_length[14]|max_length[15]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|valid_email|max_length[100]');

        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_estado', 'Estado', 'trim|exact_length[2]');
        $this->form_validation->set_rules('sistema_bairro', 'Bairro', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|exact_length[9]');
        $this->form_validation->set_rules('sistema_numero', 'Número', 'trim|max_length[10]');
        $this->form_validation->set_rules('sistema_link_site', 'Site', 'trim|max_length[255]');
        
        $this->form_validation->set_rules('sistema_facebook', 'Facebook', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_linkedin', 'Linkedin', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_instagram', 'Instagram', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_you_tube', 'YouTube', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_behance', 'Behance', 'trim|max_length[255]');

        $this->form_validation->set_rules('logo_foto_troca', 'Logo', 'trim');
        $this->form_validation->set_rules('logo_foto_troca_2', 'Logo', 'trim');
        $this->form_validation->set_rules('icon_foto_troca', 'Ícone', 'trim');
        $this->form_validation->set_rules('gif_foto_troca', 'Gif animado', 'trim');

        if($this->form_validation->run()){
               
            if($area->editar){
                        $data = elements(
                            array(
                                'sistema_site_titulo',
                                'sistema_palavras_seo',

                                'sistema_telefone_fixo',
                                'sistema_telefone_movel',
                                'sistema_email',
                                
                                'sistema_endereco',
                                'sistema_estado',
                                'sistema_numero',
                                'sistema_cidade',
                                'sistema_bairro',
                                'sistema_cep',
                                'sistema_link_site',

                                'sistema_instagram',
                                'sistema_linkedin',
                                'sistema_facebook',
                                'sistema_you_tube',
                                
                            ), $this->input->post()
                        ); 

                        $data = html_escape($data);

                        $data['sistema_logo'] = $this->input->post('logo_foto_troca');
                        $data['sistema_logo_2'] = $this->input->post('logo_foto_troca_2');
                        $data['sistema_icon'] = $this->input->post('icon_foto_troca');
                        $data['sistema_gif'] = $this->input->post('gif_foto_troca');
                        $data['sistema_descricao'] = html_escape($this->input->post('sistema_descricao', FALSE));

                        $log_query = $this->core_model->update('sistema', $data, array('sistema_id' => 1));

                        $login = [
                            
                            'tipo' => 3,
                            'acao' => 'Atualizou informações do blog',
                            'log_query' => $log_query
                        ];
            
                        insert_login($login);

                        redirect('restrita/'.$this->router->fetch_class());
                }else{
                    redirect('restrita/'.$this->router->fetch_class());
                }

        }else{

            $login = [
                            
                'tipo' => 1,
                'acao' => 'Entrou em informações do blog',
            ];

            insert_login($login);

            $area = areas();

            /**
             * <script src="assets/bundles/chocolat/dist/js/jquery.chocolat.min.js"></script>
            * <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
            *<link rel="stylesheet" href="assets/bundles/chocolat/dist/css/chocolat.css">
             *  */ 


            $data = array(
                'titulo' => 'Informações do Blog',
                
                'scripts' => array( 
                    'assets/bundles/chocolat/dist/js/jquery.chocolat.min.js',
                    'assets/bundles/jquery-ui/jquery-ui.min.js',
                    'assets/mask/jquery.mask.min.js', 
                    'assets/mask/custom.js',
                    'assets/js/sistema.js',
                ),
                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
                'editar' => $area->editar,
                'banners' => $this->core_model->get_all('banners_site'),
                'artigos' => $this->core_model->get_all('artigos', array('artigo_publicado' => 1))
            );
    
            $this->load->view('restrita/layout/header');
            $this->load->view('restrita/sistema/index', $data);
            $this->load->view('restrita/layout/footer');

        }
		
	}

    public function trocar_banner(){

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $banner_id = $this->input->post('valor');

        $antigo = $this->core_model->get_all('banners_site', array('banner_status' => 1));

        $cont=0;
        foreach($antigo as $ant){
            $cont++;
        }

        for($i=0;$i<$cont;$i++){

            $antigos = array(
                'banner_status' => 0,
            );

            $this->core_model->update_ajax('banners_site', $antigos, array('banner_id' => $antigo[$i]->banner_id));

        }
       

        $data = $this->core_model->update_ajax('banners_site', array('banner_status' => 1), array('banner_id' => $banner_id));

        // print_r($data);

        echo json_encode($data);
    }

    public function artigo_destaque(){

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $artigo_id = $this->input->post('valor');

        $antigo = $this->core_model->get_all('artigos', array('artigo_destaque' => 1));

        $cont=0;
        foreach($antigo as $ant){
            $cont++;
        }

        for($i=0;$i<$cont;$i++){

            $antigos = array(
                'artigo_destaque' => 0,
            );

            $this->core_model->update_ajax('artigos', $antigos, array('artigo_id' => $antigo[$i]->artigo_id));

        }
       

        $data = $this->core_model->update_ajax('artigos', array('artigo_destaque' => 1), array('artigo_id' => $artigo_id));

        // print_r($data);

        echo json_encode($data);
    }

    public function layout_config(){

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $valor = $this->input->post('valor');

            $nova_config = array(
                'email_ativacao' => $valor,
            );

        $data = $this->core_model->update_ajax('users', $nova_config, array('id' => $_SESSION['user_id']));

       
        // print_r($data);

        echo json_encode($data);
    }

    public function upload_logo(){

        $config['upload_path']          = './uploads/sistema/logo';
        $config['allowed_types']        = 'jpg|png|PNG|JPG|WEBP|webp';
        $config['encrypt_name']             = true;
        $config['max_size']             = 3000;
        $config['max_width']            = 1950;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_logo')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'logo_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Logo enviado com sucesso!'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }

    public function upload_logo_2(){

        $config['upload_path']          = './uploads/sistema/logo';
        $config['allowed_types']        = 'jpg|png|PNG|JPG|WEBP|webp';
        $config['encrypt_name']             = true;
        $config['max_size']             = 3000;
        $config['max_width']            = 1950;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_logo_2')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'logo_foto_troca_2' => $this->upload->data('file_name'),
                'mensagem' => 'Logo enviado com sucesso!'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }

    public function upload_icon(){

        $config['upload_path']          = './uploads/sistema/icone';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 100;
        $config['max_width']            = 150;
        $config['max_height']           = 150;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_icon')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'icon_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Ícone enviado com sucesso!'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }

    public function upload_gif(){

        $config['upload_path']          = './uploads/sistema/gif';
        $config['allowed_types']        = 'GIF|PNG|png|gif';
        $config['encrypt_name']             = true;
        $config['max_size']             = 3000;
        $config['max_width']            = 1950;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_gif')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'gif_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Gif enviado com sucesso!'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }

    
}