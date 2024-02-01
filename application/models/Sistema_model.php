<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Sistema_model extends CI_Model
{


    public function get_all($grupo_id = null){

        $this->db->select([
            'areas_acessos.*',
            'areas.area_nome',
            'areas.area_id',
            'areas.area_url',
            'areas.area_icone',
            'areas.area_principal',
            'areas.submenu',
            'groups.name'

        ]);

        $this->db->where('area_grupo_id', $grupo_id);
        $this->db->where('permissao', 1);
        $this->db->where('areas.area_status', 1);

        $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');
        $this->db->join('groups', 'groups.id = areas_acessos.area_grupo_id', 'left');

        $this->db->group_by('areas.area_id');

        return $this->db->get('areas_acessos')->result();
    }

    public function get_all_subs($grupo_id = null, $area_id = null){

        $this->db->select([
            'areas_acessos.*',
            'areas.area_nome',
            'areas.area_id',
            'areas.area_url',
            'areas.area_principal',
            'areas.submenu',
            'groups.name'

        ]);

        $this->db->where('areas.area_principal', $area_id);
        $this->db->where('area_grupo_id', $grupo_id);
        $this->db->where('permissao', 1);
        $this->db->where('areas.area_status', 1);

        $this->db->join('areas', 'areas.area_id = areas_acessos.area_id');
        $this->db->join('groups', 'groups.id = areas_acessos.area_grupo_id', 'left');

        $this->db->group_by('areas.area_id');

        return $this->db->get('areas_acessos')->result();
    }

    // public function get_all_subs($condicoes = null){

    //     $this->db->select([
    //         'areas.*',
    //     ]);

    //     if($condicoes){
    //         $this->db->where('areas.area_principal', $condicoes);
    //     }

    //     return $this->db->get('areas')->result();
    // }

}