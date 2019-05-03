<table class="layui-table mt10" lay-even="" lay-skin="row">
    <colgroup>
        <col width="400">
    </colgroup>
    <thead>
    <tr>
        <th>时间</th>
        <th>创建文章数</th>
        <th>审核文章数</th>
        <th>终审文章数</th>
    </tr>
    </thead>
    <tbody>
    {volist name="data_list" id="v"}
    <tr>
        <td>{$v['year']}-{$v['month']}月</td>
        <td>{$v['create']}</td>
        <td>{$v['pre']}</td>
        <td>{$v['finaly']}</td>
    </tr>
    {/volist}
    </tbody>
</table>
{include file="block/layui" /}