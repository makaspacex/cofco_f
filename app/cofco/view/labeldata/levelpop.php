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
                <input type="text" name="q" value="{:input('get.q')}" lay-verify="required" placeholder="标签值" autocomplete="off" class="layui-input">
                <input type="hidden" name="callback" value="{$callback}">
            </div>
        </div>
    </form>
</div>
<form class="page-list-form">
{volist name="menu_list" id="v" key="k"}
<div class="layui-tab-item layui-form menu-dl layui-show">

    <form class="page-list-form">

        <dl class="menu-dl1 menu-hd mt10">
            <dt>标签名称</dt>
            <dd>
                <span class="hd">标签分值</span>
                <span class="hd3">操作</span>
            </dd>
        </dl>
        {volist name="v['childs']" id="vv" key="kk"}
        <dl class="menu-dl1">
            <dt>
                <input type="checkbox"   name="{$vv['id']}" value="{$vv['cid']}" class="checkbox-ids" lay-skin="primary" title="{$vv['value']}"data-json='{:json_encode($v, 1)}'>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><span>{$vv['value']}</span><i class="layui-icon">&#xe626;</i></div>
                <input type="text" class="menu-sort j-ajax-input" name="score[{$kk}]" onkeyup="value=value.replace(/[^\d]/g,'')" value="{$vv['score']}" data-value="{$vv['score']}" data-href="{:url('score?table=admin_levellabel&ids='.$vv['id'])}">

                <div class="menu-btns">
                    <a href="{:url('levellabel_edit?id='.$vv['id'])}" title="编辑"><i class="layui-icon">&#xe642;</i></a>
                    <a href="{:url('levellabel_add?cid='.$vv['id'])}" title="添加子菜单"><i class="layui-icon">&#xe654;</i></a>
                    <a href="{:url('levellabel_del?ids='.$vv['id'])}" title="删除之后无法恢复，您确定要删除吗？" class="j-ajax"><i class="layui-icon">&#xe640;</i></a>
                </div>
            </dt>
            <dd>
                {php}
                $kk++;
                {/php}
                {volist name="vv['childs']" id="vvv" key="kkk"}

                <dl class="menu-dl2">
                    <dt>
                        <input type="checkbox" name="{$vvv['id']}"  value="{$vvv['cid']}" class="checkbox-ids" lay-skin="primary" title="{$vvv['value']}"data-json='{:json_encode($v, 1)}'>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><span>{$vvv['value']}</span><i class="layui-icon">&#xe626;</i></div>
                        <input type="text" class="menu-sort j-ajax-input" name="score[{$kk}]" onkeyup="value=value.replace(/[^\d]/g,'')" value="{$vvv['score']}" data-value="{$vvv['score']}" data-href="{:url('sort?table=admin_levellabel&ids='.$vvv['id'])}">
                        <div class="menu-btns">
                            <a href="{:url('levellabel_edit?id='.$vvv['id'])}" title="编辑"><i class="layui-icon">&#xe642;</i></a>
                            <a href="{:url('levellabel_add?cid='.$vvv['id'])}" title="添加子菜单"><i class="layui-icon">&#xe654;</i></a>
                            <a href="{:url('levellabel_del?ids='.$vvv['id'])}"title="删除之后无法恢复，您确定要删除吗？" class="j-ajax"><i class="layui-icon">&#xe640;</i></a>
                        </div>
                    </dt>
                    {php}
                    $kk++;
                    {/php}
                    {volist name="vvv['childs']" id="vvvv" key="kkkk"}
                    {php}
                    $kk++;
                    {/php}
                    <dd>
                        <input type="checkbox" name="{$vvvv['id']}"   value="{$vvvv['cid']}" class="checkbox-ids" lay-skin="primary" title="{$vvvv['value']}"data-json='{:json_encode($v, 1)}'>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><span>{$vvvv['value']}</span><i class="layui-icon">&#xe626;</i></div>
                        <input type="text" class="menu-sort j-ajax-input" name="score[{$kk}]" onkeyup="value=value.replace(/[^\d]/g,'')" value="{$vvvv['score']}" data-value="{$vvvv['score']}" data-href="{:url('score?table=admin_levellabel&ids='.$vvvv['id'])}">
                        <div class="menu-btns">
                            <a href="{:url('levellabel_edit?id='.$vvvv['id'])}" title="编辑"><i class="layui-icon">&#xe642;</i></a>
                            <a href="{:url('levellabel_add?cid='.$vvvv['id'])}" title="添加子菜单"><i class="layui-icon">&#xe654;</i></a>
                            <a href="{:url('levellabel_del?ids='.$vvvv['id'])}" title="删除之后无法恢复，您确定要删除吗？" class="j-ajax"><i class="layui-icon">&#xe640;</i></a>
                        </div>
                    </dd>
                    {/volist}
                </dl>
                {/volist}
            </dd>
        </dl>
        {php}
        $kk++;
        {/php}
        {/volist}

    </form>
</div>
{/volist}
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
    layui.use(['form'], function(){
        var form = layui.form;
        var $ = layui.form;
        form.on('checkbox', function (data) {
            //alert("哈哈哈");
            //layer.tips('开关checked：' + (this.checked ? 'true' : 'false'), data.othis);
            //layer.tips('开关checked：' + (this.checked ? 'true' : 'false'), data.othis)
            //$('111').attr('checked', true);
            while (data.value!=1) {
                var boxes = document.getElementsByClassName("checkbox-ids");
                for (i = 0; i < boxes.length; i++) {
                    if (boxes[i].name == data.value) {
                        boxes[i].checked = true;
                        data.value=boxes[i].value;
                        break
                    }
                }
                form.render('checkbox');
            }
        });
    });


    layui.use(['jquery'], function(){
        var $ = layui.jquery;
        $('#popConfirm').click(function() {
            var data = new Array(), json = '';
            if ($('input[class="checkbox-ids"]:checked').length <= 0) {
                layui.layer.msg('请选择数据！');
                return false;
            }

            $('input[class="checkbox-ids"]:checked').each(function(i) {
                json = eval('(' + $(this).attr('data-json') + ')');
                data[i] = json;
            });
            // 触发父级页面函数
            parent.{$callback}(data);
            alert(JSON.stringify(data));
            parent.layer.closeAll();
        });
    });
</script>
</body>
</html>