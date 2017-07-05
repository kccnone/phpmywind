<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************

update: 2014-5-30 12:27:37

**************************
*/


//初始化变量
$b_url = 'templates/html/default.html';
$s_url = 'templates/html/default_user.html';

//开启Session
if(!isset($_SESSION)) session_start();

$cfg_firstlogin = $_SESSION['firstlogin'];
if($cfg_adminlevel == 1)
	require_once($b_url);
else
	require_once($s_url);

?>