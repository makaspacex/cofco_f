{include file="cofco@block/edit_form"/}
<script>
    input = $('.field-status[value=1]');
    input.prop('checked', true);
    for(var i=2;i<5;i++){
        input = $('.field-status[value="' + i + '"]');
        input.prop('disabled', true);
    }
</script>

<script>
    $('#formSubmit').click(function (e) {
        var form_s = $('#editForm');
        var form_data = form_s.serializeArray();
        console.log(form_data);
        var article_api_url_edit = "{$article_api_url}/add";
        $.post(article_api_url_edit,form_data,function (res) {
            console.log(res);
            if(res.code===0){
                layer.msg(
                    res.message
                    ,{time:1000}
                    ,function () {
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);//关闭当前页
                    });

            }
            else {
                layer.msg(res.message);
            }

        });
        if(e.preventDefault){ e.preventDefault(); }else{ window.event.returnValue == false;}
    });
</script>