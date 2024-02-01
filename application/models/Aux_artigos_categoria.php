<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Aux_artigos_categoria extends CI_Model{

    // restrita home / web home
    public function get_all($group = null){
        $this->db->select([
            'aux_categoria_artigos.*',
            'categorias.categoria_nome',
            'categorias.categoria_meta_link'
        ]);

        $this->db->join('categorias', 'categoria_id = aux_categoria_artigos.ca_id_subcategoria', 'left');

        if($group){
            $this->db->group_by($group);
        }

        return $this->db->get('aux_categoria_artigos')->result();
    }

    public function get_all_ativa(){
        $this->db->select([
            'aux_categoria_artigos.*',
            'categorias.categoria_nome',
            'categorias.categoria_meta_link',
            'categorias.categoria_ativa'
        ]);

        $this->db->join('categorias', 'categoria_id = aux_categoria_artigos.ca_id_subcategoria', 'left');

        $this->db->where('categoria_ativa', 1);

        return $this->db->get('aux_categoria_artigos')->result();
    }

    public function get_all_by_id($prod_id = null){
        $this->db->select([
            'aux_categoria_produtos.*',
            'cadastro_subcategorias.scat_titulo',
            'cadastro_categorias.cat_titulo',
        ]);

        $this->db->where('cp_produto', $prod_id);
        $this->db->join('cadastro_subcategorias', 'scat_id = cp_subcategoria', 'left');
        $this->db->join('cadastro_categorias', 'cat_id = cp_categoria', 'left');

        return $this->db->get('aux_categoria_produtos')->result();
    }

    public function get_all_categorias_do_artigo($condicoes = null) {

        $this->db->select([
            'aux_categoria_artigos.*',
            'categorias.*',
        ]);

        if (is_array($condicoes)) {

            $this->db->where($condicoes);
        }

        $this->db->join('categorias', 'categorias.categoria_id = aux_categoria_artigos.ca_id_subcategoria');

        return $this->db->get('aux_categoria_artigos')->result();
    }

    public function get_all_categorias_do_artigo_array($condicoes = null) {

        $this->db->select([
            'categorias.*',
        ]);

        foreach($condicoes as $cond){
            $this->db->where('categoria_id != ', $cond->categoria_id);
        }

        return $this->db->get('categorias')->result();
    }

    public function get_all_by($condicoes = null) {


        if (is_array($condicoes)) {

            $this->db->select([
                'aux_categoria_artigos.*',
                'artigos.*',
                'categorias.*',
                'categorias_pai.*',
                'artigos_fotos.foto_nome',
                'users.id',
                'users.first_name',
            ]);

            $this->db->join('artigos', 'artigos.artigo_id = aux_categoria_artigos.ca_id_artigo');
            $this->db->join('categorias', 'categorias.categoria_id = aux_categoria_artigos.ca_id_subcategoria');
            $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = aux_categoria_artigos.ca_id_categoria');
            $this->db->join('artigos_fotos', 'artigos_fotos.foto_artigo_id = artigos.artigo_id');
            $this->db->join('users', 'users.id = artigos.artigo_user_id');

            $this->db->where('artigos.artigo_publicado', 1);

            $this->db->where($condicoes);

            $this->db->group_by('artigos.artigo_id');

            return $this->db->get('aux_categoria_artigos')->result();
        }
    }

    // 
    public function get_all_categorias_count($condicoes = null) {

        $this->db->select([
            'aux_categoria_artigos.*',
            'COUNT(ca_id_subcategoria) as quantidade_artigos'
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }

        return $this->db->get('aux_categoria_artigos')->result();
    }

}