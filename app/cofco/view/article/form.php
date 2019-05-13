{include file="cofco@block/edit_form"/}
<script>
    $('#formSubmit').click(function (e) {
        var form_s = $('#editForm');
        var form_data = form_s.serializeArray();
        var data = [];
        for(var key in form_data){
            var ele = form_data[key];
            data[ele['name']] = ele['value']
        }
        var article_api_url_edit = "{$article_api_url}/edit";
        $.post(article_api_url_edit,form_data,function (res) {
            if(res.code===0){
                layer.msg(res.message);
            }

        });
        if(e.preventDefault){ e.preventDefault(); }else{ window.event.returnValue == false;}
    });
</script>