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
<title>��¼</title>
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
    /* �ؼ����벿�� */
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
    <form id="login" name="login" method="post" action="index.php">
        <div class="form-item"><label class="lb">�û�����</label><input type="text" value="" id="user_name" name="user_name" class="input" /></div>
        <div class="form-item"><label class="lb">���룺</label><input type="password" value="" id="user_password" name="user_password" class="input" /></div>
        <div class="form-act"><input type="submit" class="but" value="��¼" id="submit"/></div>
    </form>
</div>
<script>
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
    S.login=function(submit,user_name,user_password){
        submit.className='but-loading';
        if(!submit.ajax){
            S.Ajax(
                    function(date){
                        var d=S.parseJson(date);
                        if(d.user && d.user==='error'){
                            alert('�û���������')
                        }
                        if(d.password && d.password==='correct'){
                            location.href='index.php';
                        }else{
                            d.user==='correct' && alert('�������');
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
    S.submit(S.$('login'),function(){
        var form=S.$('login'),user_name=S.$('user_name'),user_password=S.$('user_password'),submit=S.$('submit'),v=[],s='';
        if(user_name.value.replace(/\s/g,'')==''){
            s+='�û�������Ϊ��\n';
        }else{
            v.push(user_name);
        };
        if(user_password.value.replace(/\s/g,'')==''){
            s+='���벻��Ϊ��\n';
        }else{
            v.push(user_password);
        }
        if(s) alert(s);
        if(v.length!=2) return false;
        S.login(submit,user_name,user_password);
        return false
    })
})('notes');
</script>

</body>
</html>
