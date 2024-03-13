<?php

defined('BASEPATH') or exit('Ação não permitida');
//https://resultadosdigitais.com.br/

function insert_login($data = null):void{
    $CI = & get_instance();

    $data['login'] = (isset($data['login']) ? $data['login'] : (isset($_SESSION['login']) ? $_SESSION['login'] : 'Anônimo'));
    $data['log_controller'] = $CI->router->fetch_class();
    $data['log_method'] = $CI->router->fetch_method();
    $data['log_lixeira'] = 1;
    $data['log_usuario_id'] = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);
    $data['ip'] = (isset($_SESSION['ip_usuario']) ? $_SESSION['ip_usuario'] : get_client_ip());

    //$CI->core_model->insert_login('logs', $data);  
}


function usuarios($usuario_id){
    $CI = & get_instance();

    $usuario = $CI->core_model->get_by_id('users', array('id' => $usuario_id));

    return $usuario;
}


function cont($tabela, $condicoes){
    $CI = & get_instance();

    $users = $CI->core_model->get_all($tabela, $condicoes);

    return $users;
}


function insert_padrao($registro = null):void{
    $CI = & get_instance();

    $data['log_controller'] = $CI->router->fetch_class();
    $data['log_method'] = $CI->router->fetch_method();
    $data['log_lixeira'] = 1;
    $data['log_usuario_id'] = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);
    $data['ip'] = (isset($_SESSION['ip_usuario']) ? $_SESSION['ip_usuario'] : get_client_ip());
    $data['tipo'] = 5;
    $data['acao'] = 'O registro '.$registro.' já existe';
    $data['login'] = (isset($_SESSION['email']) ? $_SESSION['email'] : get_client_ip());

    $CI->core_model->insert_login('logs', $data);  
}

function mensagem_padrao($registro){
    return 'O registro: '.$registro.' já existe';
}



function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}


function area_acesso(){
    $CI = & get_instance();
    $user = $CI->ion_auth->user()->row();
    //$acessos = $CI->usuarios_model->get_all_acessos(array('area_grupo_id' => $_SESSION['grupo_id']->grupo_id));
    $acessos = $CI->usuarios_model->get_all_acessos(array('area_grupo_id' => $user->grupo_id));

    return $acessos;
}

function membros_titulares_prefeito($mandato_id = null){
    $CI = & get_instance();
    $membros = $CI->conselho_model->get_prefeito('Titulares', $mandato_id);
    return $membros;
}

function membros_suplentes_prefeito($mandato_id = null){
    $CI = & get_instance();
    $membros = $CI->conselho_model->get_prefeito('Suplentes', $mandato_id);
    return $membros;
}

function membros_titulares_servidores($mandato_id = null){
    $CI = & get_instance();
    $membros = $CI->conselho_model->get_servidores('Titulares', $mandato_id);
    return $membros;
}

function membros_suplentes_servidores($mandato_id = null){
    $CI = & get_instance();
    $membros = $CI->conselho_model->get_servidores('Suplentes', $mandato_id);
    return $membros;
}

function get_link($pag_id = null){
    $CI = & get_instance();
    $link = $CI->core_model->get_by_id('paginas', array('pag_id' => $pag_id));
    return $link;
}

function get_pregao($pregao_id = null){
    $CI = & get_instance();
    $arquivos = $CI->core_model->get_all('pregao_doc', array('predoc_pregao_id' => $pregao_id));
    return $arquivos;
}


function areas(){
    $CI = & get_instance();
    $user = $CI->ion_auth->user()->row();
    $area = $CI->areas_model->get_by_area(array('area_grupo_id' => $user->grupo_id, 'area_url' => $CI->router->fetch_class()));
    return $area;
}


function sidebar_sistema(){
    $CI = & get_instance();
    $sidebar_sistema = $CI->sistema_model->get_all($_SESSION['grupo_id']->grupo_id);
    return $sidebar_sistema;
}


function sidebar_sub_sistema($area_id){
    $CI = & get_instance();
 
    $sidebar_sub_sistema = $CI->sistema_model->get_all_subs($_SESSION['grupo_id']->grupo_id, $area_id);
    return $sidebar_sub_sistema;
}


function url_amigavel($string = NULL) {
    $string = remove_acentos($string);
    return url_title($string, '-', TRUE);
}

function remove_acentos($string = NULL) {
    $procurar = array('À', 'Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Õ', 'Ô', 'Ú', 'Ü', 'Ç', 'à', 'á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'õ', 'ô', 'ú', 'ü', 'ç');
    $substituir = array('a', 'a', 'a', 'a', 'e', 'r', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c');
    return str_replace($procurar, $substituir, $string);
}

function formata_data_banco_com_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}

function info_header_footer() {

    $CI = & get_instance();

    $sistema = $CI->core_model->get_by_id('sistema', array('sistema_id' => 1));

    return $sistema;
}


function info_config() {

    $CI = & get_instance();

    $configuracao = $CI->core_model->get_by_id('configuracoes', array('con_id' => 1));

    return $configuracao;
}

function get_pdf($pdf_id) {

    $CI = & get_instance();

    $pdf = $CI->core_model->get_all('dispensa_de_licitacao_doc', array('disdoc_dispensa_id' => $pdf_id));

    return $pdf;
}


function submenu($menu_id = null) {

    $CI = & get_instance();

    $submenu = $CI->menu_principal_model->get_all_submenu($menu_id);

    return $submenu;
}

function submenu_2($menu_id = null) {

    $CI = & get_instance();

    $submenu = $CI->menu_principal_model->get_all_submenu_2($menu_id);

    return $submenu;
}

function submenu_3($menu_id = null) {

    $CI = & get_instance();

    $submenu = $CI->menu_principal_model->get_all_submenu_3($menu_id);

    return $submenu;
}

function token($login = null): void {

    $CI = & get_instance();

    $token = bin2hex(random_bytes(16));

    $data = 
        array(
            'token' => $token,
            'token_expira_em' => date('Y-m-d H:i:s', time() + 7200)
        );
    
    $CI->core_model->update_token('users', $data, array('email' => $login));

}


function envia_email_framework($subject = null, $message = null, $email = null){

    $system = info_header_footer();

    $CI->load->library('email');

    $CI->email->from('autenticacao@mogicomp.com.br', $system->sistema_site_titulo);
    $CI->email->to($email);

    $CI->email->subject($subject);
    $CI->email->message($message);

    if ($CI->email->send(FALSE)) {

        $CI->session->set_flashdata('sucesso', 'E-mail enviado com sucesso');
        return true;

    } else {

        $CI->session->set_flashdata("erro", $this->email->print_debugger('header'));
        return false;
        
    }

}


function enviar($rota = null, $usuario_id = null){

    if(!$usuario_id){
        return false;
    }

    ?> 
    <script>
        window.location.href = "<?=base_url('envia/'.$rota.'/'.$usuario_id)?>";
    </script>
    <?php
}
