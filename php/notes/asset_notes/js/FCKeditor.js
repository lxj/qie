 (function(S){
     var new_post_form=S.$('new-post-form'),fabu_button=S.$('fabu-button');
	 /*
	  *��ʼ��new-post-form;
	  **/
	  function initPostForm(){
			s='';
			s+='<form id="myform" action="recive_add.php" method="post">';
			s+='<div id="fabu" class="fabu">';
			s+='<div><label>���⣺</label><input type="text" class="input" value="" name="title" /><input type="hidden" class="input" value="0" name="marrow" /></div>';
			s+='<div id="FCKeditorLoading" style="line-height:200px; text-align:center; font-size:14px">���ڳ�ʼ���༭�������Ժ�.......</div>';
			s+='<div id="noteFCKeditor"></div>';
			s+='<div id="editor-cat-list"></div>';
			s+='<div class="form-act"><input type="submit" id="queding" value="�ύ" class="button"><input type="button" id="quxiao" value="ȡ��" class="button btn-gray" /></div>';
			s+='</div>';
			s+='</form>';
			new_post_form.innerHTML=s;
	 };

	 /*
	  *��ʼ���༭��;
	  **/
	 function initFCKeditor(){
			var oFCKeditor = new FCKeditor('content');//�������Ϊ��Ԫ�أ���FCKeditor���ɵ�input��textarea����name
			oFCKeditor.BasePath='asset_notes/js/editor/fckeditor/';//ָ��FCKeditor��·����Ҳ����fckeditor.js���ڵ�·��
			oFCKeditor.Height='200px';
			oFCKeditor.ToolbarSet='SeanLou';//��Default��ָ��������
			oFCKeditor.Value="";//Ĭ��ֵ
			oFCKeditor.Create = function(){
			   S.$('noteFCKeditor').innerHTML=this.CreateHtml();
			}
			oFCKeditor.Create();
			S.$('FCKeditorLoading').style.display='none';

			S.addEvent(S.$('queding'),'click',function(event){
				  if(S.getEditorTextContents('content').toString().trim().length=='0'){
					  alert('���ݲ���Ϊ��');
					  S.preventDefault(event);
				  }
				}
			)
			S.addEvent(S.$('quxiao'),'click',function(){
				  S.SetEditorContents('content','');
				  S.myform.action='recive_add.php';
				  S.myform['title'].value='';
				  S.myform['cat'].value='���';
				  S.$('queding').value='�ύ';
				}
			);

	 };

	 /*
	  *��ʼ�����·���;
	  **/
	 function initEditorSelect(){
			var curCat="<?=$_GET['act'];?>",select='';
			function createCatSelect(catData){
					var s='<label>���ࣺ</label><select name="cat">',zzData=catData;
					   S.each(zzData,function(val){
						  if(curCat===val.cat_name){select=" selected='select'"}
						  s+='<option value="'+val.cat_name+'"'+select+'>'+val.cat_name+'</option>';
						  select='';
					   })
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
	 };
	 	 	   
     S.addEvent(fabu_button,'click',function(e){
         new_post_form.offsetHeight==0 ? new_post_form.style.display='block' : new_post_form.style.display='none';
		 if(!new_post_form.Editor){
			 initPostForm();
			 initFCKeditor();
			 initEditorSelect();
			 new_post_form.Editor=1;
		 };
		 S.preventDefault(e);
	 })
 })(notes)