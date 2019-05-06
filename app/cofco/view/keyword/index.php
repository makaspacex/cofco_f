<form class="page-list-form">
    <div class="layui-btn-group">
        <a href="{:url('addpubmedkw')}" class="layui-btn layui-btn-sm layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        <a data-href="{:url('kwdel')}" class="layui-btn layui-btn-sm layui-btn-primary j-page-btns confirm j-ajax"><i class="aicon ai-jinyong"></i>删除</a>
    </div>
    <div class="layui-form">
        <table class="layui-table" lay-even="" lay-skin="row">
            <thead>

            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th>关键词名称</th>
                <th>类型</th>
<!--                <th>值</th>-->
                <th>创建人</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            {volist name="data_list" id="v"}
            {php}
            if($v['type']==1){
                $v['type'] = "Science";
            }
            else
            {   $v['type'] = "Pubmed";
            }
            $v['ctime'] =date("Y-m-d H:i", $v['ctime']);
            {/php}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['id']}" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>{$v['name']}</td>
                <td>{$v['type']}</td>
<!--                <td>{$v['value']}</td>-->
                <td>{$v['username']}</td>
                <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1"}checked=""{/if}  value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" data-href="{:url('status?table=admin_kw&ids='.$v['id'])}"></td>
                <td>{$v['ctime']}</td>
                <td>
                    <div class="layui-btn-group">
                        <a href="{:url('kwedit?id='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>
                        <a href="{:url('kwdel?ids='.$v['id'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe640;</i></a>
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