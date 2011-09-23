<div id="cat-list-bx" class="cat-list-bx">
   <p id="cat-loading" style="text-align:center">加载中....</p>
	<ul id="cat-list" class="cat-list"></ul>
</div>
<script>
(function(S){
	var cur_cat='首页',select='class="select"',mr=[{"cat_name":"首页","cat_slug":"index"},{"cat_name":"精华","cat_slug":"marrow"}];
	<?php if($_GET['act']){?>
	cur_cat="<?=$_GET['act'];?>";
	select='';
	<?php }?>
	function createCatList(catData){
		var s='',zzData=mr.concat(catData),sli;
		S.each(zzData,function(val){
			  select=cur_cat===val.cat_name ? 'class="select"' : '';
			  sli={'index':'<li class="cat-item"><a href="index.php" '+select+'>'+val.cat_name+'</a></li>','marrow':'<li class="cat-item"><a href="marrow.php" '+select+'>'+val.cat_name+'</a></li>','mr':'<li class="cat-item"><a href="cat.php?act='+val.cat_name+'" '+select+'>'+val.cat_name+'</a></li>'};
			  s+=(sli[val.cat_slug] || sli['mr']);
			  select='';
		})
		S.$('cat-list').innerHTML=s;
	}
	S.$('cat-loading').style.display='block';
	S.catData ? createCatList(S.catData) : S.Ajax(
	   function(date){
		var d=S.parseJson(date);
			S.$('cat-loading').style.display='none';
			createCatList(d.cat_list);
			S.catData=d.cat_list;
	   },
	   'cat_list.php',
	   "get"
	);
})(notes)
</script>
