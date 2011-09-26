 (function(S){
     var new_post_form=S.$('new-post-form'),fabu_button=S.$('fabu-button');
	 /*
	  *初始化new-post-form;
	  **/
	  function initPostForm(){
			s='';
			s+='<form id="myform" action="recive_add.php" method="post">';
			s+='<div id="fabu" class="fabu">';
			s+='<div><label>标题：</label><input type="text" class="input" value="" name="title" /><input type="hidden" class="input" value="0" name="marrow" /></div>';
			s+='<div id="FCKeditorLoading" style="line-height:200px; text-align:center; font-size:14px">正在初始化编辑器，请稍候.......</div>';
			s+='<div id="noteFCKeditor"></div>';
			s+='<div id="editor-cat-list"></div>';
			s+='<div class="form-act"><input type="submit" id="queding" value="提交" class="button"><input type="button" id="quxiao" value="取消" class="button btn-gray" /></div>';
			s+='</div>';
			s+='</form>';
			new_post_form.innerHTML=s;
	 };

	 /*
	  *初始化编辑器;
	  **/
	 function initFCKeditor(){
			var oFCKeditor = new FCKeditor('content');//传入参数为表单元素（由FCKeditor生成的input或textarea）的name
			oFCKeditor.BasePath='asset_notes/js/editor/fckeditor/';//指定FCKeditor根路径，也就是fckeditor.js所在的路径
			oFCKeditor.Height='200px';
			oFCKeditor.ToolbarSet='SeanLou';//‘Default’指定工具栏
			oFCKeditor.Value="";//默认值
			oFCKeditor.Create = function(){
			   S.$('noteFCKeditor').innerHTML=this.CreateHtml();
			}
			oFCKeditor.Create();
			S.$('FCKeditorLoading').style.display='none';

			S.addEvent(S.$('queding'),'click',function(event){
				  if(S.getEditorTextContents('content').toString().trim().length=='0'){
					  alert('内容不能为空');
					  S.preventDefault(event);
				  }
				}
			)
			S.addEvent(S.$('quxiao'),'click',function(){
				  S.SetEditorContents('content','');
				  S.myform.action='recive_add.php';
				  S.myform['title'].value='';
				  S.myform['cat'].value='随笔';
				  S.$('queding').value='提交';
				}
			);

	 };

	 /*
	  *初始化文章分类;
	  **/
	 function initEditorSelect(){
			var curCat="<?=$_GET['act'];?>",select='';
			function createCatSelect(catData){
					var s='<label>分类：</label><select name="cat">',zzData=catData;
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