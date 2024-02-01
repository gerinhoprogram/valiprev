<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Artigos_model extends CI_Model {
      
    public function get_all($user_id = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.*',
            'users.id',
            'artigos_fotos.foto_nome',
            'users.first_name as nome_anunciante',
        ]);

        if ($user_id) {

            $this->db->where('artigos.artigo_user_id', $user_id);
        }

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');
        $this->db->order_by('artigos.artigo_id DESC');
        $this->db->group_by('artigos.artigo_id');

        return $this->db->get('artigos')->result();
    }

    public function get_mais_lidas($limit = null) {

        $this->db->select([
            'mais_visitadas.*',
            'artigos.artigo_titulo',
            'artigos.artigo_url',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_meta_link',
            'users.first_name',
            'count(visita_artigo_id) as qtd'
        ]);

        $this->db->join('artigos', 'artigos.artigo_id = mais_visitadas.visita_artigo_id');
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');

        $this->db->group_by('mais_visitadas.visita_artigo_id');
        $this->db->order_by('qtd', 'desc') ;
        $this->db->limit($limit);
        

        return $this->db->get('mais_visitadas')->result();
    }

    /*
     * Exibe na Home todos os anúncios publicados de forma randômica
     */

    public function get_all_artigos_random($condicoes = null, $limite = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_meta_link',
            'artigos_fotos.foto_nome',
            'users.id'
        ]);

        $this->db->where($condicoes);


        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');

        $this->db->order_by('artigos.artigo_id', 'RANDOM');
        $this->db->group_by('artigos.artigo_id');

        if($limite){
            $this->db->limit($limite);
        }

        return $this->db->get('artigos')->result();
    }

    // home web
    public function get_all_artigos_home($condicoes = null, $limite = null, $limite2 = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_meta_link',
            'categorias_pai.categoria_pai_classe_icone',
            'users.first_name',
            'artigos_fotos.foto_nome',
        ]);

        $this->db->where($condicoes);
        $this->db->where('foto_principal', 1);

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
        
        $this->db->group_by('artigos.artigo_id');
        
        $this->db->order_by('artigos.artigo_id', 'DESC');


        if($limite){
            if($limite2){
                $this->db->limit($limite, $limite2);
            }else{
                $this->db->limit($limite);
            }
           
        }
        
        return $this->db->get('artigos')->result();
    }


    // home web
    public function get_all_artigo_destaque($condicoes = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_meta_link',
            'categorias_pai.categoria_pai_classe_icone',
            'users.first_name',
            'artigos_fotos.foto_nome',
        ]);

        $this->db->where($condicoes);

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');

        $this->db->group_by('artigos.artigo_id');

        $this->db->limit(1);
        
        return $this->db->get('artigos')->row();
    }

    // restrita artigos / web detalhes
    public function get_all_artigos_semelhantes($condicoes = null) {

        $this->db->select([
            'artigos_semelhantes.*',
            'artigos.artigo_titulo',
            'artigos.artigo_url',
            'artigos_fotos.foto_nome',
            'artigos.artigo_id'
        ]);
    
        $this->db->where($condicoes);

        $this->db->join('artigos', 'artigos.artigo_id = artigos_semelhantes.artigo_id_semelhante', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos_semelhantes.artigo_id_semelhante', 'LEFT');
        $this->db->group_by('artigos.artigo_id');

        return $this->db->get('artigos_semelhantes')->result();
    }

    public function get_all_artigos_seo($condicoes = null) {

        $this->db->select([
            'artigo_palavras_seo.*',
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }

        $this->db->join('artigos', 'artigos.artigo_id = artigo_palavras_seo.seo_artigo_id', 'LEFT');

        return $this->db->get('artigo_palavras_seo')->result();
    }

    public function get_all_seo() {

        $this->db->select([
            'artigo_palavras_seo.*',
        ]);

        $this->db->join('artigos', 'artigos.artigo_id = artigo_palavras_seo.seo_artigo_id', 'LEFT');
        $this->db->group_by('seo_palavra');
        $this->db->order_by('seo_artigo_id', 'RANDOM');
        $this->db->limit(15);

        return $this->db->get('artigo_palavras_seo')->result();
    }

    public function get_all_artigos_semelhantes_2($condicoes = null) {

        $this->db->select([
            'artigos_semelhantes.*',
            'artigos.artigo_titulo',
            'artigos.artigo_url',
            'artigos_fotos.foto_nome',
        ]);
    
        $this->db->where($condicoes);

        $this->db->join('artigos', 'artigos.artigo_id = artigos_semelhantes.artigo_id_semelhante', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos_semelhantes.artigo_id_semelhante', 'LEFT');
        $this->db->group_by('artigos_semelhantes.artigo_id');

        return $this->db->get('artigos_semelhantes')->result();
    }

    // restrita artigos
    public function get_all_artigos_diferentes($condicoes = null) {

        $this->db->select([
            'artigos.artigo_titulo',
            'artigos.artigo_id'
        ]);
    
        foreach($condicoes as $cond){
            $this->db->where('artigos.artigo_id !=', $cond->artigo_id_semelhante);
        }

        $this->db->where('artigos.artigo_publicado', 1);

        return $this->db->get('artigos')->result();
    }

    public function get_by_id($condicoes = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_id',
            'categorias_pai.categoria_pai_meta_link',
            'categorias_pai.categoria_pai_classe_icone',
            'categorias_pai.categoria_pai_cor',
            'users.id',
            'users.first_name as nome_anunciante',
        ]);


        if (is_array($condicoes)) {

            $this->db->where($condicoes);
        }
        
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id');
        $this->db->join('users', 'users.id = artigos.artigo_user_id');

        return $this->db->get('artigos')->row();
    }



    // area restrita home / core categorias pai
    public function get_all_categorias_pai($condicoes = null) {

        $this->db->select([
            'categorias_pai.*',
            'COUNT(artigo_categoria_pai_id) as quantidade_artigos'
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }

        $this->db->join('artigos', 'artigos.artigo_categoria_pai_id = categorias_pai.categoria_pai_id', 'left');

        $this->db->group_by('categoria_pai_nome', 'ASC');

        return $this->db->get('categorias_pai')->result();
    }

    public function get_all_categorias_pai_artigos($condicoes = null) {

        $this->db->select([
            'categorias_pai.*',
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }

        $this->db->join('categorias', 'categorias.categoria_pai_id = categorias_pai.categoria_pai_id', 'left');

        $this->db->group_by('categoria_pai_nome', 'ASC');

        return $this->db->get('categorias_pai')->result();
    }

    

    public function get_all_categorias_pai_home($limite = null) {


        $this->db->select([
            'categorias_pai.*',
            'COUNT(categoria_pai_id) as quantidade_artigos'
        ]);

        $this->db->where('categoria_pai_ativa', 1);
        $this->db->where('artigos.artigo_publicado', 1);

        $this->db->join('artigos', 'artigos.artigo_categoria_pai_id = categorias_pai.categoria_pai_id');

        $this->db->group_by('categoria_pai_nome', 'ASC');
        //$this->db->order_by('categoria_pai_id', 'RANDOM');

        if($limite){
            $this->db->limit($limite);
        }


        return $this->db->get('categorias_pai')->result();
    }

  

    public function get_categorias_filhas_navbar() {

        $this->db->select([
            'categorias.*',
        ]);

        $this->db->where('categoria_ativa', 1);
        $this->db->where('artigos.artigo_publicado', 1);

        $this->db->limit(6);

        $this->db->join('artigos', 'artigos.artigo_categoria_id = categorias.categoria_id');

        $this->db->order_by('categoria_id', 'RANDOM');

        return $this->db->get('categorias')->result();
    }

    // web categorias
    public function get_categorias_filhas() {

        $this->db->select([
            'categorias.*',
            'categorias_pai.categoria_pai_cor',
            'categorias_pai.categoria_pai_classe_icone'
        ]);

        $this->db->where('categoria_ativa', 1);

        $this->db->join('categorias_pai', 'categorias_pai.categoria_Pai_id = categorias.categoria_pai_id');
        $this->db->join('aux_categoria_artigos', 'aux_categoria_artigos.ca_id_subcategoria = categorias.categoria_id');

        $this->db->group_by('categorias.categoria_id');
        $this->db->limit(10);

        return $this->db->get('categorias')->result();
    }

    /*
     * Método que retorna os anúncios por Estado, Cidade, Bairro ou Categoria
     */

    public function get_all_by($condicoes = null) {


        if (is_array($condicoes)) {

            $this->db->select([
                'artigos.*',
                'categorias_pai.categoria_pai_nome',
                'categorias_pai.categoria_pai_meta_link',
                'categorias_pai.categoria_pai_classe_icone',
                'artigos_fotos.foto_nome',
                'users.id',
                'users.first_name',
            ]);


            $this->db->where('artigos.artigo_publicado', 1);

            $this->db->where($condicoes);

            $this->db->group_by('artigos.artigo_id');

            $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
            $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
            $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');

            return $this->db->get('artigos')->result();
        }
    }

    public function get_all_seo_by($condicoes = null) {


        if (is_array($condicoes)) {

            $this->db->select([
                'artigos.*',
                'categorias_pai.categoria_pai_nome',
                'categorias_pai.categoria_pai_meta_link',
                'categorias_pai.categoria_pai_classe_icone',
                'artigos_fotos.foto_nome',
                'users.id',
                'users.first_name',
                'seo_palavra'
            ]);


            $this->db->where('artigos.artigo_publicado', 1);

            $this->db->where($condicoes);

            $this->db->group_by('artigos.artigo_id');

            $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
            $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
            $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');
            $this->db->join('artigo_palavras_seo', 'seo_artigo_id = artigos.artigo_id', 'LEFT');

            return $this->db->get('artigos')->result();
        }
    }

    /*
     * Recuperamos os anúncios de acordo com o termo digitado no input busca da navbar
     */

    public function get_all_by_busca($busca = null) {

        $this->db->select([
            'artigos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias_pai.categoria_pai_meta_link',
            'users.id',
            'users.first_name',
            'artigos_fotos.foto_nome',
        ]);


        //$this->db->like('artigos.artigo_titulo', $busca, 'BOTH');

        $this->db->where('artigos.artigo_publicado', 1);
        $this->db->where('categorias_pai.categoria_pai_ativa', 1);
        $this->db->where("artigos.artigo_titulo like '%$busca%' or artigos.artigo_descricao like '%$busca%'");
       

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = artigos.artigo_categoria_pai_id', 'LEFT');
        $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id', 'LEFT');
        $this->db->join('users', 'users.id = artigos.artigo_user_id', 'LEFT');


        $this->db->group_by('artigos.artigo_id');

        return $this->db->get('artigos')->result();
    }

    /*
     * Recuperamos da tabela de histórico todas as perguntas do anúncio que está sendo detalhado no controller Detalhes
     */

    public function get_perguntas_artigo_historico($condicoes = null) {

        if (is_array($condicoes)) {


            $this->db->select([
                'artigos_perguntas_historico.*',
                'artigos.artigo_titulo',
                'artigos_fotos.foto_nome',
                'users.user_foto',
                'users.id as anunciante_id',
                'users.first_name as nome_anunciante_pergunta'
            ]);


            $this->db->where($condicoes);


            $this->db->join('artigos', 'artigos.artigo_id = artigos_perguntas_historico.artigo_id');
            $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id');
            $this->db->join('users', 'users.id = artigos_perguntas_historico.anunciante_pergunta_id');

            $this->db->order_by('artigos_perguntas_historico.data_pergunta', 'DESC');


            $this->db->group_by('artigos_perguntas_historico.pergunta');

            return $this->db->get('artigos_perguntas_historico')->result();
        } else {
            return false;
        }
    }

}
