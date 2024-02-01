<?php

defined('BASEPATH') OR exit('Ação não permitida');


/*
 * Verificar o arquivo php.ini do xamp para saber se extensão php_openssl.dll está descomentada
 */


/*
 * Habilitar na sua conta o acesso de aplicativos menos seguros
 * Sem esta configuração não funciona o envio de e-mail
 */

$config = array();
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'seuemail@gmail.com';
$config['smtp_pass'] = 'suasenha';
$config['mailtype'] = 'text';
$config['newline'] = "\r\n"; //Se esta linha não funciona (Vai saber né??)
