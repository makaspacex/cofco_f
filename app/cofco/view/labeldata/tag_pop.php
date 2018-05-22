<!DOCTYPE html>
<html>
<head>
    <title>{$_admin_menu_current['title']}-后台首页</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN_CSS__/style.css?v={:time()}">
</head>
<body class="pb50">
<div class="page-filter fr">
    <form class="layui-form layui-form-pane" action="{:url()}" method="get">
        <div class="layui-form-item">
            <label class="layui-form-label">搜索</label>
            <div class="layui-input-inline">
                <input type="text" name="q" value="{:input('get.q')}" lay-verify="required" placeholder="标签标题" autocomplete="off" class="layui-input">
                <input type="hidden" name="callback" value="{$callback}">
            </div>
        </div>
    </form>
</div>
<form class="page-list-form">
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox"  lay-skin="primary" lay-filter="allChoose"></th>
                <th>标签名称</th>
                <th>所在分组</th>
                <th>状态</th>
                <th>值</th>
            </tr>
            </thead>
            <tbody>
            {php}
            $label=config('hs_system.label');

            {/php}
            {volist name="data_list" id="v"}
            <tr>
                <td><input type="checkbox" name="ids[]" class="layui-checkbox checkbox-ids" value="{$v['id']}" lay-skin="primary" data-json='{:json_encode($v, 1)}'></td>
                <td>{$v['name']}</td>
                <td>{$label[$v['label_id']]}</td>
                <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1"}checked=""{/if} value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" data-href="{:url('status?table=admin_label&ids='.$v['id'])}"></td>
                <td>{$v.value}</td>
            </tr>
            {/volist}
            </tbody>
        </table>
    </div>
</form>
<div class="pop-bottom-bar">
    <div class="fl pages">{:str_replace('&raquo;', '下一页', str_replace('&laquo;', '上一页', $pages))}</div>
    <div class="fr btns">
        <a class="layui-btn mr10" id="popConfirm">确定</a>
        <a class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll();">关闭</a>
    </div>
</div>
{include file="admin@block/layui" /}
<script>
    layui.use(['jquery'], function(){
        var $ = layui.jquery;
        $('#popConfirm').click(function() {
            var data = new Array(), json = '';
            if ($('input[name="ids[]"]:checked').length <= 0) {
                layui.layer.msg('请选择数据！');
                return false;
            }

            $('input[name="ids[]"]:checked').each(function(i) {
                json = eval('(' + $(this).attr('data-json') + ')');
                data[i] = json;
            });
            // 触发父级页面函数
            parent.{$callback}(data);
            parent.layer.closeAll();
        });
    });
</script>
</body>
</html>