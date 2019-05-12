
<blockquote class="layui-elem-quote layui-text">
    为了减少爬虫爬取数量和人工审核数量，爬虫系统2.0版本支持了关键词高级搜索。
    <br>
    All of the fields are optional. Find out more about the new advanced search.
</blockquote>

<fieldset class="layui-elem-field layui-field-title" >
    <legend>新建pubmed爬虫</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="" lay-filter="example">

    <div class="layui-form-item">

        <div class="layui-inline w500">
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
        <div class="layui-inline ">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="newpubmed">新建爬虫</button>
            </div>
        </div>
    </div>

</form>

<fieldset class="layui-elem-field layui-field-title" >
    <legend>新建science爬虫</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="" lay-filter="example">
    <div class="layui-form-item">
        <div class="layui-inline w500">
            <label class="layui-form-label">爬虫关键词</label>
            <div class="layui-input-block">
                <select name="kw_id" id="kw_id" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    {volist name="science_keyword_list" id="v"}
                    <option value={$v['id']}>{$v['name']}</option>
                    {/volist}
                </select>
            </div>
        </div>
        <div class="layui-inline ">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="newscience">新建爬虫</button>
            </div>
        </div>
    </div>
</form>

<fieldset class="layui-elem-field layui-field-title" >
    <legend>更新中科院分区表数据</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="" lay-filter="example">
    <div class="layui-form-item" style="margin-left: 20px;">
        <div class="layui-inline w500" >
            <textarea lay-verify="required" name="raw_cookies" rows="8" cols="120" placeholder="请输入登录用户的cookies，使用浏览器自动发送的cookies格式" ></textarea>
        </div>
        <div>
            <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="new_journal">新建Journal爬虫</button>
            <button class="layui-btn layui-btn-warm layui-btn-sm" lay-submit="" lay-filter="update_cookies">更新cookies</button>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}
<script>
    layui.use('form', function(){
        submit('submit(newpubmed)',1);
        submit('submit(newscience)',2);
        submit('submit(new_journal)',3);
        submit('submit(update_cookies)',4);
    });
    function submit(name,type) {

        layui.use(['jquery', 'table','tablePlug','layer'], function () {
            var form = layui.form;
            var layer = layui.layer;

            form.on(name, function(data){
                var url = '{$controlspider_url}'
                var $ = layui.jquery;
                var sub_data = {}

                if(type===1 || type === 2){
                    sub_data = {kw_id:data.field.kw_id,action:"new",uname:'{$uname}',uid:'{$uid}',spider_type:type}
                }
                else if(type === 3){
                    sub_data = {action:"new",uname:'{$uname}',uid:'{$uid}',spider_type:type,raw_cookies:data.field.raw_cookies}
                }else if(type === 4){
                    sub_data = {raw_cookies:data.field.raw_cookies}
                    url = "{:config('spider.update_cookies_url')}"
                }
                $.ajax({
                    url:url,
                    data:sub_data,
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        if(res.status){
                            layer.alert('操作成功', {
                                offset:'auto',
                                icon: 1,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            },function (e) {
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);//关闭当前页
                            })
                        }else{
                            layer.alert(res.info, {
                                offset:'auto',
                                icon: 2,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            })
                        }
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });



        });




    }

</script>

<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">

