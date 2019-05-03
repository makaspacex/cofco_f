document.write("<form class=\"layui-form layui-form-pane\">\n" +
    "    <div class=\"layui-form-item\">\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <label class=\"layui-form-label\">文章标题</label>\n" +
    "            <div class=\"layui-input-inline\" style=\"width: 400px\">\n" +
    "                <input type=\"text\" name=\"title\" value=\"{:input('get.title')}\" lay-verify=\"required\" placeholder=\"文章标题\"\n" +
    "                       autocomplete=\"off\" class=\"layui-input\">\n" +
    "            </div>\n" +
    "        </div>\n" +
    "\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <label class=\"layui-form-label\">爬虫关键词</label>\n" +
    "            <div class=\"layui-input-inline\">\n" +
    "                <select name=\"sstr\" id=\"sstr\"  lay-verify=\"required\" lay-search=\"\">\n" +
    "                    <option value=\"\">直接选择或搜索选择</option>\n" +
    "                    {volist name=\"keyword_list\" id=\"v\"}\n" +
    "                    <option value={$v['keywords']}>{$v['keywords']}</option>\n" +
    "                    {/volist}\n" +
    "                </select>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <label class=\"layui-form-label\">期刊分区</label>\n" +
    "            <div class=\"layui-input-inline\" style=\"width: 90px\">\n" +
    "                <select name=\"journal_zone\" id=\"journal_zone\" lay-verify=\"required\" value=\"{:input('get.journal_zone')}\">\n" +
    "                    <option value=\"\"></option>\n" +
    "                    <option value=\"1\">1</option>\n" +
    "                    <option value=\"2\">2</option>\n" +
    "                    <option value=\"3\">3</option>\n" +
    "                    <option value=\"4\">4</option>\n" +
    "                </select>\n" +
    "            </div>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "\n" +
    "    <div class=\"layui-form-item\">\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <label class=\"layui-form-label\">时间区间</label>\n" +
    "            <div class=\"layui-input-inline\">\n" +
    "                <input type=\"text\" name=\"date_start\" id=\"date_start\" value=\"{:input('get.date_start')}\"\n" +
    "                       lay-verify=\"date_start\" placeholder=\"开始时间\" class=\"layui-input\">\n" +
    "            </div>\n" +
    "            <div class=\"layui-form-mid\">-</div>\n" +
    "            <div class=\"layui-input-inline\">\n" +
    "                <input type=\"text\" name=\"date_end\" id=\"date_end\" value=\"{:input('get.date_end')}\" lay-verify=\"date\"\n" +
    "                       placeholder=\"结束时间\" autocomplete=\"off\" class=\"layui-input\">\n" +
    "            </div>\n" +
    "        </div>\n" +
    "\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <label class=\"layui-form-label\">影响因子区间</label>\n" +
    "            <div class=\"layui-input-inline\">\n" +
    "                <input type=\"text\" name=\"impact_factor_start\" id=\"impact_factor_start\"\n" +
    "                       value=\"{:input('get.impact_factor_start')}\" lay-verify=\"date\" placeholder=\"0\" autocomplete=\"off\"\n" +
    "                       class=\"layui-input\">\n" +
    "            </div>\n" +
    "            <div class=\"layui-form-mid\">-</div>\n" +
    "            <div class=\"layui-input-inline\">\n" +
    "                <input type=\"text\" name=\"impact_factor_end\" id=\"impact_factor_end\"\n" +
    "                       value=\"{:input('get.impact_factor_end')}\" lay-verify=\"date\" placeholder=\"10\" autocomplete=\"off\"\n" +
    "                       class=\"layui-input\">\n" +
    "            </div>\n" +
    "        </div>\n" +
    "\n" +
    "        <div class=\"layui-inline\">\n" +
    "            <button type=\"submit\" class=\"layui-btn\">搜索</button>\n" +
    "            <button type=\"reset\" class=\"layui-btn layui-btn-primary\">重置</button>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <table class=\"layui-hide\" id=\"demo\" lay-filter=\"test\"></table>\n" +
    "    <div id=\"myDiv\"></div>\n" +
    "</form>");