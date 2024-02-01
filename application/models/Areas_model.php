<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Areas_model extends CI_Model{
    

    public function get_all($condicoes = null){
        $this->db->select([
            'areas_acessos.*',
            'areas.area_nome',
            'areas.area_id as id_area',
            'areas.area_url'
        ]);

        $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');

        if($condicoes){
            $this->db->where($condicoes);
        }

        return $this->db->get('areas_acessos')->result();
    }

    

    public function get_by_area($condicoes = null){
        $this->db->select([
            'areas_acessos.*',
            'areas.area_nome',
            'areas.area_id as id_area',
            'areas.area_url'
        ]);

        $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');

        if($condicoes){
            $this->db->where($condicoes);
        }

        $this->db->where('permissao', 1);

        return $this->db->get('areas_acessos')->row();
    }

    public function get_all_areas($condicoes = null){
        $this->db->select([
            'groups.*',
            'areas_acessos.area_grupo_id',
            'areas.area_nome',
            'areas.area_id',
            'areas_acessos.excluir',
            'areas_acessos.editar',
            'areas_acessos.adicionar',
            'areas_acessos.permissao'
        ]);

    

        if($condicoes){
            $this->db->join('areas_acessos', 'areas_acessos.area_grupo_id = groups.id');
            $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');
            $this->db->where($condicoes);
            // $this->db->group_by('groups.id');
        }else{
            $this->db->join('areas_acessos', 'areas_acessos.area_grupo_id = groups.id');
            $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');
        }

        return $this->db->get('groups')->result();
    }

    public function get_all_acessos($condicoes = null){
        $this->db->select([
            'areas_acessos.*',
            'areas.area_nome',
            'areas.area_id as id_area',
            'excluir',
            'editar',
            'adicionar',
            'permissao'
        ]);

        $this->db->join('areas', 'areas.area_id = areas_acessos.area_id', 'left');

        foreach($condicoes as $cond){
            $this->db->where('areas.area_id != ', $cond->area_id);
        }

        $this->db->group_by('areas.area_id');

        return $this->db->get('areas_acessos')->result();
    }

    public function get_all_restantes($condicoes = null){
        $this->db->select([
            'areas.*',
        ]);

        foreach($condicoes as $cond){
            $this->db->where('areas.area_id != ', $cond->area_id);
        }

        return $this->db->get('areas')->result();
    }

    public function get_all_access($condicoes = null){
        $this->db->select([
            'areas.*'
        ]);

        foreach($condicoes as $cond){
            $this->db->where('areas.area_id != ', $cond->id_area);
        }

        $this->db->group_by('areas.area_id');

        return $this->db->get('areas')->result();
    }


}