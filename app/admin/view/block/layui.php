{if condition="defined('MODULENAME') && MODULENAME eq 'COFCO' "}
<script src="__ADMIN_JS__/layui-v2.4.5/layui.js"></script>
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/layui-v2.4.5/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>
{else}
<script src="__ADMIN_JS__/layui/layui.js?v={:config('hisiphp.version')}"></script>
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>
{/if}
