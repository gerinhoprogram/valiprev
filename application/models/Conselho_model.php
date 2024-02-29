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

	public function get_all_atas() {


        $this->db->select([
            'atas.*',
			'paginas.*'
        ]);

        $this->db->join('paginas', 'paginas.pag_id = atas.ata_pagina_id');

        return $this->db->get('atas')->result();
    }

	public function get_all_mandatos() {


        $this->db->select([
            'mandatos.*',
			'paginas.*'
        ]);

        $this->db->join('paginas', 'paginas.pag_id = mandatos.man_pagina_id');

        return $this->db->get('mandatos')->result();
    }

}
