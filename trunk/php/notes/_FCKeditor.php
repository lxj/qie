<div style="overflow:hidden;zoom:1"><a href="#" onclick="document.getElementById('fabu').offsetHeight==0 ? document.getElementById('fabu').style.display='block' : document.getElementById('fabu').style.display='none';return false" class="button">����ʼ�</a></div>
 <form id="myform" action="recive_add.php" method="post">
  <div id="fabu" class="fabu">
	  <div><label>���⣺</label><input type="text" class="input" value="" name="title" /></div>
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
	  <div><label>���ࣺ</label><select name="cat">
	  <option value="CSS">CSS</option>
		<option value="HTML">HTML</option>
	  <option value="CSS3">CSS3</option>
	  <option value="HTML5">HTML5</option>
	  <option value="JavaScript">JavaScript</option>
	  <option value="PHP">PHP</option>
	  <option value="����">����</option>
		<option value="ǰ��">ǰ��</option>
	  <option value="FCKeditor">FCKeditor</option>
	  <option selected="selected" value="���">���</option>
	  </select>
	  </div>
	  <div class="form-act"><input type="submit" id="queding" value="�ύ" class="button"><input type="button" id="quxiao" value="ȡ��" class="button btn-gray" /></div>
  </div>
 </form>