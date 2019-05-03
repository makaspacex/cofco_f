layui.use(['table'], function () {
    var url = window.location.href;
    var data_url = url.replace(/index/,"data");
    var table = layui.table;
    var $ = layui.jquery;
    layui.use('form', function(){
        try {
            $("#journal_zone").find("option[value={:input('get.journal_zone')}]").attr('selected', 'true');
        }
        catch (e) {

        }
        try {
            $("#sstr").find("option[value={:input('get.sstr')}]").attr('selected', 'true');
        }catch (e) {

        }
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
            , {fixed: 'right', width: 180, align: 'center', toolbar: '#barDemo'}
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
        switch (obj.event) {
            case 'pending_add':
                window.event.returnValue=false;
                window.location.href = "add";
                break;
            case 'pending_del':
                var checkStatus = table.checkStatus(obj.config.id);
                pending_del(checkStatus);
                break;
            case 'pending_del_all':
                pending_del_all();
                break;
        }
        ;
    });


});