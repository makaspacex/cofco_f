
<table class="layui-table mt10" lay-even="" lay-skin="row">
    <colgroup>
        <col width="400">
    </colgroup>
    <thead>
    <tr>
        <th>时间</th>
        <th>创建文献数</th>
        <th>初审文献数</th>
        <th>标注文献数</th>
        <th>终审文献数</th>
    </tr>
    </thead>
    <tbody>
    {volist name="data_list" id="v"}
    <tr>
        <td>{$v['year']}-{$v['month']}月</td>
        <td>{$v['creater']}</td>
        <td>{$v['auditor']}</td>
        <td>{$v['labelor']}</td>
        <td>{$v['final_auditor']}</td>
    </tr>
    {/volist}
    </tbody>
</table>

