<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Banners_cta_model extends CI_Model {
   
   
    public function get_do_artigo($condicoes = null) {

        $this->db->select([
            'artigos_banner_cta.*',
            'banners_site.*',
        ]);


        if (is_array($condicoes)) {

            $this->db->where($condicoes);
        }

        $this->db->join('artigos_banner_cta', 'artigos_banner_cta.aux_cta_codigo = banners_site.banner_id');

        return $this->db->get('banners_site')->result();
    }

    public function get_all($condicoes = null) {

        $this->db->select([
            'banners_cta.*',
        ]);


        if (is_array($condicoes)) {

            $this->db->where($condicoes);
        }

        return $this->db->get('banners_cta')->result();
    }

    public function get_all_array($condicoes = null) {

        $this->db->select([
            'banners_site.*',
        ]);

        foreach($condicoes as $cond){
            $this->db->where('banner_id !=', $cond->aux_cta_codigo);
        }

        return $this->db->get('banners_site')->result();
    }

}
