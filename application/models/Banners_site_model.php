<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Banners_site_model extends CI_Model{

    public function get_all($condicoes = null, $posicao = null) {

        if (is_array($condicoes)) {

            $this->db->select([
                'banners_site.banner_imagem',
                'banners_site.banner_url',
                'banners_site.banner_id',
                'primario',
                'secundario'
            ]);

            $this->db->where($condicoes);

            if($posicao == 1){
                $this->db->join('banners_posicoes', 'primario = banners_site.banner_id');
            }else{
                $this->db->join('banners_posicoes', 'secundario = banners_site.banner_id');
            }

            return $this->db->get('banners_site')->row();
        }
    }

    public function get_all_posicao($posicao) {

            $this->db->select([
                'banners_site.*',
                'primario',
                'secundario'
            ]);

            if($posicao == 1){
                $this->db->join('banners_posicoes', 'primario = banners_site.banner_id', 'left');
            }else{
                $this->db->join('banners_posicoes', 'secundario = banners_site.banner_id', 'left');
            }

            $this->db->group_by('banner_id');

            return $this->db->get('banners_site')->result();
        }


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

}
