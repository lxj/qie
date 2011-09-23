;(function(S){
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
            var _this=o,notes_list=S.$('notes-list'),admin='';
            o.innerHTML='正在加载中.....'
            S.Ajax(
                   function(date){
                        var d=S.parseJson(date),DocumentFragment=document.createDocumentFragment();
						S.each(d.t_list,function(va){
                            var id=va.id,
                            cat=va.cat,
                            title=va.title,
                            time=va.time,
                            marrow=va.marrow=='1' ? '取消加精' : '加精',
                            marrow2=va.marrow=='1' ? '<span class="jh">精华</span>' : '',str,
                            li;
							if(notes_list.admin) admin='<a class="dele" data-edit="ajax_show.php?id='+id+'">编辑</a><a href="dele.php?id='+id+'" data-dele="'+id+'" class="dele" onclick="return false">删除</a>';
                            str='<div class="lt" data-show="ajax_show.php?id='+id+'">['+cat+']<a class="cat">'+marrow2+'<strong style="margin-left:5px">'+title+'</strong></a>'+time+'<span class="jiajing" data-marrow="'+id+'">'+marrow+'</span><b></b></div><div class="notes-content"></div><div class="rt"><a href="show.php?id='+id+'" target="_blank" >详细</a>'+admin+'</div>',
                           DocumentFragment.appendChild(li=document.createElement('li'));
                           li.className='notes-item';
                           li.innerHTML=str;
						});
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