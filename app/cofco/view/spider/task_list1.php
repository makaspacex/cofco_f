<form class="page-list-form">
    <div class="layui-btn-group">
        <a href="{:url('task_add')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        <a data-href="{:url('task_del')}" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="aicon ai-jinyong"></i>删除</a>

    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th>进程号</th>
                <th>使用内存</th>
                <th>进度</th>
                <th>创建时间</th>
                <th>创建人</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            {volist name="data_list" id="v"}
            {php}
            if($v['status']==1)
            $v['status']="运行中";
            if($v['status']==2)
            $v['status']="暂停";
            if($v['status']==3)
            $v['status']="停止";
            if($v['status']==4)
            $v['status']="已完成";
            {/php}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['pid']}" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>{$v['pid']}</td>
                <td>{$v.memory_percent}</td>
                <td>{$v.progress}</td>
                <td>{$v['create_time']}</td>
                <td>{$v['creator']}</td>
<!--                <td><input type="" name="status" {if condition="$v['status'] eq 3"} value="运行中" {/if}></td>-->
                <td>{$v['status']}</td>
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
                            <a href="{:url('task_edit?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>
                            <a data-href="{:url('task_stop?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe640;</i></a>
                            <a data-href="{:url('task_pause?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe651;</i></a>
                            <a data-href="{:url('task_continue?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del"><i class="layui-icon">&#xe652;</i></a>
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