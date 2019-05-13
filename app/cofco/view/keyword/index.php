{include file="admin@block/layui" /}

<table class="layui-hide" id="demo" lay-filter="test"></table>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>

</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="addPubmed">添加Pubmed关键词</button>
        <button class="layui-btn layui-btn-sm" lay-event="addScience">添加Science关键词</button>

        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="delete">删除</button>
    </div>
</script>
<script>
    layui.use(['table', 'form', 'jquery'], function () {
        var table = layui.table;
        table.render({
            elem: '#demo'
            , url: 'data'
            , title: '关键词列表'
            ,toolbar: '#toolbar'
            , cols: [[ //表头
                {type: 'checkbox', fixed: 'left', width: '5%'}
                , {field: 'id', title: 'ID', width: '10%'}
                , {field: 'name', title: '关键词名称', width: '25%'}
                , {field: 'type', title: '类型', width: '10%', templet: typeTpl}
                , {field: 'username', title: '创建人', width: '10%'}
                , {field: 'status', title: '状态', width: '10%', templet: statusTpl}
                , {field: 'ctime', title: '创建时间', width: '15%'}
                , {fixed: 'right', width: '15%', align: 'center', toolbar: '#barDemo'}

            ]]
            , parseData: function (res) { //res 即为原始返回的数据
                return {
                    "code": res.status, //解析接口状态
                    "msg": res.message, //解析提示文本
                    "data": res.data //解析数据列表
                };
            }
        });
        //监听工具条
        table.on('tool(test)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象

            if (layEvent === 'detail') { //查看
                console.log(data.type);
                data.type === '1' ? detailPubmed(data.value) : detailScience(data.value);
            } else if (layEvent === 'del') { //删除
                layer.confirm('删除后不可恢复，确认删除吗？', function (index) {
                    obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                    layer.close(index);
                    $ = layui.jquery;
                    $.ajax({
                        type: "POST",
                        url: 'kwdel',
                        data: {'ids': data.id},
                        success: function (res) {
                            console.log(res);
                        }
                    });
                });
            } else if (layEvent === 'edit') { //编辑
                //do something

                //同步更新缓存对应的值
                obj.update({
                    username: '123'
                    , title: 'xxx'
                });
            }
        });

        table.on('toolbar(test)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'addPubmed':
                    addPubmedKeyword();
                    break;
                case 'addScience':
                    addScienceKeyword();
                    break;
                case 'delete':
                    var data = checkStatus.data;
                    var ids = new Array();
                    for (var i = 0; i < data.length; i++) {
                        ids.push(data[i].id);
                    }
                    layer.confirm('删除后不可恢复，确认删除吗？', function (index) {
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        $ = layui.jquery;
                        $.ajax({
                            type: "POST",
                            url: 'kwdel',
                            data: {'ids': ids},
                            success: function (res) {
                                console.log(res);
                            }
                        });
                    });
                    break;
            };
        });
        var form = layui.form;
        var $ = layui.jquery;
        form.on('switch(status)', function (obj) {
            var id = $(this).attr('id');
            var status = $(this).attr('status');
            $.ajax({
                url: 'setstatus',
                type: 'post',
                data: {'status': status, 'ids': id},
                success: function (res) {
                    if (res.code == 1) {
                        layer.msg('修改成功');
                    } else {
                        layer.msg('修改失败');
                    }


                }
            });

        });
    });


    var typeTpl = function (d) {
        return (d.type == '1' ? '<a>Pubmed</a>' : '<a>Science</a>');
    }

    /**
     * 时间转换模板
     * @param d
     * @returns {string}
     */
    var statusTpl = function (d) {
        var D = document.createElement('div')
        console.log(d['id']);
        console.log('setstatus?status=' + d.status + '&ids=' + d.id);

        var status = document.createElement('input');
        status.setAttribute("type", "checkbox");
        status.setAttribute("lay-skin", "switch");
        status.setAttribute("lay-text", "正常|关闭");
        status.setAttribute("name", "status");
        status.setAttribute("lay-filter", "status");
        status.setAttribute("id", d.id);
        status.setAttribute("status", d.status);
        if (d.status) {
            status.setAttribute("checked", "");
        }
        D.appendChild(status);
        return D.innerHTML;
    }

</script>

