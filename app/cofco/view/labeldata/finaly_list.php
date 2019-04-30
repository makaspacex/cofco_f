<form class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-inline" style="width: 400px">
                <input type="text" name="title" value="{:input('get.title')}" lay-verify="required" placeholder="文章标题"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">爬虫关键词</label>
            <div class="layui-input-inline">
                <select name="sstr" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    {volist name="keyword_list" id="v"}
                    <option>{$v['keywords']}</option>
                    {/volist}
                </select>
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">期刊分区</label>
            <div class="layui-input-inline" style="width: 90px">
                <select name="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">时间区间</label>
            <div class="layui-input-inline">
                <input type="text" name="date_start" id="date_start" value="{:input('get.date_start')}"
                       lay-verify="date_start" placeholder="开始时间" class="layui-input">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline">
                <input type="text" name="date_end" id="date_end" value="{:input('get.date_end')}" lay-verify="date"
                       placeholder="结束时间" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">影响因子区间</label>
            <div class="layui-input-inline">
                <input type="text" name="impact_factor_start" id="impact_factor_start"
                       value="{:input('get.impact_factor_start')}" lay-verify="date" placeholder="0" autocomplete="off"
                       class="layui-input">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline">
                <input type="text" name="impact_factor_end" id="impact_factor_end"
                       value="{:input('get.impact_factor_end')}" lay-verify="date" placeholder="10" autocomplete="off"
                       class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <button type="submit" class="layui-btn">搜索</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>



    <table class="layui-hide" id="demo" lay-filter="test"></table>
</form>
{include file="cofco@block/layui" /}
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate; 
    //常规用法
    laydate.render({
        elem: '#date_start'
    });
    laydate.render({
        elem: '#date_end'
    });
});
</script>
<script type="text/html" id="barDemo">
 <!--  <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a> -->
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script type="text/html" id="statusTpl">
  {{#  if(d.status == 3){ }}
  <a>已审核</a>
  {{#  } else { }}
  <a>未审核</a>
  {{#  } }}
</script>
<script type="text/html" id="timeTpl">
  {{#  if(d.issue != null){ }}
  {{# new Date(d.issue*1000)}}
  {{#  } }}
</script>
<script>
    layui.use(['table'], function(){
        var url = window.location.href;
        finaly_list_url = url.replace(/list/,"list_data");
        var table = layui.table;
        table.render({
            elem: '#demo'
            ,url:finaly_list_url
            ,cellMinWidth: 80
            ,toolbar: true
            ,title: '已审核数据表'
            ,totalRow: true
            ,id:'testReload'
            ,cols: [[
            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
            ,{field: 'title', title: '文章标题', width:500, fixed: 'left'}
            ,{field: 'sstr', title: '爬虫关键词', width:200}
            ,{field: 'journal_zone', title: '期刊分区', width: 100}
            ,{field: 'impact_factor', title: '影响因子', width: 100}
            ,{field: 'special_version', title: '特别说明', width:90}
            ,{field: 'document_type', title: '文献类型', width:90} 
            ,{field: 'urgency', title: '紧要程度', width: 90}
            ,{field: 'status', title: '状态', width: 90,templet: '#statusTpl'}
            ,{field: 'tabstract', title: '摘要翻译', width: 100,hide:'true'}
            ,{field: 'doi', title: 'doi', width: 100,hide:'true'}
            ,{field: 'country', title: '国家', width: 100,hide:'true'}
            ,{field: 'author', title: '作者', width: 100,hide:'true'}
            ,{field: 'journal', title: '所属期刊', width: 100,hide:'true'}
            ,{field: 'issue', title: '文章发表时间', width: 100,hide:'true',templet:'#timeTpl'}
            ,{field: 'keyword', title: '关键词', width: 100,hide:'true'}
            ,{field: 'institue', title: '发表机构', width: 100,hide:'true'}
            ,{fixed: 'right', width: 120, align:'center', toolbar: '#barDemo'}    
            ]]
            ,page: true
    ,parseData: function(res){ //将原始数据解析成 table 组件所规定的数据
        return {
        "code": res.code, //解析接口状态
        "msg": res.message, //解析提示文本
        "count": res.data.total, //解析数据长度
        "data": res.data.data //解析数据列表
    };
}

});


    //监听行工具事件
  table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data //获得当前行数据
    ,layEvent = obj.event; //获得 lay-event 对应的值
//     if(layEvent === 'detail'){
//       console.log(JSON.stringify(data));
//       layer.alert(JSON.stringify(data), {
//           title: '当前行数据：'
//       });

//     //标注选中样式
//     obj.tr.addClass('layui-table-click').siblings().removeClass('layui-table-click');
// } else 
    if(layEvent === 'del'){
        del_url = url.replace(/list/,"del?id="+data.id);
        window.location.href=del_url;
    } else if(layEvent === 'edit'){
        edit_url = url.replace(/list/,"edit?id="+data.id);
        window.location.href=edit_url;
}
});
});
</script>