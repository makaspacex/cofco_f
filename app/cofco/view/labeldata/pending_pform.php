<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <div class="layui-input-inline w300">
            <input type="hidden" class="layui-input field-pmid" name="pmid" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w300">
            <input type="hidden" class="layui-input field-doi" name="doi" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w300">
            <input type="hidden" class="layui-input field-source" name="source" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w300">
            <input type="hidden" class="layui-input field-flink" name="flink" lay-verify="" autocomplete="off" placeholder="">
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
            <input type="text" class="layui-input field-author" name="author" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属期刊</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-journal" name="journal" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w300">
            <input type="hidden" class="layui-input field-ojournal" name="ojournal" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">影响因子</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-impact_factor" name="impact_factor" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所在分区</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-journal_zone" name="journal_zone" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发表时间</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-issue" name="issue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-inline w300">
            <textarea rows="6"  class="layui-textarea field-abstract" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">摘要翻译</label>
        <div class="layui-input-inline w300">
            <textarea rows="6"  class="layui-textarea field-tabstract" name="tabstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章关键词</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-keyword" name="keyword" lay-verify="" autocomplete="off" placeholder="逗号分隔，如 China,America,English">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发表机构</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-institue" name="institue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">机构国家</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-country" name="country" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline w300">
            <input type="radio" class="field-status" name="status" value="2" title="未审核" checked>
<!--            <input type="radio" class="field-status" name="status" value="3" title="已审核">-->
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
</script>
<script src="__ADMIN_JS__/footer.js"></script>