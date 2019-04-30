<script src="__ADMIN_JS__/layui-v2.4.5/layui.js"></script>
<link rel="stylesheet" href="__ADMIN_JS__/layui-v2.4.5/css/layui.css"  >
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>