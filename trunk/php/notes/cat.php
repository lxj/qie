<?
include ('notes.php');
$date=$newNotes ->cat();
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/editor/fckeditor/fckeditor.js"></script>
<!--SyntaxHighlighter-->
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushBash.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCpp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCSharp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushDelphi.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushDiff.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushGroovy.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPython.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushRuby.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushScala.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushSql.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushVb.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushXml.js"></script>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shCore.css"/>
<link type="text/css" rel="stylesheet" href="asset_notes/js/editor/syntaxhighlighter/styles/shThemeDefault2.css"/>
<script type="text/javascript">
  SyntaxHighlighter.config.clipboardSwf = 'asset_notes/js/editor/syntaxhighlighter/scripts/clipboard.swf';
  SyntaxHighlighter.all();
</script>
<title>SeanLou'notes</title>
</head>

<body>
<div id="contenter">
     <div class="con-rt"><span style="margin-right:15px"><?php echo $_COOKIE['user_name'];?></span><?php if(!$_GET['admin']){ ?><a href="index.php?admin=1" class="admin">����</a><?php }?><a href="logout.php" style="margin-left:15px">�˳�</a></div>
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
		    <option value="HTML5">HTML</option>
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

    <?php include('_cat_list.php');?>

    <div class="crumb"><a href="index.php">��ҳ</a>&nbsp;&gt;&nbsp;<?=$_GET['act'];?>(<span id="pagegeshu"><?php echo count($date); ?></span>)</div>
    <div id="notes">
     <ul id="notes-list" class="notes-list">
    <?php
    
    ##############################################
    //��ʾ�����б�
    ##############################################
       $nub=0;
       foreach($date as $msg)//ѭ����ʾ����
       {
        $nub++;
       ?>
       
        <li class="notes-item">
          <div class="lt" data-show='ajax_show.php?id=<?=$msg['id'];?>'><a class="cat"><?php if($msg['marrow']=='1'){ ?><span class="jh">����</span><?php }?><?php if($msg['title']){ ?><strong style="margin-left:5px"><?=$msg['title'];?></strong><?php }?></a><?=$msg['time'];?><span class="jiajing" data-marrow="<?=$msg['id'];?>"><?php if($msg['marrow']=='1'){ ?>ȡ���Ӿ�<?php }else{?>�Ӿ�<?php }?></span><b></b></div>
          <div class="notes-content"></div>
          <div class="rt"><a href="show.php?id=<?=$msg['id'];?>" target="_blank" >��ϸ</a><?php if($_GET['admin']==1){?><a class="dele"  data-edit="ajax_show.php?id=<?=$msg['id'];?>">�༭</a><a href="dele.php?id=<?=$msg['id'];?>" data-dele="<?=$msg['id'];?>" class="dele" onclick="return false">ɾ��</a><?php }?></div>
        </li>
       <?	 
       }
    ?>
    
      </ul>
      <?php if(1>1){?><div class="pagemore"><a data-page='ajax_page.php?page=2'>����</a></div><?php } ?>
    </div>

