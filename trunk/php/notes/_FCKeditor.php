<div style="overflow:hidden;zoom:1"><a href="#" onclick="document.getElementById('fabu').offsetHeight==0 ? document.getElementById('fabu').style.display='block' : document.getElementById('fabu').style.display='none';return false" class="button">����ʼ�</a></div>
 <form id="myform" action="recive_add.php" method="post">
  <div id="fabu" class="fabu">
	  <div><label>���⣺</label><input type="text" class="input" value="" name="title" /><input type="hidden" class="input" value="0" name="marrow" /></div>
	  <div id="chushi" style="line-height:200px; text-align:center; font-size:14px">���ڳ�ʼ���༭�������Ժ�.......</div>
	  <script>
		var oFCKeditor = new FCKeditor('content');//�������Ϊ��Ԫ�أ���FCKeditor���ɵ�input��textarea����name
		oFCKeditor.BasePath='asset_notes/js/editor/fckeditor/';//ָ��FCKeditor��·����Ҳ����fckeditor.js���ڵ�·��
		oFCKeditor.Height='200px';
		oFCKeditor.ToolbarSet='SeanLou';//��Default��ָ��������
		oFCKeditor.Value="";//Ĭ��ֵ
		oFCKeditor.Create();
		document.getElementById('chushi').style.display='none'
	 </script>
	  <div id="editor-cat-list"></div>
	  <div class="form-act"><input type="submit" id="queding" value="�ύ" class="button"><input type="button" id="quxiao" value="ȡ��" class="button btn-gray" /></div>
  </div>
 </form>
 <script>
 var curCat="<?=$_GET['act'];?>",select='';
;(function(S){
	function createCatSelect(catData){
			var s='<label>���ࣺ</label><select name="cat">',zzData=catData;
			   for(var i=0,ii=zzData.length;i<ii;i++){
				  if(curCat===zzData[i].cat_name){select=" selected='select'"}
				  s+='<option value="'+zzData[i].cat_name+'"'+select+'>'+zzData[i].cat_name+'</option>';
				  select='';
			   }
			   s+='</select>';
			   S.$('editor-cat-list').innerHTML=s;
	};
	S.catData ? createCatSelect(S.catData) : S.Ajax(
		   function(date){
			    createCatSelect(S.parseJson(date).cat_list);
				S.catData=S.parseJson(date).cat_list;
		   },
		   'cat_list.php',
		   "get"
	);
})(notes)
</script>