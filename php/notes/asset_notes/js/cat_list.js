(function(S){
	var cur_cat='首页',select='class="select"',mr=[{"cat_name":"首页","cat_slug":"index"},{"cat_name":"精华","cat_slug":"marrow"}],catList=S.$('cat-list');
	if(catList.getAttribute('data-cat')){
			cur_cat=catList.getAttribute('data-cat');
	        select='';
	}
	function createCatList(catData){
		var s='',zzData=mr.concat(catData),sli;
		S.each(zzData,function(val){
			  select=cur_cat===val.cat_name ? 'class="select"' : '';
			  sli={'index':'<li class="cat-item"><a href="index.php" '+select+'>'+val.cat_name+'</a></li>','marrow':'<li class="cat-item"><a href="marrow.php" '+select+'>'+val.cat_name+'</a></li>','mr':'<li class="cat-item"><a href="cat.php?act='+val.cat_name+'" '+select+'>'+val.cat_name+'</a><span class="count">('+val.count+')</span></li>'};
			  s+=(sli[val.cat_slug] || sli['mr']);
			  select='';
		})
		catList.innerHTML=s;
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