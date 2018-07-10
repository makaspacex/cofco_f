<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="page-filter left">
        <form class="layui-form layui-form-pane" action="{:url()}" method="get">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索</label>
                <div class="layui-input-inline">
                    <input type="hidden" name="q"  lay-verify="required" placeholder="文章标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="label" class="layui-input field-value"  name="value" lay-verify="" autocomplete="off" placeholder="标签">
                </div>
                <a href="{:url('levelpop1?callback=func')}" title="选择标签" class="layui-btn layui-btn-primary j-iframe-pop fl">选择标签</a>
            </div>
        </form>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="1">
                <col width="9">
                <col width="2">
                <col width="2">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th>文章标题</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            {volist name="data_list" id="v"}
            {php}
            if($v['status']==1)
            $v['status']="未爬取";
            if($v['status']==2)
            $v['status']="未审核";
            if($v['status']==3)
            $v['status']="已审核";
            {/php}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['id']}" class="layui-checkbox checkbox-ids"
                           lay-skin="primary"></td>
                <td>{$v['title']}</td>
                <!--                    <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1" } checked="" {/if}-->
                <!--                        value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭"-->
                <!--                        data-href="{:url('status?table=admin_pending&ids='.$v['id'])}">-->
                <!--                    </td>-->
                <td>{$v['status']}</td>
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
                            <a href="{:url('pending_edit?id='.$v['id'])}"class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>
                        </div>
                    </div>
                </td>

            </tr>
            {/volist}

            </tbody>
        </table>
        {$pages}
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    var formData = {:json_encode($data_info)};
    var A={:json_encode($data_list1)};
    if(A!=null)
        alert(JSON.stringify(A))
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
        $('input[name="q"]').val(text1);
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