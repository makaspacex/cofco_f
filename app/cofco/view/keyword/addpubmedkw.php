<blockquote class="layui-elem-quote layui-text">
    为了减少爬虫爬取数量和人工审核数量，爬虫系统2.0版本支持了关键词高级搜索。
    <br>
    本页面暂时未开放
    <br>
    All of the fields are optional. Find out more about the new advanced search.
</blockquote>


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>关键词添加</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="" id="form_div">

    <div class="layui-form-item">
        <div class="layui-inline w100" >
        </div>
        <div class="layui-inline w500">
            <label class="layui-form-label">关键词名称</label>
            <div class="layui-input-block">
                <input type="text" name="keyword"  autocomplete="off" class="layui-input">
            </div>

        </div>

    </div>

    <div class="layui-form-item" id="0">

        <div class="layui-inline w100" >
        </div>

        <div class="layui-inline w200" >
            <select class="index_field" id="field">
                <option value="Affiliation">Affiliation</option>
                <option value="All Fields" selected="selected">All Fields</option>
                <option value="Author">Author</option>
                <option value="Author - Corporate">Author - Corporate</option>
                <option value="Author - First">Author - First</option>
                <option value="Author - Full">Author - Full</option>
                <option value="Author - Identifier">Author - Identifier</option>
                <option value="Author - Last">Author - Last</option>
                <option value="Book">Book</option>
                <option value="Conflict of Interest Statements">Conflict of Interest Statements</option>
                <option value="Date - Completion">Date - Completion</option>
                <option value="Date - Create">Date - Create</option>
                <option value="Date - Entrez">Date - Entrez</option>
                <option value="Date - MeSH">Date - MeSH</option>
                <option value="Date - Modification">Date - Modification</option>
                <option value="Date - Publication">Date - Publication</option>
                <option value="EC/RN Number">EC/RN Number</option>
                <option value="Editor">Editor</option>
                <option value="Filter">Filter</option>
                <option value="Grant Number">Grant Number</option>
                <option value="ISBN">ISBN</option>
                <option value="Investigator">Investigator</option>
                <option value="Investigator - Full">Investigator - Full</option>
                <option value="Issue">Issue</option>
                <option value="Journal">Journal</option>
                <option value="Language">Language</option>
                <option value="Location ID">Location ID</option>
                <option value="MeSH Major Topic">MeSH Major Topic</option>
                <option value="MeSH Subheading">MeSH Subheading</option>
                <option value="MeSH Terms">MeSH Terms</option>
                <option value="Other Term">Other Term</option>
                <option value="Pagination">Pagination</option>
                <option value="Pharmacological Action">Pharmacological Action</option>
                <option value="Publication Type">Publication Type</option>
                <option value="Publisher">Publisher</option>
                <option value="Secondary Source ID">Secondary Source ID</option>
                <option value="Subject - Personal Name">Subject - Personal Name</option>
                <option value="Supplementary Concept">Supplementary Concept</option>
                <option value="Text Word">Text Word</option>
                <option value="Title">Title</option>
                <option value="Title/Abstract">Title/Abstract</option>
                <option value="Transliterated Title">Transliterated Title</option>
                <option value="Volume">Volume</option>
            </select>
        </div>

        <div class="layui-inline w500">
<!--            <label class="layui-form-label">关键词名称</label>-->
                <input type="text" name="keyword"  autocomplete="off" class="layui-input">
        </div>

        <div class="layui-inline w200">
            <button id="add" class="layui-btn layui-btn-primary layui-btn-radius">+</button>
            <button id="del" class="layui-btn layui-btn-radius">-</button>

            <button type="submit" class="layui-btn">提交</button>


        </div>



    </div>


    </div>
</form>
<div class="layui-inline w500">
    <div class="hide" id="count">1</div>
</div>
{include file="cofco@block/layui" /}
<script>


    layui.use('form', function() {
        var form = layui.form; //只有执行了这一步，部分表单元素才会自动修饰成功
        var addbtn = document.getElementById("add");
        addbtn.onclick = function(event){
            event.preventDefault();
            var count = document.getElementById("count").innerHTML;
            var form_div = document.getElementById("form_div");
            form_div.appendChild(addItem(count));
            form.render();
            document.getElementById("count").innerHTML = parseInt(count)+1;
        }

        var delbtn = document.getElementById("del");
        delbtn.onclick = function(event){
            event.preventDefault();
            var form_div = document.getElementById("form_div");
            form_div.appendChild(addItem());
            delItem();
        }

    });


    
    function addItem(no) {
        var layui_form_item = document.createElement("div");
        layui_form_item.setAttribute("class","layui-form-item");
        layui_form_item.setAttribute("id",no);
        layui_form_item.appendChild(addSymbolSelect(no));
        layui_form_item.appendChild(addFieldsSelect(no));
        layui_form_item.appendChild(addInput(no));
        return layui_form_item;

    }

    function delItem(no) {

    }

    //添加符号选择框
    function addSymbolSelect(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class","layui-inline w100");
        var select = document.createElement("select");
        select.setAttribute("name","symbol_"+no);
        var option = document.createElement("option");
        option.setAttribute("value","1");
        option.setAttribute("selected","");
        option.append("AND");
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value","2");
        option.append("OR");
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value","3");
        option.append("NOT");
        select.appendChild(option);

        select.appendChild(option);
        layui_inline.appendChild(select);

        return layui_inline;

    }

    //添加字段选择框
    function addFieldsSelect(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class","layui-inline w200");

        var select = document.getElementById("field");
        select.setAttribute("id","field"+no)
        layui_inline.appendChild(select);
        return layui_inline;
    }


    //添加输入框
    function addInput(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class","layui-inline w500");
        var layui_input = document.createElement("input");
        layui_inline.setAttribute("name","keyword_"+no);
        layui_input.setAttribute("class","layui-input")

        layui_inline.appendChild(layui_input);
        return layui_inline;
    }
</script>

<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">





</div>


