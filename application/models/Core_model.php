<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Core_model extends CI_Model {

    public function get_all($tabela = null, $condicoes = null, $limite = null) {


        if ($tabela && $this->db->table_exists($tabela)) {

            if (is_array($condicoes)) {

                $this->db->where($condicoes);
            }

            if ($limite) {
                $this->db->limit($limite);
            }


            $this->db->order_by(1, 'DESC');

            return $this->db->get($tabela)->result();
        } else {
            return false;
        }
    }

	public function get_all_group_by($tabela = null, $condicoes = null, $grupo = null) {


        if ($tabela && $this->db->table_exists($tabela)) {

            if (is_array($condicoes)) {

                $this->db->where($condicoes);
            }

			$this->db->group_by($grupo);

            $this->db->order_by('pdf_ano', 'DESC');

            return $this->db->get($tabela)->result();
        } else {
            return false;
        }
    }

	public function get_all_asc($tabela = null, $condicoes = null, $limite = null) {


        if ($tabela && $this->db->table_exists($tabela)) {

            if (is_array($condicoes)) {

                $this->db->where($condicoes);
            }

            if ($limite) {
                $this->db->limit($limite);
            }


            $this->db->order_by(1, 'ASC');

            return $this->db->get($tabela)->result();
        } else {
            return false;
        }
    }

    public function insert_login($tabela = null, $data = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($data)) {

            $this->db->insert($tabela, $data);

        } else {
            return false;
        }
    }

    public function get_all_id($tabela = null) {


        $this->db->select([
            'banners_cta.cta_id',
        ]);

        return $this->db->get($tabela)->result();
    }


    public function get_by_id($tabela = null, $condicoes = null) {


        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)) {

            $this->db->where($condicoes);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();
        } else {
            return false;
        }
    }

    public function insert($tabela = null, $data = null, $get_last_id = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($data)) {


            $this->db->insert($tabela, $data);


            /*
             * Se $get_last_id veio como parâmetro, então será inserido na sessão o último ID criado banco de dados da $tabela
             */
            if ($get_last_id) {

                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                return $this->db->last_query();
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados');
            }
        } else {
            return false;
        }
    }

    public function update($tabela = null, $data = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)) {

            if ($this->db->update($tabela, $data, $condicoes)) {
                
                    $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                    return $this->db->last_query();
                
            } else {
                
                    $this->session->set_flashdata('erro', 'Não foi possível salvar os dados');
                
                
            }
        } else {
            return false;
        }
    }

    
    public function update_token($tabela = null, $data = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)) {

            if ($this->db->update($tabela, $data, $condicoes)) {
               
                
            } else {
                
                
            }
        } else {
            return false;
        }
    }

    public function update_ajax($tabela = null, $data = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)) {

            if ($this->db->update($tabela, $data, $condicoes)) {
                
                return true;
                
            } else {
                
                return false;
                
            }
        } else {
            return false;
        }
    }

    public function delete($tabela = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)) {

            if ($this->db->delete($tabela, $condicoes)) {
                
                    $this->session->set_flashdata('sucesso', 'Registro excluído com sucesso');
                    return $this->db->last_query();
            } else {
                
                    $this->session->set_flashdata('erro', 'Não foi possível excluir o registro');
                
            }
        } else {
            return false;
        }
    }

    public function delete_msn($tabela = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)) {

            if ($this->db->delete($tabela, $condicoes)) {
                
                return true;
                
            } else {
                
                return false;
                
            }
        } else {
            return false;
        }
    }

    public function delete2($tabela = null) {

        if ($tabela && $this->db->table_exists($tabela)) {

            $this->db->delete($tabela);


            if ($this->db->affected_rows() > 0) {
            } else {
            }
        } else {
            return false;
        }
    }

    public function generate_unique_code($tabela = null, $tipo_codigo = null, $tamanho_codigo = null, $campo_procura = null) {


        do {

            $codigo = random_string($tipo_codigo, $tamanho_codigo);
            $this->db->where($campo_procura, $codigo);
            $this->db->from($tabela);
        } while ($this->db->count_all_results() >= 1);

        return $codigo;
    }

    public function count_all_results($tabela = null, $condicoes = null) {

        if ($tabela && $this->db->table_exists($tabela)) {

            if (is_array($condicoes)) {

                $this->db->where($condicoes);
            }

            return $this->db->count_all_results($tabela);
        } else {
            return false;
        }
    }

	public function get_all_by_busca($busca = null) {

        $this->db->select([
            'paginas.*',
        ]);


        //$this->db->like('artigos.artigo_titulo', $busca, 'BOTH');

        $this->db->where("paginas.pag_nome like '%$busca%'");

        return $this->db->get('paginas')->result();
    }


	public function get_busca($busca = null) {

        $this->db->select([
            'paginas.*',
			'paginas_nivel2.*',
			'paginas_menu.*'
        ]);


        //$this->db->like('paginas.pag_nome', $busca, 'BOTH');
		$this->db->join('paginas_nivel2', 'paginas_nivel2.cont_pagina_id = paginas.pag_id', 'left');
		$this->db->join('paginas_menu', 'paginas_menu.men_id = paginas.pag_menu_id', 'left');

        $this->db->where("paginas.pag_nome like '%$busca%' or paginas_nivel2.cont_texto like '%$busca%'");

        return $this->db->get('paginas')->result();
    }

}
