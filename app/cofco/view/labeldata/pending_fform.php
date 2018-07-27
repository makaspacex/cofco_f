<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">文献网址</label>
        <div class="layui-input-inline w300">
            <input type="text" class="layui-input field-url" name="url" lay-verify="required" autocomplete="off" placeholder="">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id">
            <button type="submit" class="layui-btn" lay-submit="">提交</button>
            <a href="{:url('crawurl')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>

    var formData = {:json_encode($data_info)};
    var t={:json_encode($msg)};
    if (t!='')
    {
        layui.use('layer', function(){
            var $ = layui.layer;
            layer.msg(t);
        });
    }

    var res = $.ajax({
        url:'pending_fform.php',
        timeout : 10, //超时时间设置，单位毫秒
        complete : function(xhr,status){
            if(status=='timeout'){
                // 超时处理
            }
        }
    });
</script>
<script src="__ADMIN_JS__/footer.js"></script>