<form class="page-list-form">
    <div class="layui-btn-group">
        <a href="{:url('pending_padd')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        <a data-href="{:url('pending_del')}" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="aicon ai-jinyong"></i>删除</a>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th>文章标识</th>
                <th>文章标题</th>
                <th>文章作者</th>
                <th>所属期刊</th>
                <th>影响因子</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            {volist name="data_list" id="v"}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['id']}" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>{$v['doi']}</td>
                <td>{$v['title']}</td>
                <td>{$v['authors']}</td>
                <td>{$v['journal']}</td>
                <td>{$v['journal_if']}</td>

                <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1"}checked=""{/if} value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" data-href="{:url('status?table=admin_pending&ids='.$v['id'])}"></td>
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
<!--                            <if condition="$v['tag_id'] eq 0">-->
<!--                                <a href="{:url('pending_edit?id='.$v['id'])}"  class="layui-btn layui-btn-primary layui-btn-sm">未标注</a>-->
<!--                                <else />-->
<!--                                <a href="{:url('pending_edit?id='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm">已标注</a>-->
<!--                            </if>-->
<!--                            <a href="{:url('pop?callback=func&id='.$v['id'])}" class="layui-btn layui-btn-primary j-iframe-pop">详情</a>-->
                            <a href="{:url('pending_edit?id='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>
                            <a data-href="{:url('pending_del?ids='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe640;</i></a>
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