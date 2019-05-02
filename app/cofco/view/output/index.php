<form class="layui-form layui-form-pane">
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-inline" style="width: 400px">
                <input type="text" name="title" value="{:input('get.title')}" lay-verify="required" placeholder="文章标题"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">爬虫关键词</label>
            <div class="layui-input-inline">
                <select name="sstr" id="sstr" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    {volist name="keyword_list" id="v"}
                    <option value={$v['keywords']}>{$v['keywords']}</option>
                    {/volist}
                </select>
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">期刊分区</label>
            <div class="layui-input-inline" style="width: 90px">
                <select name="journal_zone" id="journal_zone" lay-verify="required" value="{:input('get.journal_zone')}">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">时间区间</label>
            <div class="layui-input-inline">
                <input type="text" name="date_start" id="date_start" value="{:input('get.date_start')}"
                       lay-verify="date_start" placeholder="开始时间" class="layui-input">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline">
                <input type="text" name="date_end" id="date_end" value="{:input('get.date_end')}" lay-verify="date"
                       placeholder="结束时间" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">影响因子区间</label>
            <div class="layui-input-inline">
                <input type="text" name="impact_factor_start" id="impact_factor_start"
                       value="{:input('get.impact_factor_start')}" lay-verify="date" placeholder="0" autocomplete="off"
                       class="layui-input">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline">
                <input type="text" name="impact_factor_end" id="impact_factor_end"
                       value="{:input('get.impact_factor_end')}" lay-verify="date" placeholder="10" autocomplete="off"
                       class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <button type="submit" class="layui-btn">搜索</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>

    <table class="layui-hide" id="demo" lay-filter="test"></table>
</form>
{include file="cofco@block/layui" /}
<script type="text/html" id="barDemo">
 <!--  <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a> -->
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
<!--    <button class="layui-btn layui-btn-sm" lay-event="pending_add">添加</button>-->
    <button class="layui-btn layui-btn-sm" lay-event="pending_del">删除选中行数据</button>
  </div>
</script>
<script type="text/html" id="statusTpl">
  {{#  if(d.status == 1){ }}
  <a>爬虫数据</a>
  {{#  } else if (d.status == 2) { }}
  <a>未审核</a>
  {{#  } else if (d.status == 3) { }}
  <a>已审核</a>
  {{#  } else{ }}
  <a>待输出</a>
  {{# } }}
</script>
<script src="__COFCO_JS__/output_table"></script>
