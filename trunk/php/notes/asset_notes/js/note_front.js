(function(S,undef){
        if (window[S] === undefined) window[S] = {};
        S = window[S];
        S.$=function(o){return typeof(o)==='string' ? document.getElementById(o) : o};
        S.ready=function(fn){
            var self=this;
            if(!+'\v1'){
                (function(){
                    try{
                        document.documentElement.doScroll('left');
                    } catch (error){
                        setTimeout(arguments.callee, 0);
                        return;
                    };
                    fn.call(window,self);
                })();
                /*					  try{
                 document.documentElement.doScroll('left');
                 } catch (error){
                 setTimeout(arguments.callee, 0);
                 return;
                 };
                 alert('')
                 fn.call(window,self);*/

            }else{
                document.addEventListener('DOMContentLoaded', function(){fn.call(window,self)}, false);
            }
        };
        S.each=function(object, fn, context) {
            var key, val, i = 0, length = object.length,
                    isObj = length === undef || Object.prototype.toString.call(object)==='[object Function]';;
            context = context || window;

            if (isObj) {
                for (key in object) {
                    if (fn.call(context, object[key], key, object) === false) {
                        break;
                    }
                }
            } else {
                for (val = object[0];
                     i < length && fn.call(context, val, i, object) !== false; val = object[++i]) {
                }
            }

            return object;
        };
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
        //去掉字符串的空格
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
			 * s.type存在 保帧丢时模式.
			 * s.type不存在 保时丢帧模式.
			 * s.callback 动画完成后的回调函数.
			 */
			var b=be,
				c=to-be,
				d=time || 300,
				s=s || {},
				t=0,
				dd,
				webkit=/applewebkit/.test(window.navigator.userAgent.toLowerCase()),//webkit内核浏览器
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
				 * t=t+1 保帧丢时.
				 * t=new Date().getTime()-betime 保时丢帧
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
            //创建XMLHttpRequest对象
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
            //创建请求结果处理程序
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
            //打开连接，true表示异步提交
            xmlhttp.open(p, url, true);
            //当方法为post时需要如下设置http头
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            //发送数据
            xmlhttp.send(send);
        };
		S.submit=function(elem,fn,under){
			S.addEvent(elem,'click',function(event){
				var e=window.event || event,targer=e.srcElement || e.target,type = targer.type;
				if(targer.nodeName.toLowerCase()==='input' && (type === "submit" || type === "image")){
					fn.call(this)===false && S.preventDefault(event);
				}
			});
			S.addEvent(elem,'onkeypress',function(){
				var e=window.event || event,targer=e.srcElement || e.target,type = targer.type;
				if(targer.nodeName.toLowerCase()==='input' && (type === "text" || type === "password") && e.keyCode === 13){
					fn.call(this)===false && S.preventDefault(event);
				}
			});
		};
})('notes');