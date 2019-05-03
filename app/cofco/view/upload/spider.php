{include file="cofco@block/layui" /}
<table class="layui-hide" id="test" lay-filter="test"></table>
<script type="text/html" id="barDemo">
    <div style="width: 300px;height: 80px">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停爬虫</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复爬虫</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止爬虫</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">删除爬虫</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停IDS</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复IDS</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止IDS</a>
        <br>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停Content</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复Content</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止Content</a>
    </div>
</script>
<style type="text/css">
    .layui-table-cell {
        height: 50px;
        line-height: 50px;
    }
</style>
<script>
    layui.use(['jquery','table'], function(){
        var url = 'http://192.168.69.165:9001/api/v1/getthreadstatus/';
        var table = layui.table;
        table.render({
            elem: '#test'
            ,url:url
            ,toolbar: true
            ,title: '用户数据表'
            ,totalRow: true
            , cellMinWidth: 100
            ,cols: [[
                {field:'uid', title:'ID', width:80, fixed: 'left', unresize: true, sort: true, totalRowText: '合计行'}
                ,{field:'uname', title:'用户名', width:120}
                ,{field:'kw_id', title:'关键词ID', width:100}
                ,{field:'sp_t', title:'爬虫', width:150}
                ,{field:'w_num', title:'爬虫数目'}
                ,{field:'pN', title:'页数'}
                ,{field:'f_pN', title:'完成页数'}
                ,{field:'fail_pN', title:'失败页数'}
                ,{field:'fail_num', title:'失败文章'}
                ,{field:'total_num', title:'总文章'}
                ,{field:'idsP_status', title:'翻页进程'}
                ,{field:'cP_status', title:'文章获取进程',width:120}
                ,{field:'c_time', title:'创建时间', width:180}
                ,{field:'s_time', title:'最后启动时间', width:180}
                ,{field:'status', title:'总状态'}
                ,{field:'operation', title:'操作'}
                ,{fixed: 'right', width: 300, align:'center', toolbar: '#barDemo'}

            ]]
            ,page: false
            ,parseData: function(res){ //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.threadlist, //解析数据列表
                };
            }
        });
    });
</script>