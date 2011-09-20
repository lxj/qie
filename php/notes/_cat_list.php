<div id="cat-list-bx" class="cat-list-bx">
   <p id="cat-loading" style="text-align:center">加载中....</p>
	<ul id="cat-list" class="cat-list">
	  <?php if(1>1){?>
		<li class="cat-item"><a href="index.php"<?php if(!$_GET['act']){?> class="select"<?php }?>>首页</a></li>
		<li class="cat-item"><a href="cat.php?act=CSS"<?php if($_GET['act']=='CSS'){?> class="select"<?php }?>>CSS</a></li>
		<li class="cat-item"><a href="cat.php?act=HTML"<?php if($_GET['act']=='HTML'){?> class="select"<?php }?>>HTML</a></li>
		<li class="cat-item"><a href="cat.php?act=CSS3"<?php if($_GET['act']=='CSS3'){?> class="select"<?php }?>>CSS3</a></li>
		<li class="cat-item"><a href="cat.php?act=HTML5"<?php if($_GET['act']=='HTML5'){?> class="select"<?php }?>>HTML5</a></li>
		<li class="cat-item"><a href="cat.php?act=JavaScript"<?php if($_GET['act']=='JavaScript'){?> class="select"<?php }?>>JavaScript</a></li>
		<li class="cat-item"><a href="cat.php?act=PHP"<?php if($_GET['act']=='PHP'){?> class="select"<?php }?>>PHP</a></li>
		<li class="cat-item"><a href="cat.php?act=性能"<?php if($_GET['act']=='性能'){?> class="select"<?php }?>>性能</a></li>
		<li class="cat-item"><a href="cat.php?act=前端"<?php if($_GET['act']=='前端'){?> class="select"<?php }?>>前端</a></li>
		<li class="cat-item"><a href="cat.php?act=SVN"<?php if($_GET['act']=='SVN'){?> class="select"<?php }?>>SVN</a></li>
		<li class="cat-item"><a href="cat.php?act=FCKeditor"<?php if($_GET['act']=='FCKeditor'){?> class="select"<?php }?>>FCKeditor</a></li>
		<li class="cat-item"><a href="cat.php?act=随笔"<?php if($_GET['act']=='随笔'){?> class="select"<?php }?>>随笔</a></li> 
	  <?php } ?>
	</ul>
</div>
<script>
(function(S){
	 var cur_cat='首页',select='class="select"';
	<?php if($_GET['act']){?>
      cur_cat="<?=$_GET['act'];?>";
	  select='';
	<?php }?>
    S.$('cat-loading').style.display='block';
	S.Ajax(
		   function(date){
			var d=S.parseJson(date),s='',mr=[{"cat_name":"首页","cat_slug":"index"},{"cat_name":"精华","cat_slug":"marrow"}],zzData=mr.concat(d.cat_list),sli;

			   for(var i=0,ii=zzData.length;i<ii;i++){
				  select=cur_cat===zzData[i].cat_name ? 'class="select"' : '';
				  sli={'index':'<li class="cat-item"><a href="index.php" '+select+'>'+zzData[i].cat_name+'</a></li>','marrow':'<li class="cat-item"><a href="marrow.php" '+select+'>'+zzData[i].cat_name+'</a></li>','mr':'<li class="cat-item"><a href="cat.php?act='+zzData[i].cat_name+'" '+select+'>'+zzData[i].cat_name+'</a></li>'};
				  s+=(sli[zzData[i].cat_slug] || sli['mr']);
				  select='';
			   }

			   S.$('cat-loading').style.display='none';
			   S.$('cat-list').innerHTML=s;
		   },
		   'cat_list.php',
		   "get"
	);
})(notes)
</script>
