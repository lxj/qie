<?
include ('notes.php');
$date=$newNotes ->cat();
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/editor/fckeditor/fckeditor.js"></script>
<!--SyntaxHighlighter-->
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushXml.js"></script>

<script type="text/javascript" src="asset_notes/js/note_front.js"></script>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shCore.css"/>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shThemeDefault2.css"/>
<script type="text/javascript">
  SyntaxHighlighter.config.clipboardSwf = 'asset_notes/js/editor/syntaxhighlighter/scripts/clipboard.swf';
  SyntaxHighlighter.all();
</script>
<title>SeanLou'notes</title>
</head>

<body>
<div id="contenter">
    <div class="con-rt"><span style="margin-right:15px"><?php echo $_COOKIE['user_name'];?></span><?php if(!$_GET['admin']){ ?><a href="index.php?admin=1" class="admin">管理</a><?php }?><a href="logout.php" style="margin-left:15px">退出</a></div>
	 
	 <?php include('_FCKeditor.php');?>
    <?php include('_cat_list.php');?>

	<?php if(count($date)==0){ ?>
		   <p style="padding-top:15px">没有该分类文章</p>
	 <?php }else{ ?>
		<div class="crumb"><a href="index.php">首页</a>&nbsp;&gt;&nbsp;<?=$catid[$_GET['act']]['cat_name'];?>(<span id="pagegeshu"><?php echo count($date); ?></span>)</div>
		<div id="notes">
		 <ul id="notes-list" class="notes-list">
		<?php

		##############################################
		//显示留言列表
		##############################################
		   $nub=0;
		   foreach($date as $msg)//循环显示内容
		   {
			$nub++;
		   ?>
		   
			<li class="notes-item">
          <div class="lt" data-show='ajax_show.php?id=<?=$msg['id'];?>'><a class="cat"><?php if($msg['marrow']=='1'){ ?><span class="jh" data-marrow="<?=$msg['id'];?>" title="取消加星">取消加星</span><?php }else{?><span class="jh jh2" data-marrow="<?=$msg['id'];?>" title="加星">加星</span><?php }?><?php if($msg['title']){ ?><strong style="margin-left:5px"><?=$msg['title'];?></strong><?php }?></a><?=$msg['time'];?><b></b></div>
			  <div class="notes-content"></div>
			  <div class="rt"><a href="show.php?id=<?=$msg['id'];?>" target="_blank" >详细</a><?php if($_GET['admin']==1){?><a class="dele"  data-edit="ajax_show.php?id=<?=$msg['id'];?>">编辑</a><a href="dele.php?id=<?=$msg['id'];?>" data-dele="<?=$msg['id'];?>" class="dele" onclick="return false">删除</a><?php }?></div>
			</li>
		   <?	 
		   }
		?>
		  </ul>
		  <?php if(1>1){?><div class="pagemore"><a data-page='ajax_page.php?page=2'>更多</a></div><?php } ?>
		</div>
	<?php }?>

</div>
<script type="text/javascript" src="asset_notes/js/note_init.js" async="true" defer="true" ></script>
</body>
</html>
