<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Carousel extends CI_Controller {

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
            'titulo' => 'Banners para o carousel no topo do site',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css',
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js',
                'assets/js/carousel.js'
            ),
            'banners' => $this->core_model->get_all('banners_carousel'),
            'excluir' => $area->excluir,
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1))
        );


        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/carousel/index');
        $this->load->view('restrita/layout/footer');
    }

    public function ativar(){

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $ativar = $this->input->post('valor');

        $data = $this->core_model->update_ajax('sistema', array('carousel' => $ativar), array('sistema_id' => 1));

        // print_r($data);

        echo json_encode($data);
    }

    public function editar($carousel_id = null) {

        $area = areas();

        if($area->editar){

            $carousel_id = (int) $carousel_id;

            if (!$carousel_id || !$banner = $this->core_model->get_by_id('banners_carousel', array('carousel_id' => $carousel_id))) {
                $this->session->set_flashdata('erro', 'Banner não encontrado');
                redirect('restrita/' . $this->router->fetch_class());
            } else {

            $this->form_validation->set_rules('titulo', 'Título', 'trim|max_length[240]');
            $this->form_validation->set_rules('link', 'Link', 'trim|max_length[240]');
            $this->form_validation->set_rules('texto', 'Texto', 'trim|max_length[240]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'titulo',
                            'link',
                            'texto',
                            'ativo'
                        ), $this->input->post()
                );

                $data['banner'] = $this->input->post('banner_foto_troca');

                $this->core_model->update('banners_carousel', $data, array('carousel_id' => $banner->carousel_id));

                redirect('restrita/' . $this->router->fetch_class());

            } else {

                $data = array(
                    'titulo' => 'Editar Banner',
                    'scripts' => array(
                        'assets/js/carousel.js'
                    ),
                    'banner' => $this->core_model->get_by_id('banners_carousel', array('carousel_id' => $carousel_id)),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/carousel/editar');
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

            $editando = $this->input->post('editando');

            $validacao = false;
            if($editando){
                $validacao = true;
            }

            if ($validacao) {

                $data = elements(
                        array(
                            'titulo',
                            'link',
                            'texto',
                        ), $this->input->post()
                );

                $cta_id = $this->core_model->get_all_carousel_id('banners_carousel');

                foreach($cta_id as $cta){

                    $data3  = array(
                        'carousel_id' => $cta->carousel_id,
                    );

                    $this->core_model->delete('banners_carousel', $data3);
                }

                $cta_imagem = $this->input->post('banner');
                $fotos_principal = $this->input->post('foto_principal');
                $ativo = $this->input->post('ativo');

                $total_fotos = count($cta_imagem);

                for ($i = 0; $i < $total_fotos; $i++) {

                    $data2 = array(
                        'link' => $data['link'][$i],
                        'titulo' => $data['titulo'][$i],
                        'texto' => $data['texto'][$i],
                        'principal' => ($cta_imagem[$i] == $fotos_principal ? 1 : 0),
                        'banner' => $cta_imagem[$i],
                        'ativo' => ($ativo[$i] ? 1 : 0),
                    );

                    $this->core_model->insert('banners_carousel', $data2);
                }

                redirect('restrita/' . $this->router->fetch_class());

            } else {

                $data = array(
                    'titulo' => 'Editar, cadastras, excluir banners',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                        'assets/jquery-upload-file/js/carousel.js',
                    ),
                    'banners' => $this->core_model->get_all('banners_carousel'),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/carousel/core');
                $this->load->view('restrita/layout/footer');
            }

        }else{
            redirect('restrita/' . $this->router->fetch_class());
        }
    }

    public function upload() {

        $mensagem_upload = "No máximo 3000 x 3000 pixels";

        $this->session->set_userdata('mensagem_upload', $mensagem_upload);

        $config['upload_path'] = './uploads/sistema/carousel/';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG|gif';
        $config['encrypt_name'] = true;
        $config['max_size'] = 4000; //Max 2M
        $config['max_width'] = 2500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_banner')) {

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

    public function delete($carousel_id = null) {

        $area = areas();

        if($area->excluir){
            $carousel_id = (int) $carousel_id;

            if (!$carousel_id || !$banner = $this->core_model->get_by_id('banners_carousel', array('carousel_id' => $carousel_id))) {
                $this->session->set_flashdata('erro', 'Banner não foi encontrado');
                redirect('restrita/' . $this->router->fetch_class());
            }
    
            $this->core_model->delete('banners_carousel', array('carousel_id' => $banner->carousel_id));
    
            $foto_grande = FCPATH . 'uploads/sistema/carousel/' . $banner->banner;
    
            if (file_exists($foto_grande)) {
                unlink($foto_grande);
            }
        
        }

        redirect('restrita/' . $this->router->fetch_class());

    }

}
