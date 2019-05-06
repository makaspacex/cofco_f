<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">
<style>
    .layui-form-title{
        color: #5FB878!important;
    }
</style>
<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm" >
    <div class="layui-container-fluid" style="max-width: 1400px">
        <div class="row">
            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">文章基本信息</div>
            </div>
            <div class="layui-col-md11">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input field-title" name="title" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
            <div class="layui-col-md5">
                <label class="layui-form-label">文章作者</label>
                <div class="layui-input-block ">
                    <input type="text" class="layui-input field-author" name="author" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
<!--            <div class="layui-col-md3">-->
<!--                <label class="layui-form-label">PMID</label>-->
<!--                <div class="layui-input-block" >-->
<!--                    <input type="text" class="layui-input field-pmid" name="pmid" lay-verify="" autocomplete="off" placeholder="">-->
<!--                </div>-->
<!--            </div>-->

            <div class="layui-col-md3">
                <label class="layui-form-label">DOI</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-doi" name="doi" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">发表时间</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-issue" name="issue" id="issue" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>


            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">期刊信息</div>
            </div>
            <div class="layui-col-md5">
                <label class="layui-form-label">所属期刊</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-journal" name="journal" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">影响因子</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input field-impact_factor" name="impact_factor" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">所在分区</label>
                <div class="layui-input-block">
                    <select name="journal_zone" id="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="">请选择</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>


            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">发表机构信息</div>
            </div>

            <div class="layui-col-md5">
                <label class="layui-form-label ">发表机构</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input field-institue" name="institue" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>


            <div class="layui-col-md3">
                <label class="layui-form-label">文献类型 </label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-document_type" name="document_type" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>


            <div class="layui-col-md3">
                <label class="layui-form-label">机构国家</label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-country" name="country" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>

            <div class="layui-col-md11">
                <label class="layui-form-label">文章关键词</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input field-keyword" name="keyword" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>

            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">标注及说明</div>
            </div>

            <div class="layui-col-md11">
                <label class="layui-form-label">标签标注</label>
                <div class="layui-input-block" >
                    <input type="label" class="layui-input field-value" disabled="true"
                           name="value" lay-verify="" autocomplete="off" placeholder="未标记">
                    <button href="{:url('/cofco/labeldata/levelpop?callback=func')}" title="选择标签"
                            class="layui-btn layui-btn-sm layui-btn-primary j-iframe-pop fl margin-0 abs-right" style="margin-left:0px;">选择标签</button>
                    <input type="hidden"  class="layui-input field-tag_id" name="tag_id"
                           lay-verify="" autocomplete="off" placeholder="标签选择">
                </div>
            </div>
            <div class="layui-col-md6">
                <label class="layui-form-label">特别说明</label>
                <div class="layui-input-block ">
                    <input type="text" class="layui-input field-special_version" name="special_version" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>
            <div class="layui-col-md5">
                <label class="layui-form-label">紧要程度 </label>
                <div class="layui-input-block" >
                    <input type="text" class="layui-input field-urgency" name="urgency" lay-verify="" autocomplete="off" placeholder="">
                </div>
            </div>


            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">原文摘要</div>
            </div>
            <div class="layui-col-md11">
                <div class="layui-form-item">
                    <textarea rows="25" class="layui-textarea field-abstract" name="abstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
                </div>

            </div>
            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">摘要翻译</div>
            </div>
            <div class="layui-col-md11">
                <div class="layui-form-item">
                    <textarea rows="25"  class="layui-textarea field-tabstract" name="tabstract" lay-verify="" autocomplete="off" placeholder=""></textarea>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-form-item">
                <input type="radio" class="field-status" name="status" value="3" title="已审核" checked>
                <input type="radio" class="field-status" name="status" value="2" title="未审核">
                </div>
            </div>
            <div class="layui-col-md10">
                <input type="hidden" class="field-id" name="id">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">提交</button>
            </div>


        </div>
    </div>


</form>
{include file="admin@block/layui" /}
<script>
    layui.use('laydate', function() {
        var laydate = layui.laydate;
        //常规用法
        laydate.render({
            elem: '#issue'
        });
    })
</script>

<form class="layui-form " action="{:url()}" method="post" id="editForm">

    <div class="layui-form-item">
        <div class="layui-inline">

        </div>
        <div class="layui-inline">

        </div>

    </div>
    <div class="layui-form-item">

    </div>
    <div class="layui-form-item">

    </div>
    <div class="layui-form-item">
        <div class="layui-inline">

        </div>
        <div class="layui-inline">

        </div>

    </div>
    <div class="layui-form-item">

    </div>
    <div class="layui-form-item">
        <div class="layui-inline">

        </div>
        <div class="layui-inline">

        </div>
    </div>


    <div class="layui-form-item">

        <div class="layui-inline">

        </div>

    </div>
    <div class="layui-form-item">

    </div>
</form>

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