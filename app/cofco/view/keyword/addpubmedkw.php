<blockquote class="layui-elem-quote layui-text">
    为了减少爬虫爬取数量和人工审核数量，爬虫系统2.0版本支持了关键词高级搜索。
    <br>
    本页面完全重现了Pubmed官网的高级搜索页面，
    只在风格上有所不同，更详细的使用方式见
    <a href="https://www.ncbi.nlm.nih.gov/pubmed/advanced" style="color: #0000cc">官网高级搜索</a>。
    <br>
    All of the fields are optional. Find out more about the new advanced search.
    <br>
    <h3 style="color: #ff0709">爬虫关键词一旦创建不可修改</h3>
</blockquote>


<fieldset class="layui-elem-field layui-field-title">
    <legend>关键词添加</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="" id="form_div" method="post">

    <div class="layui-form-item">
        <div class="layui-inline w100">
        </div>
        <div class="layui-inline w500">
            <label class="layui-form-label">关键词名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" required autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>

    <div class="layui-form-item" id="0">
        <div class="layui-inline w100 " style="visibility:hidden;" >
            <select class="index_field" id="symbol" name="0[symbol]">
                <option value="none" selected></option>
            </select>
        </div>
        <div class="layui-inline w200">
            <select class="index_field" id="field" name="0[field]">
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
            <input type="text" name="0[keyword]" autocomplete="off" class="layui-input">
        </div>

        <div class="layui-inline w200">
            <button id="delBtn0" class="layui-btn layui-btn-radius">-</button>
            <button id="addBtn0" class="layui-btn layui-btn-primary layui-btn-radius">+</button>
            <button type="submit" class="layui-btn">提交</button>
        </div>
    </div>
    </div>
</form>
<div class="layui-hide">
    <div id="count">1</div>
</div>
{include file="admin@block/layui" /}
<script>
    var addbtn = document.getElementById("addBtn0");
    addbtn.onclick = function (event) {
        event.preventDefault();
        var count = document.getElementById("count").innerHTML;
        var form_div = document.getElementById("form_div");
        form_div.appendChild(addItem(count));
        document.getElementById("count").innerHTML = parseInt(count) + 1;
        addbtn.style.visibility = "visible";
        formrender();
    }

    var delbtn = document.getElementById("delBtn0");
    delbtn.style.visibility = "hidden";
    delbtn.onclick = function (event) {
        event.preventDefault();
    }

    function addItem(no) {
        var layui_form_item = document.createElement("div");
        layui_form_item.setAttribute("class", "layui-form-item");
        layui_form_item.setAttribute("id", no);
        layui_form_item.appendChild(addSymbolSelect(no));
        layui_form_item.appendChild(addFieldsSelect(no));
        layui_form_item.appendChild(addInput(no));
        layui_form_item.appendChild(addButton(no));
        return layui_form_item;

    }


    //添加符号选择框
    function addSymbolSelect(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class", "layui-inline w100");
        var select = document.createElement("select");
        select.setAttribute("name", no + "[symbol]");
        var option = document.createElement("option");
        option.setAttribute("value", "1");
        option.setAttribute("selected", "");
        option.append("AND");
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value", "2");
        option.append("OR");
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value", "3");
        option.append("NOT");
        select.appendChild(option);

        select.appendChild(option);
        layui_inline.appendChild(select);

        return layui_inline;

    }

    //添加字段选择框
    function addFieldsSelect(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class", "layui-inline w200");

        var select = document.getElementById("field");
        select = select.cloneNode(true);

        select.setAttribute("name", no + "[field]");
        layui_inline.appendChild(select);
        return layui_inline;
    }

    //添加输入框
    function addInput(no) {
        var layui_inline = document.createElement("div");
        layui_inline.setAttribute("class", "layui-inline w500");
        var layui_input = document.createElement("input");
        layui_input.setAttribute("name", no + "[keyword]");
        layui_input.setAttribute("class", "layui-input");

        layui_inline.appendChild(layui_input);
        return layui_inline;
    }

    //添加按钮
    function addButton(no) {
        var newbtnDiv = document.createElement("div");
        newbtnDiv.setAttribute("class", "layui-inline w200");

        //添加del按钮
        var delBtn = document.getElementById("delBtn0");
        var newdelBtn = delBtn.cloneNode(true);
        newdelBtn.setAttribute("id", "delBtn" + no);
        //newdelBtn.style.visibility = "none";      //隐藏元素
        newdelBtn.style.visibility = "visible"; //显示元素
        newdelBtn.onclick = function (event) {
            event.preventDefault();
            var id = event.target.id.substring(6); //当前组件的id
            var count = document.getElementById("count").innerHTML; //当前item数

            lastid = parseInt(id) - 1;
            lastaddBtn = document.getElementById("addBtn" + lastid);
            lastaddBtn.style.visibility = "visible";

            var item = document.getElementById(id);
            item.parentNode.removeChild(item);
            document.getElementById("count").innerHTML = parseInt(count) - 1;
            formrender();
        }
        newbtnDiv.appendChild(newdelBtn);

        //添加add按钮
        var addBtn = document.getElementById("addBtn0");
        var newaddBtn = addBtn.cloneNode(true);
        newaddBtn.setAttribute("id", "addBtn" + no);
        newaddBtn.style.visibility = "visible";
        newaddBtn.onclick = function (event) {
            event.preventDefault();
            var id = event.target.id;
            lastid = parseInt(id.substring(6)) - 1;
            lastaddBtn = document.getElementById("addBtn" + lastid);
            newaddBtn.style.visibility = "hidden";

            var count = document.getElementById("count").innerHTML;
            var form_div = document.getElementById("form_div");
            form_div.appendChild(addItem(count));
            document.getElementById("count").innerHTML = parseInt(count) + 1;
            formrender();
        }
        newbtnDiv.appendChild(newaddBtn);
        return newbtnDiv;
    }

    //重新渲染表单
    function formrender() {
        layui.use('form', function () {
            var form = layui.form; //只有执行了这一步，部分表单元素才会自动修饰成功
            form.render();
        });
    }
</script>



<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">



