<?

require_once( dirname(realpath(__FILE__)).'/inc/__autoload.php' );
Database::connect();
session_start();


//����� ������� ���-���� � phpMyExcel (�� ��������� ��� ������ "/")
Root::i()->setVar("wroot", "/");


if(file_exists(dirname(__FILE__)."/_local_settings.php"))
	include(dirname(__FILE__)."/_local_settings.php");


$auth = new HttpAuth();
$auth->authorize();
?>