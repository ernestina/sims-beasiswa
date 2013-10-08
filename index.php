<?php 

/*
 * error reporting on
 */

error_reporting(E_ALL ^ E_NOTICE);

/*
 * define the sitepath beasiswa/
 */

$sitepath = realpath(dirname(__FILE__));
define('ROOT',$sitepath);

//echo $sitepath;

/*
 * define the sitepath url
 */

$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/beasiswa/';
//echo $base_url;
define('URL',$base_url);

$path = array(
    ROOT.'/libs/',
    ROOT.'/app/controllers/',
    ROOT.'/app/models/'
);

//include ROOT.'/config/config.php';
include ROOT.'/libs/Autoloader.php';
include ROOT.'/libs/config.php';
include ROOT.'/app/akses.php';

Autoloader::setCacheFilePath(ROOT.'/libs/cache.txt');
Autoloader::setClassPaths($path);
Autoloader::register();
$registry = new Registry();
$registry->upload = new Upload();
$registry->view = new View();
$registry->db = new Database();
$registry->auth = new Auth();
$registry->auth->add_roles('admin');
$registry->auth->add_access('admin','admin',$akses['Admin']);
$registry->auth->add_access('auth','admin','logout');
$registry->auth->add_roles('pic');
$registry->auth->add_access('cuti','pic',$akses['Cuti']);
$registry->auth->add_access('surattugas','pic',$akses['Surattugas']);
$registry->auth->add_access('elemenBeasiswa','pic',$akses['ElemenBeasiswa']);
$registry->auth->add_access('kontrak','pic',$akses['Kontrak']);
$registry->auth->add_access('penerima','pic',$akses['Penerima']);
$registry->auth->add_access('auth','pic','logout');
$registry->auth->add_access('auth','guest',$akses['Auth']);
$registry->exception = new ClassException();
$registry->bootstrap = new Bootstrap($registry);

$registry->bootstrap->loader();

//echo "hello world";

?>