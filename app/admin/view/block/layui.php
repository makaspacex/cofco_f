{if condition="defined('MODULENAME') && MODULENAME eq 'COFCO' "}
    {if condition="$layout_on eq false"}
        <link rel="stylesheet" href="__ADMIN_JS__/layui-v2.4.5/css/layui.css"  >
        <link rel="stylesheet" href="__ADMIN_JS__/layui-v2.4.5/tablePlug.css" >
        <link rel="stylesheet" href="__ADMIN_CSS__/project.css?v={:config('hisiphp.version')}">
    {/if}
<script src="__ADMIN_JS__/layui-v2.4.5/layui.js"></script>
<script src="__ADMIN_JS__/jquery.2.1.4.min.js"></script>
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/layui-v2.4.5/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>
{else}
    {if condition="$layout_on eq false"}
        <link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css?v={:config('hisiphp.version')}">
        <link rel="stylesheet" href="__ADMIN_CSS__/project.css?v={:config('hisiphp.version')}">
    {/if}
<script src="__ADMIN_JS__/layui/layui.js?v={:config('hisiphp.version')}"></script>
<script src="__ADMIN_JS__/jquery.2.1.4.min.js"></script>
<script>
    var ADMIN_PATH = "{$_SERVER['SCRIPT_NAME']}", LAYUI_OFFSET = 0;
    layui.config({
        base: '__ADMIN_JS__/',
        version: '{:config("hisiphp.version")}'
    }).use('global');
</script>
{/if}
