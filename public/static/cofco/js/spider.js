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
        // , toolbar: true
        , title: '用户数据表'
        // , totalRow: true
        , cellMinWidth: 80
        , smartReloadModel:true
        , reloaddingShow:false
        , cols: [[
            {field: 'uid', title: 'ID', width: 50, fixed: 'left', unresize: true, sort: true, totalRowText: '合计行'}
            , {field: 'uname', title: '用户名', width: 100}
            , {field: 'kw_id', title: '关键词ID', width: 80}
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

    function reload_table (){
        table.reload('testReload', {})
    }
    setInterval(reload_table, 1500);
    addBarEvent(table,'{$controlspider_url}');
});
function addBarEvent(table,url){
    //监听行工具事件
    table.on('tool(test)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            , layEvent = obj.event; //获得 lay-event 对应的值
        var $ = layui.jquery;
        switch (layEvent) {
            case 'pause':
                console.log(url);
                $.ajax({
                    url:url, //+'?kw_id='+data.kw_id+'&action=pause',
                    data:{kw_id:data.kw_id,action:"pause",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(url);
                        console.log(res);
                    }
                });
                break;
            case 'resume':
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"resume",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);

                    }
                });
                break;
            case 'terminate':
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"terminate",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);

                    }
                });
                break;
            case 'del':
                console.log(url);
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"del",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);
                    }
                });
                break;
        }
        table.reload('testReload', {})

    });
}

