<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Busca extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('aux_artigos_categoria');

    }

    public function index() {

        $busca = $this->input->post('busca');

        $artigos = $this->artigos_model->get_all_by_busca($busca);

        // print_r($artigos);
        // echo"<br><br>";
        // exit($busca);


        $data = array(
                    'titulo' => 'Resultados da pesquisa: ' . $busca,
                    'informacao_busca' => 'Termo digitado ' . $busca,
                    //'pag_detalhe' => false,
                    //'carousel_home' => false,
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
                );

                foreach ($artigos as $artigo) {

                    $data['categoria_pai_nome'] = $artigo->categoria_pai_nome;
                    $data['categoria_pai_meta_link'] = $artigo->categoria_pai_meta_link;
                    // $data['categoria_meta_link'] = $artigo->categoria_meta_link;

                    break;
                }


                $data['artigos'] = $artigos;

                $cont=0;
                foreach($data['artigos'] as $str2){
                    $data['artigos'][$cont]->artigo_descricao = strip_tags($str2->artigo_descricao, '?');
                    $cont++;
                }

                $this->load->view('web/layout/header', $data);
                $this->load->view('web/home/busca');
                $this->load->view('web/layout/footer');
            
        
    }




    public function master($categoria_pai_meta_link = null) {

        if (!$categoria_pai_meta_link) {
            redirect('/');
        } else {

            $data = array(
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
                'artigos_master' => $this->artigos_model->get_all_by(array('categoria_pai_meta_link' => $categoria_pai_meta_link)),
            );


            foreach ($data['artigos_master'] as $artigo) {

                $data['titulo'] = $artigo->categoria_pai_nome;

                $data['informacao_busca'] = $artigo->categoria_pai_nome;

                break;
            }

            // $cont=0;
            //     foreach($data['artigos_master'] as $str2){
            //         $data['artigos_master'][$cont]->artigo_descricao = strip_tags($str2->artigo_descricao, '?');
            //         $cont++;
            //     }


            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/categorias');
            $this->load->view('web/layout/footer');
        }
    }


    public function tags($tag = null) {


        if (!$tag) {
            redirect('/');
        } else {

            $data = array(
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
                //'pag_detalhe' => false,
                //'carousel_home' => false,
                'artigos_master' => $this->artigos_model->get_all_seo_by(array('seo_url' => $tag)),
            );


            foreach ($data['artigos_master'] as $artigo) {

                $data['titulo'] = $artigo->seo_palavra;

                $data['informacao_busca'] = $artigo->seo_palavra;

                break;
            }

            $cont=0;
                foreach($data['artigos_master'] as $str2){
                    $data['artigos_master'][$cont]->artigo_descricao = strip_tags($str2->artigo_descricao, '?');
                    $cont++;
                }


            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/categorias');
            $this->load->view('web/layout/footer');
        }
    }
    

    public function categoria($categoria_meta_link = null) {

        if (!$categoria_meta_link) {
            redirect('/');
        } else {

            $data = array(
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
                'artigos_master' => $this->aux_artigos_categoria->get_all_by(array('categoria_meta_link' => $categoria_meta_link)),
            );

            // print_r($data['artigos_master']);
            // exit();

            if($data['artigos_master']){

                foreach ($data['artigos_master'] as $artigo) {

                    $data['titulo'] = $artigo->categoria_nome;
                    $meta_link = $artigo->categoria_pai_meta_link;
                    break;
    
                }
            }else{
                $data['titulo'] = 'Resultado não encontarado';
            }

        
            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/categorias');
            $this->load->view('web/layout/footer');
            
        }
    }


    public function redatores($redator_url = null) {


        if (!$redator_url) {
            redirect('/');
        } else {


            $data = array(
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
                //'pag_detalhe' => false,
                //'carousel_home' => false,
                'artigos_master' => $this->artigos_model->get_all_artigos_home(array('users.user_url' => $redator_url, 'artigos.artigo_publicado' => 1)),
            );

            foreach ($data['artigos_master'] as $artigo) {
                $data['titulo'] = $artigo->first_name;
                break;
            }

            $cont=0;
            foreach($data['artigos_master'] as $str2){
                $data['artigos_master'][$cont]->artigo_descricao = strip_tags($str2->artigo_descricao, '?');
                $cont++;
            }

            $this->load->view('web/layout/header', $data);
            $this->load->view('web/home/categorias');
            $this->load->view('web/layout/footer');
        }
    }

    public function busca_ajax() {


        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $busca = $this->input->post('busca');


        if (!$busca) {
            redirect('/');
        } else {


            $artigos = $this->artigos_model->get_all_by_busca($busca);


            $data['response'] = 'false';


            if ($artigos) {


                $data['response'] = 'true';
                $data['message'] = array();


                foreach ($artigos as $artigo) {

                    $data['message'][] = array(
                        'value' => $artigo->artigo_titulo,
                    );
                }
            }
            echo json_encode($data);
        }
    }

}
