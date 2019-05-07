
{include file="admin@block/layui" /}
<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">
<form class="layui-form layui-form-pane" >
    <div class="layui-container-fluid">
        <div class="row">
            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">基本设置</div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">爬虫类型</label>
                <div class="layui-input-block">
                    <select name="spider_type" id="spider_type" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="">请选择一个类型</option>
                        <option value="1">PUBMED</option>
                        <option value="2">ScienceDirect</option>
                    </select>
                </div>
            </div>
            <div  class="layui-col-md3">
                <label class="layui-form-label">爬虫关键词</label>
                <div class="layui-input-block">
                    <select name="kw_id" id="kw_id" lay-verify="required" lay-search="">
                        <option value="">直接选择或搜索选择</option>
                        {volist name="pubmed_keyword_list" id="v"}
                        <option value={$v['id']}>{$v['name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>
            <div class="layui-col-md11">
                <div class="layui-form-title margin-t-20 margin-b-10">可选信息</div>
                <div class="layui-form-title layui-form-title-tip margin-t-20 ">请您合理选择并发数目，一是为了防止被封杀，二是服务器性能可能无法达到要求。</div>
            </div>
            <div  class="layui-col-md2">
                <label class="layui-form-label">翻页线程数目</label>
                <div class="layui-input-block">
                    <select name="spider_type" id="spider_type" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="2">2</option>
                        <option value="4" selected>4</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
            <div  class="layui-col-md2">
                <label class="layui-form-label">内容获取进程数</label>
                <div class="layui-input-block">
                    <select name="spider_type" id="spider_type" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div  class="layui-col-md2">
                <label class="layui-form-label">内容获取线程数</label>
                <div class="layui-input-block">
                    <select name="spider_type" id="spider_type" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="4">4</option>
                        <option value="8" selected>8</option>
                        <option value="16">16</option>
                        <option value="32">32</option>
                    </select>
                </div>
            </div>

            <div  class="layui-col-md2">
                <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="newscience">添加爬虫</button>
            </div>
            <div  class="layui-col-md6">
                &nbsp;
            </div>

        </div>

    </div>
</form>

<script>
    layui.use('form', function(){

        submit('submit(newpubmed)',1);
        submit('submit(newscience)',2);
    });


    function submit(name,type) {
        var form = layui.form;
        form.on(name, function(data){
            var url = '{$controlspider_url}'
            var $ = layui.jquery;
            $.ajax({
                url:url,
                data:{kw_id:data.field.kw_id,action:"new",uname:'{$uname}',uid:'{$uid}',spider_type:type},
                type:"post",
                dataType:"json",
                success:function (res) {
                    console.log(url);
                    console.log(res.status);
                    if(res.status){
                        layer.open({
                            offset: 'auto',
                            content: "创建成功" //注意，如果str是object，那么需要字符拼接。
                        });

                    }
                    else{
                        layer.open({
                            offset: 'auto',
                            content: "创建失败，当前爬虫已存在" //注意，如果str是object，那么需要字符拼接。
                        });
                    }
                }
            });
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
        //各种基于事件的操作，下面会有进一步介绍

    }

</script>

<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">

