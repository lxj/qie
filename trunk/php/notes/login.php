<?php
	if(!empty($_COOKIE['user_password'])){
	   header("Location:index.php");
	   exit;
	};
	if($_GET['act']=='login'){
		include ('notes.php');
		$date=$newNotes ->login();
    }
?>
<!doctype html> 
<html> 
<head> 
<meta charset="gbk" /> 
<title>登录</title>
<style>
*{margin:0; padding:0}
body{font:14px/2 Tahoma, Geneva, sans-serif}
input{visibility:visible}
#loginBx {
    position:fixed; 
	_position:absolute;
	top:50%;left:50%;
    width:240px;
	margin:-92px 0 0 -143px;
    background-color: white;
    padding:15px;
    /* 关键代码部分 */
    -moz-background-clip:padding;     /* Firefox 3.6 */
    -webkit-background-clip:padding;  /* Safari 4? Chrome 6? */
    background-clip:padding-box;      /* Firefox 4, Safari 5, Opera 10, IE 9 */
    border:8px solid rgba(0,0,0,0.3);

    -webkit-border-radius:8px;
    -moz-border-radius:8px;
    border-radius: 8px; 
	*border:8px solid #ddd;
	border:8px solid #ddd\0;
	font-size:14px;
}
.input{width:160px;height:19px;border:1px solid #c5c5c5;padding:3px 4px;outline:none}
.but,.but-loading{display:block;width:74px;height:27px;border:0;cursor:pointer;background:url(asset_notes/img/denglu.png) no-repeat;text-indent:-9999px}
.but:hover{background-position:0 -27px}
.but-loading{background-position:0 -54px}

.form-item{overflow:hidden;zoom:1;line-height:26px;padding-bottom:7px}
	.form-item .lb,
	.form-item .input,
	.form-item .but{float:left;margin-right:5px}
	.form-item .lb{margin:0;width:60px;text-align:right}
	
.form-act{zoom:1;padding:5px 0 0 60px}
</style>
</head>

<body>

<div id="loginBx">
	<form id="login" name="login" method="post" action="login.php?act=login">
		<div class="form-item"><label class="lb">用户名：</label><input type="text" value="" id="user_name" name="user_name" class="input" /></div>
		<div class="form-item"><label class="lb">密码：</label><input type="password" value="" id="user_password" name="user_password" class="input" /></div>
		<div class="form-act"><input type="button" class="but" value="登录" id="submit"/></div>
	</form>
</div>
<script>
/*	function trigger( type, elem, args ) {
		// Piggyback on a donor event to simulate a different one.
		// Fake originalEvent to avoid donor's stopPropagation, but if the
		// simulated event prevents default then we do the same on the donor.
		// Don't pass args or remember liveFired; they apply to the donor event.
		var event = jQuery.extend( {}, args[ 0 ] );
		event.type = type;
		event.originalEvent = {};
		event.liveFired = undefined;
		jQuery.event.handle.call( elem, event );
		if ( event.isDefaultPrevented() ) {
			args[ 0 ].preventDefault();
		}
    };*/

/*	jQuery.event.special.submit = {
		setup: function( data, namespaces ) {
			if ( !jQuery.nodeName( this, "form" ) ) {
				jQuery.event.add(this, "click.specialSubmit", function( e ) {
					var elem = e.target,
						type = elem.type;

					if ( (type === "submit" || type === "image") && jQuery( elem ).closest("form").length ) {
						trigger( "submit", this, arguments );
					}
				});

				jQuery.event.add(this, "keypress.specialSubmit", function( e ) {
					var elem = e.target,
						type = elem.type;

					if ( (type === "text" || type === "password") && jQuery( elem ).closest("form").length && e.keyCode === 13 ) {
						trigger( "submit", this, arguments );
					}
				});

			} else {
				return false;
			}
		},

		teardown: function( namespaces ) {
			jQuery.event.remove( this, ".specialSubmit" );
		}
	};*/

;(function(S){
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
        }
        S.login=function(){
			var form=document.getElementById('login'),user_name=S.$('user_name'),user_password=S.$('user_password'),submit=S.$('submit'),v=[],s='';
			if(user_name.value.replace(/\s/g,'')==''){
				s+='用户名不能为空\n';
			}else{
				v.push(user_name);
			};
			if(user_password.value.replace(/\s/g,'')==''){
				s+='密码不能为空\n';
			}else{
				v.push(user_password);
			}
			if(s) alert(s);
			if(v.length!=2) return false;
			submit.className='but-loading';
			if(!submit.ajax){
			S.Ajax(
				function(date){
				   var d=S.parseJson(date);
				   if(d.user && d.user==='error'){
					   alert('用户名不存在')
				   }
				   if(d.password && d.password==='correct'){
					   location.href='index.php';
				   }else{
					   d.user==='correct' && alert('密码错误');
				   }
				   submit.className='but';
				   submit.ajax=0;
				},
				'login.php?act=login',
				"post",
				"user_name="+escape(user_name.value)+"&user_password="+escape(user_password.value)
			);
			submit.ajax=1;
			}
        };
		S.$('submit').onclick=function(){
		   S.login();
		   return false;
		};
})('notes');
</script>

</body>
</html>
