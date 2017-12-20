<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<link href="templates/style/menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/tinyscrollbar.js"></script>
<script type="text/javascript" src="templates/js/leftmenu.js"></script>
</head>
<body>
<div class="quickBtn"> <span class="quickBtnLeft"><a href="infolist_add.php" target="main">添新闻</a></span> <span class="quickBtnRight"><a href="goods_add.php" target="main">添产品</a></span> </div>

<div class="tGradient"></div>
<div id="scrollmenu">
	<div class="scrollbar">
		<div class="track">
			<div class="thumb">
				<div class="end"></div>
			</div>
		</div>
	</div>
	<div class="viewport">
		<div class="overview">
			<!--scrollbar start-->
			<?php
			
			//栏目名称管理
			$dosql->Execute("SELECT * FROM `#@__adminprivacy` WHERE `siteid`='$cfg_siteid' AND `groupid`='$cfg_adminlevel' AND `model`='category' AND (`action`='list' OR `action`='add') GROUP BY `classid` ORDER BY `classid` ASC");
			
			if($dosql->GetTotalRow() < 1)
			{
				echo '<div class="tc" style="width:180px;">~(>_<)~<br />您暂无任何可操作栏目</div>';
			}
			else
			{				
				$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE `parentid`= 0 AND checkinfo=true ORDER BY orderid ASC",'ic');
				$i = 1;
				while($rowc = $dosql->GetArray('ic'))
				{
				if(IsCategoryPriv($rowc['id'],'listc',$cfg_siteid,0)){
				
					if($i == 1)
						echo '<div class="menubox"><div class="title on" onclick="DisplayMenu(\'leftmenu'.$i.'\');" title="点击切换显示或隐藏">'.$rowc['classname'].'</div><div id="leftmenu'.$i.'">';
					else
						echo '<div class="menubox"><div class="title" onclick="DisplayMenu(\'leftmenu'.$i.'\');" title="点击切换显示或隐藏">'.$rowc['classname'].'</div><div id="leftmenu'.$i.'" style="display:none">';	
						
						
						$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE (`id`=".$rowc['id']." )",$i);
						while($row2 = $dosql->GetArray($i))
						{
							switch($row2['infotype'])
							{
								case 0:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)&&IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="info_update.php?id='.$row2['id'].'" target="main">'.$row2['classname'].'</a>';
									}
									else if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<a href="javascript:;" >'.$row2['classname'].'</a>';
									}							
									break;
								case 1:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infolist.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="infolist_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 2:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infoimg.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="infoimg_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 3:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="soft.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="soft_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 4:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="goods.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="goods_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 5:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="vedio.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="vedio_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 6:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="friendship.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="friendship_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 7:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="spring.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="spring_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 8:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="summer.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="summer_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 9:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="autumn.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="autumn_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 10:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="winter.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="winter_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 11:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="east.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="east_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 12:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="west.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="west_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 13:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="north.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="north_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 14:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="south.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="south_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								default:
									$r = $dosql->GetOne("SELECT * FROM `#@__diymodel` WHERE `id`=".$row2['infotype']);
									if(isset($r) && is_array($r))
									{
										if(IsCategoryPriv($row2['id'],'list',$cfg_siteid)){
											echo '<div class="hr_1"></div>';
											echo '<a href="modeldata.php?m='.$r['modelname'].'" target="main">'.$row2['classname'].'管理</a>';
										}
										if(IsCategoryPriv($row2['id'],'add',$cfg_siteid)){
											echo '<a href="modeldata_add.php?m='.$r['modelname'].'&cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
										}
									}
							}
						}
						
											
						$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE (`parentid`=".$rowc['id']." )",$i);
						while($row2 = $dosql->GetArray($i))
						{
							switch($row2['infotype'])
							{
								case 0:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)&&IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="info_update.php?id='.$row2['id'].'" target="main">'.$row2['classname'].'</a>';
									}
									else if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<a href="javascript:;" >'.$row2['classname'].'</a>';
									}							
									break;
								case 1:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infolist.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="infolist_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 2:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infoimg.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="infoimg_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 3:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="soft.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="soft_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 4:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="goods.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="goods_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 5:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="vedio.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="vedio_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 6:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="friendship.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="friendship_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 7:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="spring.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="spring_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 8:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="summer.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="summer_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 9:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="autumn.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="autumn_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 10:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="winter.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="winter_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 11:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="east.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="east_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 12:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="west.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="west_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 13:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="north.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="north_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								case 14:
									if(IsCategoryPriv($row2['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="south.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2['id'],'add',$cfg_siteid,0)){
										echo '<a href="south_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
									}
									break;
								default:
									$r = $dosql->GetOne("SELECT * FROM `#@__diymodel` WHERE `id`=".$row2['infotype']);
									if(isset($r) && is_array($r))
									{
										if(IsCategoryPriv($row2['id'],'list',$cfg_siteid)){
											echo '<div class="hr_1"></div>';
											echo '<a href="modeldata.php?m='.$r['modelname'].'" target="main">'.$row2['classname'].'管理</a>';
										}
										if(IsCategoryPriv($row2['id'],'add',$cfg_siteid)){
											echo '<a href="modeldata_add.php?m='.$r['modelname'].'&cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
										}
									}
							}
							
							
						$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE (`parentid`=".$row2['id']."  )",'third');
						while($row2t = $dosql->GetArray('third'))
						{
							switch($row2t['infotype'])
							{
								case 0:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)&&IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="info_update.php?id='.$row2t['id'].'" target="main">'.$row2t['classname'].'</a>';
									}
									else if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<a href="javascript:;" >'.$row2t['classname'].'</a>';
									}							
									break;
								case 1:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infolist.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="infolist_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 2:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="infoimg.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="infoimg_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 3:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="soft.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="soft_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 4:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="goods.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="goods_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 5:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="vedio.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="vedio_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 6:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="friendship.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="friendship_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 7:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="spring.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="spring_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 8:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="summer.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="summer_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 9:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="autumn.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="autumn_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 10:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="winter.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="winter_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 11:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="east.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="east_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 12:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="west.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="west_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 13:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="north.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="north_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								case 14:
									if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid,0)){
										echo '<div class="hr_1"></div>';
										echo '<a href="south.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'管理</a>';
									}
									if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid,0)){
										echo '<a href="south_add.php?cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
									}
									break;
								default:
									$r = $dosql->GetOne("SELECT * FROM `#@__diymodel` WHERE `id`=".$row2t['infotype']);
									if(isset($r) && is_array($r))
									{
										if(IsCategoryPriv($row2t['id'],'list',$cfg_siteid)){
											echo '<div class="hr_1"></div>';
											echo '<a href="modeldata.php?m='.$r['modelname'].'" target="main">'.$row2t['classname'].'管理</a>';
										}
										if(IsCategoryPriv($row2t['id'],'add',$cfg_siteid)){
											echo '<a href="modeldata_add.php?m='.$r['modelname'].'&cid='.$row2t['id'].'" target="main">'.$row2t['classname'].'添加</a>';
										}
									}
							}
						}
							
							
						}
					echo '</div></div><div class="hr_5"></div>';
	
					$i++;
					}/*if*/
				}/*while*/
			}/*else*/
			?>
			<!--scrollbar end-->
		</div>
	</div>
</div>
<div class="bGradient"></div>
<div class="copyright"> © 2015 KCCN<br />
	All Rights Reserved. 
</div>
<div class="tabMenu">
	<a href="left_menu_user.php" title="切换到功能菜单" class="name"></a>
</div>
</body>
</html>