<script>

    // 字符串转化
    function symbolTransform(str) {
        switch (str) {
            case 'none':
                return "";
            case '1':
                return "and";
            case "2":
                return "or";
            case "3":
                return "not";
            default:
                return str;
        }
    }

    function articleTypesTransform(str) {
        switch (str) {
            case 'REV':
                return "Review articles";
            case 'COR':
                return "Correspondence";
            case 'PNT':
                return "Patent reports";
            case 'FLA':
                return "Research articles";
            case 'DAT':
                return "Data articles";
            case 'PGL':
                return "Practice guidelines";
            case 'EN' :
                return "Encyclopedia";
            case 'DIS':
                return "Discussion";
            case 'PRV':
                return "Product reviews";
            case 'CH':
                return "Book chapters";
            case 'EDI':
                return "Editorials";
            case 'RPL':
                return "Replication studies";
            case 'ABS':
                return "Conference abstracts";
            case 'ERR':
                return "Errata";
            case 'SCO':
                return "Short communications";
            case 'BRV':
                return "Book reviews";
            case 'EXM':
                return "Examinations";
            case 'OSP':
                return "Software publications";
            case 'CRP':
                return "Case reports";
            case 'CNF':
                return "Mini reviews";
            case 'SSU':
                return "Video articles";
            case 'NWS':
                return "Conference info";
            case 'VID':
                return "News";
            case 'OT':
                return "Other";
            default:
                return str;
        }
    }

    function detailPubmed(data) {
        console.log("Pubmed");
        data = JSON.parse(data);
        console.log(data);
        var content = '<table class="layui-table">' +
            '<colgroup>\n' +
            '<col width="100">\n' +
            '<col width="150">\n' +
            '<col width="400">\n' +
            '</colgroup>';
        for (var o in data) {
            content += '<tr>';
            for (var i in data[o]) {
                console.log(i);
                if (i === 'symbol') {
                    data[o][i] = symbolTransform(data[o][i]);
                }
                content += '<td>' + data[o][i] + '</td>';
                // content+= '<tr><td>'+o+'</td><td>' + data[o] +'</td></tr>';
            }
            content += '</tr>';

        }
        content += "</table>";
        layer.open({
            type: 1 //Page层类型
            , offset: 'auto'
            , skin: 'layer-ext-moon'
            , area: ['750px', "80%"]
            , title: 'Pubmed爬虫关键词'
            , shade: 0.5 //遮罩透明度
            // ,maxmin: true //允许全屏最小化
            , anim: 1 //0-6的动画形式，-1不开启
            , content: content
        });
    }

    function detailScience(data) {
        data = JSON.parse(data)
        var content = '<table class="layui-table">' +
            '<colgroup>\n' +
            '<col width="100">\n' +
            '<col width="400">\n' +
            '</colgroup>';
        for (var o in data) {
            if (o === 'articleTypes') {
                content += "</table>";
                content += '<table class="layui-table">' +
                    '<colgroup>' +
                    '<col width="100">' +
                    '<col width="100">' +
                    '<col width="100">' +
                    '<col width="100">' +
                    '<col width="100">' +
                    '</colgroup>';
                content += '<tr><td>' + o + '</td>';
                var count = 0;
                for (var i in data[o]) {
                    content += '<td>' + articleTypesTransform(i) + '</td>';
                    // content+= '<tr><td>'+o+'</td><td>' + data[o] +'</td></tr>';
                    count++;
                    if(count%4===0){
                        content +='</tr><tr><td></td>';
                    }

                }

            } else {
                content += '<tr><td>' + o + '</td><td>' + data[o] + '</td></tr>';
            }
        }
        content += "</table>";
        layer.open({
            type: 1 //Page层类型
            , offset: 'auto'
            , skin: 'layer-ext-moon'
            , area: ['800px', "80%"]
            , title: 'Science爬虫关键词 '
            , shade: 0.5 //遮罩透明度
            // ,maxmin: true //允许全屏最小化
            , anim: 1 //0-6的动画形式，-1不开启
            , content: content
        });
    }

    function addPubmedKeyword() {
        layer.open({
            type: 2 //Page层类型
            , offset: 'auto'
            , skin: 'layer-ext-moon'
            , area: ['800px', "85%"]
            , title: '添加Pubmed爬虫关键词 '
            , shade: 0.5 //遮罩透明度
            // ,maxmin: true //允许全屏最小化
            , anim: 1 //0-6的动画形式，-1不开启
            , content: 'addpubmedkw'
            ,end :function (){
                location.reload()
            }
        });
    }

    function addScienceKeyword() {
        layer.open({
            type: 2 //Page层类型
            , offset: 'auto'
            , skin: 'layer-ext-moon'
            , area: ['800px', "85%"]
            , title: '添加Science爬虫关键词 '
            , shade: 0.5 //遮罩透明度
            , anim: 1 //0-6的动画形式，-1不开启
            , content: 'addsciencekw'
            ,end :function (){
                location.reload()
            }
        });
    }
</script>

