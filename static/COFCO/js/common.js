/**
 * 删除选择数据
 * @param checkStatus
 */
function del_check_data(checkStatus) {
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
}


/**
 * 审核通过所选数据
 */
function pass_check_data(checkStatus) {
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
        ,title: '确认使以下内容通过审核吗'
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
/**删除当前所有数据
 *
 */
function pending_del_all() {
    var url = window.location.href;
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

}

/**
 * 查看数据详情
 * @param data
 */
function detail(data) {
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
}

/**
 * 获得表数据及表格初始化
 * @param url
 * @param title
 * @returns 表格信息
 */
function getTable(type) {
    var url = window.location.href;
    var data_url = url.replace(/index/,"data");
    return {
        elem: '#demo'
        , url: data_url
        , toolbar: '#toolbarDemo'
        , cellMinWidth: 80
        , title: getTitle(type)
        // , totalRow: true
        , cols: getcols(type)
        , page: true
        , limit:15
        ,limits :[15,20,30,40,50,60,70,80]
        , parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
        return {
            "code": res.code, //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.data.total, //解析数据长度
            "data": res.data.data //解析数据列表
        };
    }

    }

}

/**
 * 获得标题
 * @param type
 * @returns {string}
 */
function getTitle(type) {
    switch (type) {
        case '1':
            return "爬虫数据表";
        case '2':
            return "审核及标注表";
        case '3':
            return "已审核数据表";
        case '4':
            return "输出数据表"
    }
}

/**
 * 获取表头
 * @param type
 * 1.爬虫数据表 2.审核及标注数据表 3.已审核数据表 4.输出数据表
 * @returns {*[][]|*}
 */
function getcols(type) {
    switch (type) {
        case '1' :
            return getSpiderCol();
        case '2':
            return getPendingCol();
        case '3':
            return getFinalyCol();
        case '4':
            return getOutputCol();
    }

}

/**
 * 获得爬虫数据表头
 * @returns {*[][]}
 */
function getSpiderCol() {
    return [[
        {type: 'checkbox', fixed: 'left'}
        // , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
        , {field: 'title', title: '文章标题', width: 500}
        , {field: 'sstr', title: '爬虫关键词', width: 200}
        // , {field: 'creater', title: '创建人', width: 90}
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
    ]];
}

/**
 * 获得审核及标注数据表头
 */
function getPendingCol() {
   return [[
       {type: 'checkbox', fixed: 'left'}
       // , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
       , {field: 'title', title: '文章标题', width: 500}
       , {field: 'sstr', title: '爬虫关键词', width: 200}
       , {field: 'creater', title: '创建人', width: 90,sort: true}
       // , {field: 'auditor', title: '审核人', width: 90}
       // , {field: 'final_auditor', title: '终审核', width: 90}
       , {field: 'ctime', title: '创建时间', width: 150,sort: true}
       , {field: 'special_version', title: '特别说明', width: 90,sort: true}
       , {field: 'document_type', title: '文献类型', width: 90,sort: true}
       , {field: 'urgency', title: '紧要程度', width: 90,sort: true}
       , {field: 'status', title: '状态', width: 90, templet: '#statusTpl',sort: true}
       , {field: 'tabstract', title: '摘要翻译', width: 100,sort: true}
       , {field: 'doi', title: 'doi', width: 100,sort: true}
       , {field: 'impact_factor', title: '影响因子', width: 100,sort: true}
       , {field: 'country', title: '国家', width: 100,sort: true}
       , {field: 'author', title: '作者', width: 100,sort: true}
       , {field: 'journal', title: '所属期刊', width: 100,sort: true}
       , {field: 'journal_zone', title: '期刊分区', width: 100,sort: true}
       , {field: 'issue', title: '文章发表时间', width: 100,sort: true}
       , {field: 'keyword', title: '关键词', width: 100,sort: true}
       , {field: 'institue', title: '发表机构', width: 100,sort: true}
       , {fixed: 'right', width: 180, align: 'center', toolbar: '#barDemo'}
   ]];
}


/**
 * 获得已审核数据表头
 */
