<?php
include ('host-config.php');
mysql_select_db("notes");
mysql_query("set names gb2312;");
include ('cookie.php');
$newNotes=new notes();

class notes
{
	function login(){
	  //sleep(30);
	  $AJ_RET_SUCC=1096;
	  $user_name= mysql_real_escape_string($_POST['user_name']);
	  $user_pass= md5(trim($_POST['user_password']));
      $sql = "select * from `note_users` where `name` = '".$user_name."'"; 
	  $userInfo = mysql_query($sql) or $AJ_RET_SUCC=1000; 
	  include 'json/response.php';
	  //print_r(mysql_fetch_assoc($userInfo));
	  //echo count(mysql_fetch_assoc($userInfo));
	  //exit;
	  if(is_array($row=mysql_fetch_assoc($userInfo))){
	  
			if($row['password']==$user_pass){
				$_COOKIE['user_name']= $row['name'];
				$_COOKIE['user_password']= $row['password'];
				setcookie("user_name", $_COOKIE['user_name'], 0);
				setcookie("user_password", $_COOKIE['user_password'], 0);
				$result['user'] = 'correct';
				$result['password'] = 'correct';
				echo Response::HTML($AJ_RET_SUCC, $result);
				exit;	
			}else{
				$result['user'] = 'correct';
				$result['password'] = 'error';
				echo Response::HTML($AJ_RET_SUCC, $result);
				exit;	
			};
			
	  }else{
	  
			$result['user'] = 'error';
			echo Response::HTML($AJ_RET_SUCC, $result);
            exit;	
			
	  }
	}
	function logout(){
			setcookie('user_name', NULL, time() - 1);
			setcookie('user_password', NULL, time() - 1);
			header("Location:login.php");
	}
   function index(){
			$sql = "select * from `note_posts` order by id DESC limit 0,15" ;
			$date= array();
			$query_result = mysql_query($sql) or die("<p>д�����ݿ�ʧ��</p>");
			while($row = mysql_fetch_assoc($query_result)){
			 $date[]=$row;
			}
			return $date;
   }
   function marrow(){
			$sql = "select * from `note_posts` where `marrow` = '1' order by id DESC limit 0,15" ;
			$date= array();
			$query_result = mysql_query($sql) or die("<p>д�����ݿ�ʧ��</p>");
			while($row = mysql_fetch_assoc($query_result)){
			 $date[]=$row;
			}
			return $date;
   }
   function cat(){
	        $cat=$_GET['act'];
	        $sql = "select * from `note_posts` where `cat` = '".$cat."' ORDER BY `id` DESC " ;
			$date= array();
			$query_result = mysql_query($sql) or die("<p>��ȡ���ݿ�ʧ��</p>");
			while($row = mysql_fetch_assoc($query_result)){
			 $date[]=$row;
			}
			return $date;
   }
   function cat_list(){
	        $sql = "select * from note_cats order by cat_sort ASC" ;
			$date= array();
			$AJ_RET_SUCC=1096;
			$query_result = mysql_query($sql) or $AJ_RET_SUCC=1000;
			while($row = mysql_fetch_assoc($query_result)){
			 $date[]=$row;
			}
			include 'json/response.php';
			$result = array();
			$result['cat_count'] = count($date);
			$result['cat_list'] = $date;
			echo Response::HTML($AJ_RET_SUCC, $result);
   }
   function ajax_page(){
	        $AJ_RET_SUCC=1096;
	        $page=15;
	        $pagenub=$_GET['page'];
			if(!$_GET['page']){$pagenub=1;};
			$pageqs=($pagenub-1)*$page;
			$sql = "select * from note_posts order by id DESC limit $pageqs,$page";//order by id DESC  ��ʾʹ���ݰ���id�ֶε�ʱ�������˳������
			$date= array();
			$query_result = mysql_query($sql) or $AJ_RET_SUCC=1000;
			while($row = mysql_fetch_assoc($query_result)){
			 $date[]=$row;
			}
			include 'json/response.php';
			$result = array();
			$result['curpage'] = $pagenub;
			$result['total_count'] = count($date);
			$result['t_list'] = $date;
			echo Response::HTML($AJ_RET_SUCC, $result);
   }
   
