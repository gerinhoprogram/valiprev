<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Usuarios_model extends CI_Model
{

    public function get_all(){

        $this->db->select([
            'users.*',
            'groups.name as setor',
            'setores_empresa.setor_nome',
        ]);
        
        //$this->db->join('users_groups', 'users_groups.user_id = users.id', 'left');
        $this->db->join('groups', 'groups.id = users.grupo_id', 'left');
        $this->db->join('setores_empresa', 'setores_empresa.setor_id = users.setor_id', 'left');

        return $this->db->get('users')->result();
    }

    public function get_all_usuarios_count($condicoes = null) {

        $this->db->select([
            'users.*',
            'COUNT(users.id) as qtd'
        ]);

        $this->db->join('setores_empresa', 'setores_empresa.setor_id = users.setor_id', 'left');

        if($condicoes){
            $this->db->where($condicoes);
        }

        return $this->db->get('users')->result();
    }

    public function get_all_group($user_id){

        $this->db->select([
            'users.grupo_id',
        ]);

        $this->db->where('users.id', $user_id);

        return $this->db->get('users')->row();
    }

    public function get_all_artigos($condicoes = null){

        $this->db->select([
            'users.*',
            'artigos.artigo_publicado',
            'artigos.artigo_user_id'
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }
        
        $this->db->join('artigos', 'artigos.artigo_user_id = users.id', 'left');
        $this->db->group_by('users.id');

        return $this->db->get('users')->result();
    }

    public function get_all_acessos($condicoes = null){

        $this->db->select([
            'areas_acessos.*',
        ]);

        if($condicoes){
            $this->db->where($condicoes);
        }

        $this->db->where('permissao', 1);


        return $this->db->get('areas_acessos')->result();
    }

}