<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Menu_principal_model extends CI_Model {
   
   
    public function get_all() {

        $this->db->select([
            'paginas_menu.*',
        ]);

        $this->db->where('men_status', 1);
		$this->db->order_by('men_ordem', 'asc');

        return $this->db->get('paginas_menu')->result();
    }

	public function get_all_submenu($men_id = null) {

        $this->db->select([
            'paginas.*',
        ]);

        $this->db->where('pag_status', 1);
		$this->db->where('pag_menu_id', $men_id);
		$this->db->where('pag_nivel_1', 1);
		$this->db->order_by('pag_ordem', 'asc');

        return $this->db->get('paginas')->result();
    }

	public function get_all_submenu_2($men_id = null) {

        $this->db->select([
            'paginas.*',
        ]);

        $this->db->where('pag_status', 1);
		$this->db->where('pag_pai', $men_id);
		$this->db->where('pag_nivel_1', 2);
		$this->db->order_by('pag_ordem', 'asc');

        return $this->db->get('paginas')->result();
    }

	public function get_all_submenu_3($men_id = null) {

        $this->db->select([
            'paginas.*',
        ]);

        $this->db->where('pag_status', 1);
		$this->db->where('pag_pai_2', $men_id);
		$this->db->where('pag_nivel_1', 3);
		$this->db->order_by('pag_ordem', 'asc');

        return $this->db->get('paginas')->result();
    }

	public function get_pagina_url($url = null){
        $this->db->select([
            'paginas.*',
			'paginas_nivel2.*'
        ]);

        $this->db->join('paginas_nivel2', 'paginas_nivel2.cont_pagina_id = paginas.pag_id', 'left');

        if($url){
            $this->db->where('pag_link', $url);
        }

        return $this->db->get('paginas')->row();
    }

	public function get_pagina_url_array($condicoes = null){
        $this->db->select([
            'paginas.*',
			'paginas_nivel2.*'
        ]);

        $this->db->join('paginas_nivel2', 'paginas_nivel2.cont_pagina_id = paginas.pag_id', 'left');

        if($condicoes){
            $this->db->where($condicoes);
        }

        return $this->db->get('paginas')->row();
    }



}
