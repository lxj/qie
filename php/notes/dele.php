<? 
include ('notes.php');
$dText=$newNotes ->delet();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ύ�ɹ�</title>
</head>

<body>
<?= $dText;?>
<script type="text/javascript">
(function(){
	history.back(-1)	  
})()
</script>
</body>
</html>