function getFinalyCol() {
    return [[
        {type: 'checkbox', fixed: 'left'}
        // ,{field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
        ,{field: 'title', title: '文章标题', width:500,sort: true}
        ,{field: 'sstr', title: '爬虫关键词', width:200,sort: true}
        , {field: 'creater', title: '创建人', width: 90,sort: true}
        , {field: 'auditor', title: '审核人', width: 90,sort: true}
        // , {field: 'final_auditor', title: '终审核', width: 90}
        ,{field: 'journal_zone', title: '期刊分区', width: 100,sort: true}
        ,{field: 'impact_factor', title: '影响因子', width: 100,sort: true}
        ,{field: 'special_version', title: '特别说明', width:90,sort: true}
        ,{field: 'document_type', title: '文献类型', width:90,sort: true}
        ,{field: 'urgency', title: '紧要程度', width: 90,sort: true}
        ,{field: 'status', title: '状态', width: 90,templet: '#statusTpl',sort: true}
        ,{field: 'tabstract', title: '摘要翻译', width: 100,sort: true}
        ,{field: 'doi', title: 'doi', width: 100,sort: true}
        ,{field: 'country', title: '国家', width: 100,sort: true}
        ,{field: 'author', title: '作者', width: 100,sort: true}
        ,{field: 'journal', title: '所属期刊', width: 100,sort: true}
        ,{field: 'issue', title: '文章发表时间', width: 100,templet:'#timeTpl',sort: true}
        ,{field: 'keyword', title: '关键词', width: 100,sort: true}
        ,{field: 'institue', title: '发表机构', width: 100,sort: true}
        ,{fixed: 'right', width: 200, align:'center', toolbar: '#barDemo'}
    ]];
}

/**
 * 获得输出数据表头
 * @returns {*[][]}
 */
function getOutputCol() {
    return [[
        {type: 'checkbox', fixed: 'left'}
        // ,{field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
        ,{field: 'title', title: '文章标题', width:500,sort: true}
        ,{field: 'sstr', title: '爬虫关键词', width:200,sort: true}
        , {field: 'creater', title: '创建人', width: 100,sort: true}
        , {field: 'auditor', title: '审核人', width: 100,sort: true}
        , {field: 'final_auditor', title: '终审核', width: 100,sort: true}
        ,{field: 'special_version', title: '特别说明', width:90,sort: true}
        ,{field: 'document_type', title: '文献类型', width:90,sort: true}
        ,{field: 'urgency', title: '紧要程度', width: 90,sort: true}
        ,{field: 'status', title: '状态', width: 90,templet: '#statusTpl',sort: true}
        ,{field: 'tabstract', title: '摘要翻译', width: 100,hide:'true',sort: true}
        ,{field: 'doi', title: 'doi', width: 100,hide:'true',sort: true}
        ,{field: 'impact_factor', title: '影响因子', width: 100,hide:'true',sort: true}
        ,{field: 'country', title: '国家', width: 100,hide:'true',sort: true}
        ,{field: 'author', title: '作者', width: 100,hide:'true',sort: true}
        ,{field: 'journal', title: '所属期刊', width: 100,hide:'true',sort: true}
        ,{field: 'journal_zone', title: '期刊分区', width: 100}
        ,{field: 'issue', title: '文章发表时间', width: 100,hide:'true',sort: true}
        ,{field: 'keyword', title: '关键词', width: 100,hide:'true',sort: true}
        ,{field: 'institue', title: '发表机构', width: 100,hide:'true',sort: true}
        ,{fixed: 'right', width: 120, align:'center', toolbar: '#barDemo'}
    ]];

}



/**
 * 加载表格上边按钮的监听事件
 * @param table
 */
function addToolBarEvent(table){
    table.on('toolbar(test)', function (obj) {
        switch (obj.event) {
            case 'pending_add':
                window.event.returnValue=false;
                window.location.href = "add";
                break;
            case 'pending_del':
                var checkStatus = table.checkStatus(obj.config.id);
                del_check_data(checkStatus);
                break;
            case 'pending_del_all':
                pending_del_all();
                break;
            case 'pass_check_data':
                var checkStatus = table.checkStatus(obj.config.id);
                pass_check_data(checkStatus);

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
}

/**
 * 加载表格右边的监听事件
 * @param table
 */
function addBarEvent(table){
    //监听行工具事件
    table.on('tool(test)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            , layEvent = obj.event; //获得 lay-event 对应的值
        switch (layEvent) {
            case 'detail':
                //查看数据详情
                detail(data);
                break;
            case 'del':
                //删除数据
                window.location.href = "del?ids=" + data.id;
                break;
            case 'edit':
                //编辑数据
                window.location.href = "edit?id=" + data.id;
                break;
            case 'pass':
                window.location.href = "passData?ids=" + data.id;
                // var $ = layui.jquery
                // $.ajax({
                //     url:"cofco_f/admin.php/cofco/spiderdata/passData",
                //     data:{ids:data.id},
                //     type:"get",
                //     dataType:"json",
                //     success:function (res) {
                //
                //         console.log(res);
                //
                //     }
                // });
                break;

        }

    });
}