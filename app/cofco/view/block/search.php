<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">
<form class="layui-form layui-form-pane" action="JavaScript:void(0);" id='article_search_form'>
    <div class="layui-container-fluid">
        <div class="row">
            <div class="layui-col-md5">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                    <select name="title" id="title" lay-verify="required" lay-search="" enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md2">
                <label class="layui-form-label">期刊分区</label>
                <div class="layui-input-block">
                    <select name="journal_zone_start" id="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}" >
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md1">
                <div class="layui-input-input">
                    <select name="journal_zone_end" id="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md4">
                <label class="layui-form-label">爬虫关键词</label>
                <div class="layui-input-block">
                    <select name="kw_id" id="kw_id" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                        {volist name="keyword_list" id="v"}
                        <option value={$v['id']}>{$v['name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">发表时间</label>
                <div class="layui-input-block">
<!--                    <input type="text" name="date_start" id="date_start" value="{:input('get.date_start')}"-->
<!--                           lay-verify="date_start" placeholder="不限制" class="layui-input">-->
                    <select name="date_start" id="date_start" lay-search="" enable-input="false" lay-verify="date">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md2">
                <div class="layui-layer-input">
                    <select name="date_end" id="date_end" lay-search="" enable-input="false" lay-verify="date">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md2">
                <label class="layui-form-label">影响因子</label>
                <div class="layui-input-block" >
                    <input type="text" name="impact_factor_start" id="impact_factor_start"
                           value="{:input('get.impact_factor_start')}" lay-verify="date" placeholder="不限制" autocomplete="off"
                           class="layui-input" >
                </div>
            </div>
            <div class="layui-col-md1">
                <div class="layui-input-input">
                    <input type="text" name="impact_factor_end" id="impact_factor_end"
                           value="{:input('get.impact_factor_end')}" lay-verify="date" placeholder="不限制" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-col-md4">
                <div class="layui-inline right-align">
                    <button type="submit" class="layui-btn layui-btn-sm" id="search_submit_btn">搜索</button>
                    <button type="reset" class="layui-btn layui-btn-sm layui-btn-primary" id="search_reset_btn">重置</button>
                    <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-disabled" id="del_query_data" disabled>删除本次搜索结果</button>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
    <table class="layui-hide" id="demo" lay-filter="test"></table>
</form>
<script>
    $.wait = function(ms) {
        var defer = $.Deferred();
        setTimeout(function() { defer.resolve(); }, ms);
        return defer;
    };
    $(function () {
        $.wait(500).then(function (value) {
            console.log('33333')
            layui.use(['laydate','jquery'], function() {

                var laydate = layui.laydate;
                laydate.render({
                    elem: '#date_start'
                });
                //常规用法
                laydate.render({
                    elem: '#date_end'
                });
            })

        });

    })



</script>