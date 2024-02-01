<?php

/*
 * Controller responsável por gerenciar categorias filhas
 */

defined('BASEPATH') OR exit('Ação não permitida');

class Icones extends CI_Controller {

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
            'titulo' => 'Ícones cadastrados',
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
            'icones' => $this->core_model->get_all('icones'),
            'excluir' => $area->excluir,
            'adicionar' => $area->adicionar,
            'editar' => $area->editar,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/icones/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core() {

            $icones = $this->input->post('icone_foto');
		
//		echo"<pre>";
//		print_r($this->input->post());
//		exit;

            $validacao = false;
            if($icones){
                $validacao = true;
                foreach ($icones as $icone) {
                    if(!$icone){
                        $validacao = false;
                        $this->session->set_flashdata('erro', 'Imagem do ícone é obrigatório.');
                    }
                }
            }

            if ($validacao) {

                $data = elements(
                        array(
                            'icone_nome',
                        ), $this->input->post()
                );
				
				$icones = $this->input->post('icone_foto');

                $total_fotos = count($icones);

                for ($i = 0; $i < $total_fotos; $i++) {

                    $data2 = array(
                        'icone_nome' => $data['icone_nome'][$i],
                        'icone_imagem' => $icones[$i],
                    );

                    
                    $this->core_model->insert('icones', $data2);
                }


                redirect('restrita/' . $this->router->fetch_class());

            } else {

                $data = array(
                    'titulo' => 'Inserir ícones',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                        'assets/jquery-upload-file/js/icones.js',
                    ),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/icones/core');
                $this->load->view('restrita/layout/footer');
            }
    }


    public function upload() {

        $config['upload_path'] = './uploads/icones/';
        $config['allowed_types'] = 'png|PNG|svg|SVG';
        $config['encrypt_name'] = true;
        $config['max_size'] = 500; //Max 2M
        $config['max_width'] = 200;
        $config['max_height'] = 200;

        /*
         * Carregando a bibliote 'upload' pasando como parâmetro o $config
         */
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('icones')) {

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'icone_nome' => $this->upload->data('file_name'),
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



    public function delete($icone_id = null) {

        $icone_id = (int) $icone_id;

        if (!$icone_id || !$icone = $this->core_model->get_by_id('icones', array('icone_id' => $icone_id))) {
            $this->session->set_flashdata('erro', 'Ícone não foi encontrado');
            redirect('restrita/' . $this->router->fetch_class());
        }


        $this->core_model->delete('icones', array('icone_id' => $icone->icone_id));

        $foto_grande = FCPATH . 'uploads/icones/' . $icone->icone_imagem;

        if (file_exists($foto_grande)) {
            unlink($foto_grande);
        }
        
        redirect('restrita/' . $this->router->fetch_class());
    }

}
