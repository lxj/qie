<? 
include ('notes.php');
$dText=$newNotes ->show();
$_GET['act']=$dText['cat'];
//$contentuf8=iconv("GB2312","UTF-8",$dText['content']);
//header("Content-type:text/html;charset=UTF-8");
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/editor/fckeditor/fckeditor.js"></script>
<!--SyntaxHighlighter-->
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushBash.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCpp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCSharp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushDelphi.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushDiff.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushGroovy.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPython.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushRuby.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushScala.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushSql.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushVb.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript" src="asset_notes/js/note_front.js"></script>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shCore.css"/>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shThemeDefault2.css"/>
<script type="text/javascript">
  SyntaxHighlighter.config.clipboardSwf = 'asset_notes/js/editor/syntaxhighlighter/scripts/clipboard.swf';
  SyntaxHighlighter.all();
</script>
<title><?=$dText['title'];?>——SeanLou'notes</title>
</head>

<body>
<div id="contenter">
     <div class="con-rt"><span style="margin-right:15px"><?php echo $_COOKIE['user_name'];?></span><?php if(!$_GET['admin']){ ?><a href="index.php?admin=1" class="admin">管理</a><?php }?><a href="logout.php" style="margin-left:15px">退出</a></div>

	<div class="crumb"><a href="index.php">首页</a>&nbsp;&gt;&nbsp;<a href="cat.php?act=<?=$dText['cat'];?>"><?=$dText['cat'];?></a>&nbsp;&gt;&nbsp;<?=$dText['title'];?></div>

<?php include('_cat_list.php');?>

<h1 class="at-title"><?=$dText['title'];?></h1>

<div class="notes-content"><?=$dText['content'];?></div>

 
</div>


</body>
</html>
