<?php require_once(dirname(__FILE__).'/inc/config.inc.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>操作日志</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">操作日志</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
	<tr align="left" class="head">
		<td height="36" colspan="2">&nbsp;技巧提示</td>
	</tr>
	<tr align="left">
		<td height="110" colspan="2"><ul class="tipsList">
				<li class="nt">
					<form name="form" id="form" method="" action="" style="display:inline;">
						搜索用户：
						<input type="text" name="uname" id="uname" class="selSysUname" value="<?php if(!empty($uname)) echo $uname; ?>" />
						&nbsp;&nbsp;
						操作时间：
						<input type="text" name="starttime" id="starttime" class="inputms" value="<?php echo GetDateTime(time()-2592000); ?>" readonly="readonly" />
						~
						<input type="text" name="endtime" id="endtime" class="inputms" value="<?php echo GetDateTime(time()); ?>" readonly="readonly" />
						<script type="text/javascript">
						Calendar.setup({
							inputField     :    "starttime",
							ifFormat       :    "%Y-%m-%d %H:%M:%S",
							showsTime      :    true,
							position       :    [463, 200],
							timeFormat     :    "24"
						});
						
						Calendar.setup({
							inputField     :    "endtime",
							ifFormat       :    "%Y-%m-%d %H:%M:%S",
							showsTime      :    true,
							position       :    [631, 200],
							timeFormat     :    "24"
						});
						</script> 
						&nbsp;&nbsp;
						<input type="submit" class="selSysEventBtn" value="查询" />
						&nbsp;&nbsp;
						<input type="button" onclick="location.href='sysevent_nor.php'" class="selSysEventBtn" value="全部" />
					</form>
				</li>
			</ul></td>
	</tr>
	<?php
	$sql = "SELECT * FROM `#@__sysevent` WHERE `id`<>0";

	$tsql = "SELECT * FROM `#@__admin` WHERE `levelname`=1";	
	$dosql->Execute($tsql,'t');
	while ($trow = $dosql->GetArray('t')) {
		$sql .= " AND `uname`<>'".$trow['username']."'";	
	}
	
	if(!empty($uname)){
		$sql .= " AND `uname`='$uname'";
	}

	if(!empty($siteid))
		$sql .= " AND `siteid`=$siteid";
	
	if(!empty($starttime))
		$sql .= " AND `posttime`>=".GetMkTime($starttime);
	
	if(!empty($endtime))
		$sql .= " AND `posttime`<=".GetMkTime($endtime);

    $dopage->GetPage($sql,30);
	while($row = $dosql->GetArray())
	{
		$r = $dosql->GetOne("SELECT `sitename` FROM `#@__site` WHERE `id`=".$row['siteid']);
		
		if($row['model'] == 'login')
		{
	?>
	<tr class="dataTr">
		<td height="36"><span class="padl10"> <span class="number"><?php echo GetDateTime($row['posttime']); ?></span>：</span>用户 <strong><?php echo $row['uname']; ?></strong> 进行了 <span class="blue">登录操作</span></td>
		<td width="120">记录IP：<?php echo $row['ip']; ?></td>
	</tr>
	<?php
		}

		else if($row['model'] == 'logout')
		{
	?>
	<tr class="dataTr">
		<td height="36"><span class="padl10"> <span class="number"><?php echo GetDateTime($row['posttime']); ?></span>：</span>用户 <strong><?php echo $row['uname']; ?></strong> 进行了 <span class="blue">退出操作</span></td>
		<td width="120">记录IP：<?php echo $row['ip']; ?></td>
	</tr>
	<?php
		}
		else if($row['classid'] != 0)
		{
			$r2 = $dosql->GetOne("SELECT `classname` FROM `#@__infoclass` WHERE `id`=".$row['classid']);
			
			if($row['action'] == 'add')
				$action = '添加';
			else if($row['action'] == 'update')
				$action = '修改';
			else if($row['action'] == 'del')
				$action = '删除';
			else
				$action = '';
	?>
	<tr class="dataTr">
		<td height="36"><span class="padl10"> <span class="number"><?php echo GetDateTime($row['posttime']); ?></span>：</span>用户 <strong><?php echo $row['uname']; ?></strong> 在 <span class="maroon2"><?php echo $r['sitename']; ?></span> <?php echo $action; ?>了 <span class="blue"><?php echo @$r2['classname']; ?></span></td>
		<td width="120">记录IP：<?php echo $row['ip']; ?></td>
	</tr>
	<?php
		}
		else
		{
	?>
	<tr class="dataTr">
		<td height="36"><span class="padl10"> <span class="number"><?php echo GetDateTime($row['posttime']); ?></span>：</span>用户 <strong><?php echo $row['uname']; ?></strong> 在 <span class="maroon2"><?php echo $r['sitename']; ?></span> 操作了 <span class="blue"><?php echo $row['model']; ?></span></td>
		<td width="120">记录IP：<?php echo $row['ip']; ?></td>
	</tr>
	<?php
		}
    }
	?>
</table>
<?php
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</body>
</html>