</div>
<script type="text/javascript" >
(function(S){
        if (window[S] === undefined) window[S] = {};
        S = window[S];
        S.$=function(o){return typeof(o)==='string' ? document.getElementById(o) : o};
        S.addEvent=function( node, type, listener ) {
            if (node.addEventListener) {
                node.addEventListener( type, listener, false );
                return true;
            } else if(node.attachEvent) {
                node['e'+type+listener] = listener;
                node[type+listener] = function(){node['e'+type+listener]( window.event );}
                node.attachEvent( 'on'+type, node[type+listener] );
                return true;
            }
            return false;
        };
        //ȥ���ַ����Ŀո�
        String.prototype.trim = function(){
            return this.replace(/(^[\s]*)|([\s]*$)/g, "");
        }
        S.getEventTarget=function(e){
          var e = e || window.event;
          return e.target || e.srcElement;
        }
        S.stopPropagation=function(evt){
            var evt = evt || window.event;
            if (evt.stopPropagation) {
                evt.stopPropagation();
            }
            else {
                evt.cancelBubble = true;
            }
        };
        S.parseJson=function (text) {
            //extract JSON string
            var match;
            if ((match = /\{[\s\S]*\}|\[[\s\S]*\]/.exec(text))) {
                text = match[0];
            }
            var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
                });
            }
            if (/^[\],:{}\s]*$/.
            test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').
            replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
            replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                return eval('(' + text + ')');
            }
            throw 'JSON parse error';
        };
        S.preventDefault=function(evt){
            var evt = evt || window.event;
            if (evt.preventDefault) {
                evt.preventDefault();
            }
            else {
                evt.returnValue = false;
            }
        };
        S.toArray=function(source)
            {
                var result = [];

                for (var i = 0; i < source.length; i++)
                    result.push(source[i]);

                return result;
        };
        S.getECN=function(node, name, type) {
                var r = [], re = new RegExp("(^|\\s)" + name + "(\\s|$)"), e = (node || document).getElementsByTagName(type || "*");
                for ( var i = 0,len=e.length; i < len; i++ ) {
                    if(re.test(e[i].className) )
                        r.push(e[i]);
                }
                return r;
        };
        S.SetEditorContents=function(EditorName, ContentStr) {
                var oEditor = FCKeditorAPI.GetInstance(EditorName) ;
                oEditor.SetHTML(ContentStr) ;
        };
        S.getEditorHTMLContents=function(EditorName) {
                var oEditor = FCKeditorAPI.GetInstance(EditorName);
                return(oEditor.GetXHTML(true));
        }
        S.getEditorTextContents=function(EditorName) {
              var oEditor = FCKeditorAPI.GetInstance(EditorName),r;
              if(document.all){
                r = oEditor.EditorDocument.body.innerText;
              }else{
                var r = oEditor.EditorDocument.createRange();
                r.selectNodeContents(oEditor.EditorDocument.body);
              }
              return r
        };
        S.scrollTo=function(be,to,time){
			/**
			 * s.type���� ��֡��ʱģʽ.
			 * s.type������ ��ʱ��֡ģʽ.
			 * s.callback ������ɺ�Ļص�����.
			 */
			var b=be,
				c=to-be,
				d=time || 300,
				s=s || {},
				t=0,
				dd,
				webkit=/applewebkit/.test(window.navigator.userAgent.toLowerCase()),//webkit�ں������
				Tween=function(t,b,c,d){
					if ((t/=d/2) < 1) return c/2*t*t + b;
					return -c/2 * ((--t)*(t-2) - 1) + b;
				};
			if(document.body.scrollHeight<=document.documentElement.clientHeight) return false;
			dd=document.compatMode=="CSS1Compat" && !webkit ? document.documentElement : document.body;
			var betime=new Date().getTime();
			s.type && (d=d/10);
			(function(){
				/**
				 * t=t+1 ��֡��ʱ.
				 * t=new Date().getTime()-betime ��ʱ��֡
				 */
				t=s.type ? t+1:(new Date().getTime()-betime);
				if(t<d){
					dd.scrollTop =Math.ceil(Tween(t,b,c,d))
					setTimeout(arguments.callee,10)
				}else{
					dd.scrollTop=to;
					s.callback && s.callback();
				}
			})();
        };
        S.Ajax=function(fn,url,p,send){
            //����XMLHttpRequest����
            var xmlhttp;
            try{
                xmlhttp= new ActiveXObject('Msxml2.XMLHTTP');
            }catch(e){
                try{
                    xmlhttp= new ActiveXObject('Microsoft.XMLHTTP');
                }catch(e){
                    try{
                        xmlhttp= new XMLHttpRequest();
                    }catch(e){}
                }
            }
            //�����������������
            xmlhttp.onreadystatechange=function(){
                if (4==xmlhttp.readyState){
                    if (200==xmlhttp.status){
                        var date=xmlhttp.responseText;
                        fn(date)
                    }else{
                        alert("error");
                    }
                }
            }
            //�����ӣ�true��ʾ�첽�ύ
            xmlhttp.open(p, url, true);
            //������Ϊpostʱ��Ҫ��������httpͷ
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            //��������
            xmlhttp.send(send);
        }
        S.ajax_delet=function(o){
            if(confirm('ȷ��ɾ��')){
                if(o.ui){return false}
                var id=o.getAttribute('data-dele'),_this=o;
                o.ui=1;
                S.Ajax(
                    function(date){
                        _this.innerHTML=date;
                        if(date!='ɾ��ʧ��'){_this.parentNode.parentNode.parentNode.removeChild(_this.parentNode.parentNode)}
                    },
                    "ajax_dele.php",
                    "post",
                    "id="+escape(id)
                )
            }
        };
        S.myform=document.forms['myform'];
        S.edit=function(o){
            var _this=o;
            S.$('fabu').style.display='block';
            S.Ajax(
                   function(date){
                    var d=S.parseJson(date);
                    S.SetEditorContents('content',d.t_list.content);
                    S.myform.action='edit.php?id='+d.t_list.id;
                    S.myform['title'].value=d.t_list.title;
                    S.myform['cat'].value=d.t_list.cat;
                    S.$('queding').value='����';
                    S.scrollTo(_this.parentNode.parentNode.offsetTop,0,20)
                   },
                   o.getAttribute('data-edit'),
                   "get"
            );
        };
        S.ajax_page=function(o){
            var _this=o;
            o.innerHTML='���ڼ�����.....'
            S.Ajax(
                   function(date){
                        var d=S.parseJson(date),DocumentFragment=document.createDocumentFragment();
                        for(var i=0,ii=d.t_list.length;i<ii;i++){
                            var id=d.t_list[i].id,
                            cat=d.t_list[i].cat,
                            title=d.t_list[i].title,
                            time=d.t_list[i].time,
                            marrow=d.t_list[i].marrow=='1' ? 'ȡ���Ӿ�' : '�Ӿ�',
                            marrow2=d.t_list[i].marrow=='1' ? '<span class="jh">����</span>' : '',
                            str='<div class="lt" data-show="ajax_show.php?id='+id+'"><a class="cat">['+cat+']'+marrow2+'<strong style="margin-left:5px">'+title+'</strong></a>'+time+'<span class="jiajing" data-marrow="'+id+'">'+marrow+'</span><b></b></div><div class="notes-content"></div><div class="rt"><a href="show.php?id='+id+'" target="_blank" >��ϸ</a><?php if($_GET['admin']){ ?><a class="dele" data-edit="ajax_show.php?id='+id+'">�༭</a><a href="dele.php?id='+id+'" data-dele="'+id+'" class="dele" onclick="return false">ɾ��</a><?php }?>',
                            li;
                           DocumentFragment.appendChild(li=document.createElement('li'));
                           li.className='notes-item';
                           li.innerHTML=str;
                        }
                        S.$('notes-list').appendChild(DocumentFragment);
                        o.innerHTML='����';
                        S.$('pagegeshu').innerHTML=parseInt(S.$('pagegeshu').innerHTML)+parseInt(d.total_count);
                        (d.total_count>=15) ? o.setAttribute('data-page','ajax_page.php?page='+(parseInt(d.curpage)+1)) : (o.parentNode.style.display='none');
                   },
                   o.getAttribute('data-page'),
                   "get"
            );
        };
        S.ajax_show=function(o,url,params){
            var _this=o,content;
            if(o.geted) return false;
            content=S.getECN(_this.parentNode,'notes-content','div')[0];
            content.style.display='block';
            content.innerHTML='�������ڼ�����.........'
            S.Ajax(
                   function(date){
                    var d=S.parseJson(date);
                    content.innerHTML=d.t_list.content;
                    o.geted=true;
                    //S.toArray(content.getElementsByTagName('pre'))
                    SyntaxHighlighter.highlight();
                   },
                   o.getAttribute('data-show'),
                   "get"
            );
        };
        S.ajax_marrow=function(o){
            var _this=o,z=o.innerHTML=='�Ӿ�' ? '1' : '0';
            S.Ajax(
                function(date){
                   var d=S.parseJson(date),jh;
                   if(d.retCode=='1096'){
                       var jh=S.getECN(_this.parentNode,'jh','span')[0],cat=S.getECN(_this.parentNode,'cat','a')[0];
                       if(o.innerHTML=='ȡ���Ӿ�'){
                          jh.parentNode.removeChild(jh)
                       }
                       if(o.innerHTML=='�Ӿ�'){
                           var span=document.createElement('span');
                           cat.insertBefore(span,cat.getElementsByTagName('strong')[0])
                           span.innerHTML='����';
                           span.className='jh';
                       }
                       o.innerHTML=o.innerHTML=='�Ӿ�' ? 'ȡ���Ӿ�' : '�Ӿ�';
                   };
                },
                'ajax_marrow.php?id='+o.getAttribute('data-marrow'),
                "post",
                "marrow="+escape(z)
            );
        };

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
        S.addEvent(S.$('notes'),'click',function(event){
                var et=S.getEventTarget(event),datashow=(et.getAttribute('data-show') && et) || (et.parentNode.getAttribute('data-show') && et.parentNode) || (et.parentNode.parentNode.getAttribute('data-show') && et.parentNode.parentNode);
                if(!et.getAttribute('data-marrow') && datashow){
                    var content=S.getECN(datashow.parentNode,'notes-content','div')[0];
                    (datashow.geted && content.style.display==='block') ? content.style.display='none' : content.style.display='block';
                    S.ajax_show(datashow);
                };
                if(et.getAttribute('data-edit')){
                    S.edit(et);
                };
                if(et.getAttribute('data-page')){
                    S.ajax_page(et);
                };
                if(et.getAttribute('data-dele')){
                    S.ajax_delet(et);
                };
                if(et.getAttribute('data-marrow')){
                    S.ajax_marrow(et);
                };

            }
        )
})('notes');
</script>

</body>
</html>
