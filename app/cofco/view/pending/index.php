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
    </div>
</div>

<!-- =================  自定义每行的按钮, script标签的ID不要变  ===================================================-->
<div type="text/html" id="rowtools" class="hide">

</div>
<script>

    //-------------- 执行表格渲染动作 --------------------------------------------------
    $(function () {
        var init_url = "{$article_api_url}/search?status={$art_status}"; //记得加入status控制，实现方法在app/cofco/admin/Article.php
        var except_field = ['special_version','document_type','urgency','tabstract','auditor','final_auditor']
        render_article_table(init_url,except_field,240,'文献标注表');
    });

    //-------------- 为自定义的按钮添加监听事件 ----------------------------------------
    layui.use(['jquery', 'table'],function () {
        var table = layui.table, $ = layui.jquery;
        // 行工具栏监听
        table.on('tool(articletable)',function (obj) {
            var data = obj.data,layEvent = obj.event;

        });
        // 工具栏监听
        table.on('toolbar(articletable)',function (obj) {

        });
    });

</script>
