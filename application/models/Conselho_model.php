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

	public function get_prefeito($tipo = null, $man_id = null) {


        $this->db->select([
            'mandatos_membros.*',
        ]);

        $this->db->where('membros_tipo', $tipo);
		$this->db->where('membros_mandato_id', $man_id);
		$this->db->where('membros_eleitos', 'Indicado livremente pelo Prefeito Municipal');
		$this->db->order_by('membros_ordem', 'asc');

        return $this->db->get('mandatos_membros')->result();
    }

	public function get_servidores($tipo = null, $man_id = null) {


        $this->db->select([
            'mandatos_membros.*',
        ]);

        $this->db->where('membros_tipo', $tipo);
		$this->db->where('membros_mandato_id', $man_id);
		$this->db->where('membros_eleitos', 'Eleito pelos servidores municipais efetivos ativos e inativos');
		$this->db->order_by('membros_ordem', 'asc');

        return $this->db->get('mandatos_membros')->result();
    }

}
