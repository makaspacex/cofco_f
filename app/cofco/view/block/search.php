<link rel="stylesheet" type="text/css" href="__COFCO_CSS__/style.css">
<form class="layui-form layui-form-pane" action="JavaScript:void(0);" id='article_search_form'>
    <div class="layui-container-fluid">
        <div class="row">
            <div class="layui-col-md5">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                    <select name="title" id="title" lay-verify="required" lay-search="" enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">期刊分区</label>
                <div class="layui-input-block">
                    <select name="journal_zone" id="journal_zone" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md4">
                <label class="layui-form-label">爬虫关键词</label>
                <div class="layui-input-block">
                    <select name="kw_id" id="kw_id" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                        {volist name="keyword_list" id="v"}
                        <option value={$v['id']}>{$v['name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">发表时间</label>
                <div class="layui-input-block">
                    <!--                    <input type="text" name="date_start" id="date_start" value="{:input('get.date_start')}"-->
                    <!--                           lay-verify="date_start" placeholder="不限制" class="layui-input">-->
                    <select name="date_start" id="date_start" lay-search="" enable-input="false" lay-verify="date">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md2">
                <div class="layui-layer-input">
                    <select name="date_end" id="date_end" lay-search="" enable-input="false" lay-verify="date">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">影响因子</label>
                <div class="layui-input-block">
                    <select name="impact_factor" id="impact_factor" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md4">
                <label class="layui-form-label">DOI</label>
                <div class="layui-input-block">
                    <select name="doi" id="doi" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="layui-row advanced_part hide">
            <div class="layui-col-md3">
                <label class="layui-form-label">创建人</label>
                <div class="layui-input-block">
                    <select name="creator" id="creator" lay-verify="required" lay-search=""  >
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">初审人</label>
                <div class="layui-input-block">
                    <select name="auditor" id="auditor" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">标注人</label>
                <div class="layui-input-block">
                    <select name="labelor" id="labelor" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">终审人</label>
                <div class="layui-input-block">
                    <select name="final_auditor" id="final_auditor" lay-verify="required" lay-search="">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md6">
                <label class="layui-form-label">原文摘要</label>
                <div class="layui-input-block">
                    <select name="abstract" id="abstract" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md6">
                <label class="layui-form-label">翻译摘要</label>
                <div class="layui-input-block">
                    <select name="tabstract" id="tabstract" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md6">
                <label class="layui-form-label">关键词</label>
                <div class="layui-input-block">
                    <select name="key_word" id="key_word" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">文档类型</label>
                <div class="layui-input-block">
                    <select name="country" id="country" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                        <option value="MAN">人工输入</option>
                        <option value="PUBMED_SPIDER">Pubmed爬虫</option>
                        <option value="SCIENCE_SPIDER">Science爬虫</option>
                    </select>
                </div>
            </div>



            <div class="layui-col-md3">
                <label class="layui-form-label">国家</label>
                <div class="layui-input-block">
                    <select name="country" id="country" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>



            <div class="layui-col-md6">
                <label class="layui-form-label">文献作者</label>
                <div class="layui-input-block">
                    <select name="author" id="author" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md6">
                <label class="layui-form-label">发表机构</label>
                <div class="layui-input-block">
                    <select name="institue" id="institue" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md6">
                <label class="layui-form-label">发表期刊</label>
                <div class="layui-input-block">
                    <select name="journal" id="journal" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

            <div class="layui-col-md3">
                <label class="layui-form-label">ISSN</label>
                <div class="layui-input-block">
                    <select name="issn" id="issn" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md3">
                <label class="layui-form-label">紧要程度</label>
                <div class="layui-input-block">
                    <select name="urgency" id="urgency" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>
            <div class="layui-col-md12">
                <label class="layui-form-label">特别说明</label>
                <div class="layui-input-block">
                    <select name="special_version" id="special_version" lay-verify="required" lay-search=""
                            enable-input="true">
                        <option value="">不限制</option>
                        <option value="{:NULL_STR}" class="tip-opt">空字符串</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="layui-row">
            <div class="layui-col-md4 layui-col-md-offset8">
                <div class="layui-inline right-align">
                    <button type="submit" class="layui-btn layui-btn-sm search_submit_btn">搜索</button>
                    <button type="reset" class="layui-btn layui-btn-sm layui-btn-primary search_reset_btn">重置</button>
                    <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-disabled del_query_data"  disabled>删除本次搜索结果</button>
                </div>
                <div class="layui-inline right-align">
                    <a href="JavaScript:void(0);" style="display: block;margin: 12px 15px 0 0;" class="advanced_search">高级检索 展开>>></a>
                </div>
            </div>
        </div>

    </div>
    <div class="clear-both"></div>
    <table class="layui-hide" id="demo" lay-filter="test"></table>
</form>
<script>

    // 一个等待函数
    $.wait = function (ms) {
        var defer = $.Deferred();
        setTimeout(function () {
            defer.resolve();
        }, ms);
        return defer;
    };

    // 延迟渲染date插件，由于本搜索框的date插件需要等待select渲染完成后才可以正常渲染，不然找不到要渲染的元素
    $(function () {
        $.wait(500).then(function (value) {
            layui.use(['laydate', 'jquery'], function () {

                var laydate = layui.laydate;
                laydate.render({
                    elem: '#date_start'
                });
                //常规用法
                laydate.render({
                    elem: '#date_end'
                });
            })

        });
    });


    // 高级搜索按钮动作处理
    $(function () {

        have_listed = false;
        $('.advanced_search').click(function (e) {

            if(have_listed){
                $('.advanced_part').hide(0,function(){
                    have_listed = false;
                    $('.advanced_search').html("高级检索 展开>>>")
                });
            }else{
                $('.advanced_part').show(0,function(){
                    have_listed = true;
                    $('.advanced_search').html("高级检索 收起<<<")
                });

            }
        });

    });


</script>