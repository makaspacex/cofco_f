<table class="layui-hide" id="articletable" lay-filter="articletable"></table>
<script>
    // 文章列表统一渲染方法
    function render_article_table(url) {
        layui.use(['jquery', 'table', 'tablePlug'], function () {
            var tablePlug = layui.tablePlug;
            var table = layui.table;
            var $ = layui.jquery;
            tablePlug.smartReload.enable(true);
            table.render({
                elem: '#articletable'
                , toolbar: '#toolbar'
                , url: 'data'
                , id: 'articletable'
                , cellMinWidth: 80
                , title: '未审核数据表'
                , totalRow: true
                , smartReloadModel:true
                , reloaddingShow:true
                , cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    // , {field: 'id', title: 'ID', width: 80, sort: true, fixed: 'left'}
                    , {field: 'title', title: '文章标题', width: 500, sort: true}
                    , {field: 'sstr', title: '爬虫关键词', width: 200}
                    , {field: 'creater', title: '创建人', width: 90, sort: true}
                    // , {field: 'auditor', title: '审核人', width: 90}
                    // , {field: 'final_auditor', title: '终审核', width: 90}
                    , {field: 'ctime', title: '创建时间', width: 290, sort: true}
                    , {field: 'special_version', title: '特别说明', width: 90}
                    , {field: 'document_type', title: '文献类型', width: 90, sort: true}
                    , {field: 'urgency', title: '紧要程度', width: 90, sort: true}
                    , {field: 'status', title: '状态', width: 90, sort: true}
                    , {field: 'tabstract', title: '摘要翻译', width: 100}
                    , {field: 'doi', title: 'doi', width: 100}
                    , {field: 'impact_factor', title: '影响因子', width: 100, sort: true}
                    , {field: 'country', title: '国家', width: 100}
                    , {field: 'author', title: '作者', width: 100}
                    , {field: 'journal', title: '所属期刊', width: 100}
                    , {field: 'journal_zone', title: '期刊分区', width: 100, sort: true}
                    , {field: 'issue', title: '发表时间', width: 100, sort: true}
                    , {field: 'keyword', title: '关键词', width: 100}
                    , {field: 'institue', title: '发表机构', width: 100}
                    , {fixed: 'right', width: 180, align: 'center', toolbar: '#rowtools'}
                ]]
                , page: true
                , parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                    tableContent = res;
                    return {
                        "code": res.code, //解析接口状态
                        "msg": res.message, //解析提示文本
                        "count": res.data.total, //解析数据长度
                        "data": res.data.data //解析数据列表
                    };
                }
            });

            $('#search_submit_btn').click(function (e) {
                var form_s = $('#article_search_form')
                var form_data = form_s.serializeArray()
                console.log(form_data)
                var data = []
                for(var key in form_data){
                    var ele = form_data[key]
                    data[ele['name']] = ele['value']
                }
                console.log(data);
                table.reload('articletable',{
                    page: {curr: 1},
                    where: data
                });
                if(e.preventDefault){ e.preventDefault(); }else{ window.event.returnValue == false;}
            });



        })
    }
</script>