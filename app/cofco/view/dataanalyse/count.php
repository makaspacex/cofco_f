<link rel="stylesheet" href="__ADMIN_JS__/layui/css/layui.css">
<link rel="stylesheet" href="__ADMIN_CSS__/style.css?v={:time()}">
<script src="__ADMIN_JS__/echarts.js"></script>
<div>
<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="page-filter left" style="float: right">
        <form class="layui-form layui-form-pane" action="{:url()}" method="get">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索</label>
                <div class="layui-input-inline">
                    <input type="hidden" name="q"  lay-verify="required" placeholder="文章标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="label" class="layui-input field-value"  name="value" lay-verify="" autocomplete="off" placeholder="标签">
                </div>
                <a href="{:url('levelpop1?callback=func')}" title="选择标签" class="layui-btn layui-btn-primary j-iframe-pop fl">选择标签</a>
                </div>
            </div>
        </form>
        <div>
            <button id="test2"class="layui-btn">统计图</button>
            <div id="speedChart" style="display: none;float: right ">
                <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
                <div id="speedChartMain" style="width: 600px; height: 400px;"></div>
            </div>
        </div>
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
                <td>{$v['title']}</td>
                <!--                    <td><input type="checkbox" name="status" {if condition="$v['status'] eq 1" } checked="" {/if}-->
                <!--                        value="{$v['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭"-->
                <!--                        data-href="{:url('status?table=admin_pending&ids='.$v['id'])}">-->
                <!--                    </td>-->
                <td>{$v['status']}</td>
<!--                <td>-->
<!--                    <div class="layui-btn-group">-->
<!--                        <div class="layui-btn-group">-->
<!--                            <a href="{:url('pending_edit?id='.$v['id'])}"class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon">&#xe642;</i></a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </td>-->

            </tr>
            {/volist}
            </tbody>
        </table>
        {$pages}
    </div>

</form>
{include file="admin@block/layui" /}
<script type="text/javascript">
    var formData = {:json_encode($data_info)};
    var t = {:json_encode($data_info1)};
    var t1 = {:json_encode($data_info2)};
    var A={:json_encode($data_list1)};
    var A1={:json_encode($data_list2)};
    var A2={:json_encode($data_list3)};
    if(A!=null)
    {
        layui.use('layer', function(){
            var $ = layui.layer;
            layer.alert(JSON.stringify(A1+':'+A2), {icon: 1, title:'实验类型最高得分'});
        });
    }
    var text1='';var text2='';
    function func(data) {
        var $ = layui.jquery;
        for(var i=0;i<data.length;i++){
            if (i==0){
                text1= data[i]['name'];
                text2= data[i]['title'];
            }
            else{
                text1=text1+'#'+data[i]['name']
                text2=text2+'#'+data[i]['title']
            }
        }
        $('input[name="q"]').val(text1);
        $('input[name="value"]').val(text2);
    }

        var myChart = echarts.init(document.getElementById('speedChartMain'));
        var seriesValue = [];
        for (var g = 0; g < t1.length; g++) {
            var serieObj = {
                name: t1[g],
                type: 'bar',
                data: [320, 332, 301],
            };
            seriesValue.push(serieObj);
        }
        option = {
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data:t
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data :t
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
        //     series : [
        //         {
        //             name:t1[0],
        //             type:'bar',
        //             data:[320, 332, 301]
        //         },
        //
        //         {
        //             name:t1[1],
        //             type:'bar',
        //             data:[60, 72, 71]
        //         },
        //         {
        //             name:t1[2],
        //             type:'bar',
        //             data:[62, 82, 91]
        //         }
        //     ]
            series: seriesValue
        };

        myChart.setOption(option);
        layui.use(['layer'], function(){
            var layer = layui.layer;
            layui.use(['jquery'], function(){
                var $ = layui.jquery;
                $('#test2').click(function() {
                    layer.open({
                        title:'柱状图',
                        type: 1,
                        offset: '100px',
                        shade: false,
                        area: ['620px', '460px'],
                        shadeClose: false, //点击遮罩关闭
                        content: $("#speedChart")
                    });
                });
            });
        });


</script>
<script>

</script>
<script src="__ADMIN_JS__/footer.js"></script>