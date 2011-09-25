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
<link href="asset_notes/css/notes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="asset_notes/js/note_front.js"></script>
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
#login .input{width:160px;height:19px;border:1px solid #c5c5c5;padding:3px 4px;outline:none}
	#login .but,#login .but-loading{display:block;width:74px;height:27px;border:0;cursor:pointer;background:url(asset_notes/img/denglu.png) no-repeat;text-indent:-9999px;margin-left:0}
	#login .but:hover{background-position:0 -27px}
	#login .but-loading{background-position:0 -54px}
	#login .form-item{zoom:1;line-height:26px;padding-bottom:7px;position:relative}
	#login .form-item:after{content:".";display:block;height:0;clear:both;visibility:hidden;}
	#login .form-item .lb,
	#login .form-item .input,
	#login .form-item .but{float:left;margin-right:5px}
	#login .form-item .lb{margin:0;width:60px;text-align:right}
	#login .form-act{zoom:1;padding:5px 0 0 60px}
	#login .wrong{position:absolute;top:3px;left:235px;z-index:10px}
</style>
</head>

<body>

<div id="loginBx">
    <form id="login" name="login" method="post" action="index.php">
        <div class="form-item">
			<label class="lb">用户名：</label>
			<input type="text" value="" id="user_name" name="user_name" class="input" />
		</div>
        <div class="form-item">
			<label class="lb">密码：</label>
			<input type="password" value="" id="user_password" name="user_password" class="input" />
		</div>
        <div class="form-act"><input type="submit" class="but" value="登录" id="submit"/></div>
    </form>
</div>
<script>
(function(S){
	/*
	 *登陆模块
	 **/
	var form=S.$('login'),user_name=S.$('user_name'),user_password=S.$('user_password'),submit=S.$('submit'),v=[],v2=[];
	var tip={
         createTip:function(par,inner,cn){
			var span=document.createElement('span'),c=cn || 'wrong';
			span.className=c;
			span.innerHTML=inner+'<b></b>';
			par.appendChild(span);
			return span;
		 },
         wrong:function(o,inner,sh){
            if(!o.wrong){
				o.wrong=this.createTip(o.parentNode,'用户名不能为空');
			}
			o.wrong.innerHTML=inner+'<b></b>'
			o.wrong.style.display=sh;
			return o.wrong;
		 }
	}
    S.addEvent(user_name,'focus',function(){
		this.wrong && (this.wrong.offsetHeight!==0) && (this.wrong.style.display='none');
	})
    S.addEvent(user_name,'blur',function(){
        if(this.value.replace(/\s/g,'')==''){
			tip.wrong(this,'用户名不能为空','block');
			v[this.name]='wrong';
        }else{
			v[this.name]='correct';
        };
	})
    S.addEvent(user_password,'focus',function(){
		this.wrong && (this.wrong.offsetHeight!==0) && (this.wrong.style.display='none');
	})
    S.addEvent(user_password,'blur',function(){
        if(this.value.replace(/\s/g,'')==''){
			tip.wrong(this,'密码不能为空','block');
			v[this.name]='wrong';
        }else{
            v[this.name]='correct';
        }
	})
    S.login=function(submit,user_name,user_password){
        submit.className='but-loading';
        if(!submit.ajax){
            S.Ajax(
                    function(date){
                        var d=S.parseJson(date);
                        if(d.user && d.user==='error'){
							tip.wrong(user_name,'用户名不存在','block');
							submit.className='but';
                        }
                        if(d.password && d.password==='correct'){
                            location.href='index.php';
                        }else{
                            (d.user==='correct') && tip.wrong(user_password,'密码错误','block');
							submit.className='but';
                        }
                        submit.ajax=0;
                    },
                    'login.php?act=login',
                    "post",
                    "user_name="+escape(user_name.value)+"&user_password="+escape(user_password.value)
            );
            submit.ajax=1;
        }
    };
    S.submit(form,function(){
        var s='';
        if(user_name.value.replace(/\s/g,'')==''){
			tip.wrong(user_name,'用户名不能为空','block')
			v[user_name.name]='wrong';
        }else{
            v[user_name.name]='correct';
        };
        if(user_password.value.replace(/\s/g,'')==''){
            tip.wrong(user_password,'密码不能为空','block');
			v[user_password.name]='wrong';
        }else{
            v[user_password.name]='correct';
        }

		for(var key in v){
		    v2.push(v[key])
		}
	    if(/wrong/.test(v2.join(''))) return false;

        S.login(submit,user_name,user_password);
        return false
    });
	var lxj=[];
	lxj['we']='qqq';
	lxj['we2']='qqq2';
	lxj['we3']='qqq3';
	lxj['we4']='qqq4';
})(notes);
</script>

</body>
</html>