   function insert(){
		   $title = $_POST['title'];
		   $content = $_POST['content'];
		   $cat = $_POST['cat'];
		   $marrow = $_POST['marrow'];
		   date_default_timezone_set(PRC);
		   $time=date("Y-m-d G:i:s");
		   list($month, $da, $ye) = explode("/", $date);
		   //$time=$ye."_".$month;
		  //����ִ�����
		  $sql = "insert into note_posts (id,title,content,cat,marrow,time) values ( null,'$title','$content','$cat','$marrow','$time')";
		  //ִ�����ݿ������������д��
		  $query = mysql_query($sql) or $result='fail';
		  //echo "<p>���������ݿ⣺�ɹ���</p>";
		  if($result!=='fail'){
			$ok="<div class='OK'><p><img src='asset_notes/img/apply.gif' alt=''>�ύ�ɹ���<a href=\"index.php\" class=\"back\">����</a></p>";
		  }else{
			 $ok="<div class='OK'><p><img src='asset_notes/img/stop.gif' alt=''>�ύʧ�ܣ�<a href=\"index.php\" class=\"back\">����</a></p>"; 
		  }
		  return $ok;
   }
   
   function edit(){
		  #########################
		  //
		  ######################### 
		  date_default_timezone_set(PRC);
		  $time=date("Y-m-d G:i:s");
		  $title = $_POST['title'];
		  $content=$_POST['content'];
		  $cat=$_POST['cat'];
		  $id=$_GET['id'];
		  $sql="update `note_posts` set title = '".$title."',content = '".$content."',cat = '".$cat."',`time` = '".$time."' where `note_posts`.`id` =".$id." LIMIT 1;";
		  $query = mysql_query($sql) or $result='fail'; //��ѯ��¼��
		  if($result!=='fail'){
			$ok="<div class='OK'><p><img src='asset_notes/img/apply.gif' alt=''>���³ɹ���<a href=\"index.php?admin=1\" class=\"back\">����</a>";
		  }else{
			 $ok="<div class='OK'><p><img src='asset_notes/img/stop.gif' alt=''>����ʧ�ܣ�<a href=\"index.php\" class=\"back\">����</a></p>"; 
		  }
		  return $ok;
   }

   function ajax_marrow(){
		  date_default_timezone_set(PRC);
		  $id = $_GET['id'];
		  $marrow = $_POST['marrow'];
		  $AJ_RET_SUCC=1096;
		  $sql="update `note_posts` set marrow = '".$marrow."' where `note_posts`.`id` =".$id." LIMIT 1;";
		 // $sql="update  `notes`.`list` set  `marrow` =  '1' where  `list`.`id` =566 LIMIT 1 ;";
		  $query = mysql_query($sql) or $AJ_RET_SUCC=1000; //��ѯ��¼��
		  include 'json/response.php';
		  $result = array();
		  echo Response::HTML($AJ_RET_SUCC, $result);
   }
   
   function ajax_edit(){

   }

   function ajax_delet(){
		##########################################
		//���ܲ��� id
		########################################## 
		$id = $_POST['id'];
		$sql = "delete from note_posts where id =$id";
		$query = mysql_query($sql) or die("ɾ��ʧ��");
		echo "ɾ���ɹ���";
   }
   
   function delet(){
		$id = $_GET['id'];
		$sql = " delete from note_posts where id =$id";
		$query = mysql_query($sql) or die("<p>ɾ��ʧ��</p>");
		$dText= "<p>ɾ���ɹ���</p>";
		return $dText;
   }
   
   function show(){
		#########################
		//�������������
		#########################
		$id = $_GET['id'];
		$id=mysql_real_escape_string($id);
		$sql = "select * from `note_posts` where `id` = {$id}"; //����ִ�����:��������˳��ݼ�����ʾ30�����
		$query = mysql_query($sql) or die("�޷�ִ��SQL��䣺$sql ��"); //��ѯ��¼��
		$t=mysql_fetch_assoc($query);
		#########################
		//�������������
		#########################
		return $t;
   }
   function ajax_show(){
		#########################
		//�������������
		#########################
		$AJ_RET_SUCC=1096;
		$id = $_GET['id'];
		$id=mysql_real_escape_string($id);
		$sql = "select * from `note_posts` where `id` = {$id}"; //����ִ�����:��������˳��ݼ�����ʾ30�����
		$query = mysql_query($sql) or $AJ_RET_SUCC=1000; //��ѯ��¼��
		$t=mysql_fetch_assoc($query);
		#########################
		//�������������
		#########################
		include 'json/response.php';
		$result = array();
		$result['total_count'] = count($t);
		$result['t_list'] = $t;
		echo Response::HTML($AJ_RET_SUCC, $result);
   }
   function login2(){
		if($_COOKIE['user_password'] && $_COOKIE['user_password']=='9dc3ff796374b3561138cc44aaca192d'){
			header("Location:index.php");
			exit;
		};
		$user_pass= md5(trim($_POST['user_password']));
		if($user_pass=='9dc3ff796374b3561138cc44aaca192d'){
			$_COOKIE['user_password']= $user_pass;
			setcookie("user_password", $_COOKIE['user_password']);
			header("Location:index.php");
		}
  }

}

?>