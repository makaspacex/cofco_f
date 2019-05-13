<table class="layui-hide" id="articletable" lay-filter="articletable"></table>
<!-- =================  通用工具按钮, script标签的ID不要变  ===================================================-->
<div type="text/html" id="general_toolbar" class="hide">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="select_all_row">全选</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="de_select">反选</button>
        <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del_selected">删除选中</button>
    </div>
</div>
<!--预留站位-->
<div type="text/html" id="all_toolbar" class="hide"></div>

<!-- =================  通用每行的按钮, script标签的ID不要变  ===================================================-->
<div type="text/html" id="general_rowtools" class="hide">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">详情</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="source">来源</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del_this_row">删除</a>
</div>
<!--预留站位-->
<div type="text/html" id="all_rowtools" class="hide"></div>

<script>

    // 全局共享数据
    SEARCH_RESULT_ROWS = -1



    function getField(except_field=[],width){
        var all_filed = [
            {type: 'checkbox', fixed: 'left'}
            // , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
            , {field: 'title', title: '文章标题', width: 500, sort: true}
            , {field: 'issue', title: '发表时间', width: 100, sort: true}
            , {field: 'keyword', title: '关键词', width: 100}
            , {field: 'kw_id', title: '爬虫关键词', width: 100, templet: function(d){return d.kw_id>0? "<a href='#'>"+d['spider_kw']['name']+"</a>":"<a></a>"}}
            , {field: 'creater', title: '创建人', width: 90, sort: true, templet: function(d){return d['create_user']['nick']}}
            , {field: 'auditor', title: '审核人', width: 90, sort: true}
            , {field: 'final_auditor', title: '终审核', width: 90, sort: true}
            , {field: 'ctime', title: '创建时间', width: 150, sort: true}
            , {field: 'special_version', title: '特别说明', width: 90}
            , {field: 'document_type', title: '文献类型', width: 90, sort: true}
            , {field: 'urgency', title: '紧要程度', width: 90, sort: true}
            // , {field: 'status', title: '状态', width: 90, sort: true}
            , {field: 'abstract', title: '摘要', width: 100}
            , {field: 'tabstract', title: '摘要翻译', width: 100}
            , {field: 'doi', title: 'doi', width: 100}
            , {field: 'impact_factor', title: '影响因子', width: 100, sort: true}
            , {field: 'country', title: '国家', width: 100}
            , {field: 'author', title: '作者', width: 100}
            , {field: 'journal', title: '所属期刊', width: 100}
            , {field: 'journal_zone', title: '期刊分区', width: 100, sort: true}
            , {field: 'institue', title: '发表机构', width: 100}
            , {title: '操作',fixed: 'right', width: width, align: 'center', toolbar: '#all_rowtools'}
        ];
        var new_filed = [];
        for(var key in all_filed){
            var ele = all_filed[key];
            var is_push = true;
            for(var ex_key in except_field){
                var ex_filed_name = except_field[ex_key];
                if(ele.field === ex_filed_name){
                    is_push = false;
                }
            }
            if(is_push){ new_filed.push(ele)};
        }
        var cols = [];
        cols.push(new_filed);
        return cols
    }

    // 删除按钮样式控制

    function enable_del_btn() {
        $('#del_query_data').removeClass('layui-btn-disabled');
        $('#del_query_data').attr('disabled',false);
    }

    function disable_del_btn() {
        $('#del_query_data').addClass('layui-btn-disabled');
        $('#del_query_data').attr('disabled',true);
    }


    // 文章列表统一渲染方法
    function render_article_table(url,except_field=[], width=80,title='') {
        layui.use(['jquery', 'table', 'tablePlug','layer'], function () {
            var tablePlug = layui.tablePlug;
            var table = layui.table;
            var layer = layui.layer;
            var form = layui.form
            var $ = layui.jquery;
            tablePlug.smartReload.enable(true);

            // 获取工具栏
            $('#all_toolbar').append($('#general_toolbar  > div').html());
            $('#all_toolbar').append($('#toolbar > div').html());

            // 获取每行的按钮
            $('#all_rowtools').append($('#rowtools').html());
            $('#all_rowtools').append($('#general_rowtools').html());

            table.render({
                elem: '#articletable'
                , toolbar: '#all_toolbar'
                , url: url
                , id: 'articletable'
                , cellMinWidth: 80
                , title: title
                , totalRow: true
                , autoSort: false
                , smartReloadModel:true
                , reloaddingShow:true
                // ,size: 'sm' //小尺寸的表格
                , cols: getField(except_field,width)
                , limit:10
                , limits:[10,15,20,30,40,50,60,70,80,90]
                , page: true
                , parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                    tableContent = res;
                    SEARCH_RESULT_ROWS = res.data.total;
                    return {
                        "code": res.code, //解析接口状态
                        "msg": res.message, //解析提示文本
                        "count": res.data.total, //解析数据长度
                        "data": res.data.data //解析数据列表
                    };
                }
            });

            //排序
            table.on('sort(articletable)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                //尽管我们的 table 自带排序功能，但并没有请求服务端。
                //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，如：
                table.reload('articletable', {
                    initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。 layui 2.1.1 新增参数
                    ,where: { //请求参数
                        orderby: obj.field //排序字段
                        ,ordertype: obj.type //排序方式
                    }
                });
            });

            // 重置按钮
            $('#search_reset_btn').click(function (e) {
                disable_del_btn()
            })

            // 搜索按钮
            $('#search_submit_btn').click(function (e) {
                var form_s = $('#article_search_form')
                var form_data = form_s.serializeArray()
                var data = []
                for(var key in form_data){
                    var ele = form_data[key]
                    data[ele['name']] = ele['value']
                }
                data['status'] = "{$art_status}"
                table.reload('articletable',{
                    page: {curr: 1},
                    where: data
                });
                enable_del_btn()
                if(e.preventDefault){ e.preventDefault(); }else{ window.event.returnValue == false;}
            });

            function _exe_del(article_api_url,form_data){
                $.post(article_api_url,form_data,function (rsp) {
                    if(rsp['code'] === 0){
                        table.reload('articletable',{page: {curr: 1} });
                        $('#search_reset_btn').trigger('click')
                        $('#search_submit_btn').trigger('click')
                        disable_del_btn()
                        $('#search_reset_btn').trigger('click')
                        layer.closeAll()
                    }else{
                        layer.msg(rsp['message'],{offset: 'auto'});
                    }
                });

            }

            var article_api_url_del = "{$article_api_url}/del";
            // ----------- 搜索删除按钮 -----------
            $('#del_query_data').click(function (e) {
                var form_s = $('#article_search_form');
                var form_data = form_s.serializeArray();

                // 检查提交参数
                var has_status = false;
                for(var key in form_data){
                    var ele = form_data[key];
                    if(ele['name'] === 'status'){
                        has_status = true;
                    }
                }

                // 如果没有自定义status筛选，则加入本页默认的status
                if(!has_status){
                    form_data.push({name: "status", value: "{$art_status}"})
                }

                //询问框
                layer.confirm('本次操作将删除'+SEARCH_RESULT_ROWS+'条结果，是否继续？', {
                    btn: ['确认','取消'] //按钮
                    , offset:'auto'
                }, function(){
                    _exe_del(article_api_url_del,form_data)
                });

                if(e.preventDefault){ e.preventDefault(); }else{ window.event.returnValue == false;}
            });


            table.on('toolbar(articletable)',function (obj) {
                var check_all = true;
                switch(obj.event){
                    case 'select_all_row':
                        $(".layui-table input[type='checkbox']").prop("checked",true);
                        var aa = $(".layui-table input[type='checkbox']").serializeArray();
                        form.render('checkbox');
                        break;
                    case 'de_select':
                        $(".layui-table input[type='checkbox']").each(function(){
                            if($(this).attr('lay-filter') === 'layTableAllChoose'){
                                return;
                            }
                            if($(this).prop("checked")){
                                check_all = false;
                                console.log('dddd')
                                $(this).prop("checked",false);
                            }else{
                                $(this).prop("checked",true);
                            }
                        });
                        if(check_all){
                            $(".layui-table input[lay-filter='layTableAllChoose']").prop("checked",true)
                        } else {
                            $(".layui-table input[lay-filter='layTableAllChoose']").prop("checked", false);
                        }
                        form.render('checkbox');
                        break;
                    case 'del_selected':
                        var checkStatus = table.checkStatus(obj.config.id)
                            ,data = checkStatus.data;
                        var form_data = [];
                        for(var key_i in data){
                            var ele = data[key_i];
                            form_data.push({name: "art_id["+key_i+']', value: ele['art_id']});
                        }
                        if(form_data.length == 0){
                            layer.msg('请选择数据',{offset:'auto'})
                        }else {
                            form_data.push({name: "status", value: "{$art_status}"});
                            _exe_del(article_api_url_del,form_data);
                        }
                        break;
                }
            });

            table.on('tool(articletable)',function (obj) {
                var layEvent = obj.event,data = obj.data;
                if(layEvent === 'del_this_row'){
                    var form_data = [];
                    form_data.push({name: "art_id[0]", value: obj.data['art_id']});
                    form_data.push({name: "status", value: "{$art_status}"});
                    _exe_del(article_api_url_del,form_data);
                }else if(layEvent === 'source'){ // 查看来源
                    console.log(data['project']);
                    var type_ = data['project'];
                    var sourr_url = 'https://www.ncbi.nlm.nih.gov/pubmed/'+data['art_id'];
                    if( type_ === 'SCIENCE_SPIDER'){
                        sourr_url = 'https://www.sciencedirect.com/science/article/pii/'+data['art_id'];
                    }
                    window.open(sourr_url, '_blank');
                }else if(layEvent === 'detail'){
                    var content = '<table class="layui-table">';
                    for(var o in data){
                        content+= '<tr><td>'+o+'</td><td>' + data[o] +'</td></tr>';
                    }
                    content+="</table>";
                    layer.open({
                        type: 1 //Page层类型
                        ,offset: 'auto'
                        ,skin: 'layer-ext-moon'
                        ,area: ['750px', "80%"]
                        ,title: '当前行数据'
                        ,shade: 0.5 //遮罩透明度
                        // ,maxmin: true //允许全屏最小化
                        ,anim: 1 //0-6的动画形式，-1不开启
                        ,content: content
                    });
                }else if(layEvent === 'edit'){
                    var article_api_url_view = '{$article_api_url}/view?art_id=';
                    article_api_url_view = article_api_url_view+data.art_id;
                    layer.open({
                        type: 2,
                        title: '编辑页面',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['80%', '100%'],
                        content: article_api_url_view //iframe的url
                    });
                }
            });

        })
    }
</script>