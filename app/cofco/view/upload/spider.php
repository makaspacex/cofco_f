{include file="admin@block/layui" /}
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="spider_new">新建爬虫</button>
    </div>
</script>

<table class="layui-hide" id="test" lay-filter="test"></table>
<script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-primary layui-btn-sm" lay-event="pause">暂停</a>
        <a class="layui-btn  layui-btn-sm" lay-event="resume">恢复</a>
        <a class="layui-btn layui-btn-warm layui-btn-sm" lay-event="terminate">终止</a>
        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
<!--        <br>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停IDS</a>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复IDS</a>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止IDS</a>-->
<!--        <br>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停Content</a>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复Content</a>-->
<!--        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止Content</a>-->
<!--    -->
</script>

<script type="text/html" id="statusTpl">
    {{#  if(d.status == 0){ }}
    <a>未运行</a>
    {{#  } else if (d.status == 1) { }}
    <a>运行中</a>
    {{#  } else if (d.status == 2) { }}
    <a>已暂停</a>
    {{#  } else if (d.status == 3) { }}
    <a>已完成</a>
    {{#  } else if (d.status == 4) { }}
    <a>已终止</a>
    {{#  } else if (d.status == 5) { }}
    <a>混合状态</a>
    {{#  } else if (d.status == 6) { }}
    <a>失败</a>
    {{#  } else{ }}
    <a>未初始化</a>
    {{# } }}
</script>

<script src="__COFCO_JS__/spider.js"></script>
<script>

    layui.use(['jquery', 'table','tablePlug'], function () {
        var table = layui.table;
        var tablePlug = layui.tablePlug;
        var $ = layui.$;

        tablePlug.smartReload.enable(true);
        console.log('{$controlspider_url}');

        table.render({
            elem: '#test'
            ,id: 'testReload'
            , url: '{$getthreadstatus_url}'
            , toolbar: '#toolbarDemo'
            , title: '用户数据表'
            , totalRow: true
            , cellMinWidth: 80
            , smartReloadModel:true
            , reloaddingShow:false
            , cols: [[
                {field: 'uid', title: 'ID', width: 50, fixed: 'left', unresize: true, sort: true, totalRowText: '合计行'}
                , {field: 'uname', title: '用户名', width: 100}
                , {field: 'kw_name', title: '关键词名', width: 80}
                , {field: 'sp_t', title: '爬虫', width: 140}
                // , {field: 'w_num', title: '爬虫数目'}
                // , {field: 'pN', title: '页数'}
                // , {field: 'f_pN', title: '完成页数'}
                // , {field: 'fail_pN', title: '失败页数'}
                , {field: 'total_num', title: '总文章'}
                , {field: 'f_num', title: '完成文章'}
                , {field: 'fail_num', title: '失败文章'}

                // , {field: 'idsP_status', title: '翻页进程'}
                // , {field: 'cP_status', title: '文章获取进程', width: 120}
                , {field: 'c_time', title: '创建时间', width: 165}
                , {field: 's_time', title: '最后启动时间', width: 165}
                , {field: 'status', fixed: 'right',title: '状态',templet: '#statusTpl',width:80}
                // , {field: 'operation', title: '操作'}
                , {fixed: 'right', width: 260, align: 'center', toolbar: '#barDemo'}

            ]]
            , page: false
            , parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.count, //解析数据长度
                    "data": res.data.threadlist, //解析数据列表
                };
            }
        });

        table.on('toolbar(test)', function (obj) {
            if(obj.event === 'spider_new'){
                layer.open({
                    type:2,
                    content:'add',
                    offset: 'auto',
                    area: ['800px', '80%'] //自定义文本域宽高
                });
            }
        });

        function reload_table (){
            table.reload('testReload', {})
        }
        setInterval(reload_table, 1500);
        addBarEvent(table,'{$controlspider_url}');
    });

</script>

