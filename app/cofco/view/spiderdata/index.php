{include file='cofco@block/search' /}
{include file="admin@block/layui" /}
<script type="text/html" id="barDemo">
      <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="pass">通过审核</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>

</script>
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
<!--        <button class="layui-btn layui-btn-sm" lay-event="pending_add">添加</button>-->
        <button class="layui-btn layui-btn-sm" lay-event="pending_del">删除（选中行数据）</button>
<!--        <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="pending_del_all">删除（所有数据）</button>-->
        <button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="pass_check_data">通过审核（选中行数据）</button>
<!--        <button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="pass_all_data">审核通过（所有数据）</button>-->
    </div>

</script>
<script>
    layui.use(['table'], function () {
        var $ = layui.jquery;
        layui.use('form', function(){
            try {
                $("#journal_zone").find("option[value={:input('get.journal_zone')}]").attr('selected', 'true');
            }
            catch (e) {}
            try {
                $("#sstr").find("option[value={:input('get.sstr')}]").attr('selected', 'true');
            }catch (e) {}
            var form = layui.form;
            form.render('select');
        });
        var table = layui.table;
        table.render(getTable('1'));
        addToolBarEvent(table);
        addBarEvent(table);
    });
</script>
<script src="__COFCO_JS__/common.js"></script>
