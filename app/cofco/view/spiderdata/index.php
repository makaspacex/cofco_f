<!-- 加载统一layui资源 -->
{include file="admin@block/layui" /}

<!-- 加载统一搜索框 -->
{include file='cofco@block/search'/}

<!-- 加载统一的文章表格内容，注意此时并未执行渲染动作 -->
{include file='cofco@block/article_table' /}


<!--  ---------------- 华 ------- 丽 ------- 丽 ------- 的 ------- 分 ------- 割 ------- 线 ----------------------- -->


<!-- =================  自定义表格工具按钮, script标签的ID不要变  ===================================================-->
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="pending_del">删除[选中行数据]</button>
        <button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="pass_check_data">通过审核[选中行数据]</button>
        <button class="layui-btn layui-btn-sm layui-btn-warm" lay-event="pass_query_data">通过审核[搜索结果数据]</button>
    </div>
</script>

<!-- =================  自定义每行的按钮, script标签的ID不要变  ===================================================-->
<script type="text/html" id="rowtools">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="pass">通过审核</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>

    //-------------- 执行渲染动作 ----------------------------------------
    var init_url = "{$article_api_url}/search?status=1"; //记得加入status控制
    render_article_table(init_url);

    //-------------- 为自定义的按钮添加监听事件 ----------------------------------------
    layui.use(['jquery', 'table', 'tablePlug'], function () {
        var table = layui.table;
        var $ = layui.jquery;

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

            }
            switch (layEvent) {
                case 'detail':

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
                    break;
            }

        })

    });
</script>
