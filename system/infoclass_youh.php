<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('infoclass'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优化栏目</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/getcatpsize.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
</head>
<body>
<?php
$row = $dosql->GetOne("SELECT * FROM `#@__infoclass` WHERE `id`=$id");
?>
<div class="formHeader">
    <span class="title">修改栏目</span>
    <a href="javascript:location.reload();" class="reload">刷新</a>
</div>
<form name="form" id="form" method="post" action="infoclass_save.php" onsubmit="return cfm_infoclass();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="25%" height="40" align="right">栏目名称：</td>
			<td width="380"><?php echo $row['classname']; ?></td>
			<td></td>
		</tr>
		<tr>
			<td height="40" align="right">SEO标题：</td>
			<td>
                <input type="text" name="seotitle" id="seotitle" class="input" value="<?php echo $row['seotitle']; ?>" />
            </td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="40" align="right">关键词：</td>
			<td>
                <input type="text" name="keywords" id="keywords" class="input" value="<?php echo $row['keywords']; ?>" />
            </td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="118" align="right">栏目描述：</td>
			<td>
                <textarea name="description" id="description" class="textarea"><?php echo $row['description']; ?></textarea>
            </td>
			<td>&nbsp;</td>
		</tr>
       
	</table>
	<div class="formSubBtn">
		<input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="youh" />
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="repid" id="repid" value="<?php echo $row['parentid']; ?>" />
	</div>
</form>
</body>
</html>