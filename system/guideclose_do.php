<?php require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************

update: 2013-11-27 11:27:45

**************************
*/


//开启SESSION
if(!isset($_SESSION)) session_start();


//初始化参数
$action = isset($action) ? $action : '';


//锁屏操作
if($action == 'stop')
{
	if(!isset($_SESSION['admin'])) exit('Request Error Admin!');

	$stopname = $_SESSION['admin'];
	$dosql->ExecNoneQuery("UPDATE `#@__admin` SET firstlogin='false' WHERE `username`='$stopname'");
	$_SESSION['firstlogin'] = "false";
	exit();
}


//无条件返回
else
{
	exit('Request Error!');
}
?>