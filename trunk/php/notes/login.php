<?php
	if(!empty($_COOKIE['user_password'])){
	   header("Location:index.php");
	   exit;
	};
	if($_GET['act']=='login'){
		include ('notes.php');
		$date=$newNotes ->login();
    }
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/note_front.js"></script>
<title>登录</title>
</head>

<body>

<div id="loginBx">
    <form id="login" name="login" method="post" action="index.php">
        <div class="form-item">
			<label class="lb">用户名：</label>
			<input type="text" value="" id="user_name" name="user_name" class="input" />
		</div>
        <div class="form-item">
			<label class="lb">密码：</label>
			<input type="password" value="" id="user_password" name="user_password" class="input" />
		</div>
        <div class="form-act"><input type="submit" class="but" value="登录" id="submit"/></div>
    </form>
</div>
<script type="text/javascript" src="asset_notes/js/login.js"></script>
</body>
</html>
