<!-- 加载统一layui资源 -->
{include file="admin@block/layui" /}

<!-- 加载统一搜索表单 -->
{include file='cofco@block/search'/}

<!-- 加载统一的文章表格框架，注意此时并未执行渲染动作 -->
{include file='cofco@block/article_table' /}


<!--  ---------------- 华 ------- 丽 ------- 丽 ------- 的 ------- 分 ------- 割 ------- 线 ----------------------- -->

<!-- =================  自定义表格工具按钮, script标签的ID不要变  ===================================================-->
<div type="text/html" id="toolbar" class="hide">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="pass_check_data">通过审核[选中行数据]</button>
        <button class="layui-btn layui-btn-sm layui-btn-warm" lay-event="pass_query_data">通过审核[搜索结果数据]</button>
    </div>
</div>

<!-- =================  自定义每行的按钮, script标签的ID不要变  ===================================================-->
<div type="text/html" id="rowtools" class="hide">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">详情</a>
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="source">来源</a>
    <a class="layui-btn layui-btn-xs" lay-event="pass_this_one">通过审核</a>
</div>
<script>

    var article_api_url_setstauts = "{$article_api_url}/setstatus";
    //-------------- 执行表格渲染动作 --------------------------------------------------
    $(function () {
        var init_url = "{$article_api_url}/search?status={$art_status}"; //记得加入status控制，实现方法在app/cofco/admin/Article.php
        var except_field = ['special_version','document_type','urgency','tabstract']
        render_article_table(init_url,except_field,240);
    });

    function _exe_update_status(requset_url, form_data){

        layui.use(['jquery', 'table'],function () {
            var table = layui.table, $ = layui.jquery;
            form_data.push({name:'setstatus',value:'2'})
            $.post(requset_url,form_data,function (rsp) {
                if(rsp['code'] === 0){
                    table.reload('articletable',{page: {curr: 1} });
                }else{
                    layer.msg(rsp['message'],{offset: 'auto'});
                }
            });
        });
    }

    //-------------- 为自定义的按钮添加监听事件 ----------------------------------------
    layui.use(['jquery', 'table'],function () {
        var table = layui.table, $ = layui.jquery;

        // 行工具栏监听
        table.on('tool(articletable)',function (obj) {
            var data = obj.data,layEvent = obj.event;
            if(layEvent === 'detail'){
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
            }else if(layEvent === 'source'){ // 查看来源
                var type_ = data['project'];
                var sourr_url = 'https://www.ncbi.nlm.nih.gov/pubmed/'+data['art_id'];
                if( type_ === 'SCIENCE_SPIDER'){
                    sourr_url = 'https://www.sciencedirect.com/science/article/pii/'+data['art_id'];
                }
                window.open(sourr_url, '_blank');
            }else if(layEvent === 'pass_this_one'){ // 通过审核
                var form_data = [];
                form_data.push({name: "art_id[0]", value: obj.data['art_id']});
                form_data.push({name: "status", value: "{$art_status}"});
                _exe_update_status(article_api_url_setstauts,form_data);
            }
        });
    });
    // 工具栏监听
    layui.use(['jquery', 'table'], function () {
        var table = layui.table;
        table.on('toolbar(articletable)',function (obj) {
            var layEvent = obj.event;
            var checkStatus = table.checkStatus(obj.config.id)
            if(layEvent === 'pass_check_data'){
                var data = checkStatus.data;
                var form_data = [];
                for(var key_i in data){
                    var ele = data[key_i];
                    form_data.push({name: "art_id["+key_i+']', value: ele['art_id']});
                }
                if(form_data.length == 0){
                    layer.msg('请选择数据',{offset:'auto'})
                }else {
                    form_data.push({name: "status", value: "{$art_status}"});
                    _exe_update_status(article_api_url_setstauts,form_data);
                }
            }else if(layEvent === 'pass_query_data'){
                console.log('pass_query_data')
                var form_s = $('#article_search_form');
                var form_data = form_s.serializeArray();

                // 检查提交参数
                var has_status = false;
                var danger = true;

                for(var key in form_data){
                    var ele = form_data[key];
                    if(ele['value'] !== ''){
                        danger = false;
                    }
                    if(ele['name'] === 'status'){
                        has_status = true;
                    }
                }
                // 如果没有自定义status筛选，则加入本页默认的status
                if(!has_status){
                    form_data.push({name: "status", value: "{$art_status}"})
                }

                // 如果查询条件太弱
                if(danger){
                    //询问框
                    layer.confirm('由于查询条件太弱，本次操作将更改大量结果，是否继续？', {
                        btn: ['确认','取消'] //按钮
                        , offset:'auto'
                    }, function(){
                        _exe_update_status(article_api_url_setstauts,form_data)
                        layer.closeAll()
                    });
                }else{
                    _exe_update_status(article_api_url_setstauts,form_data)
                }

            }
        });
    })

</script>
