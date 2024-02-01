<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias_model extends CI_Model {

    public function get_all_categorias() {


        $this->db->select([
            'categorias.*',
            'categorias_pai.categoria_pai_nome',
        ]);

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id');

        $this->db->order_by('categorias.categoria_id', 'DESC');

        return $this->db->get('categorias')->result();
    }

    public function get_all_icones() {


        $this->db->select([
            'icones.*',
        ]);

        $this->db->group_by('icone_nome');

        $this->db->order_by('icone_id', 'DESC');

        return $this->db->get('icones')->result();
    }


    public function get_all_categorias_id($cat_pai = null) {


        $this->db->select([
            'categorias.*',
        ]);

        $this->db->where('categoria_pai_id', $cat_pai);

        return $this->db->get('categorias')->result();
    }

}
