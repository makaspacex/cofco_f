<!DOCTYPE html>
<html>
<head>
    <title>{$_admin_menu_current['title']}-后台首页</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN_CSS__/style.css?v={:time()}">
</head>
<body class="pb50">

<form class="page-list-form">
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th>文章标识</th>
                <th>标签批注</th>
                <th>使用网站</th>
                <th>文章ID</th>
                <th>文章标题</th>
                <th>文章作者</th>
                <th>所属期刊</th>
                <th>影响因子</th>
                <th>分区</th>
                <th>发表时间</th>
                <th>摘要</th>
                <th>关键词</th>
                <th>发表机构</th>
                <th>机构国家</th>
                <th>原网址</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            {php}
            $tag=config('hs_system.tag');
            {/php}
            {volist name="data_list" id="v"}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['id']}" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>{$v['doi']}</td>
                <td>{$tag[$v['tag_id']]}</td>
                <td>{$v['source']}</td>
                <td>{$v['pmid']}</td>
                <td>{$v['title']}</td>
                <td>{$v['author']}</td>
                <td>{$v['journal']}</td>
                <td>{$v['impact_factor']}</td>
                <td>{$v['journal_zone']}</td>
                <td>{$v['issue']}</td>
                <td>{$v['abstract']}</td>
                <td>{$v['keyword']}</td>
                <td>{$v['institue']}</td>
                <td>{$v['country']}</td>
                <td>{$v['flink']}</td>
                <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1"}checked=""{/if} value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" data-href="{:url('status?table=admin_label&ids='.$v['id'])}"></td>
            </tr>
            {/volist}
            </tbody>
        </table>
    </div>
</form>

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