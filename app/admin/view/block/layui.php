<script src="__ADMIN_JS__/layui/layui.js?v={:config('hisiphp.version')}"></script>
<link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css"  >
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>