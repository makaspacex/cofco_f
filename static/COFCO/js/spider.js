
function addBarEvent(table,url){
    //监听行工具事件
    table.on('tool(test)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            , layEvent = obj.event; //获得 lay-event 对应的值
        var $ = layui.jquery;
        switch (layEvent) {
            case 'pause':
                console.log('pause');
                console.log(data.kw_id);

                $.ajax({
                    url:url, //+'?kw_id='+data.kw_id+'&action=pause',
                    data:{kw_id:data.kw_id,action:"pause",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(url);
                        console.log(res);
                    }
                });
                break;
            case 'resume':
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"resume",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);

                    }
                });
                break;
            case 'terminate':
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"terminate",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);

                    }
                });
                break;
            case 'del':
                $.ajax({
                    url:url,
                    data:{kw_id:data.kw_id,action:"del",idsP:1,contentP:1},
                    type:"post",
                    dataType:"json",
                    success:function (res) {
                        console.log(res);
                    }
                });
                break;

        }

    });
}