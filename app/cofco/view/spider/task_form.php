{php}
$user=config('hs_system.user');
$name=$user[ADMIN_ID];
{/php}
<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">创建人</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-creator" name="creator" readonly="true" value='{$name}' lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键词选择</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-keywords" readonly="true" name="keywords" lay-verify="" autocomplete="off" placeholder="关键词选择">
        </div>
        <a href="{:url('keywords_pop?callback=func')}" title="选择关键词" class="layui-btn layui-btn-primary j-iframe-pop fl">选择关键词</a>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">爬虫选择</label>
        <div class="layui-input-inline">
            <select name="spider_id"  class="field-spider_id" type="select"lay-search multiple="multiple">
                {$spider_option}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">更新频率</label>
        <div class="layui-input-inline">
            <select name="frequen_d"  class="field-frequen_d" type="select" >
                <option value ="-1"selected>按天更新（请选择）</option>
                <option value ="0"> 只更新一次</option>
                <option value ="1">一天更新一次</option>
                <option value="2">两天更新一次</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="frequen_m"  class="field-frequen_m" type="select" >
                <option value ="0"selected>按月更新（请选择）</option>
                <option value ="1">一月更新一次</option>
                <option value="2">两月更新一次</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id">
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">提交</button>
            <a href="{:url('task_list1')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    var formData = {:json_encode($data_info)};
    // var text='';
    // function func(data) {
    //     var $ = layui.jquery;
    //       for(var i=0;i<data.length;i++){
    //
    //          if (i==0)
    //                 text= data[i]['keywords'];
    //                   else
    //                       text=text+'#'+data[i]['keywords']
    //              }
    //     $('input[name="keywords"]').val(text);
    // }
    var str='';
    function func(data) {
        var $ = layui.jquery;
        str=data[0]['value'];
        str= str.replace(/\r\n/g,"#");
        //$('input[name="keywords"]').val(obj[3]);
        //$('input[name="keywords"]').val(data[0]['value']);
            $('input[name="keywords"]').val(str);
    }
</script>
<script src="__ADMIN_JS__/footer.js"></script>