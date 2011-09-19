<?php
if(empty($_COOKIE['user_password']) && $_GET['act']!='login'){
   header("Location:login.php");
   exit;
};
?>