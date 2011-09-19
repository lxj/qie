<?php
  #########################
  //连接数据库
  #########################
  define("host","localhost");
  define("user","root");
  define("password","123456");
  $connect=mysql_connect(host,user,password) or die("unable to connect datebase server");
?>