
<blockquote class="layui-elem-quote layui-text">
    为了减少爬虫爬取数量和人工审核数量，爬虫系统2.0版本支持了关键词高级搜索。
    <br>
    本页面完全重现了ScienceDirect官网的高级搜索页面，
    只在风格上有所不同，更详细的使用方式见
    <a href=" " style="color: #0000cc">官网高级搜索</a>。
    <br>
    All of the fields are optional. Find out more about the new advanced search.
</blockquote>

<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
    <div class="layui-row">
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">关键词名称</div>
                <input type="text" name="name" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Find articles with these terms</div>
                <input type="text" name="qs"   placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md6">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">In this journal or book title</div>
                <input type="text" name="pub"   placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Year(s)</div>
                <input type="text" name="date"   placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md6">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Author(s)</div>
                <input type="text" name="authors"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Author affiliation</div>
                <input type="text" name="affiliations"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Title, abstract or author-specified keywords</div>
                <input type="text" name="tak"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Title</div>
                <input type="text" name="title"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>



    </div>
    <div class="layui-row">
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Volume(s)</div>
                <input type="text" name="volume"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Issue(s)</div>
                <input type="text" name="issue"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md2">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Page(s)</div>
                <input type="text" name="page"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">DOI, ISSN or ISBN</div>
                <input type="text" name="docId"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">References</div>
                <input type="text" name="references"  placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <div class="layui-form-title">Article types</div>
                <br><br>
                <input type="checkbox" name="articleTypes[REV]" lay-skin="primary" title="Review articles">
                <input type="checkbox" name="articleTypes[COR]" lay-skin="primary" title="Correspondence">
                <input type="checkbox" name="articleTypes[PNT]" lay-skin="primary" title="Patent reports">

                <input type="checkbox" name="articleTypes[FLA]" lay-skin="primary" title="Research articles">
                <input type="checkbox" name="articleTypes[DAT]" lay-skin="primary" title="Data articles">
                <input type="checkbox" name="articleTypes[PGL]" lay-skin="primary" title="Practice guidelines">

                <input type="checkbox" name="articleTypes[EN]" lay-skin="primary" title="Encyclopedia">
                <input type="checkbox" name="articleTypes[DIS]" lay-skin="primary" title="Discussion">
                <input type="checkbox" name="articleTypes[PRV]" lay-skin="primary" title="Product reviews">

                <input type="checkbox" name="articleTypes[CH]" lay-skin="primary" title="Book chapters">
                <input type="checkbox" name="articleTypes[EDI]" lay-skin="primary" title="Editorials">
                <input type="checkbox" name="articleTypes[RPL]" lay-skin="primary" title="Replication studies">

                <input type="checkbox" name="articleTypes[ABS]" lay-skin="primary" title="Conference abstracts">
                <input type="checkbox" name="articleTypes[ERR]" lay-skin="primary" title="Errata">
                <input type="checkbox" name="articleTypes[SCO]" lay-skin="primary" title="Short communications">

                <input type="checkbox" name="articleTypes[BRV]" lay-skin="primary" title="Book reviews">
                <input type="checkbox" name="articleTypes[EXM]" lay-skin="primary" title="Examinations">
                <input type="checkbox" name="articleTypes[OSP]" lay-skin="primary" title="Software publications">

                <input type="checkbox" name="articleTypes[CRP]" lay-skin="primary" title="Case reports">
                <input type="checkbox" name="articleTypes[CNF]" lay-skin="primary" title="Mini reviews">
                <input type="checkbox" name="articleTypes[SSU]" lay-skin="primary" title="Video articles">

                <input type="checkbox" name="articleTypes[NWS]" lay-skin="primary" title="Conference info">
                <input type="checkbox" name="articleTypes[VID]" lay-skin="primary" title="News">
                <input type="checkbox" name="articleTypes[OT]" lay-skin="primary" title="Other">
            </div>
        </div>


        <div class="layui-col-md10">
            <div class="layui-form-item margin-bottom-0">
                <button type="submit" class="layui-btn">提交</button>

            </div>
        </div>
</form>

<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">

{include file="admin@block/layui" /}
