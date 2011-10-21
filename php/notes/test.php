<?php
include ('host-config.php');
mysql_select_db("notes");
mysql_query("set names gb2312;");
include ('cookie.php');
$newNotes=new notes();

class notes
{
   function cat_list(){
	        $sql = "select * from note_cats order by cat_sort ASC" ;
			$date= array();
			$AJ_RET_SUCC=1096;
			$query_result = mysql_query($sql) or $AJ_RET_SUCC=1000;
			while($row = mysql_fetch_assoc($query_result)){
			 $date[$row['cat_id']]=$row;
			}
           
		   return $date;
   }

  

}
$date=$newNotes ->cat_list();
echo $date[1]['cat_name'].'<br/>';
echo $date[2]['cat_name'].'<br/>';
echo $date[3]['cat_name'].'<br/>';
echo $date[4]['cat_name'].'<br/>';
echo $date[5]['cat_name'].'<br/>';
echo $date[6]['cat_name'].'<br/>';
echo $date[7]['cat_name'].'<br/>';
echo $date[8]['cat_name'].'<br/>';
echo $date[9]['cat_name'].'<br/>';
echo $date[10]['cat_name'].'<br/>';
echo $date[11]['cat_name'].'<br/>';
?>
