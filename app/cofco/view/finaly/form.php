<form class="layui-form " action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <div class="layui-inline ">
            <label class="layui-form-label">PMID</label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-pmid" name="pmid" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">DOI</label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-doi" name="doi" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">爬虫关键词</label>
            <div class="layui-input-inline w300">
                <input type="text" class="layui-input field-sstr" name="sstr"
                       lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">标签标注</label>
            <div class="layui-input-inline" >
                <input type="hidden"  class="layui-input field-tag_id" name="tag_id"
                       lay-verify="" autocomplete="off" placeholder="标签选择">
            </div>
            <div class="layui-input-inline" >
                <input type="label" class="layui-input field-value" disabled="true"
                       name="value" lay-verify="" autocomplete="off" placeholder="未标记">
            </div>
            <a href="{:url('/cofco/labeldata/levelpop?callback=func')}" title="选择标签"
               class="layui-btn layui-btn-primary j-iframe-pop fl">选择标签</a>
        </div>
    </div>

    <div class="layui-form-item">

    </div>
    <div class="layui-form-item">
<!--        <label class="layui-form-label">来源网站</label>-->
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-source" name="source" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline " style="width: 750px">
            <input type="text" class="layui-input field-title" name="title" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章作者</label>
        <div class="layui-input-inline " style="width: 750px">
            <input type="text" class="layui-input field-author" name="author" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">所属期刊</label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-journal" name="journal" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">影响因子</label>
            <div class="layui-input-inline w100">
                <input type="text" class="layui-input field-impact_factor" name="impact_factor" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">所在分区</label>
            <div class="layui-input-inline " style="width: 60px" >
                <input type="text" class="layui-input field-journal_zone" name="journal_zone" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">文章摘要</label>
            <div class="layui-input-inline " style="width: 750px" >
                <textarea rows="15"  class="layui-textarea field-abstract" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">摘要翻译</label>
            <div class="layui-input-inline " style="width: 750px" >
                <textarea rows="15"  class="layui-textarea field-tabstract" name="tabstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
            </div>
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章关键词</label>
        <div class="layui-input-inline " style="width: 750px">
            <input type="text" class="layui-input field-keyword" name="keyword" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">特别说明</label>
        <div class="layui-input-inline " style="width: 750px">
            <input type="text" class="layui-input field-special_version" name="special_version" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">文献类型 </label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-document_type" name="document_type" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">紧要程度 </label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-urgency" name="urgency" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label ">发表机构</label>
        <div class="layui-input-inline " style="width: 750px">
            <input type="text" class="layui-input field-institue" name="institue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">发表时间</label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-issue" name="issue" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">机构国家</label>
            <div class="layui-input-inline w300" >
                <input type="text" class="layui-input field-country" name="country" lay-verify="" autocomplete="off" placeholder="">
            </div>
        </div>
    </div>


    <div class="layui-form-item">

        <div class="layui-inline">
            <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
            <div class="layui-input-inline w600" >
                 <input type="radio" class="field-status" name="status" value="4" title="输出" >
                <input type="radio" class="field-status" name="status" value="3" title="已审核" checked>
                <input type="radio" class="field-status" name="status" value="2" title="未审核">
            </div>
            <div class="layui-form-mid layui-word-aux">选择输出将存入输出页面,选择未审核将退回到审核及标注页面</div>
        </div>

    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id">
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">提交</button>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    var formData = {:json_encode($data_info)};
    console.log(formData);
    var text1='';var text2='';
    function func(data) {
        var $ = layui.jquery;
          for(var i=0;i<data.length;i++){
             if (i==0){
                 text1= data[i]['name'];
                 text2= data[i]['title'];
             }
                      else{
                 text1=text1+'#'+data[i]['name']
                 text2=text2+'#'+data[i]['title']
             }
                 }
        $('input[name="tag_id"]').val(text1);
        $('input[name="value"]').val(text2);
    }

</script>
<script src="__ADMIN_JS__/footer.js"></script>