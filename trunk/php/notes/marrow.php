<?
include ('notes.php');
$date=$newNotes ->marrow();
$_GET['act']='精华';
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/editor/fckeditor/fckeditor.js"></script>
<!--SyntaxHighlighter-->
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="asset_notes/js/editor/syntaxhighlighter/scripts/shBrushXml.js"></script>

<script type="text/javascript" src="asset_notes/js/note_front.js"></script>
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
    <div class="con-rt"><span style="margin-right:15px"><?php echo $_COOKIE['user_name'];?></span><?php if(!$_GET['admin']){ ?><a href="index.php?admin=1" class="admin">管理</a><?php }?><a href="logout.php" style="margin-left:15px">退出</a></div>
	 
	 <?php include('_FCKeditor.php');?>
    <?php include('_cat_list.php');?>

    <div class="crumb"><a href="index.php">首页</a>&nbsp;&gt;&nbsp;<?=$_GET['act'];?>(<span id="pagegeshu"><?php echo count($date); ?></span>)</div>
    <div id="notes">
     <ul id="notes-list" class="notes-list">
    <?php
    
    ##############################################
    //显示留言列表
    ##############################################
       $nub=0;
       foreach($date as $msg)//循环显示内容
       {
        $nub++;
       ?>
       
        <li class="notes-item">
          <div class="lt" data-show='ajax_show.php?id=<?=$msg['id'];?>'><a class="cat"><?php if($msg['marrow']=='1'){ ?><span class="jh">精华</span><?php }?><?php if($msg['title']){ ?><strong style="margin-left:5px"><?=$msg['title'];?></strong><?php }?></a><?=$msg['time'];?><span class="jiajing" data-marrow="<?=$msg['id'];?>"><?php if($msg['marrow']=='1'){ ?>取消加精<?php }else{?>加精<?php }?></span><b></b></div>
          <div class="notes-content"></div>
          <div class="rt"><a href="show.php?id=<?=$msg['id'];?>" target="_blank" >详细</a><?php if($_GET['admin']==1){?><a class="dele"  data-edit="ajax_show.php?id=<?=$msg['id'];?>">编辑</a><a href="dele.php?id=<?=$msg['id'];?>" data-dele="<?=$msg['id'];?>" class="dele" onclick="return false">删除</a><?php }?></div>
        </li>
       <?	 
       }
    ?>
    
      </ul>
      <?php if(1>1){?><div class="pagemore"><a data-page='ajax_page.php?page=2'>更多</a></div><?php } ?>
    </div>

</div>
<script type="text/javascript" >
(function(S){
        S.ajax_delet=function(o){
            if(confirm('确定删除')){
                if(o.ui){return false}
                var id=o.getAttribute('data-dele'),_this=o;
                o.ui=1;
                S.Ajax(
                    function(date){
                        _this.innerHTML=date;
                        if(date!='删除失败'){_this.parentNode.parentNode.parentNode.removeChild(_this.parentNode.parentNode)}
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
                    S.$('queding').value='更新';
                    S.scrollTo(_this.parentNode.parentNode.offsetTop,0,20)
                   },
                   o.getAttribute('data-edit'),
                   "get"
            );
        };
        S.ajax_page=function(o){
            var _this=o;
            o.innerHTML='正在加载中.....'
            S.Ajax(
                   function(date){
                        var d=S.parseJson(date),DocumentFragment=document.createDocumentFragment();
                        for(var i=0,ii=d.t_list.length;i<ii;i++){
                            var id=d.t_list[i].id,
                            cat=d.t_list[i].cat,
                            title=d.t_list[i].title,
                            time=d.t_list[i].time,
                            marrow=d.t_list[i].marrow=='1' ? '取消加精' : '加精',
                            marrow2=d.t_list[i].marrow=='1' ? '<span class="jh">精华</span>' : '',
                            str='<div class="lt" data-show="ajax_show.php?id='+id+'"><a class="cat">['+cat+']'+marrow2+'<strong style="margin-left:5px">'+title+'</strong></a>'+time+'<span class="jiajing" data-marrow="'+id+'">'+marrow+'</span><b></b></div><div class="notes-content"></div><div class="rt"><a href="show.php?id='+id+'" target="_blank" >详细</a><?php if($_GET['admin']){ ?><a class="dele" data-edit="ajax_show.php?id='+id+'">编辑</a><a href="dele.php?id='+id+'" data-dele="'+id+'" class="dele" onclick="return false">删除</a><?php }?>',
                            li;
                           DocumentFragment.appendChild(li=document.createElement('li'));
                           li.className='notes-item';
                           li.innerHTML=str;
                        }
                        S.$('notes-list').appendChild(DocumentFragment);
                        o.innerHTML='更多';
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
            content.innerHTML='内容正在加载中.........'
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
            var _this=o,z=o.innerHTML=='加精' ? '1' : '0';
            S.Ajax(
                function(date){
                   var d=S.parseJson(date),jh;
                   if(d.retCode=='1096'){
                       var jh=S.getECN(_this.parentNode,'jh','span')[0],cat=S.getECN(_this.parentNode,'cat','a')[0];
                       if(o.innerHTML=='取消加精'){
                          jh.parentNode.removeChild(jh)
                       }
                       if(o.innerHTML=='加精'){
                           var span=document.createElement('span');
                           cat.insertBefore(span,cat.getElementsByTagName('strong')[0])
                           span.innerHTML='精华';
                           span.className='jh';
                       }
                       o.innerHTML=o.innerHTML=='加精' ? '取消加精' : '加精';
                   };
                },
                'ajax_marrow.php?id='+o.getAttribute('data-marrow'),
                "post",
                "marrow="+escape(z)
            );
        };

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
})(notes);
</script>

</body>
</html>
