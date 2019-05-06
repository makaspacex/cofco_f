{include file="cofco@block/layui" /}
<div class="layui-btn layui-btn-primary" lay-event="new" id="new">新建爬虫</div>
<table class="layui-hide" id="test" lay-filter="test"></table>
<script type="text/html" id="barDemo">
    <div style="width: 300px;height: 80px">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="pause">暂停爬虫</a>
        <a class="layui-btn  layui-btn-xs" lay-event="resume">恢复爬虫</a>
        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="terminate">终止爬虫</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除爬虫</a>
        <br>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停IDS</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复IDS</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止IDS</a>
        <br>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">暂停Content</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">恢复Content</a>
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">终止Content</a>
    </div>
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
    newBtn = document.getElementById("new");
    newBtn.onclick = function(){
        console.log("1");
        layer.open({
            type:2,
            content:'add',
            offset: 'auto',
            area: ['800px', '100%'] //自定义文本域宽高
        });

    }
    console.log("1");

    //监听工具条
    function renderTable() {
        layui.use(['jquery', 'table'], function () {
            var table = layui.table;
            table.render({
                elem: '#test'
                , url: '{$getthreadstatus_url}'
                , toolbar: true
                , title: '用户数据表'
                , totalRow: true
                , cellMinWidth: 100
                , cols: [[
                    {field: 'uid', title: 'ID', width: 80, fixed: 'left', unresize: true, sort: true, totalRowText: '合计行'}
                    , {field: 'uname', title: '用户名', width: 120}
                    , {field: 'kw_id', title: '关键词ID', width: 100}
                    , {field: 'sp_t', title: '爬虫', width: 150}
                    , {field: 'w_num', title: '爬虫数目'}
                    , {field: 'pN', title: '页数'}
                    , {field: 'f_pN', title: '完成页数'}
                    , {field: 'fail_pN', title: '失败页数'}
                    , {field: 'fail_num', title: '失败文章'}
                    , {field: 'total_num', title: '总文章'}
                    , {field: 'idsP_status', title: '翻页进程'}
                    , {field: 'cP_status', title: '文章获取进程', width: 120}
                    , {field: 'c_time', title: '创建时间', width: 180}
                    , {field: 's_time', title: '最后启动时间', width: 180}
                    , {field: 'status', title: '状态',templet: '#statusTpl'}
                    , {field: 'operation', title: '操作'}
                    , {fixed: 'right', width: 300, align: 'center', toolbar: '#barDemo'}

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
            addBarEvent(table,'{$controlspider_url}');
        });
    }




    function runEvery10Sec() {
        // 1000 * 10 = 10 秒钟
        setTimeout(runEvery10Sec, 1000 *20);
        renderTable();
        //
        // layui.use(['jquery'], function () {
        // var $ = layui.jquery;
        //     $.ajax({
        //         type: "POST",
        //         url: '{$getthreadstatus_url}',
        //         success: function(res) {
        //            console.log(res);
        //             //同步更新缓存对应的值
        //            var  data = res.data.threadlist;
        //             obj.update({
        //                 w_num: data
        //                 ,pN: 'xxx'
        //                 ,f_pN :
        //                 ,fail_pN:
        //                 ,fail_num:
        //                 ,total_num:
        //                 ,idsP_status:
        //                 ,cP_status:
        //
        //             });
        //         }
        //     });
        // });

    }
    runEvery10Sec();
    //监听工具条

</script>

