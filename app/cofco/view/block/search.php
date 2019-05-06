<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">
<form class="layui-form layui-form-pane" >
    <div class="layui-container-fluid">
        <div class="row">
            <div class="layui-col-md5">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="{:input('get.title')}" lay-verify="required" placeholder="不限制"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">爬虫关键词</label>
                <div class="layui-input-block">
                    <select name="sstr" id="sstr" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        {volist name="keyword_list" id="v"}
                        <option value={$v['id']}>{$v['name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">期刊分区</label>
                <div class="layui-input-block">
                    <select name="journal_zone" id="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}">
                        <option value="">不限制</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">时间区间</label>
                <div class="layui-input-block">
                    <input type="text" name="date_start" id="date_start" value="{:input('get.date_start')}"
                           lay-verify="date_start" placeholder="不限制" class="layui-input">
                </div>
            </div>
            <div class="layui-col-md2">
                <div class="layui-layer-input">
                    <input type="text" name="date_end" id="date_end" value="{:input('get.date_end')}" lay-verify="date"
                           placeholder="不限制" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-col-md2">
                <label class="layui-form-label">影响因子区间</label>
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
            <div class="layui-col-md3">
                <div class="layui-inline right-align">
                    <button type="submit" class="layui-btn layui-btn-sm">搜索</button>
                    <button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">重置</button>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
    <table class="layui-hide" id="demo" lay-filter="test"></table>
</form>