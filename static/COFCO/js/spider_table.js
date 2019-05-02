layui.use(['table'], function () {
    var url = window.location.href;
    var data_url = url.replace(/index/,"data");
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
    table.render({
        elem: '#demo'
        , url: data_url
        , toolbar: true
        , toolbar: '#toolbarDemo'
        , cellMinWidth: 80
        , title: '未审核数据表'
        , totalRow: true
        , cols: [[
            {type: 'checkbox', fixed: 'left'}
            , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
            , {field: 'title', title: '文章标题', width: 500, fixed: 'left'}
            , {field: 'sstr', title: '爬虫关键词', width: 200}
            , {field: 'creater', title: '创建人', width: 90}
            // , {field: 'auditor', title: '审核人', width: 90}
            // , {field: 'final_auditor', title: '终审核', width: 90}
            , {field: 'ctime', title: '创建时间', width: 290}
            , {field: 'special_version', title: '特别说明', width: 90}
            , {field: 'document_type', title: '文献类型', width: 90}
            , {field: 'urgency', title: '紧要程度', width: 90}
            , {field: 'status', title: '状态', width: 90, templet: '#statusTpl'}
            , {field: 'tabstract', title: '摘要翻译', width: 100}
            , {field: 'doi', title: 'doi', width: 100}
            , {field: 'impact_factor', title: '影响因子', width: 100}
            , {field: 'country', title: '国家', width: 100}
            , {field: 'author', title: '作者', width: 100}
            , {field: 'journal', title: '所属期刊', width: 100}
            , {field: 'journal_zone', title: '期刊分区', width: 100}
            , {field: 'issue', title: '文章发表时间', width: 100}
            , {field: 'keyword', title: '关键词', width: 100}
            , {field: 'institue', title: '发表机构', width: 100}
            , {fixed: 'right', width: 200, align: 'center', toolbar: '#barDemo'}
        ]]
        , page: true
        , parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
            // console.log(res);
            tableContent = res;
            return {
                "code": res.code, //解析接口状态
                "msg": res.message, //解析提示文本
                "count": res.data.total, //解析数据长度
                "data": res.data.data //解析数据列表
            };
        }

    });
    table.on('toolbar(test)', function (obj) {
        var checkStatus = table.checkStatus(obj.config.id);
        switch (obj.event) {
            case 'pending_add':
                window.event.returnValue=false;
                window.location.href = "add";
                break;
            case 'pending_del':
                window.event.returnValue=false; //禁止表单提交
                var data = checkStatus.data;
                var ids = new Array();
                var content =  '<table class="layui-table">' +
                    '<colgroup>' +
                    '<col width="50">' +
                    '<col width="700">' +
                    '</colgroup>'+
                    '<thead><tr> ' +
                    '<th>ID</th> ' +
                    '<th>文章标题</th> ' +
                    '</tr> ' +
                    '</thead>'+'<tbody>';
                for (var i = 0; i < data.length; i++) {
                    ids.push(data[i].id);
                    content += '<tr><td>'+data[i].id+'</td><td>'+data[i].title+'<td></tr>';
                    console.log(data[i]);
                }
                content+= '</tbody></table>'
                console.log(ids);
                layer.open({
                    type: 1 //Page层类型
                    ,offset: 'auto'
                    ,skin: 'layer-ext-moon'
                    ,area: ['750px', '500px']
                    ,title: '确认删除以下内容吗'
                    ,shade: 0.5 //遮罩透明度
                    // ,maxmin: true //允许全屏最小化
                    ,anim: 1 //0-6的动画形式，-1不开启
                    ,content: content
                    , btn: ['确定', '取消']
                    , yes: function (index) {
                        layer.close(index);
                        window.location.href = "del?ids="+ids;
                    }
                });

                break;
            case 'pending_del_all':
                var getAllIdByCondition_url = url.replace(/index/,"getAllIdByCondition");
                var $ = layui.jquery;
                window.event.returnValue=false; //禁止表单提交
                $.ajax({
                    url: getAllIdByCondition_url,
                    data: "",
                    type: "get",
                    dataType: "json",
                    success: function(res) {
                        res = $.parseJSON(res);  //dataType指明了返回数据为json类型，故不需要再反序列化
                        var ids = res["data"];
                        var count = res["count"];
                        var content = '<table class="layui-table"><tr>';
                        for (var i =0;i<count;i++){
                            content+='<td> '+ids[i]+' </td>';
                            if((i+1)%10==0){
                                content+='</tr><tr>';
                            }
                        }
                        content+="</tr></table>";
                        layer.open({
                            type: 1 //Page层类型
                            ,area: ['800px', '500px']
                            ,title: '确认删除以下'+count+'条数据吗?'
                            ,shade: 0.5 //遮罩透明度
                            // ,maxmin: true //允许全屏最小化
                            ,anim: 1 //0-6的动画形式，-1不开启
                            ,content: content
                            , btn: ['确定', '取消']
                            , yes: function (index) {
                                layer.close(index);
                                window.location.href = "del?ids="+ids;
                            }
                        });
                    }
                });
                break;
            case 'pass_check_data':
                window.event.returnValue=false; //禁止表单提交
                var data = checkStatus.data;
                var ids = new Array();
                var content =  '<table class="layui-table">' +
                    '<colgroup>' +
                    '<col width="50">' +
                    '<col width="700">' +
                    '</colgroup>'+
                    '<thead><tr> ' +
                    '<th>ID</th> ' +
                    '<th>文章标题</th> ' +
                    '</tr> ' +
                    '</thead>'+'<tbody>';
                for (var i = 0; i < data.length; i++) {
                    ids.push(data[i].id);
                    content += '<tr><td>'+data[i].id+'</td><td>'+data[i].title+'<td></tr>';
                    console.log(data[i]);
                }
                content+= '</tbody></table>'
                console.log(ids);
                layer.open({
                    type: 1 //Page层类型
                    ,offset: 'auto'
                    ,skin: 'layer-ext-moon'
                    ,area: ['750px', '500px']
                    ,title: '确认审核通过以下内容吗'
                    ,shade: 0.5 //遮罩透明度
                    // ,maxmin: true //允许全屏最小化
                    ,anim: 1 //0-6的动画形式，-1不开启
                    ,content: content
                    , btn: ['确定', '取消']
                    , yes: function (index) {
                        layer.close(index);
                        window.location.href = "passData?ids="+ids;
                    }
                });

                break;
            case 'pass_all_data':
                var getAllIdByCondition_url = url.replace(/index/,"getAllIdByCondition");
                var $ = layui.jquery;
                window.event.returnValue=false; //禁止表单提交
                $.ajax({
                    url: getAllIdByCondition_url,
                    data: "",
                    type: "get",
                    dataType: "json",
                    success: function(res) {
                        res = $.parseJSON(res);  //dataType指明了返回数据为json类型，故不需要再反序列化
                        var ids = res["data"];
                        var count = res["count"];
                        var content = '<table class="layui-table"><tr>';
                        for (var i =0;i<count;i++){
                            content+='<td> '+ids[i]+' </td>';
                            if((i+1)%10==0){
                                content+='</tr><tr>';
                            }
                        }
                        content+="</tr></table>";
                        layer.open({
                            type: 1 //Page层类型
                            ,area: ['800px', '500px']
                            ,title: '确认审核通过以下'+count+'条数据吗?'
                            ,shade: 0.5 //遮罩透明度
                            // ,maxmin: true //允许全屏最小化
                            ,anim: 1 //0-6的动画形式，-1不开启
                            ,content: content
                            , btn: ['确定', '取消']
                            , yes: function (index) {
                                layer.close(index);
                                window.location.href = "passData?ids="+ids;
                            }
                        });
                    }
                });
                break;
        }
        ;
    });

    //监听行工具事件
    table.on('tool(test)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            , layEvent = obj.event; //获得 lay-event 对应的值
        if (layEvent === 'detail') {
            var content = '<table class="layui-table">';
            for(var o in data){
                content+= '<tr><td>'+o+'</td><td>' + data[o] +'</td></tr>';
            }
            content+="</table>";
            layer.open({
                type: 1 //Page层类型
                ,offset: 'auto'
                ,skin: 'layer-ext-moon'
                ,area: ['750px', "100%"]
                ,title: '当前行数据'
                ,shade: 0.5 //遮罩透明度
                // ,maxmin: true //允许全屏最小化
                ,anim: 1 //0-6的动画形式，-1不开启
                ,content: content
            });
        } else if (layEvent === 'del') {
            window.location.href = "del?ids=" + data.id;
        } else if (layEvent === 'edit') {
            // layer.open({
            //     type: 2//Page层类型
            //     ,area: ['800px', '100%']
            //     ,title: '编辑'
            //     ,shade: 0.5 //遮罩透明度
            //     // ,maxmin: true //允许全屏最小化
            //     ,anim: 1 //0-6的动画形式，-1不开启
            //     ,content: "pending_edit?id=" + data.id
            //     , btn: ['确定', '取消']
            //     , yes: function (index) {
            //         layer.close(index);
            //     }
            // });
            window.location.href = "edit?id=" + data.id;
        }
    });
});