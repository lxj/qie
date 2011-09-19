<div style="overflow:hidden;zoom:1"><a href="#" onclick="document.getElementById('fabu').offsetHeight==0 ? document.getElementById('fabu').style.display='block' : document.getElementById('fabu').style.display='none';return false" class="button">发表笔记</a></div>
 <form id="myform" action="recive_add.php" method="post">
  <div id="fabu" class="fabu">
	  <div><label>标题：</label><input type="text" class="input" value="" name="title" /></div>
	  <div id="chushi" style="line-height:200px; text-align:center; font-size:14px">正在初始化编辑器，请稍候.......</div>
	  <script>
		var oFCKeditor = new FCKeditor('content');//传入参数为表单元素（由FCKeditor生成的input或textarea）的name
		oFCKeditor.BasePath='asset_notes/js/editor/fckeditor/';//指定FCKeditor根路径，也就是fckeditor.js所在的路径
		oFCKeditor.Height='200px';
		oFCKeditor.ToolbarSet='SeanLou';//‘Default’指定工具栏
		oFCKeditor.Value="";//默认值
		oFCKeditor.Create();
		document.getElementById('chushi').style.display='none'
	 </script>
	  <div><label>分类：</label><select name="cat">
	  <option value="CSS">CSS</option>
		<option value="HTML">HTML</option>
	  <option value="CSS3">CSS3</option>
	  <option value="HTML5">HTML5</option>
	  <option value="JavaScript">JavaScript</option>
	  <option value="PHP">PHP</option>
	  <option value="性能">性能</option>
		<option value="前端">前端</option>
	  <option value="FCKeditor">FCKeditor</option>
	  <option selected="selected" value="随笔">随笔</option>
	  </select>
	  </div>
	  <div class="form-act"><input type="submit" id="queding" value="提交" class="button"><input type="button" id="quxiao" value="取消" class="button btn-gray" /></div>
  </div>
 </form>