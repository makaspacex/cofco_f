<form class="page-list-form">
    <div class="page-toolbar">
        <div class="page-filter fr">
            <form class="layui-form layui-form-pane" action="{:url()}" method="get">
                <div class="layui-form-item">
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline">
                        <input type="text" name="q" value="{:input('get.q')}" lay-verify="required" placeholder="文章标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>
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
                <td><a href="{:url('finaly_url?id='.$v['id'])}">{$v['title']}</a></td>
                <td>{$v['status']}</td>
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
                            <a href="{:url('finaly_edit?id='.$v['id'])}"class="layui-btn layui-btn-primary layui-btn-sm j-ajax"><i class="layui-icon">&#xe642;</i></a>
                            <a href="{:url('finaly_url?id='.$v['id'])}"target="blank" class="layui-btn layui-btn-primary layui-btn-sm j-ajax">来源</a>
                            <a data-href="{:url('finaly_del?ids='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe640;</i></a>
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