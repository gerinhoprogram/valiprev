<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('banners_cta_model');
        $this->load->model('aux_artigos_categoria');

    }

    public function index($artigo_url = null) {


        if (!$artigo_url || !$artigo = $this->artigos_model->get_by_id(array('artigo_url' => $artigo_url))) {
            redirect('/');
        } else {

            $this->session->set_userdata('artigo_detalhado', $artigo);

            $data = array(
                'titulo' => $artigo->artigo_titulo,
                'pag_detalhe' => true,
                'artigo' => $artigo,
                'carousel_home' => false,
                'categorias' => $this->aux_artigos_categoria->get_all_categorias_do_artigo(array('aux_categoria_artigos.ca_id_artigo' => $artigo->artigo_id)),
                'artigo_user' => $artigo,
                'foto_principal' => $this->core_model->get_by_id('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id, 'foto_principal' => 1)),
                'artigos_semelhantes' => $this->artigos_model->get_all_artigos_semelhantes(array('artigos_semelhantes.artigo_id' => $artigo->artigo_id, 'artigos.artigo_publicado' => 1)),
                'artigos_fotos' => $this->core_model->get_all('artigos_fotos', array('foto_artigo_id' => $artigo->artigo_id)),
                'todos_artigos_anunciante' => $this->artigos_model->get_all_artigos_random(array('artigos.artigo_user_id' => $artigo->artigo_user_id), 5), //Recuperando todos Artigo do dono do Artigo que está sendo detalhado
                'banners' => $this->banners_site_model->get_do_artigo(array('aux_artigo_id' => $artigo->artigo_id)),
                'tags_seo' => $this->core_model->get_all('artigo_palavras_seo', array('seo_artigo_id' => $artigo->artigo_id)),
            );

            $this->session->set_userdata('url_anterior', current_url());

            $this->load->view('web/layout/header', $data);
            $this->load->view('web/detalhes/index');
            $this->load->view('web/layout/footer');
        }
    }

    public function perguntar($artigo_id = null) {


        $artigo_id = (int) $artigo_id;

        /*
         * Só permitiremos que sejam feitas perguntas se estiver logado
         */
        if (!$this->ion_auth->logged_in()) {

            /*
             * Recuperamos o que veio no POST no name pergunta antes de ser feito o login,
             * E setamos na sessão para quando o visitante realizar o login redirecionarmos para o formulário da pergunta, carregando no input 
             * a pergunta anterior
             */
            $pergunta = $this->input->post('pergunta');
            $this->session->set_userdata('pergunta', $pergunta);

            redirect('login');
        }

        /*
         * Maravilha.... anunciante/visitante está logado... damos sequência
         */

        if (!$artigo_id || !$artigo = $this->artigos_model->get_by_id(array('artigo_id' => $artigo_id))) {
            redirect($this->session->userdata('url_anterior'));
        } else {

            /*
             * Maravilha.... Artigo existe
             */


            /*
             * Não permitiremos que o dono do Artigo faça perguntas para ele mesmo
             */
            if ($artigo->artigo_user_id == $this->session->userdata('user_id')) {
                $this->session->set_flashdata('erro_pergunta', 'Você não pode fazer uma pergunta para o seu Artigo');
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            }


            /*
             * Chegou a hora de validar o formulário
             */


            $this->form_validation->set_rules('pergunta', 'Pergunta', 'trim|required|min_length[4]|max_length[200]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'pergunta'
                        ), $this->input->post()
                );

                $data['artigo_id'] = $artigo->artigo_id;
                $data['artigo_user_id'] = $artigo->id;
                $data['anunciante_pergunta_id '] = $this->session->userdata('user_id');

                $data = html_escape($data);

                /*
                 * Inserimos na tabela principal
                 */
                $this->core_model->insert('artigos_perguntas', $data);


                /*
                 * Inserimos na tabela de histórico
                 */
                $this->core_model->insert('artigos_perguntas_historico', $data);


                /*
                 * Removemos da sessão a pergunta anterior (antes do login), pois não precisamos mais dela
                 */
                $this->session->unset_userdata('pergunta');


                $this->session->set_flashdata('sucesso_pergunta', 'Sua pergunta foi enviada para o anunciante. Você será notificado por e-mail quando ela for respondida');
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            } else {


                /*
                 * Erros de validação
                 */

                $this->session->set_flashdata('erro_pergunta', validation_errors());
                redirect($this->session->userdata('url_anterior') . '#pergunta');
            }
        }
    }

}
