<?php

defined('BASEPATH') or exit('Ação não permitida');

class Banners_site extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        $this->load->model('banners_site_model');
    }

    public function redirecionar(){
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index()
    {

        if (!$area = areas()) {
            redirect('restrita');
        }

        $login = [
            
            'tipo' => 1,
            'acao' => 'Entrou banners'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Banners cadastrados',
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
            'banners' => $this->core_model->get_all('banners_site'),
            'adicionar' => $area->adicionar,
            'excluir' => $area->excluir,
            'editar' => $area->editar,
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/banners_site/index');
        $this->load->view('restrita/layout/footer');
    }

    public function posicoes($pagina = null)
    {

        $area = areas();
        if ($area->editar) {
            if ($this->input->post()) {
                $data =
                    array(
                        'primario' => $this->input->post('primario'),
                        'secundario' => $this->input->post('secundario'),
                        'pagina' => $pagina,
                    );

                $this->core_model->delete('banners_posicoes', array('pagina' => $pagina));
                $this->core_model->insert('banners_posicoes', $data);

                $this->redirecionar();
            } else {

                $data = array(
                    'titulo' => 'Escolher posição de banner para ' . $pagina,
                    'banners_primarios' => $this->banners_site_model->get_all_posicao(1),
                    'banners_secundarios' => $this->banners_site_model->get_all_posicao(2),
                );


                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/banners_site/posicoes');
                $this->load->view('restrita/layout/footer');
            }
        } else {
            $this->redirecionar();
        }
    }

    public function core($banner_id = null)
    {

        $area = areas();

        $banner_id = (int) $banner_id;

        if (!$banner_id) {
            $banners = $this->input->post('banner_foto');

            $validacao = false;
            if ($banners) {
                $validacao = true;
                foreach ($banners as $banner) {
                    if (!$banner) {
                        $validacao = false;
                        $this->session->set_flashdata('erro', 'Imagem do banner é obrigatório.');
                    }
                }
            }

            if ($validacao) {

                if ($area->adicionar) {

                    $data = elements(
                        array(
                            'banner_tamanho',
                            'banner_titulo',
                            'banner_url',
                            'banner_medida',
                            'banner_tipo',
                        ),
                        $this->input->post()
                    );

                    $banners = $this->input->post('banner_foto');

                    $total_fotos = count($banners);

                    for ($i = 0; $i < $total_fotos; $i++) {

                        $data2 = array(
                            'banner_titulo' => $data['banner_titulo'][$i],
                            'banner_url' => $data['banner_url'][$i],
                            'banner_medida' => $data['banner_medida'][$i],
                            'banner_tipo' => $data['banner_tipo'][$i],
                            'banner_tamanho' => $data['banner_tamanho'][$i],
                            'banner_imagem' => $banners[$i],
                        );


                        $this->core_model->insert('banners_site', $data2);
                    }

                    $login = [
            
                        'tipo' => 2,
                        'acao' => 'Adicionou banners'
                    ];
            
                    insert_login($login);

                    $this->redirecionar();
                } else {
                    $this->redirecionar();
                }
            } else {

                $login = [
            
                    'tipo' => 1,
                    'acao' => 'Entrou para adicionar banners'
                ];
        
                insert_login($login);

                $data = array(
                    'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Inserir banners</span>',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                        'assets/jquery-upload-file/js/banners_site.js',
                    ),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/banners_site/core');
                $this->load->view('restrita/layout/footer');
            }
        } elseif ($area->editar) {

            if ($this->input->post('banner_id')) {

                $data = elements(
                    array(
                        'banner_tamanho',
                        'banner_titulo',
                        'banner_url',
                        'banner_medida',
                        'banner_tipo',
                        'banner_imagem',
                        'banner_id',
                    ),
                    $this->input->post()
                );

                $login = [
            
                    'tipo' => 3,
                    'acao' => 'Editou banner'
                ];
        
                insert_login($login);

                $this->core_model->update('banners_site', $data, array('banner_id' => $data['banner_id']));

                $this->redirecionar();

            } else {

                if (!$banner = $this->core_model->get_by_id('banners_site', array('banner_id' => $banner_id))) {
                    
                    $this->session->set_flashdata('erro', 'Banner não encontrado');
                    $this->redirecionar();

                } else {

                    $login = [
            
                        'tipo' => 1,
                        'acao' => 'Entrou para editar banner: '.$banner->banner_titulo
                    ];
            
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar banner: '.$banner->banner_titulo.'</span>',
                        'scripts' => array(
                            'assets/js/banners_site.js',
                        ),
                        'banner' => $banner,
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/banners_site/editar');
                    $this->load->view('restrita/layout/footer');
                }
            }
        } else {
            $this->redirecionar();
        }
    }

    public function upload()
    {

        $config['upload_path'] = './uploads/banners_site/';
        $config['allowed_types'] = 'png|PNG|svg|SVG|jpg|jpeg|JPG|jpg|webp|WEBP';
        $config['encrypt_name'] = false;
        $config['max_size'] = 3000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;


        $this->load->library('upload', $config);

        if ($this->upload->do_upload('banners')) {

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'banner_titulo' => $this->upload->data('file_name'),
                'mensagem' => 'Foto foi enviada com sucesso',
                'medida' => $this->upload->data('image_width') . 'x' . $this->upload->data('image_height'),
                'tamanho' => $this->upload->data('file_size') . ' KB',
                'tipo' => $this->upload->data('image_type'),
                'nome' => $this->upload->data('raw_name'),
            );
        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);
    }

    public function upload_editar()
    {

        $config['upload_path'] = './uploads/banners_site/';
        $config['allowed_types'] = 'png|PNG|svg|SVG|jpg|jpeg|JPG|jpg|webp|WEBP';
        $config['encrypt_name'] = false;
        $config['max_size'] = 3000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;


        $this->load->library('upload', $config);

        if ($this->upload->do_upload('banner_site')) {

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'banner_titulo' => $this->upload->data('file_name'),
                'mensagem' => 'Foto foi enviada com sucesso',
                'medida' => $this->upload->data('image_width') . 'x' . $this->upload->data('image_height'),
                'tamanho' => $this->upload->data('file_size') . ' KB',
                'tipo' => $this->upload->data('image_type'),
            );
        } else {

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);
    }



    public function delete($banner_id = null)
    {

        $area = areas();

        if ($area->excluir) {

            $banner_id = (int) $banner_id;

            if (!$banner_id || !$banner = $this->core_model->get_by_id('banners_site', array('banner_id' => $banner_id))) {
                $this->session->set_flashdata('erro', 'Banner não foi encontrado');
                $this->redirecionar();
            }


            $this->core_model->delete('artigos_banner_cta', array('aux_cta_codigo' => $banner->banner_id));
            $this->core_model->delete('banners_site', array('banner_id' => $banner->banner_id));

            $foto_grande = FCPATH . 'uploads/banners_site/' . $banner->banner_imagem;

            if (file_exists($foto_grande)) {
                unlink($foto_grande);
            }

            $this->redirecionar();
        } else {
            $this->redirecionar();
        }
    }
}
