<?php
/**
 * 模块基本信息
 */
return [
    // 核心框架[必填]
    'framework' => 'thinkphp5.1',
    // 模块名[必填]
    'name'        => 'cms',
    // 模块标题[必填]
    'title'       => '内容',
    // 模块唯一标识[必填]，格式：模块名.[应用市场ID].module.[应用市场分支ID]
    'identifier'  => 'cms.1000025.module.2000023',
    // 主题模板[必填]，默认default
    'theme'        => 'default',
    // 模块图标[选填]
    'icon'        => '/static/cms/cms.png',
    // 模块简介[选填]
    'intro' => '支持自定义内容模型、自定义栏目筛选、自定义表单等功能，提供简单灵活的模板标签和完整的api接口。',
    // 开发者[必填]
    'author'      => 'hisiphp',
    // 开发者网址[选填]
    'author_url'  => 'http://www.hisiphp.com',
    // 版本[必填],格式采用三段式：主版本号.次版本号.修订版本号
    // 主版本号【位数变化：1-99】：当模块出现大更新或者很大的改动，比如整体架构发生变化。此版本号会变化。
    // 次版本号【位数变化：0-999】：当模块功能有新增或删除，此版本号会变化，如果仅仅是补充原有功能时，此版本号不变化。
    // 修订版本号【位数变化：0-999】：一般是 Bug 修复或是一些小的变动，功能上没有大的变化，修复一个严重的bug即发布一个修订版。
    'version'     => '1.0.6',
    // 模块依赖[可选]，格式[[模块名, 模块唯一标识, 依赖版本, 对比方式]]
    'module_depend' => [
        // ['user', 'user.1000020.module.2000019', '1.0.0', '>='],
    ],
    // 插件依赖[可选]，格式[[插件名, 插件唯一标识, 依赖版本, 对比方式]]
    'plugin_depend' => [],
    // 模块数据表[有数据库表时必填,不包含表前缀]
    'tables' => [
        'cms_attribute_index',
        'cms_attribute_item',
        'cms_attribute_value',
        'cms_block',
        'cms_category',
        'cms_comment',
        'cms_content',
        'cms_diy_article',
        'cms_diy_download',
        'cms_diy_page',
        'cms_diy_picture',
        'cms_diy_product',
        'cms_diy_video',
        'cms_field',
        'cms_form',
        'cms_form_field',
        'cms_link',
        'cms_model',
        'cms_nav',
        'cms_rec',
        'cms_slide',
        'cms_tag',
        'cms_type',
    ],
    // 原始数据库表前缀,模块带sql文件时必须配置
    'db_prefix' => 'hisiphp_',
    // 模块预埋钩子[非系统钩子，必须填写]
    'hooks' => [
        'cms_form_save' => 'CMS自定义表单保存成功后触发',
        'cms_comment_save' => 'CMS评论保存成功后触发',
    ],
    // 模块配置，格式['sort' => '100','title' => '配置标题','name' => '配置名称','type' => '配置类型','options' => '配置选项','value' => '配置默认值', 'tips' => '配置提示'],各参数设置可参考管理后台->系统->系统功能->配置管理->添加
    'config' => [
            [
            'sort' => 100, 
            'title' => 'API状态', 
            'name' => 'api_status', 
            'type' => 'switch', 
            'options' => [
                '0'=> '禁用',
                '1'=> '启用',
            ], 
            'value' => '1', 
            'tips' => '禁用后API接口将无法访问',
        ], 
        [
            'sort' => 101, 
            'title' => 'API版本号', 
            'name' => 'api_version', 
            'type' => 'input', 
            'options' => '', 
            'value' => 'v1', 
            'tips' => '设置API默认版本号，有多个版本时有效',
        ], 
        [
            'sort' => 102, 
            'title' => 'API签名验证', 
            'name' => 'api_sign_check', 
            'type' => 'switch', 
            'options' => [
                '0'=> '禁用',
                '1'=> '启用',
            ], 
            'value' => '1', 
            'tips' => '禁用后任何人都可以访问API接口',
        ], 
        [
            'sort' => 103, 
            'title' => 'API签名秘钥', 
            'name' => 'api_secret_key', 
            'type' => 'input', 
            'options' => '', 
            'value' => '', 
            'tips' => 'API接口调用签名KEY，请妥善保管',
        ], 
        [
            'sort' => 104, 
            'title' => 'API签名时效', 
            'name' => 'api_sign_timeout', 
            'type' => 'input', 
            'options' => '', 
            'value' => '60', 
            'tips' => '单位秒，超过规定值将提示签名验证失败',
        ], 
        [
            'sort' => 105, 
            'title' => '内容推荐旗帜', 
            'name' => 'content_flag', 
            'type' => 'textarea', 
            'options' => '', 
            'value' => 'new:最新
hot:热门
top:置顶', 
            'tips' => '格式：选项值:选项名，多个旗帜请使用回车键换行',
        ], 
    ],
];