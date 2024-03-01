<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['404_override'] = 'Custom_404';
$route['translate_uri_dashes'] = FALSE;


$route['restrita'] = 'restrita/home/index';

$route['institucional/o-valiprev'] = 'institucional/o_valiprev';
$route['institucional/presidencia'] = 'institucional/presidencia';
$route['institucional/diretoria/(:any)'] = 'institucional/diretoria/$1';
$route['institucional/diretoria'] = 'institucional/diretoria';
$route['institucional/censo-previdenciario'] = 'institucional/censo_previdenciario';
$route['institucional/capacitacao-de-servidores'] = 'institucional/capacitacao_servidores';

$route['institucional/conselhos/conselho-fiscal/(:any)'] = 'institucional/conselho_fiscal/$1';
$route['institucional/conselhos/conselho-fiscal'] = 'institucional/conselho_fiscal';

$route['institucional/conselhos/conselho-administrativo/(:any)'] = 'institucional/conselho_administrativo/$1';
$route['institucional/conselhos/conselho-administrativo'] = 'institucional/conselho_administrativo';
$route['institucional/conselhos'] = 'institucional/conselhos';
$route['institucional/como-solicitar-sua-aposentadoria'] = 'institucional/como_solicitar_sua_aposentadoria';

$route['transparencia/juridico'] = 'transparencia/juridico';
$route['transparencia/juridico/resolucoes/(:any)'] = 'transparencia/resolucoes/$1';
$route['transparencia/juridico/resolucoes'] = 'transparencia/resolucoes';
$route['transparencia/juridico/portais'] = 'transparencia/portais';
$route['transparencia/juridico/decretos'] = 'transparencia/decretos';

$route['transparencia/certidoes-crp'] = 'transparencia/certidoes';
$route['transparencia/contratos'] = 'transparencia/contratos';
$route['transparencia/planos-de-capacitacao'] = 'transparencia/planos_de_capacitacao';
$route['transparencia/relatorio-de-governanca-corporativa'] = 'transparencia/relatorio_de_governanca_corporativa';
$route['transparencia/controle-interno'] = 'transparencia/controle_interno';
$route['transparencia/tce-sp'] = 'transparencia/tce';
$route['transparencia/dacao-em-pagamento'] = 'transparencia/dacao_em_pagamento';
$route['transparencia/eleicoes-dos-conselhos'] = 'transparencia/eleicoes_dos_conselhos';
$route['transparencia/holerite-e-informe-de-rendientos'] = 'transparencia/holerite_e_informe_de_rendimento';

