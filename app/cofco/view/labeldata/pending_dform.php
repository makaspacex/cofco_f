<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-pmid" name="pmid" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-doi" name="doi" lay-verify="" autocomplete="off" placeholder="">
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
            <input type="text" class="layui-input field-sstr" name="sstr" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w600">
            <input type="hidden" class="layui-input field-flink" name="flink" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标签标注</label>
        <div class="layui-input-inline">
            <input type="hidden"  class="layui-input field-tag_id" name="tag_id" lay-verify="" autocomplete="off" placeholder="标签选择">
        </div>
        <div class="layui-input-inline">
            <input type="label" class="layui-input field-value" disabled="true" name="value" lay-verify="" autocomplete="off" placeholder="未标记">
        </div>
        <a href="{:url('levelpop?callback=func')}" title="选择标签" class="layui-btn layui-btn-primary j-iframe-pop fl">选择标签</a>
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
            <input type="text" class="layui-input field-title" name="title" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章作者</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-author" name="author" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属期刊</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-journal" name="journal" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">影响因子</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-impact_factor" name="impact_factor" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所在分区</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-journal_zone" name="journal_zone" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-inline w600">
            <textarea rows="6"  class="layui-textarea field-abstract" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">摘要翻译</label>
        <div class="layui-input-inline w600">
            <textarea rows="6"  class="layui-textarea field-tabstract" name="tabstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章关键词</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-keyword" name="keyword" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发表时间</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-issue" name="issue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label ">发表机构</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-institue" name="institue" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">机构国家</label>
        <div class="layui-input-inline w600">
            <input type="text" class="layui-input field-country" name="country" lay-verify="" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline w600">
            <input type="radio" class="field-status" name="status" value="3" title="已审核" checked>
            <input type="radio" class="field-status" name="status" value="2" title="未审核">
        </div>
        <div class="layui-form-mid layui-word-aux">审核完毕则直接存入最终表，否则存入待审表</div>
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
    var text1='';var text2='';
    function func(data) {
        var $ = layui.jquery;
          for(var i=1;i<data.length;i++){
             if (i==1){
                 text1= data[i]['id'];
                 text2= data[i]['value'];
             }
                      else{
                 text1=text1+'#'+data[i]['id']
                 text2=text2+'#'+data[i]['value']
             }
                 }
        $('input[name="tag_id"]').val(text1);
        $('input[name="value"]').val(text2);
    }
    // var str='';
    // function func(data) {
    //     var $ = layui.jquery;
    //     $('input[name="tag_id"]').val(data[0]['id']);
    //     str=data[0]['value'];
    //     str= str.replace(/\r\n/g,"#");
    //     $('input[name="value"]').val(str);
    // }
</script>
<script src="__ADMIN_JS__/footer.js"></script>