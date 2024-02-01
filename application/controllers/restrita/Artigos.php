<?php
defined('BASEPATH') or exit('Ação não permitida');

class Artigos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }

        $this->load->model('banners_cta_model');
        $this->load->model('aux_artigos_categoria');
        $this->load->model('categorias_model');
    }

    public function redirecionar()
    {
        redirect('restrita/' . $this->router->fetch_class());
    }

    public function index()
    {

        if (!$area = areas()) {
            redirect('restrita');
        }

        $login = [

            'tipo' => 1,
            'acao' => 'Entrou em artigos'
        ];

        insert_login($login);

        $data = array(
            'titulo' => 'Seus artigos cadastrados',
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
            'subcategorias' => $this->aux_artigos_categoria->get_all(),
            'excluir' => $area->excluir,
            'editar' => $area->editar,
            'adicionar' => $area->adicionar,
        );

        $data['artigos'] = $this->artigos_model->get_all($this->session->userdata('user_id'));

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/artigos/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($artigo_id = null)
    {

        $artigo_id = (int) $artigo_id;
        $area = areas();

        if (!$artigo_id) {

            if ($area->adicionar) {

                $this->form_validation->set_rules('artigo_titulo', 'Título do artigo', 'trim|required|max_length[150]|callback_valida_titulo_artigo');
                $this->form_validation->set_rules('artigo_legenda', 'Legenda', 'trim|max_length[200]');
                $this->form_validation->set_rules('artigo_categoria_pai_id', 'Categoria principal', 'trim|required');
                $this->form_validation->set_rules('artigo_descricao', 'Texto', 'trim|required');

                $fotos_produtos = $this->input->post('fotos_produtos');

                if (!$fotos_produtos) {
                    $this->form_validation->set_rules('fotos_produtos', 'Imagens do artigo', 'trim|required');
                }

                if ($this->form_validation->run()) {

                    $data = elements(
                        array(
                            'artigo_titulo',
                            'artigo_legenda',
                            'artigo_categoria_pai_id',
                        ),
                        $this->input->post()
                    );

                    $data['artigo_url'] = url_amigavel($data['artigo_titulo']);
                    $data['artigo_user_id'] = $this->session->userdata('user_id');
                    $data['artigo_publicado'] = 0;
                    $data['artigo_descricao'] = html_escape($this->input->post('artigo_descricao', FALSE));

                    $log_query = $this->core_model->insert('artigos', $data, TRUE);

                    $artigo_last = $this->core_model->get_by_id('artigos', array('artigo_id' => $this->session->userdata('last_id')));

                    // inserindo fotos
                    $fotos_produtos = $this->input->post('fotos_produtos');
                    $fotos_titulos = $this->input->post('foto_titulo');
                    $fotos_principal = $this->input->post('foto_principal');

                    $total_fotos = count($fotos_produtos);

                    for ($i = 0; $i < $total_fotos; $i++) {

                        $data = array(
                            'foto_artigo_id' => $artigo_last->artigo_id,
                            'foto_nome' => $fotos_produtos[$i],
                            'foto_titulo' => $fotos_titulos[$i],
                            'foto_principal' => ($fotos_produtos[$i] == $fotos_principal ? 1 : 0)
                        );

                        $this->core_model->insert('artigos_fotos', $data);
                    }

                    // inserindo os Banners
                    $ctas = $this->input->post('artigo_banner_cta');
                    if ($ctas) {
                        $total_ctas = count($ctas);

                        for ($i = 0; $i < $total_ctas; $i++) {

                            $cta_data = array(
                                'aux_artigo_id' => $artigo_last->artigo_id,
                                'aux_cta_codigo' => $ctas[$i],
                            );

                            $this->core_model->insert('artigos_banner_cta', $cta_data);
                        }
                    }


                    // inserindo os artigos semelhantes
                    $semelhantes = $this->input->post('artigos_semelhantes');

                    if ($semelhantes) {
                        $total_semelhantes = count($semelhantes);

                        for ($i = 0; $i < $total_semelhantes; $i++) {

                            $semelhantes_data = array(
                                'artigo_id' => $artigo_last->artigo_id,
                                'artigo_id_semelhante' => $semelhantes[$i],
                            );

                            $this->core_model->insert('artigos_semelhantes', $semelhantes_data);
                        }
                    }


                    // inserindo subcategorias
                    // recebe a categoria principal
                    $categoria_id = $this->input->post('artigo_categoria_pai_id');

                    // array das subcategorias do select multiple
                    $subcategorias_id = $this->input->post('artigo_categoria_id');

                    if ($subcategorias_id) {

                        // conta quantas subcategorias existem
                        $qty_subcategorias = 0;
                        foreach ($subcategorias_id as $sub) {
                            $qty_subcategorias++;
                        }

                        $prod_categoria = $this->input->post('artigo_categoria_id');

                        for ($i = 0; $i < $qty_subcategorias; $i++) {

                            $data_subcategorias = array(
                                'ca_id_artigo' => $artigo_last->artigo_id,
                                'ca_id_categoria' => $categoria_id,
                                'ca_id_subcategoria' => $prod_categoria[$i]
                            );

                            $this->core_model->insert('aux_categoria_artigos', $data_subcategorias);
                        }
                    }

                    // inserindo TAGS SEO
                    $seo = $this->input->post('artigo_seo');
                    if ($seo) {
                        $total_seo = count($seo);

                        for ($i = 0; $i < $total_seo; $i++) {

                            if ($seo[$i]) {
                                $seo_data = array(
                                    'seo_artigo_id' => $artigo_last->artigo_id,
                                    'seo_palavra' => $seo[$i],
                                    'seo_url' => url_amigavel($seo[$i]),
                                );

                                $this->core_model->insert('artigo_palavras_seo', $seo_data);
                            }
                        }
                    }

                    $login = [

                        'tipo' => 2,
                        'acao' => 'Cadastrou artigo: ' . $artigo_last->artigo_titulo,
                        'log_query' => $log_query
                    ];

                    insert_login($login);

                    redirect('restrita/' . $this->router->fetch_class() . '/view/' . $artigo_last->artigo_id);
                } else {

                    if($this->input->post()){
                        $this->session->set_flashdata('erro', 'Verifique os campos em vermelho');
                    }

                    $login = [

                        'tipo' => 1,
                        'acao' => 'Entrou para cadastrar artigo'
                    ];
                    insert_login($login);

                    $data = array(
                        'titulo' => '<span class="text-success"><i class="fas fa-plus"></i>&nbsp; Cadastrar novo artigo</span>',
                        'styles' => array(
                            'assets/jquery-upload-file/css/uploadfile.css',
                            'assets/bundles/select2/dist/css/select2.min.css',
                        ),
                       
                        'scripts' => array(
                            'assets/sweetalert2/sweetalert2.all.min.js',
                            'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                            'assets/jquery-upload-file/js/artigos.js',
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                            // 'assets/mask/jquery.mask.min.js',
                            // 'assets/mask/custom.js',
                            'assets/js/artigos.js',
                        ),
                        'categorias_pai' => $this->artigos_model->get_all_categorias_pai_artigos(array('categorias_pai.categoria_pai_ativa' => 1)),
                        'banners' => $this->core_model->get_all('banners_site'),
                        'todos_artigos' => $this->core_model->get_all('artigos', array('artigo_publicado' => 1)),

                    );

                    $data['categorias'] = $this->categorias_model->get_all_categorias_id($data['categorias_pai'][0]->categoria_pai_id);

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/artigos/core');
                    $this->load->view('restrita/layout/footer');
                }
            } else {
                $this->redirecionar();
            }
        } else {

            if ($area->editar) {

                if (!$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {

                    $login = [

                        'tipo' => 5,
                        'acao' => 'Tentou entrar sem artigo cadastrado'
                    ];
                    insert_login($login);

                    $this->session->set_flashdata('erro', 'Artigo não encontrado');
                    $this->redirecionar();

                } else {

                    if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
                        $login = [

                            'tipo' => 5,
                            'acao' => 'Tentou editar artigo de outro usuário'
                        ];
                        insert_login($login);
                        $this->redirecionar();
                    }

                    $this->form_validation->set_rules('artigo_titulo', 'Título do artigo', 'trim|required|max_length[150]|callback_valida_titulo_artigo');
                    $this->form_validation->set_rules('artigo_legenda', 'Legenda', 'trim|max_length[200]');
                    $this->form_validation->set_rules('artigo_categoria_pai_id', 'Categoria principal', 'trim|required');
                    $this->form_validation->set_rules('artigo_descricao', 'Texto', 'trim|required');

                    $fotos_produtos = $this->input->post('fotos_produtos');

                    if (!$fotos_produtos) {
                        $this->form_validation->set_rules('fotos_produtos', 'Imagens do artigo', 'trim|required');
                    }

                    if ($this->form_validation->run()) {

                        $data = elements(
                            array(
                                'artigo_titulo',
                                'artigo_legenda',
                                'artigo_categoria_pai_id',
                            ),
                            $this->input->post()
                        );

                        $data['artigo_url'] = url_amigavel($data['artigo_titulo']);
                        $data['artigo_descricao'] = html_escape($this->input->post('artigo_descricao', FALSE));

                        $log_query = $this->core_model->update('artigos', $data, array('artigo_id' => $artigo->artigo_id));

                        $this->core_model->delete_msn('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id));

                        // inserindo fotos
                        $fotos_produtos = $this->input->post('fotos_produtos');
                        $fotos_titulos = $this->input->post('foto_titulo');
                        $fotos_principal = $this->input->post('foto_principal');

                        $total_fotos = count($fotos_produtos);

                        for ($i = 0; $i < $total_fotos; $i++) {

                            $data = array(
                                'foto_artigo_id' => $artigo_id,
                                'foto_nome' => $fotos_produtos[$i],
                                'foto_titulo' => $fotos_titulos[$i],
                                'foto_principal' => ($fotos_produtos[$i] == $fotos_principal ? 1 : 0)
                            );

                            $this->core_model->insert('artigos_fotos', $data);
                        }

                        // inserindo os Banners
                        $ctas = $this->input->post('artigo_banner_cta');

                        if ($ctas) :

                            $total_ctas = count($ctas);

                            $this->core_model->delete_msn('artigos_banner_cta', array('aux_artigo_id' => $artigo->artigo_id));

                            for ($i = 0; $i < $total_ctas; $i++) {

                                $cta_data = array(
                                    'aux_artigo_id' => $artigo->artigo_id,
                                    'aux_cta_codigo' => $ctas[$i],
                                );

                                $this->core_model->insert('artigos_banner_cta', $cta_data);
                            }
                        endif;


                        $this->core_model->delete_msn('aux_categoria_artigos', array('ca_id_artigo' => $artigo->artigo_id));

                        // inserindo subcategorias
                        // recebe a categoria principal
                        $categoria_id = $this->input->post('artigo_categoria_pai_id');

                        // array das subcategorias do select multiple
                        $subcategorias_id = $this->input->post('artigo_categoria_id');

                        if ($subcategorias_id) {

                            // conta quantas subcategorias existem
                            $qty_subcategorias = 0;
                            foreach ($subcategorias_id as $sub) {
                                $qty_subcategorias++;
                            }

                            $prod_categoria = $this->input->post('artigo_categoria_id');

                            for ($i = 0; $i < $qty_subcategorias; $i++) {

                                $data_subcategorias = array(
                                    'ca_id_artigo' => $artigo->artigo_id,
                                    'ca_id_categoria' => $categoria_id,
                                    'ca_id_subcategoria' => $prod_categoria[$i]
                                );

                                $this->core_model->insert('aux_categoria_artigos', $data_subcategorias);
                            }
                        }

                        $semelhantes = $this->input->post('artigos_semelhantes');
                        $this->core_model->delete_msn('artigos_semelhantes', array('artigos_semelhantes.artigo_id' => $artigo->artigo_id));

                        if (is_array($semelhantes)) {

                            $total_semelhantes = count($semelhantes);

                            for ($i = 0; $i < $total_semelhantes; $i++) {

                                $semelhantes_data = array(
                                    'artigo_id' => $artigo->artigo_id,
                                    'artigo_id_semelhante' => $semelhantes[$i],
                                );

                                $this->core_model->insert('artigos_semelhantes', $semelhantes_data);
                            }
                        }

                        $seo = $this->input->post('artigo_seo');
                        $this->core_model->delete_msn('artigo_palavras_seo', array('seo_artigo_id' => $artigo->artigo_id));

                        if ($seo) {

                            $total_seo = count($seo);

                            for ($i = 0; $i < $total_seo; $i++) {
                                if ($seo[$i]) {
                                    $seo_data = array(
                                        'seo_artigo_id' => $artigo->artigo_id,
                                        'seo_palavra' => $seo[$i],
                                        'seo_url' => url_amigavel($seo[$i]),
                                    );

                                    $this->core_model->insert('artigo_palavras_seo', $seo_data);
                                }
                            }
                        }

                        $login = [

                            'tipo' => 3,
                            'acao' => 'Editou artigo: ' . $artigo->artigo_titulo,
                            'log_query' => $log_query
                        ];
                        insert_login($login);

                        redirect('restrita/' . $this->router->fetch_class() . '/view/' . $artigo->artigo_id.'/editar');

                    } else {

                        if($this->input->post()){
                            $this->session->set_flashdata('erro', 'Verifique os campos em vermelho');
                        }

                        $login = [

                            'tipo' => 1,
                            'acao' => 'Entrou para editar artigo: ' . $artigo->artigo_titulo
                        ];
                        insert_login($login);

                        $data = array(
                            'titulo' => '<span class="text-warning"><i class="fas fa-edit"></i>&nbsp; Editar artigo: ' . $artigo->artigo_titulo . '</span>',
                            'styles' => array(
                                'assets/jquery-upload-file/css/uploadfile.css',
                                'assets/bundles/select2/dist/css/select2.min.css',
                            ),
                           
                            'scripts' => array(
                                'assets/sweetalert2/sweetalert2.all.min.js',
                                'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                                'assets/jquery-upload-file/js/artigos.js',
                                'assets/bundles/select2/dist/js/select2.full.min.js',
                                // 'assets/mask/jquery.mask.min.js',
                                // 'assets/mask/custom.js',
                                'assets/js/artigos.js',
                            ),
                            'artigo' => $artigo,
                            'seo' => $this->artigos_model->get_all_artigos_seo(array('seo_artigo_id' => $artigo->artigo_id)),
                            'fotos_artigo' => $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id)),
                            'categorias_pai' => $this->artigos_model->get_all_categorias_pai_artigos(array('categorias_pai.categoria_pai_ativa' => 1)),
                            'subcategorias_do_artigo' => $this->aux_artigos_categoria->get_all_categorias_do_artigo(array('ca_id_artigo' => $artigo->artigo_id)),
                            'banners_do_artigo' => $this->banners_cta_model->get_do_artigo(array('aux_artigo_id' => $artigo->artigo_id)),
                            'artigos_semelhantes_do_artigo' => $this->artigos_model->get_all_artigos_semelhantes(array('artigos_semelhantes.artigo_id' => $artigo->artigo_id)),
                        );

                        $data['artigos_semelhantes'] = $this->artigos_model->get_all_artigos_diferentes($data['artigos_semelhantes_do_artigo']);
                        $data['banners'] = $this->banners_cta_model->get_all_array($data['banners_do_artigo']);
                        $data['subcategorias'] = $this->aux_artigos_categoria->get_all_categorias_do_artigo_array($data['subcategorias_do_artigo']);

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/artigos/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }
            } else {
                $this->redirecionar();
            }
        }
    }

    public function view($artigo_id = null)
    {

        $artigo_id = (int) $artigo_id;

        if (!$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {

            $login = [

                'tipo' => 5,
                'acao' => 'Tentou entrar sem artigo cadastrado'
            ];
            insert_login($login);

            $this->session->set_flashdata('erro', 'Artigo não encontrado');
            $this->redirecionar();

        } else {

            if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
                $login = [

                    'tipo' => 5,
                    'acao' => 'Tentou entrar em artigo de outro usuário'
                ];
                insert_login($login);
                $this->redirecionar();
            }

            $login = [

                'tipo' => 1,
                'acao' => 'Entrou em visualização do artigo: ' . $artigo->artigo_titulo
            ];
            insert_login($login);

            $data = array(
                'titulo' => '<span class="text-info"><i class="fas fa-check"></i>&nbsp; Revise seu artigo e publique</span>',
                'scripts' => array(
                    'assets/js/artigos_view.js',
                ),
                'acao' => true,
                'artigo' => $artigo,
                'seo' => $this->artigos_model->get_all_artigos_seo(array('seo_artigo_id' => $artigo->artigo_id)),
                'fotos_artigo' => $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id)),
                'artigos_semelhantes_do_artigo' => $this->artigos_model->get_all_artigos_semelhantes(array('artigos_semelhantes.artigo_id' => $artigo->artigo_id, 'artigos.artigo_publicado' => 1)),
                'subcategorias_do_artigo' => $this->aux_artigos_categoria->get_all_categorias_do_artigo(array('ca_id_artigo' => $artigo->artigo_id)),
                'banners_do_artigo' => $this->banners_cta_model->get_do_artigo(array('aux_artigo_id' => $artigo->artigo_id)),
            );

            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/artigos/view_artigo');
            $this->load->view('restrita/layout/footer');
        }
    }

    public function get_categorias_filhas()
    {

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $categorias = array();

        $artigo_categoria_pai_id = $this->input->post('artigo_categoria_pai_id');

        if ($artigo_categoria_pai_id) {

            $categorias = $this->core_model->get_all('categorias', array('categorias.categoria_pai_id' => $artigo_categoria_pai_id, 'categorias.categoria_ativa' => 1));
        }

        if (!$categorias) {
            $categorias = false;
        }

        echo json_encode($categorias);
    }

    public function get_artigos()
    {

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }

        $artigo_titulo = $this->input->post('titulo');
        $artigo_id = $this->input->post('artigo_id');

        $artigo = $this->core_model->get_all('artigos', array('artigo_titulo' => $artigo_titulo, 'artigo_id !=' => $artigo_id));
        
        if ($artigo) {
            $result = false;
        }else{
            $result = true;
        }

        echo json_encode($result);
    }


    public function salva_leitura()
    {

        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }


        $artigo_leitura = $this->input->post('artigo_leitura');
        $artigo_id = $this->input->post('artigo_id');
        if ($artigo_leitura) {

            $this->core_model->update_ajax('artigos', array('artigo_tempo_leitura' => $artigo_leitura), array('artigo_id' => $artigo_id));
        }

        echo json_encode($artigo_leitura);
    }

    public function valida_titulo_artigo($artigo_titulo) {

        $artigo_id = $this->input->post('artigo_id');
        $mensagem = mensagem_padrao($artigo_titulo);

        if (!$artigo_id) {

            if ($this->core_model->get_by_id('artigos', array('artigo_titulo' => $artigo_titulo))) {

                insert_padrao($artigo_titulo);
                $this->form_validation->set_message('valida_titulo_artigo', $mensagem);
                return false;
            } else {

                return true;
            }
        } else {

            if ($this->core_model->get_by_id('artigos', array('artigo_titulo' => $artigo_titulo, 'artigo_id !=' => $artigo_id))) {

                insert_padrao($artigo_titulo);
                $this->form_validation->set_message('valida_titulo_artigo', $mensagem);
                return false;
            } else {

                return true;
            }
        }
    }


    public function upload()
    {

        $mensagem_upload = "No máximo 3000 x 3000 pixels";

        $this->session->set_userdata('mensagem_upload', $mensagem_upload);

        $config['upload_path'] = './uploads/artigos/';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG|gif|GIF|svg|SVG|PDF|pdf';
        $config['encrypt_name'] = true;
        $config['max_size'] = 3000;
        $config['max_width'] = 3000;
        $config['max_height'] = 3000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_produto')) {

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

    public function delete($artigo_id = null)
    {

        $area = areas();

        if ($area->excluir) {

            $artigo_id = (int) $artigo_id;


            if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
                $this->session->set_flashdata('erro', 'Artigo não encontrado');
                redirect('restrita/'.$this->router->fetch_class() . '/artigos');
            }

            if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
                $login = [

                    'tipo' => 5,
                    'acao' => 'Tentou deletar artigo de outro usuário'
                ];
                insert_login($login);
                $this->redirecionar();
            }

            $fotos_artigo = $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id));

            $log_query = $this->core_model->delete('artigos', array('artigo_id' => $artigo->artigo_id));
            $this->core_model->delete('artigos_banner_cta', array('aux_artigo_id' => $artigo->artigo_id));
            $this->core_model->delete('aux_categoria_artigos', array('ca_id_artigo' => $artigo->artigo_id));

            if ($fotos_artigo) {

                foreach ($fotos_artigo as $foto) {

                    $foto_grande = FCPATH . 'uploads/artigos/' . $foto->foto_nome;

                    if (file_exists($foto_grande)) {
                        unlink($foto_grande);
                    }
                }
            }

            $login = [

                'tipo' => 4,
                'acao' => 'Deletou artigo: '.$artigo->artigo_titulo,
                'log_query' => $log_query
            ];
            insert_login($login);
            $this->redirecionar();
        }

        $this->redirecionar();
    }

    public function situacao($artigo_id = null)
    {

        $area = areas();

        if ($area->editar) {

            $artigo_id = (int) $artigo_id;


            if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
                $this->session->set_flashdata('erro', 'Artigo não encontrado');
                redirect('restrita/' . $this->router->fetch_class() . '/artigos');
            }

            if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
                $login = [

                    'tipo' => 5,
                    'acao' => 'Tentou entrar em artigo de outro usuário'
                ];
                insert_login($login);
                $this->redirecionar();
            }

            if ($artigo->artigo_publicado == 1) {

                $login = [

                    'tipo' => 3,
                    'acao' => 'Alterou para inativo o artigo: ' . $artigo->artigo_titulo
                ];
                insert_login($login);

                $data =
                    array(
                        'artigo_publicado' => 0,
                    );
            } else {

                $login = [

                    'tipo' => 3,
                    'acao' => 'Alterou para ativo o artigo: ' . $artigo->artigo_titulo
                ];
                insert_login($login);

                $data =
                    array(
                        'artigo_publicado' => 1,
                    );
            }

            $this->core_model->update('artigos', $data, array('artigo_id' => $artigo->artigo_id));
        }

        $this->redirecionar();
    }

}
