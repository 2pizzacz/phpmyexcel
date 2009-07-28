<?
require_once( dirname(realpath(__FILE__)).'/inc/__autoload.php' );


//здесь задаётся веб-путь к phpMyExcel (по умолчанию это корень "/")
Root::i()->setVar("wroot", "/");



Database::$DB_HOST = 'localhost';
Database::$DB_DATABASENAME = 'test';
Database::$DB_USER = 'limited';
Database::$DB_PASS = 'limited';



if(file_exists(dirname(__FILE__)."/_local_settings.php"))
	include(dirname(__FILE__)."/_local_settings.php");


Database::connect();
session_start();


/*$auth = new HttpAuth();
$auth->authorize();*/
?>