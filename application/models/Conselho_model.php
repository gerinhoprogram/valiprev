<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Conselho_model extends CI_Model {

    public function get_all_conselheiros() {


        $this->db->select([
            'conselheiros.*',
			'paginas.*'
        ]);

        $this->db->join('paginas', 'paginas.pag_id = conselheiros.con_pagina_id');

        return $this->db->get('conselheiros')->result();
    }

	public function get_all_regimentos() {


        $this->db->select([
            'regimentos_internos.*',
			'paginas.*'
        ]);

        $this->db->join('paginas', 'paginas.pag_id = regimentos_internos.reg_pagina_id');

        return $this->db->get('regimentos_internos')->result();
    }

}
