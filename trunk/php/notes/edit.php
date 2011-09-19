<?
include ('notes.php');
$ok=$newNotes ->edit();
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<title>提交成功</title>
<style type="text/css">
*{margin:0; padding:0}
.OK{width:200px;margin:0 auto;font:14px/1.8 '微软雅黑',Tahoma, Geneva, sans-serif}
.OK img{vertical-align:middle;margin-right:10px}
.OK .back{padding-left:10px}
</style>
</head>

<body>
<div>
<?=$ok; ?>
</div>
<!--<script type="text/javascript">
(function(){
	setTimeout(function(){history.back(-1)},2000) 
})()
</script>-->
</body>
</html>
