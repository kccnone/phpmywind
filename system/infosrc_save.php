<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('infosrc');
error_reporting(0);
/*
**************************

update: 2013-3-11 14:27:57

**************************
*/


//初始化参数
$tbname = '#@__infosrc';
$gourl  = 'infosrc.php';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');


//保存操作
if($action == 'save')
{
	if($srcnameadd != '')
	{
		$dosql->ExecNoneQuery("INSERT INTO `$tbname` (srcname, linkurl, orderid) VALUES ('$srcnameadd', '$linkurladd', '$orderidadd')");
	}

	if(isset($id))
	{
		$ids = count($id);
		for($i=0; $i<$ids; $i++)
		{
			$dosql->ExecNoneQuery("UPDATE `$tbname` SET srcname='$srcname[$i]', linkurl='$linkurl[$i]', orderid='$orderid[$i]' WHERE `id`=$id[$i]");
		}
	}

    header("location:$gourl");
	exit();
}


//无条件返回
else
{
	header("location:$gourl");
	exit();
}
?>