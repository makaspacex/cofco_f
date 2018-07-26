<form class="page-list-form">
    <div class="layui-btn-group">
        <a href="{:url('task_add')}" id="btn" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        <a data-href="{:url('task_stop')}" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="aicon ai-jinyong"></i>删除</a>

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
                <th>关键词</th>
                <th>进度</th>
                <th>已爬取/总数</th>
                <th>创建时间</th>
                <th>创建人</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
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
            if($v['pid']=='')
            $v['pid']="未运行";
            if($v['progress']!=null)
            {
             $v['progress']=$v['progress']*100;
             $v['progress'].="%";
            }
            if($v['sstr']!=null)
            {
            $v['sstr']= str_replace('*', ' ', $v['sstr']);
            }
            {/php}
            <tr>
                <td><input type="checkbox" name="ids[]" value="{$v['pid']}" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>{$v['pid']}</td>
                <td>{$v.sstr}</td>
                <td>{$v.progress}</td>
                <td>{$v.totalnum-$v.remainnum}/{$v.totalnum}</td>
                <td>{:date('Y-m-d H:i:s', $v['create_time'])}</td>
                <td>{$v['creator']}</td>
<!--                <td><input type="" name="status" {if condition="$v['status'] eq 3"} value="运行中" {/if}></td>-->
                <td>{$v['status']}</td>
<!--                <td>{$v['sstr']}</td>-->
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
<!--                            <a href="{:url('task_edit?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>-->
                            <a href="{:url('task_pause?id='.$v['pid'])}" id="id1" class="layui-btn layui-btn-primary layui-btn-sm j-ajax">暂停</a>
                            <a href="{:url('task_continue?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm j-ajax">继续</a>
                            <a data-href="{:url('task_remove',"id=".$v['sstr'])}" class="layui-btn layui-btn-primary layui-btn-sm j-tr-del">删除</a>
                            <a href="{:url('task_stop?id='.$v['pid'])}" class="layui-btn layui-btn-primary layui-btn-sm j-ajax">停止</a>
<!--                            <a href="{:url('task_startforce?id='.$v['sstr'])}" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe623;</i></a>-->
                            <a href="{:url('task_startforce',"id=".$v['sstr'])}" class="layui-btn layui-btn-primary layui-btn-sm j-ajax">重启</a>
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
<script >
    var t = {:json_encode($data_list)};
    var tt = {:json_encode($msg)};
    if (tt!='')
    {
        layui.use('layer', function(){
            var $ = layui.layer;
            if (tt=='链接爬虫失败')
            {
                layer.alert(tt,{icon: 2, title:'服务'});
            }
            else {
                if (t == '') {
                    layer.msg('爬虫任务列表为空');
                }
            }
        });



    }

</script>