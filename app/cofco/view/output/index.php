{include file='cofco@block/search' /}
{include file="admin@block/layui" /}
<script type="text/html" id="barDemo">
 <!--  <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a> -->
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
<!--    <button class="layui-btn layui-btn-sm" lay-event="pending_add">添加</button>-->
    <button class="layui-btn layui-btn-sm" lay-event="pending_del">删除选中行数据</button>
  </div>
</script>
<script type="text/html" id="statusTpl">
  {{#  if(d.status == 1){ }}
  <a>爬虫数据</a>
  {{#  } else if (d.status == 2) { }}
  <a>未审核</a>
  {{#  } else if (d.status == 3) { }}
  <a>已审核</a>
  {{#  } else{ }}
  <a>待输出</a>
  {{# } }}
</script>
<script>
    layui.use(['table'], function () {
        var table = layui.table;
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
        table.render(getTable('4'));
        addToolBarEvent(table);
        addBarEvent(table);
    });
</script>
<script src="__COFCO_JS__/common.js"></script>
