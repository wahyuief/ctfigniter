<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/show/user/(:num)/(:num)']['GET'] = 'admin/show_user/$1/$2';
$route['admin/show/chal/(:num)/(:num)']['GET'] = 'admin/show_chal/$1/$2';
$route['flag/verify/(:num)'] = 'flag/verify/$1';
$route['profile/edit']['POST'] = 'profile/edit';
$route['profile/(:num)'] = 'profile/user/$1';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
