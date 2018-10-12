<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'form_validation', 'parser', 'session');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'email', 'security', 'inflector');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('settings_m');
