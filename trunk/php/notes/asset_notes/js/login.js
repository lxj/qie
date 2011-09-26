(function(S){
	/*
	 *登陆模块
	 **/
	var form=S.$('login'),user_name=S.$('user_name'),user_password=S.$('user_password'),submit=S.$('submit'),v=[];
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
	function focus(input){
          input.wrong && (input.wrong.offsetHeight!==0) && (input.wrong.style.display='none');
	}
	function blur(input,text,sd){
		var sd=sd || 'block';
        if(input.value.replace(/\s/g,'')==''){
			tip.wrong(input,text,sd);
			v[input.name]='wrong';
        }else{
			v[input.name]='correct';
        };
	}
    S.addEvent(user_name,'focus',function(){
		focus(this);
	})
    S.addEvent(user_name,'blur',function(){
		blur(this,'用户名不能为空');
	})
    S.addEvent(user_password,'focus',function(){
		focus(this);
	})
    S.addEvent(user_password,'blur',function(){
		blur(this,'密码不能为空');
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
        var v2=[];
		blur(user_name,'用户名不能为空');
		blur(user_password,'密码不能为空');
		for(var key in v){
		    v2.push(v[key])
		}
	    if(/wrong/.test(v2.join(''))) return false;
        S.login(submit,user_name,user_password);
        return false
    });
})(notes);