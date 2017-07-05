<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************

update: 2014-4-8 21:16:15

**************************
*/


//更新操作日志
SetSysEvent('logout');

$_SESSION = array();
session_destroy();

header('location:login.php');
exit();

?>