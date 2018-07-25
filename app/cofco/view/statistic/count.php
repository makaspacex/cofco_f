<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">原料类型</label>
        <div class="layui-input-inline">
            <input type="hidden" name="yuanliaotype" lay-verify="required" autocomplete="off" class="layui-input" value="{$user_input?$user_input['yuanliaotype']:''}">
        </div>
        <div class="layui-input-inline" style="width: 650px">
            <input type="label" class="layui-input field-value"
                   name="yuanliaoname" lay-verify="" autocomplete="off" placeholder="空表示不限制" value="{$user_input?$user_input['yuanliaoname']:''}">
        </div>
        <a href="{:url('levelpop1?callback=yuanliao')}" title="选择标签" class="layui-btn   layui-btn-primary j-iframe-pop fl">选择原料类型</a>

    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">疾病类型</label>
        <div class="layui-input-inline" >
            <input type="hidden" name="jibingtype" lay-verify="required" autocomplete="off" class="layui-input" value="{$user_input?$user_input['jibingtype']:''}">
        </div>
        <div class="layui-input-inline" style="width: 650px">
            <input type="label" class="layui-input field-value" name="jibingname" lay-verify="" autocomplete="off" value="{$user_input?$user_input['jibingname']:''}"
                   placeholder="空表示不限制">
        </div>
        <a href="{:url('levelpop2?callback=jibing')}" title="选择标签" class="layui-btn   layui-btn-primary j-iframe-pop fl">选择疾病类型</a>

    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" class="field-id" name="id" value="63">
            <button type="submit" class="layui-btn" lay-filter="formSubmit">统计</button>
            <button type="reset" class="layui-btn layui-btn-primary ml10">清空</button>
        </div>
    </div>
</form>
<script>

    function yuanliao(data) {
        var text1 = '';
        var text2 = '';
        var $ = layui.jquery;
        for (var i = 0; i < data.length; i++) {
            if (i == 0) {
                text1 = data[i]['name'];
                text2 = data[i]['title'];
            }
            else {
                text1 = text1 + '#' + data[i]['name']
                text2 = text2 + '#' + data[i]['title']
            }
        }
        $('input[name="yuanliaotype"]').val(text1);
        $('input[name="yuanliaoname"]').val(text2);
    }

    function jibing(data) {
        var text1 = '';
        var text2 = '';
        var $ = layui.jquery;
        for (var i = 0; i < data.length; i++) {
            if (i == 0) {
                text1 = data[i]['name'];
                text2 = data[i]['title'];
            }
            else {
                text1 = text1 + '#' + data[i]['name']
                text2 = text2 + '#' + data[i]['title']
            }
        }
        $('input[name="jibingtype"]').val(text1);
        $('input[name="jibingname"]').val(text2);
    }


</script>




{if condition="$dispaly_statistic==1"}
<div class="container" id="data_result">
    <div id="main" style="width: 100%;height:500px;"></div>
</div>
<div class="layui-tab-content page-tab-content">
    <div class="layui-tab-item layui-show">
        <div class="fl" style="width:99%">
            <table class="layui-table">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th colspan="1">实验类型</th>
                    <th colspan="1">分数</th>
                    <th colspan="1">数量</th>
                    <th colspan="1">占比</th>
                    <th colspan="1">得分</th>
                </tr>
                </thead>
                <tbody>
                {volist name='level_info' id='v'}
                <tr {$statistic_info['max_name']==$key?"style='font-weight:bold;'":''}>
                    <td>{$key}</td>
                    <td>{$v['score']}</td>
                    <td>{$v['p_total_number']}</td>
                    <td>{$v['percent']}%</td>
                    <td>{$v['score']*$v['p_total_number']}</td>
                </tr>
                {/volist}

                </tbody>
                <thead>
                <tr>
                    <th colspan="5">统计信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="color: red;font-weight: bold">分值最大实验类型</td>
                    <td colspan="4">{$statistic_info['max_name']}，得分为{$statistic_info['max_score']}</td>
                </tr>
                <tr>
                    <td style="color: red;font-weight: bold">文章数目</td>
                    <td colspan="4">{$statistic_info['total_p']}</td>
                </tr>
                <tr>
                    <td style="color: red;font-weight: bold">总分数</td>
                    <td colspan="4">{$statistic_info['total_score']}</td>
                </tr>

                <tr>
                    <td style="color: red;font-weight: bold">加权得分</td>
                    <td colspan="4">{$statistic_info['total_score']/$statistic_info['total_p']} (说明：设筛选出的文章数目为N，每个标签的分值和数量分别为a和n1，b和n2，c和n3。分数计算公式为：S = (a*n1 + b*n2 + c*n3)/N)</td>
                </tr>

                </tbody>
            </table>
        </div>


    </div>
</div>


<script type="text/javascript">

    var dom = document.getElementById("main");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    var posList = [
        'left', 'right', 'top', 'bottom',
        'inside',
        'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
        'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
    ];

    app.configParameters = {
        rotate: {
            min: -90,
            max: 90
        },
        align: {
            options: {
                left: 'left',
                center: 'center',
                right: 'right'
            }
        },
        verticalAlign: {
            options: {
                top: 'top',
                middle: 'middle',
                bottom: 'bottom'
            }
        },
        position: {
            options: echarts.util.reduce(posList, function (map, pos) {
                map[pos] = pos;
                return map;
            }, {})
        },
        distance: {
            min: 0,
            max: 100
        }
    };

    app.config = {
        rotate: 90,
        align: 'left',
        verticalAlign: 'middle',
        position: 'insideBottom',
        distance: 5,
        onChange: function () {
            var labelOption = {
                normal: {
                    rotate: app.config.rotate,
                    align: app.config.align,
                    verticalAlign: app.config.verticalAlign,
                    position: app.config.position,
                    distance: app.config.distance
                }
            };
            myChart.setOption({
                series: [{
                    label: labelOption
                }, {
                    label: labelOption
                }, {
                    label: labelOption
                }, {
                    label: labelOption
                }]
            });
        }
    };


    var labelOption = {
        normal: {
            show: true,
            position: app.config.position,
            distance: app.config.distance,
            align: app.config.align,
            verticalAlign: app.config.verticalAlign,
            rotate: app.config.rotate,
            formatter: '{c}  {name|{a}}',
            fontSize: 18,
            rich: {
                name: {
                    color:'#ffffff',
                    // textBorderColor: '#fff'
                }
            }
        }
    };

    option = {
        color: ['#003366', '#006699', '#4cabce', '#e5323e'],
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: [<?php foreach ($shiyan_names as $v){ echo "'$v',";} ?>]
        },
        toolbox: {
            show: false,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                mark: {show: true},
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        calculable: true,
        xAxis: [
            {
                type: 'category',
                name: '原料分类',
                axisTick: {show: false},
                data: [<?php foreach ($mingcheng as $v){ echo "'$v',";} ?>]
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '实验类型百分比',
                max: 100,
                min:0,
                splitNumber:10,
                axisLabel:{
                    formatter:'{value}%'
                }
            },

        ],
        series: [
            {volist name='shiyanfenzu'  id='v'}
            {
                name: '{$key}',
                type: 'bar',
                barGap: 0,
                label: labelOption,
                data: [{:join(',', $v['inner_percent'])}]
    },
    {/volist}
    ]
    };;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
{/if}
{include file="admin@block/layui" /}
<script>  var formData = null</script>
<script src="__ADMIN_JS__/footer.js"></script>