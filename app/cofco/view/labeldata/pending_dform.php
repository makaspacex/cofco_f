<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">文章标识</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-doi" name="doi" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标签标注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tag_id" name="tag_id" lay-verify="" autocomplete="off" placeholder="标签选择">
        </div>
        <a href="{:url('tag_pop?callback=func')}" title="选择标签" class="layui-btn layui-btn-primary j-iframe-pop fl">选择标签</a>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-name" disabled="true" name="name" lay-verify="" autocomplete="off" placeholder="未标记">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">来源网站</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-source" name="source" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-title" name="title" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章作者</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-author" name="author" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属期刊</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-journal" name="journal" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">影响因子</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-impact_factor" name="impact_factor" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所在分区</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-journal_zone" name="journal_zone" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-inline w300">
            <textarea rows="6"  class="layui-textarea field-abstract" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章关键词</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-keyword" name="keyword" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label ">发表机构</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-institue" name="institue" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">机构国家</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-country" name="country" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id">
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">提交</button>
            <a href="{:url('pending_list')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    var formData = {:json_encode($data_info)};
    // <if $data_info.name==0 $('input[name="name"]').val('未标记')>
    function func(data) {
        var $ = layui.jquery;
        $('input[name="tag_id"]').val(data[0]['id']);
        $('input[name="name"]').val(data[0]['name']);
    }
</script>
<script src="__ADMIN_JS__/footer.js"></script>