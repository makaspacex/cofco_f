<!DOCTYPE html>
<head>
	<title>后台管理注册</title>
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css">
	<link rel="stylesheet"  href="__ADMIN_CSS__/login.css">  
	<script src="__ADMIN_JS__/layui/layui.js"></script>
</head>
<body>
<div class="login-head">
		<h1>{:config('base.site_name')}</h1>
	</div>
<div class="login-box">
	<?php
		function getcookie($arg)
		{
			if (isset($_COOKIE[$arg]))
			  echo  $_COOKIE[$arg];
			else
			  echo "";
		}
	?>
		<form action="{:url()}" method="post" class="layui-form layui-form-pane" >
			<fieldset class="layui-elem-field layui-field-title">
				<legend>管理后台注册</legend>
			</fieldset>

			<div class="layui-form-item">
	            <label class="layui-form-label">用户名</label>
	            <div class="layui-input-block">
	                <input type="text" name="username" class="layui-input" lay-verify="required" placeholder="请输入用户名" autofocus="autofocus" value=<?php getcookie("username")?>>
	            </div>
        	</div>

			<div class="layui-form-item">
	            <label class="layui-form-label">昵称</label>
	            <div class="layui-input-block">
	                <input type="text" name="nick" class="layui-input" lay-verify="required" placeholder="请输入昵称" autofocus="autofocus" value=<?php getcookie("nick")?>>
	            </div>
        	</div>
        	<div class="layui-form-item">
	            <label class="layui-form-label">手机</label>
	            <div class="layui-input-block">
	                <input type="text" name="mobile" class="layui-input" lay-verify="phone" placeholder="请输入手机号" autofocus="autofocus" value=<?php getcookie("mobile")?>>
	            </div>
        	</div>

        	<div class="layui-form-item">
	            <label class="layui-form-label">邮箱</label>
	            <div class="layui-input-block">
	                <input type="text" name="email" class="layui-input" lay-verify="required|email" placeholder="请输入邮箱" value=<?php getcookie("email")?>>
	            </div>
        	</div>

			<div class="layui-form-item">
				<label class="layui-form-label">密码</label>
				<div class="layui-input-block">
					<input type="password" name="password" class="layui-input"  placeholder="请输入密码" lay-verify="required" value=<?php getcookie("password")?>>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">确认密码</label>
				<div class="layui-input-block">
					<input type="password" name="password1" class="layui-input"  placeholder="请再次输入密码" lay-verify="required" value=<?php getcookie("password1")?>>
				</div>
			</div>
			{:token('__token__', 'sha1')}
			<input type="submit" value="注册"  lay-filter="formRegister" class="layui-btn">
			<a href="index">已有账号？立即登录</a>
		</form>
		<div class="copyright">
			© 2017-2018 <a href="{:config('hisiphp.url')}" target="_blank">{:config('hisiphp.copyright')}</a> All Rights Reserved.
		</div>
	</div>

	<script>
layui.config({
  base: '__ADMIN_JS__/'
}).use('global');
</script>
<script type="text/javascript">
layui.define('form', function(exports) {
    var $ = layui.jquery, layer = layui.layer, form = layui.form;
    form.on('submit(formRegister)', function(data) {
        var _form = $(this).parents('form');
        layer.msg('数据提交中...',{time:500000});
        $.ajax({
            type: "POST",
            url: _form.attr('action'),
            data: _form.serialize(),
            success: function(res) {
                layer.msg(res.msg, {},function() {
                    if (res.code == 1) {
                        if (typeof(res.url) != 'undefined' && res.url != null && res.url != '') {
                            location.href = res.url;
                        } else {
                            location.reload();
                        }
                    } else {
                        location.reload();
                    }
                });
            }
        });
        return false;
    });
});
</script>
</body>

</html>