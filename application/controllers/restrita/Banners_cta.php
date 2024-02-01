<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Banners_cta extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        if(!$area = areas()){
            redirect('restrita');
        }

    }

    public function index() {

        $area = areas();

        $data = array(
            'titulo' => 'Banners CTA cadastrados',
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
            'banners' => $this->core_model->get_all('banners_cta'),
            'excluir' => $area->excluir,
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/banners/index');
        $this->load->view('restrita/layout/footer');
    }

    public function editar($cta_id = null) {

        $area = areas();

        if($area->editar){

            $cta_id = (int) $cta_id;

            if (!$cta_id || !$cta = $this->core_model->get_by_id('banners_cta', array('cta_id' => $cta_id))) {
                $this->session->set_flashdata('erro', 'Banner não encontrado');
                redirect('restrita/' . $this->router->fetch_class());
            } else {

            $this->form_validation->set_rules('cta_titulo', 'Título', 'trim|required|max_length[240]');
            $this->form_validation->set_rules('cta_url', 'URL', 'trim');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'cta_titulo',
                            'cta_url',
                        ), $this->input->post()
                );

                $data['cta_imagem'] = $this->input->post('cta_foto_troca');

                $this->core_model->update('banners_cta', $data, array('cta_id' => $cta->cta_id));

                redirect('restrita/' . $this->router->fetch_class());

            } else {

                $data = array(
                    'titulo' => 'Editar Banners CTA',
                    'scripts' => array(
                        'assets/js/banners.js'
                    ),
                    'banner' => $this->core_model->get_by_id('banners_cta', array('cta_id' => $cta_id)),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/banners/editar');
                $this->load->view('restrita/layout/footer');
            }
        }

        }else{
            redirect('restrita/' . $this->router->fetch_class());
        }
        
    }

    public function core() {

        $area = areas();

        if($area->editar){

            $cta_imagem = $this->input->post('cta_imagem');
            $ctas = $this->input->post('cta_titulo');

            $validacao = false;
            if($ctas){
                $validacao = true;
                foreach ($ctas as $cta) {
                    if(!$cta){
                        $validacao = false;
                        $this->session->set_flashdata('erro', 'Título do bannner é obrigatório.');
                    }
                }
            }

            if ($validacao) {

                $data = elements(
                        array(
                            'cta_titulo',
                            'cta_url',
                            'cta_imagem',
                            'cta_id',
                            'cta_codigo'
                        ), $this->input->post()
                );

                $cta_id = $this->core_model->get_all_id('banners_cta');

                foreach($cta_id as $cta){

                    $data3  = array(
                        'cta_id' => $cta->cta_id,
                    );

                    $this->core_model->delete('banners_cta', $data3);
                }

                $cta_imagem = $this->input->post('cta_imagem');

                $total_fotos = count($cta_imagem);

                for ($i = 0; $i < $total_fotos; $i++) {

                    $data2 = array(
                        'cta_url' => $data['cta_url'][$i],
                        'cta_titulo' => $data['cta_titulo'][$i],
                        'cta_imagem' => $cta_imagem[$i],
                    );

                    if($data['cta_codigo'][$i]){
                        $data2['cta_codigo'] = $data['cta_codigo'][$i];
                        
                    }else{
                        $cta_codigo = $this->core_model->generate_unique_code('banners_cta', 'numeric', 4, 'cta_codigo');
                        $data2['cta_codigo'] =  $cta_codigo;
                    }
                    
                    $this->core_model->insert('banners_cta', $data2);
                }

                redirect('restrita/' . $this->router->fetch_class());

            } else {

                $data = array(
                    'titulo' => 'Gerenciar Banners CTA em lote',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                        'assets/jquery-upload-file/js/banners.js',
                    ),
                    'banners' => $this->core_model->get_all('banners_cta'),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/banners/core');
                $this->load->view('restrita/layout/footer');
            }

        }else{
            redirect('restrita/' . $this->router->fetch_class());
        }
    }

    public function upload() {

        $mensagem_upload = "No máximo 3000 x 3000 pixels";

        $this->session->set_userdata('mensagem_upload', $mensagem_upload);

        $config['upload_path'] = './uploads/banners_cta/';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
        $config['encrypt_name'] = true;
        $config['max_size'] = 4000; //Max 2M
        $config['max_width'] = 3000;
        $config['max_height'] = 3000;

        /*
         * Carregando a bibliote 'upload' pasando como parâmetro o $config
         */
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_cta')) {

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'foto_nome' => $this->upload->data('file_name'),
                'mensagem' => 'Foto foi enviada com sucesso',
            );

        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);
    }

    public function view(){
        $data = array(
            'titulo' => 'Banners CTA cadastrados',
            'styles' => array(
                'assets/bundles/lightgallery/dist/css/lightgallery.css',
            ),
            'scripts' => array(
                'assets/bundles/lightgallery/dist/js/lightgallery-all.js',
                'assets/js/page/light-gallery.js',
            ),
            'banners' => $this->core_model->get_all('banners_cta'),
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/banners/view');
        $this->load->view('restrita/layout/footer');
    }

    public function delete($cta_id = null) {

        $area = areas();

        if($area->excluir){
            $cta_id = (int) $cta_id;

            if (!$cta_id || !$cta = $this->core_model->get_by_id('banners_cta', array('cta_id' => $cta_id))) {
                $this->session->set_flashdata('erro', 'Banner CTA não foi encontrado');
                redirect('restrita/' . $this->router->fetch_class());
            }
    
            $this->core_model->delete('artigos_banner_cta', array('aux_cta_codigo' => $cta->cta_codigo));
    
            $this->core_model->delete('banners_cta', array('cta_id' => $cta->cta_id));
    
            $foto_grande = FCPATH . 'uploads/banners_cta/' . $cta->cta_imagem;
    
            if (file_exists($foto_grande)) {
                unlink($foto_grande);
            }
        
        }

        redirect('restrita/' . $this->router->fetch_class());

        
    }

}
