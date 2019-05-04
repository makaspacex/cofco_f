
<blockquote class="layui-elem-quote layui-text">
    为了减少爬虫爬取数量和人工审核数量，爬虫系统2.0版本支持了关键词高级搜索。
    <br>
    本页面完全重现了ScienceDirect官网的高级搜索页面，
    只在风格上有所不同，更详细的使用方式见
    <a href=" " style="color: #0000cc">官网高级搜索</a>。
    <br>
    All of the fields are optional. Find out more about the new advanced search.
</blockquote>


<!--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">-->
<!--    <legend>普通搜索</legend>-->
<!--</fieldset>-->

<!--<form class="layui-form layui-form-pane" action="" lay-filter="example">-->
<!--    <div class="layui-form-item">-->
<!--        <div class="layui-inline w500" >-->
<!--            <label class="layui-form-label">关键词</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="keywords" lay-verify="title" autocomplete="off"  class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="layui-inline w500">-->
<!--            <label class="layui-form-label">作者名</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="authorname"  autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="layui-form-item">-->
<!--        <div class="layui-inline w500">-->
<!--            <label class="layui-form-label">期刊/书标题</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="title"  autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="layui-inline w500">-->
<!--            <label class="layui-form-label">volume</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="volume"  autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--    <div class="layui-form-item">-->
<!--        <div class="layui-inline w500">-->
<!--            <label class="layui-form-label">Issue</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="Issue"  autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="layui-inline w500">-->
<!--            <label class="layui-form-label">页码</label>-->
<!--            <div class="layui-input-block">-->
<!--                <input type="text" name="pages"  autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="layui-inline ">-->
<!--            <div class="layui-input-block">-->
<!--                <button class="layui-btn" lay-submit="" lay-filter="demo1">搜索</button>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</form>-->
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>高级搜索</legend>
</fieldset>

<form class="layui-form layui-form-pane" action="">
    <div class="layui-row">
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Find articles with these terms</div>
                <input type="text" name="qs" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md6">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">In this journal or book title</div>
                <input type="text" name="pub" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Year(s)</div>
                <input type="text" name="date" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md6">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Author(s)</div>
                <input type="text" name="authors" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Author affiliation</div>
                <input type="text" name="affiliations" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Title, abstract or author-specified keywords</div>
                <input type="text" name="tak" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Title</div>
                <input type="text" name="title" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>



    </div>
    <div class="layui-row">
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Volume(s)</div>
                <input type="text" name="volume" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Issue(s)</div>
                <input type="text" name="issue" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Page(s)</div>
                <input type="text" name="page" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">DOI, ISSN or ISBN</div>
                <input type="text" name="docId" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">References</div>
                <input type="text" name="references" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">搜索</button>
            </div>
        </div>
</form>

</body>
</html>
<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">

{include file="admin@block/layui" /}