<?php
ob_start();
// error_reporting(E_ALL);
define('ABS', dirname(__FILE__));
if(isset($_SERVER['HTTP_USER_AGENT']))
{
}
else
{
	$_SERVER['HTTP_USER_AGENT']='';
}
require_once ABS.'/config.php';
require_once ABS.'/functions.php';

$siteurl = '//' . $_SERVER ['HTTP_HOST'] . str_replace( "\\", "/", dirname( getenv( "SCRIPT_NAME" ) ) );
$siteurl .= (substr($siteurl, -1) != '/') ? '/' : '';

$basepath = parse_url($siteurl, PHP_URL_PATH);

$path_info = '/';
if (!empty($_SERVER['PATH_INFO'])) {
	$path_info = $_SERVER['PATH_INFO'];
} else if (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php') {
	$path_info = $_SERVER['ORIG_PATH_INFO'];
} else {
	if (!empty($_SERVER['REQUEST_URI'])) {
		$path_info = (strpos($_SERVER['REQUEST_URI'], '?') > 0) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];
	}
}
if (strpos($path_info, $basepath)=== 0){
    $start = strlen($basepath)-1;
    $path_info = substr($path_info, $start);
}

$parts = preg_split('#/#', $path_info, -1);
foreach ($parts as $i => $p){
	if ( empty($p) ){
		unset($parts[$i]);
	}
}
$parts = array_values($parts);

$query_vars = array();
$home = true;

switch ( count($parts) ){
	case 3:
		$query_vars['country'] = urldecode($parts[0]);
		if ( $parts[1] != '+' ){
			$query_vars['loc'] = dash2space(urldecode($parts[1]));
		}
		$query_vars['job'] = dash2space(urldecode($parts[2]));
		$home = false;
		break;
	case 2:
		$query_vars['country'] = urldecode($parts[0]);
		$loc_cl = trim($parts[1]);
		if (!empty($loc_cl)){
		    $query_vars['loc'] = dash2space(urldecode($loc_cl));
		}
		$home = false;
		break;
	case 1:
		$query_vars['country'] = urldecode($parts[0]);
		$home = false;
		break;
}

if ( isset($query_vars['country']) ){
	$old_local = isset($_COOKIE["locale"]) ? $_COOKIE["locale"] : '';
	$new_local = isset($_locales[$query_vars['country']]) ? $_locales[$query_vars['country']] : '';
	
	if ( $new_local == '' ){
		$new_local = $_locales['US'];
		$query_vars['country'] = 'US';
		$redirect = true;
	} else if (!empty($old_local) && $new_local != $old_local ){
		$locale = $new_local;
		setcookie("locale", $locale, time()+2592000, '/');
		unset($query_vars['job']);
		unset($query_vars['loc']);
		header('Location: ' . get_site_url() );
		exit;
	} else {
		$locale = $new_local;
	}
} else {
	if ( isset($_COOKIE["locale"]) ){
		$locale = $_COOKIE["locale"];
	}
	$locale = get_locale();
	@list($tmp, $_country) = explode('-', $locale);
	$query_vars['country'] = $_country;
}

if ( isset($_REQUEST['keyword']) && !empty($_REQUEST['keyword']) && $_REQUEST['keyword'] != @$query_vars['job'] ){
	$query_vars['job'] = dash2space($_REQUEST['keyword']);
	$redirect = true;
}
if ( isset($_REQUEST['job_location']) && !empty($_REQUEST['job_location']) && $_REQUEST['job_location'] != @$query_vars['loc'] ){
	$query_vars['loc'] = dash2space($_REQUEST['job_location']);
	$redirect = true;
}
if ( !empty($_GET) ){
	$home = false;
}

// var_dump($path_info, $parts, $query_vars); die;

if ( isset($redirect) && $redirect ){
	header('Location: ' . get_site_url() );
	exit;
}

$language_dir = ABS.'/assets/lang/';
if ( file_exists( $language_dir.'common.php' ) ){
	require_once $language_dir.'common.php';
}
require_once get_language_file();

$q = isset($query_vars['job']) ? $query_vars['job'] : '';
if( empty($q) ){
	if( isset($_REQUEST['keyword']) && !empty($_REQUEST['keyword']) ){
		$q = dash2space($_REQUEST['keyword']);
	}else{
		$q = $default_keyword;
	}
}

require_once get_feedlist_file();

$document_title = !empty($q) ? sprintf( _text('SUFFIX_JOBS'), $q ) : _text('JOBS');
if ( !empty($query_vars['loc'])){
	$document_title .= sprintf( _text('PREFIX_IN'), $query_vars['loc'] );
}

$_themes = array(
		'amelia'    => 'Amelia',
		'cerulean'  => 'Cerulean',
		'cosmo'     => 'Cosmo',
		'cyborg'    => 'Cyborg',
		'darkly'    => 'Darkly',
		'default'   => 'Default',
		'flatly'    => 'Flatly',
		'journal'   => 'Journal',
		'lumen'     => 'Lumen',
		'readable'  => 'Readable',
		'simplex'   => 'Simplex',
		'slate'     => 'Slate',
		'spacelab'  => 'Spacelab',
		'superhero' => 'Superhero',
		'united'    => 'United',
		'yeti'      => 'Yeti'
);


$jhsfd=array("superjob.ru","rabota.ru","zarplata.ru","hh.ru","career.ru","job-mo.ru","irr.ru","hh.ru","advego.ru","avito.ru","hh.ru","jobinmoscow.ru","avito.ru","careerist.ru","joblab.ru","job.ru","hh.ru","specialist.ru","employmentcenter.ru","zarplata.ru","hh.ru","jobsmarket.ru");