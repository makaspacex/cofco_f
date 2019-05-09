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
    <a class="layui-btn layui-btn-xs" lay-event="pass">通过审核</a>
</div>
<script>

    //-------------- 执行表格渲染动作 --------------------------------------------------
    $(function () {
        var init_url = "{$article_api_url}/search?status={$art_status}"; //记得加入status控制，实现方法在app/cofco/admin/Article.php
        render_article_table(init_url);
    });

    //-------------- 为自定义的按钮添加监听事件 ----------------------------------------
    layui.use(['jquery', 'table', 'tablePlug'], function () {
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
            }else if(layEvent === 'del'){

            }else if(layEvent === 'source'){
                var type_ = data['project'];
                var sourr_url = 'https://www.ncbi.nlm.nih.gov/pubmed/'+data['art_id'];
                if( type_ === 'SCIENCE_SPIDER'){
                    sourr_url = 'https://www.sciencedirect.com/science/article/pii/'+data['art_id'];
                }
                window.open(sourr_url, '_blank');
            }
            // ............... 未完成的其操作
        })

    });
</script>
