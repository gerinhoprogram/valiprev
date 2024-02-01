<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

    public function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }
    }

    public function index() {

        /*
         * Montando um objeto com os dados do anunciante logado para enviá-lo para view 
         * e compor a pesquisa por total de anúncios cadastrados
         */
        $anunciante = get_info_anunciante();

        $data = array(
            'titulo' => 'Gerenciar minha conta',
            'anunciante' => $anunciante,
            'total_artigos_cadastrados' => $this->core_model->count_all_results('artigos', array('artigo_user_id' => $anunciante->id)),
        );

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/conta/index');
        $this->load->view('web/layout/footer');
    }

    public function perfil() {


        /*
         * Recuperamos da sessão o user_id do anunciante logado para realizar a edição do perfil
         */
        $user_id = $this->session->userdata('user_id');

        /*
         * Se a variável 'user_id' não contiver um valor, redirecionamos para o login
         */
        if (!$user_id) {
            redirect('login');
        } else {

            /*
             * Maravilha.... 'user_id' contém um valor.... podemos continuar com a edição
             */

            /*
             * Recuperamos os dados do anunciante logado para enviarmos para a view
             */
            $usuario = get_info_anunciante();



            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('user_cpf', 'CPF', 'trim|required|exact_length[14]|callback_valida_cpf');
            $this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[14]|max_length[15]|callback_valida_telefone');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]|callback_valida_email');
            $this->form_validation->set_rules('user_cep', 'CEP', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('user_endereco', 'Endereço', 'trim|required|min_length[5]|max_length[45]');
            $this->form_validation->set_rules('user_numero_endereco', 'Número', 'trim|max_length[45]');
            $this->form_validation->set_rules('user_bairro', 'Bairro', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('user_cidade', 'Cidade', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('user_estado', 'Estado', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('user_foto', 'Avatar', 'trim|required');

            $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[6]|max_length[200]');
            $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|matches[password]');


            if ($this->form_validation->run()) {


                /*
                 * Sucesso... formulário foi validado... damos sequência
                 */

                $data = elements(
                        array(
                            'first_name',
                            'last_name',
                            'password',
                            'user_cpf',
                            'phone',
                            'email',
                            'user_cep',
                            'user_endereco',
                            'user_numero_endereco',
                            'user_bairro',
                            'user_cidade',
                            'user_estado',
                            'user_foto',
                        ), $this->input->post()
                );

                /*
                 * Removemos do array $data o password caso o mesmo não seja informado, pois não é obrigatório
                 */

                if (!$data['password']) {
                    unset($data['password']);
                }


                /*
                 * Populamos o $id com o ID do objeto (é mais seguro)
                 */
                $id = $usuario->id;


                if ($this->ion_auth->update($id, $data)) {

                    $this->session->set_flashdata('sucesso', 'Seu perfil foi atualizado com sucesso');
                } else {
                    $this->session->set_flashdata('erro', $this->ion_auth->errors());
                }

                redirect($this->router->fetch_class() . '/perfil');
            } else {

                /*
                 * Erros de validação
                 */

                $data = array(
                    'titulo' => 'Gerenciar o meu perfil',
                    'scripts' => array(
                        'assets/mask/jquery.mask.min.js',
                        'assets/mask/custom.js',
                        'assets/js/anunciantes.js',
                    ),
                    'usuario' => $usuario,
                );

                $this->load->view('web/layout/header', $data);
                $this->load->view('web/conta/perfil');
                $this->load->view('web/layout/footer');
            }
        }
    }

    public function artigos() {

        /*
         * Montamos um objeto do anunciante logado
         */
        $anunciante = get_info_anunciante();

        $data = array(
            'titulo' => 'Meus anúncios',
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

        /*
         * Só enviamos para view se existir pelo menos um anúncio cadastrado do anunciante logado
         */
        if ($artigos = $this->artigos_model->get_all($anunciante->id)) {
            $data['artigos'] = $artigos;
        }

//        echo '<pre>';
//        print_r($artigos);
//        exit();


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/conta/artigos');
        $this->load->view('web/layout/footer');
    }

    public function perguntas() {


        $data = array(
            'titulo' => 'Perguntas realizadas',
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

        /*
         * Só enviamos para view se existir pelo menos uma pergunta realizada
         */
        if ($perguntas = $this->core_model->get_all('artigos_perguntas', array('artigo_user_id' => $this->session->userdata('user_id')))) {
            $data['perguntas'] = $perguntas;
        }

//        echo '<pre>';
//        print_r($perguntas);
//        exit();


        $this->load->view('web/layout/header', $data);
        $this->load->view('web/conta/perguntas');
        $this->load->view('web/layout/footer');
    }

    /*
     * Lista todas as perguntas na área do anunciante que o mesmo realizou
     */

    public function duvidas() {



        $data = array(
            'titulo' => 'Perguntas que eu fiz',
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

        /*
         * Só enviamos para view se existir pelo menos uma pergunta realizada
         */
        if ($duvidas = $this->core_model->get_all('artigos_perguntas_historico', array('anunciante_pergunta_id' => $this->session->userdata('user_id')))) {
            $data['duvidas'] = $duvidas;
        }




        $this->load->view('web/layout/header', $data);
        $this->load->view('web/conta/duvidas');
        $this->load->view('web/layout/footer');
    }

    public function core($artigo_id = null) {

        /*
         * Função utilizada para cadastrar ou editar um anúncio
         */

        $artigo_id = (int) $artigo_id;


        if (!$artigo_id) {

            /*
             * Cadastrando....
             */

            $this->form_validation->set_rules('artigo_titulo', 'Título do anúncio', 'trim|required|min_length[4]|max_length[240]');
            $this->form_validation->set_rules('artigo_preco', 'Preço do anúncio', 'trim|required');
            $this->form_validation->set_rules('artigo_categoria_pai_id', 'Categoria principal', 'trim|required');
            $this->form_validation->set_rules('artigo_categoria_id', 'Categoria secundária', 'trim|required');
            $this->form_validation->set_rules('artigo_situacao', 'Situação do item', 'trim|required');

            $this->form_validation->set_rules('artigo_localizacao_cep', 'CEP do anúncio', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('artigo_descricao', 'Descrição do anúncio', 'trim|required|min_length[10]|max_length[5000]');


            /*
             * Para validarmos o campo fotos_produtos[] que é do tipo array, temos que fazê-lo da seguinte forma
             */
            $fotos_produtos = $this->input->post('fotos_produtos');

            if (!$fotos_produtos) {
                $this->form_validation->set_rules('fotos_produtos', 'Imagens do anúncio', 'trim|required');
            }

            if ($this->form_validation->run()) {


                $data = elements(
                        array(
                            'artigo_codigo',
                            'artigo_titulo',
                            'artigo_preco',
                            'artigo_categoria_pai_id',
                            'artigo_categoria_id',
                            'artigo_publicado',
                            'artigo_situacao',
                            'artigo_localizacao_cep',
                            'artigo_descricao',
                        ), $this->input->post()
                );

                /*
                 * Precisamos auditar novamente o anúncio, portanto, deixamos o mesmo não publicado
                 */
                $data['artigo_publicado'] = 0;

                /*
                 * Referenciando o ID do anunciante logado 
                 */
                $data['artigo_user_id'] = $this->session->userdata('user_id');

                /*
                 * Recuperamos da sessão o objeto 'artigo_endereco_sessao' para compor os dados de endereço do novo anúncio
                 */
                $artigo_endereco_sessao = $this->session->userdata('artigo_endereco_sessao');

                $data['artigo_logradouro'] = $artigo_endereco_sessao->logradouro;
                $data['artigo_bairro'] = $artigo_endereco_sessao->bairro;
                $data['artigo_cidade'] = $artigo_endereco_sessao->localidade;
                $data['artigo_estado'] = $artigo_endereco_sessao->uf;

                /*
                 * Montando os meta links do endereço
                 */
                $data['artigo_bairro_metalink'] = url_amigavel($data['artigo_bairro']);
                $data['artigo_cidade_metalink'] = url_amigavel($data['artigo_cidade']);


                /*
                 * Removemos da sessão o objeto $artigo_endereco_sessao, pois não precisamos mais dele
                 */

                $this->session->unset_userdata('artigo_endereco_sessao');


                /*
                 * Revomendo a vírgula
                 */
                $data['artigo_preco'] = str_replace(',', '', $data['artigo_preco']);


                /*
                 * Cadastramos o anúncio
                 */
                $this->core_model->insert('artigos', $data, TRUE);


                /*
                 * e recuperamos da sessão o último ID inserido na tabela anúncios
                 * Ou seja, artigo_id
                 */
                $artigo_id = $this->session->userdata('last_id');


                $fotos_produtos = $this->input->post('fotos_produtos');


                /*
                 * Contamos quantas imagens vieram no POST
                 */
                $total_fotos = count($fotos_produtos);


                for ($i = 0; $i < $total_fotos; $i++) {

                    $data = array(
                        'foto_artigo_id' => $artigo_id,
                        'foto_nome' => $fotos_produtos[$i],
                    );

                    $this->core_model->insert('artigos_fotos', $data);
                }


                /*
                 * Chegamos no trecho em que enviamos um e-mail informando ao anunciante que seu anúncio foi publicado
                 */



                /*
                 * Montamos um objeto com todos os dados do anunciante, porque precisamos do e-mail dele
                 * Utilizando o user_id que está na sessão
                 */
                $anunciante = $this->ion_auth->user()->row();

                /*
                 * Montamos um objeto com todos os dados do website, porque precisamos do e-mail
                 */
                $sistema = info_header_footer();



                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                $from_email = $sistema->sistema_email;


                $to_email = $anunciante->email;

                $this->email->from($from_email, $sistema->sistema_nome_fantasia);

                $this->email->to($to_email);

                $this->email->subject('Falta muito pouco para o seu anúncio ser publicado!');
                $this->email->message('Olá ' . $anunciante->first_name . ' ' . $anunciante->last_name . ', seu anúncio está em análise e muito em breve será publicado!<br>'
                        . 'Assim que isso ocorrer enviaremos um e-mail informando você.<br>'
                        . '<strong>Título do anúncio: </strong>&nbsp;' . $this->input->post('artigo_titulo'));


                $this->load->library('encryption'); //Evita o envio de span


                if ($this->email->send(FALSE)) {

                    /*
                     * Sucesso.... o e-mail foi enviado
                     * Não fazemos mais nada aqui
                     */
                } else {

                    /*
                     * Opss.... não foi possível enviar o e-mail
                     * Então jogamos no flashdata os erros que ocorreram
                     */
                    $this->session->set_flashdata("erro", $this->email->print_debugger('header'));
                }

                redirect($this->router->fetch_class() . '/artigos');
            } else {

                /*
                 * Erros de validação
                 */



                $data = array(
                    'titulo' => 'Cadastrar anúncio',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                        'assets/select2/select2.min.css',
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                        'assets/jquery-upload-file/js/artigos.js',
                        'assets/mask/jquery.mask.min.js',
                        'assets/mask/custom.js',
                        'assets/select2/select2.min.js',
                        'assets/js/artigos.js',
                    ),
                    'codigo_gerado' => $this->core_model->generate_unique_code('artigos', 'numeric', 8, 'artigo_codigo'),
                    'categorias_pai' => $this->artigos_model->get_all_categorias_pai(),
                );


//                echo '<pre>';
//                print_r($data);
//                exit();

                $this->load->view('web/layout/header', $data);
                $this->load->view('web/conta/core');
                $this->load->view('web/layout/footer');
            }
        } else {

            /*
             * Editando....
             */


            /*
             * Verificamos se $artigo_id existe na base de dados
             */
            if (!$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
                $this->session->set_flashdata('erro', 'Anúncio não encontrado');
                redirect($this->router->fetch_class() . '/artigos');
            } else {

                /*
                 * Garantimos que o anunciante só possa editar um anúncio que seja seu
                 */
                if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
                    $this->session->set_flashdata('erro', 'Este anúncio não está atribuído à sua conta de anunciante.');
                    redirect($this->router->fetch_class() . '/artigos');
                }


                /*
                 * Maravilha.... confirmada a existência do anúncio e que o mesmo é do anunciante logado.... passamos para as validações
                 */

                $this->form_validation->set_rules('artigo_titulo', 'Título do anúncio', 'trim|required|min_length[4]|max_length[240]');
                $this->form_validation->set_rules('artigo_preco', 'Preço do anúncio', 'trim|required');
                $this->form_validation->set_rules('artigo_situacao', 'Situação do item', 'trim|required');

                /*
                 * Verificamos se a categoria_pai veio no POST
                 */
                $artigo_categoria_pai_id = $this->input->post('artigo_categoria_pai_id');


                /*
                 * Caso sim, a categoria filha se tornará obrigatória
                 */
                if ($artigo_categoria_pai_id) {
                    $this->form_validation->set_rules('artigo_categoria_id', 'Categoria secundária', 'trim|required');
                }


                $this->form_validation->set_rules('artigo_localizacao_cep', 'CEP do anúncio', 'trim|required|exact_length[9]');
                $this->form_validation->set_rules('artigo_descricao', 'Descrição do anúncio', 'trim|required|min_length[10]|max_length[5000]');


                /*
                 * Para validarmos o campo fotos_produtos[] que é do tipo array, temos que fazê-lo da seguinte forma
                 */
                $fotos_produtos = $this->input->post('fotos_produtos');

                if (!$fotos_produtos) {
                    $this->form_validation->set_rules('fotos_produtos', 'Imagens do anúncio', 'trim|required');
                }

                if ($this->form_validation->run()) {


                    $data = elements(
                            array(
                                'artigo_titulo',
                                'artigo_preco',
                                'artigo_categoria_pai_id',
                                'artigo_categoria_id',
                                'artigo_publicado',
                                'artigo_situacao',
                                'artigo_localizacao_cep',
                                'artigo_descricao',
                            ), $this->input->post()
                    );

                    /*
                     * Precisamos auditar novamente o anúncio, portanto, deixamos o mesmo não publicado
                     */
                    $data['artigo_publicado'] = 0;


                    /*
                     * Compondo o endereço completo do anúncio a partir dos dados do objeto 'artigo_endereco_sessao' que está na sessão atual,
                     * Mas só fazemos isso se o CEP informado no POST for diferente do existe na base de dados
                     */

                    if ($artigo->artigo_localizacao_cep != $data['artigo_localizacao_cep']) {

                        $artigo_endereco_sessao = $this->session->userdata('artigo_endereco_sessao');

                        $data['artigo_logradouro'] = $artigo_endereco_sessao->logradouro;
                        $data['artigo_bairro'] = $artigo_endereco_sessao->bairro;
                        $data['artigo_cidade'] = $artigo_endereco_sessao->localidade;
                        $data['artigo_estado'] = $artigo_endereco_sessao->uf;

                        /*
                         * Montando os meta links do endereço
                         */
                        $data['artigo_bairro_metalink'] = url_amigavel($data['artigo_bairro']);
                        $data['artigo_cidade_metalink'] = url_amigavel($data['artigo_cidade']);


                        /*
                         * Removemos da sessão o objeto $artigo_endereco_sessao, pois não precisamos mais dele
                         */

                        $this->session->unset_userdata('artigo_endereco_sessao');
                    }

                    if (!$data['artigo_categoria_pai_id']) {
                        unset($data['artigo_categoria_pai_id']);
                    }

                    if (!$data['artigo_categoria_id']) {
                        unset($data['artigo_categoria_id']);
                    }

                    /*
                     * Revomendo a vírgula
                     */
                    $data['artigo_preco'] = str_replace(',', '', $data['artigo_preco']);


                    /*
                     * Atualizamos o anúncio
                     */
                    $this->core_model->update('artigos', $data, array('artigo_id' => $artigo->artigo_id));


                    /*
                     * Deletamos as imagens antigas do anúncio
                     */
                    $this->core_model->delete('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id));


                    $fotos_produtos = $this->input->post('fotos_produtos');


                    /*
                     * Contamos quantas imagens vieram no POST
                     */
                    $total_fotos = count($fotos_produtos);


                    for ($i = 0; $i < $total_fotos; $i++) {

                        $data = array(
                            'foto_artigo_id' => $artigo->artigo_id,
                            'foto_nome' => $fotos_produtos[$i],
                        );

                        $this->core_model->insert('artigos_fotos', $data);
                    }


                    /*
                     * Chegamos no trecho em que enviamos um e-mail informando ao anunciante que seu anúncio foi publicado
                     */



                    /*
                     * Montamos um objeto com todos os dados do anunciante, porque precisamos do e-mail dele
                     */
                    $anunciante = $this->ion_auth->user($artigo->artigo_user_id)->row();

                    /*
                     * Montamos um objeto com todos os dados do website, porque precisamos do e-mail
                     */
                    $sistema = info_header_footer();



                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    $from_email = $sistema->sistema_email;


                    $to_email = $anunciante->email;

                    $this->email->from($from_email, $sistema->sistema_nome_fantasia);

                    $this->email->to($to_email);

                    $this->email->subject('Falta muito pouco para o seu anúncio ser publicado!');
                    $this->email->message('Olá ' . $anunciante->first_name . ' ' . $anunciante->last_name . ', seu anúncio está em análise e muito em breve será publicado!<br>'
                            . 'Assim que isso ocorrer enviaremos um e-mail informando você.<br>'
                            . '<strong>Título do anúncio: </strong>&nbsp;' . $this->input->post('artigo_titulo'));


                    $this->load->library('encryption'); //Evita o envio de span


                    if ($this->email->send(FALSE)) {

                        /*
                         * Sucesso.... o e-mail foi enviado
                         * Não fazemos mais nada aqui
                         */
                    } else {

                        /*
                         * Opss.... não foi possível enviar o e-mail
                         * Então jogamos no flashdata os erros que ocorreram
                         */
                        $this->session->set_flashdata("erro", $this->email->print_debugger('header'));
                    }

                    redirect($this->router->fetch_class() . '/artigos');
                } else {

                    /*
                     * Erros de validação
                     */



                    $data = array(
                        'titulo' => 'Editar anúncio',
                        'styles' => array(
                            'assets/jquery-upload-file/css/uploadfile.css',
                            'assets/select2/select2.min.css',
                        ),
                        'scripts' => array(
                            'assets/sweetalert2/sweetalert2.all.min.js', //Para confirmar a exclusão da imagem no formulário
                            'assets/jquery-upload-file/js/jquery.uploadfile.min.js',
                            'assets/jquery-upload-file/js/artigos.js',
                            'assets/mask/jquery.mask.min.js',
                            'assets/mask/custom.js',
                            'assets/select2/select2.min.js',
                            'assets/js/artigos.js',
                        ),
                        'artigo' => $artigo,
                        'fotos_artigo' => $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id)),
                        'categorias_pai' => $this->artigos_model->get_all_categorias_pai(),
                    );


//                echo '<pre>';
//                print_r($data);
//                exit();

                    $this->load->view('web/layout/header', $data);
                    $this->load->view('web/conta/core');
                    $this->load->view('web/layout/footer');
                }
            }
        }
    }

    public function responder($pergunta_id = null) {

        $pergunta_id = (int) $pergunta_id;


        if (!$pergunta_id || !$pergunta = $this->core_model->get_by_id('artigos_perguntas', array('pergunta_id' => $pergunta_id, 'artigo_user_id' => $this->session->userdata('user_id')))) {


            $this->session->set_flashdata('erro', 'Não encontramos a pergunta ou ela não está associada ao seu anúncio');
            redirect($this->router->fetch_class() . '/perguntas');
        } else {

            /*
             * Maravilha.... pergunta encontrada.... passamos para a validação do formulário
             */


            $this->form_validation->set_rules('resposta', 'Sua resposta', 'trim|required|min_length[4]|max_length[200]');

            if ($this->form_validation->run()) {


                $data = elements(
                        array(
                            'resposta'
                        ), $this->input->post()
                );

                //2020-07-24 22:51:38


                $data['data_resposta'] = date('Y-m-d H:s:i');


                $data['pergunta_respondida'] = 1;


                $data = html_escape($data);

                /*
                 * Atualizamos as tabelas prinpail e histórico 
                 */
                $this->core_model->update('artigos_perguntas', $data, array('pergunta_id' => $pergunta->pergunta_id));

                $this->core_model->update('artigos_perguntas_historico', $data, array('pergunta_id' => $pergunta->pergunta_id));


                /*
                 * Iníncio do envio de e-mail para quem perguntou
                 */


                /*
                 * Montando um objeto com os dados do websiste
                 */
                $sistema = info_header_footer();

                /*
                 * Montando um objeto do anuncinte que fez a pergunta
                 */
                $anunciante_pergunta = $this->ion_auth->user($pergunta->anunciante_pergunta_id)->row();


                /*
                 * Montando um objeto do anúncio
                 */
                $artigo = $this->core_model->get_by_id('artigos', array('artigo_id' => $pergunta->artigo_id));


                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                $from_email = $sistema->sistema_email;


                $to_email = $anunciante_pergunta->email;


                $this->email->from($from_email, $sistema->sistema_nome_fantasia);

                $this->email->to($to_email);

                $this->email->subject('Sua pergunta foi respondida.');
                $this->email->message('Olá ' . $anunciante_pergunta->first_name . ' ' . $anunciante_pergunta->last_name . ', sua pergunta referente ao anúncio <strong>' . $artigo->artigo_titulo . '</strong> foi respondida!<br><br>'
                        . '<strong>Resposta: </strong>&nbsp;' . $this->input->post('resposta') . '<br>'
                        . '<strong>Data: </strong>&nbsp;' . date('d/m/Y H:s:i'));


                $this->load->library('encryption'); //Evita o envio de span


                if ($this->email->send(FALSE)) {

                    /*
                     * Sucesso.... o e-mail foi enviado
                     * Não fazemos mais nada aqui
                     */

                    $this->session->set_flashdata('sucesso', 'A sua resposta foi enviada ao anunciante com sucesso!');
                } else {

                    /*
                     * Opss.... não foi possível enviar o e-mail
                     * Então jogamos no flashdata os erros que ocorreram
                     */
                    $this->session->set_flashdata("erro", $this->email->print_debugger('header'));
                }


                redirect($this->router->fetch_class() . '/perguntas');
            } else {


                /*
                 * Erros de validação
                 */

                $data = array(
                    'titulo' => 'Responder pergunta',
                    'pergunta' => $pergunta
                );

                $this->load->view('web/layout/header', $data);
                $this->load->view('web/conta/responder');
                $this->load->view('web/layout/footer');
            }
        }
    }

    public function visualizar($pergunta_id = null) {

        $pergunta_id = (int) $pergunta_id;


        if (!$pergunta_id || !$pergunta = $this->core_model->get_by_id('artigos_perguntas_historico', array('pergunta_id' => $pergunta_id, 'anunciante_pergunta_id' => $this->session->userdata('user_id')))) {


            $this->session->set_flashdata('erro', 'Não encontramos a pergunta ou ela não está associada ao seu anúncio');
            redirect($this->router->fetch_class() . '/duvidas');
        } else {

            /*
             * Maravilha.... pergunta encontrada.... exibimos a view
             */

            $data = array(
                'titulo' => 'Visualizar a pergunta',
                'pergunta' => $pergunta
            );


//                echo '<pre>';
//                print_r($data);
//                exit();



            $this->load->view('web/layout/header', $data);
            $this->load->view('web/conta/visualizar');
            $this->load->view('web/layout/footer');
        }
    }

    public function valida_cpf($cpf) {

        if ($this->input->post('usuario_id')) {

            /*
             * Editando usuário
             */

            $usuario_id = $this->input->post('usuario_id');

            if ($this->core_model->get_by_id('users', array('id !=' => $usuario_id, 'user_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'O campo {field} já existe, ele deve ser único');
                return FALSE;
            }
        } else {

            /*
             * Cadastrando usuário
             */
            if ($this->core_model->get_by_id('users', array('user_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'O campo {field} já existe, ele deve ser único');
                return FALSE;
            }
        }


        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c); //Se PHP version < 7.4, $cpf{$c}
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) { //Se PHP version < 7.4, $cpf{$c}
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    public function valida_telefone($phone) {


        $usuario_id = $this->input->post('usuario_id');


        if (!$usuario_id) {

            /*
             * Cadastrando
             */

            if ($this->core_model->get_by_id('users', array('phone' => $phone))) {

                $this->form_validation->set_message('valida_telefone', 'Este telefone já existe');

                return false;
            } else {
                return true;
            }
        } else {

            /*
             * Editando
             */

            if ($this->core_model->get_by_id('users', array('phone' => $phone, 'id !=' => $usuario_id))) {

                $this->form_validation->set_message('valida_telefone', 'Este telefone já existe');

                return false;
            } else {
                return true;
            }
        }
    }

    public function valida_email($email) {


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

    public function preenche_endereco() {


        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        }


        $this->form_validation->set_rules('user_cep', 'CEP', 'trim|required|exact_length[9]');

        /*
         * Retornará dados para o javascript usuarios.js
         */
        $retorno = array();

        if ($this->form_validation->run()) {

            /*
             * CEP validado quanto ao seu formato
             * Passamos então para o início da requisição
             */

            /*
             * https://viacep.com.br/ws/01001000/json/
             */

            /*
             * Formatando o cep de acordo com que é definido pela API ViaCep
             */
            $cep = str_replace("-", "", $this->input->post('user_cep'));


            $url = "https://viacep.com.br/ws/";
            $url .= $cep;
            $url .= "/json/";

            $cr = curl_init();

            /*
             * Definino a URL de busca (requisição)
             */
            curl_setopt($cr, CURLOPT_URL, $url);



            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);


            $resultado_requisicao = curl_exec($cr);


            curl_close($cr);

            /*
             * Tranformando o resultado em um objeto para facilitar o acesso aos seus atributos
             */
            $resultado_requisicao = json_decode($resultado_requisicao);


            /*
             * Verificamos se o CEP informado é existente,
             * Caso não existe, retornamos para o javascript que o CEP é inválido
             * Caso CEP seja existente, retornamos as informações do endereço
             */
            if (isset($resultado_requisicao->erro)) {

                $retorno['erro'] = 3;
                $retorno['user_cep'] = 'Informe um CEP válido';
                $retorno['mensagem'] = 'Informe um CEP válido';
            } else {

                /*
                 * Sucesso na requisição..... O CEP existe na base do ViaCep
                 */

                $retorno['erro'] = 0;
                $retorno['user_endereco'] = $resultado_requisicao->logradouro;
                $retorno['user_bairro'] = $resultado_requisicao->bairro;
                $retorno['user_cidade'] = $resultado_requisicao->localidade;
                $retorno['user_estado'] = $resultado_requisicao->uf;
                $retorno['mensagem'] = 'Cep encontrado';
            }
        } else {

            /*
             * Erros de validação
             */
            $retorno['erro'] = 3;
            $retorno['user_cep'] = form_error('user_cep', '<div class="text-danger">', '</div>');
            $retorno['mensagem'] = validation_errors();
        }

        /*
         * Retorno o dados contidos no $retorno
         */

        echo json_encode($retorno);
    }

    public function upload_file() {


        $mensagem_upload = "Imagem com no máximo 500 x 500 pixels<br>e no mínimo 350 x 340 pixels";

        $this->session->set_userdata('mensagem_upload', $mensagem_upload);

        $config['upload_path'] = './uploads/usuarios/';
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
        $config['encrypt_name'] = true;
        $config['max_size'] = 1048; //Max 1M
        $config['max_width'] = 500;
        $config['max_height'] = 500;
        $config['min_width'] = 350;
        $config['min_height'] = 340;

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


            /*
             * Criando um cópia da imagem um pouco menor (resize)
             */

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/usuarios/' . $this->upload->data('file_name');
            $config['new_image'] = './uploads/usuarios/small/' . $this->upload->data('file_name');
            $config['width'] = 300;
            $config['height'] = 280;

            $this->load->library('image_lib', $config);

            /*
             * Verificamos se houve erro no resize
             */
            if (!$this->image_lib->resize()) {

                $data['erro'] = 3;
                $data['mensagem'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');
            }
        } else {


            /*
             * Erros no upload da imagem
             */

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);
    }

    /*
     * Função que exclui o anúncio da base de dados
     */

    public function delete($artigo_id = null) {

        $artigo_id = (int) $artigo_id;


        if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
            $this->session->set_flashdata('erro', 'Anúncio não encontrado');
            redirect($this->router->fetch_class() . '/artigos');
        }


        /*
         * Garantimos que o anunciante só possa excluir um anúncio que seja seu
         */
        if ($artigo->artigo_user_id != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('erro', 'Este anúncio não está atribuído à sua conta de anunciante.');
            redirect($this->router->fetch_class() . '/artigos');
        }


        /*
         * Recuperamos todas as imagens do anúncio
         */
        $fotos_artigo = $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id));


        /*
         * Excluo o anúncio
         */
        $this->core_model->delete('artigos', array('artigo_id' => $artigo->artigo_id));


        /*
         * Excluindo as imagens
         */
        if ($fotos_artigo) {

            foreach ($fotos_artigo as $foto) {

                $foto_grande = FCPATH . 'uploads/artigos/' . $foto->foto_nome;
                $foto_pequena = FCPATH . 'uploads/artigos/small/' . $foto->foto_nome;


                if (file_exists($foto_grande)) {
                    unlink($foto_grande);
                }

                if (file_exists($foto_pequena)) {
                    unlink($foto_pequena);
                }
            }
        }

        redirect($this->router->fetch_class() . '/artigos');
    }

    /*
     * Método que exclui uma pergunta da tabela 'artigos_perguntas', mas a tabela de histórico permanecerá íntegra
     */

    public function remove($pergunta_id = null) {


        $pergunta_id = (int) $pergunta_id;



        if (!$pergunta_id || !$pergunta = $this->core_model->get_by_id('artigos_perguntas', array('pergunta_id' => $pergunta_id, 'artigo_user_id' => $this->session->userdata('user_id')))) {

            $this->session->set_flashdata('erro', 'Não encontramos a pergunta ou ela não está associada ao seu anúncio');
            redirect($this->router->fetch_class() . '/perguntas');
        }


        if ($pergunta->pergunta_respondida == 0) {

            $this->session->set_flashdata('erro', 'Você não pode excluir um pergunta que ainda não foi respondida');
            redirect($this->router->fetch_class() . '/perguntas');
        }


        $this->core_model->delete('artigos_perguntas', array('pergunta_id' => $pergunta->pergunta_id));
        $this->session->set_flashdata('sucesso', 'A pergunta foi excluída da sua área do anunciante. No entanto, ela continuará sendo exibida nas perguntas do anúncio.');
        redirect($this->router->fetch_class() . '/perguntas');
    }

}
