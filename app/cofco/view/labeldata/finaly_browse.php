<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">PMID</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-pmid" disabled="true" name="pmid" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">DOI</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-doi" disabled="true" name="doi" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-project" name="project" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">爬虫关键词</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-sstr" disabled="true" name="sstr" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-flink"  name="flink" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标签标注</label>
        <div class="layui-input-inline">
            <input type="hidden"  class="layui-input field-tag_id" name="tag_id" lay-verify="" autocomplete="off" placeholder="标签选择">
        </div>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-value" disabled="true" name="value" lay-verify="" autocomplete="off" placeholder="未标记">
        </div>
    </div>
    <div class="layui-form-item">
        <!--        <label class="layui-form-label">来源网站</label>-->
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-source" name="source" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-title" disabled="true" name="title" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章作者</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-author" disabled="true" name="author" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属期刊</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-journal" disabled="true" name="journal" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">影响因子</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-impact_factor" disabled="true" name="impact_factor" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所在分区</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-journal_zone" disabled="true" name="journal_zone" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-inline w600">
            <textarea rows="6"  class="layui-textarea field-abstract" disabled="true" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">摘要翻译</label>
        <div class="layui-input-inline w600">
            <textarea rows="6"  class="layui-textarea field-tabstract"disabled="true" name="tabstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章关键词</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-keyword" disabled="true" name="keyword" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发表时间</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-issue" disabled="true" name="issue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label ">发表机构</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-institue" disabled="true" name="institue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">机构国家</label>
        <div class="layui-input-inline w600">
            <input type="label" class="layui-input field-country" disabled="true" name="country" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>-->
<!--        <div class="layui-input-inline w600">-->
<!--            <input type="radio" disabled="true" class="field-status" name="status" value="3" title="已审核" checked>-->
<!--            <input type="radio" disabled="true" class="field-status" name="status" value="2" title="未审核">-->
<!--        </div>-->
<!--    </div>-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id">
            <a href="{:url('pending_list')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    var formData = {:json_encode($data_info)};

</script>
<script src="__ADMIN_JS__/footer.js"></script>