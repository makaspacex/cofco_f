# Dump of table hisiphp_cms_block
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_block` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '别名',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1富文本，2文本域，3单图，4多图',
  `content` text NOT NULL COMMENT '内容',
  `url` varchar(500) DEFAULT '' COMMENT '链接',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

# Dump of table hisiphp_cms_category
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `mid` int(10) unsigned DEFAULT '0' COMMENT '所属模型ID',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '筛选属性ID',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '名称',
  `alias` varchar(50) DEFAULT '' COMMENT '栏目别名',
  `subtitle` varchar(200) DEFAULT '' COMMENT '副标题',
  `url` varchar(100) DEFAULT '' COMMENT '栏目url',
  `content_limit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '内容限制(0禁止，1单条，2多条)',
  `image` varchar(200) NOT NULL DEFAULT '' COMMENT '栏目图片',
  `intro` text COMMENT '栏目简介',
  `seo_title` varchar(200) DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(200) DEFAULT '' COMMENT 'SEO关键词',
  `seo_description` varchar(500) DEFAULT '' COMMENT 'SEO描述',
  `jump_link` varchar(260) DEFAULT '' COMMENT '跳转链接',
  `poly_template` varchar(200) DEFAULT '' COMMENT '聚合模板',
  `list_template` varchar(200) DEFAULT '' COMMENT '列表模板',
  `show_template` varchar(200) DEFAULT '' COMMENT '详情模板',
  `target` varchar(10) NOT NULL DEFAULT '_blank' COMMENT '链接打开方式[_blank,_self,_top]',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `pagesize` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '分页大小',
  `childs` varchar(3000) DEFAULT '' COMMENT '子分类',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1启用，0禁用）',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='栏目';

# Dump of table hisiphp_cms_comment
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论内容ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `page` varchar(200) DEFAULT '' COMMENT '评论页面',
  `nick` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '网址',
  `content` text NOT NULL COMMENT '评论内容',
  `extend` text NOT NULL COMMENT '扩展内容json',
  `likes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '喜欢',
  `dislike` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '不喜欢',
  `ip` varchar(20) DEFAULT '' COMMENT 'IP',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0隐藏，1显示)',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) NOT NULL DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论';



# Dump of table hisiphp_cms_content
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `extend_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展内容ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(200) DEFAULT '' COMMENT '标题',
  `title_color` varchar(7) DEFAULT '' COMMENT '标题颜色',
  `tag` varchar(200) DEFAULT '' COMMENT '标签',
  `seo_title` varchar(200) DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(200) DEFAULT '' COMMENT 'SEO关键词',
  `seo_description` varchar(500) DEFAULT '' COMMENT 'SEO描述',
  `params` varchar(2000) DEFAULT '' COMMENT '扩展参数',
  `url` varchar(100) DEFAULT '' COMMENT '自定义链接',
  `image` varchar(200) DEFAULT '' COMMENT '图片',
  `flag` varchar(50) DEFAULT '' COMMENT '标注',
  `template` varchar(50) DEFAULT '' COMMENT '模板',
  `views` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览数',
  `likes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `dislike` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '不喜欢',
  `comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `favs` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（0隐藏，1已发布，2待发布）',
  `timing` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '定时发布',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='内容';


# Dump of table hisiphp_cms_diy_article
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_article` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intro` text,
  `source` varchar(255) DEFAULT '',
  `author` varchar(50) DEFAULT '',
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文章模型';



# Dump of table hisiphp_cms_diy_download
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_download` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `software_type` varchar(3) DEFAULT '1',
  `filesize` varchar(20) DEFAULT '',
  `systems` varchar(50) DEFAULT '',
  `version` varchar(30) DEFAULT '',
  `language` varchar(255) DEFAULT '1',
  `auth_type` text,
  `description` text,
  `downfile` varchar(200) DEFAULT '',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='下载模型';



# Dump of table hisiphp_cms_diy_page
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_page` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='单页模型';


# Dump of table hisiphp_cms_diy_picture
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_picture` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(50) DEFAULT '',
  `format` varchar(30) DEFAULT '',
  `size` varchar(100) DEFAULT '',
  `resolution` varchar(50) DEFAULT '',
  `albums` text,
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='图片模型';

# Dump of table hisiphp_cms_diy_product
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_product` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buy_url` varchar(1000) DEFAULT '',
  `albums` text,
  `slogan` varchar(255) DEFAULT '',
  `cost_price` varchar(10) DEFAULT '',
  `price` varchar(10) DEFAULT '',
  `mkprice` varchar(20) DEFAULT '',
  `stock` int(11) unsigned DEFAULT '0',
  `weight` varchar(20) DEFAULT '',
  `factory` varchar(100) DEFAULT '',
  `model` varchar(100) DEFAULT '',
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='产品模型';


# Dump of table hisiphp_cms_diy_video
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_diy_video` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `description` text,
  `vision` varchar(50) DEFAULT '1',
  `video` varchar(1000) DEFAULT '',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='视频模型';



# Dump of table hisiphp_cms_field
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned DEFAULT '0' COMMENT '所属模型',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '字段标题',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名',
  `options` text COMMENT '可选值',
  `type` varchar(20) NOT NULL DEFAULT 'input' COMMENT '表单/字段类型',
  `value` varchar(200) NOT NULL DEFAULT '' COMMENT '表单默认值',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '必填（0否,1是）',
  `tips` varchar(200) NOT NULL DEFAULT '' COMMENT '提示',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统（0自定义,1系统）',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `validate_rule` varchar(200) DEFAULT '' COMMENT '自定义验证规则',
  `max_length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '字符串长度限制',
  `remark` varchar(100) DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1启用，0禁用）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='模型字段';


INSERT INTO `hisiphp_cms_field` (`id`, `mid`, `group`, `title`, `name`, `options`, `type`, `value`, `is_must`, `tips`, `system`, `sort`, `validate_rule`, `max_length`, `remark`, `status`, `delete_time`)
VALUES
	(1,3,'','产品型号','model','','input','',0,'必填',1,101,'',100,'产品型号',1,0),
	(2,3,'','生产厂家','factory','','input','',0,'选填',1,102,'',100,'生产厂家',1,0),
	(3,3,'','产品重量','weight','','input','',0,'选填',1,103,'',20,'',1,0),
	(4,3,'','产品库存','stock','','number','',0,'选填',1,104,'',10,'',1,0),
	(5,3,'','市场价','mkprice','','input','',0,'单位元，选填',1,105,'',20,'市场价',1,0),
	(6,3,'','销售价','price','','input','',0,'单位元，必填',1,106,'',10,'销售价',1,0),
	(7,3,'','成本价','cost_price','','input','',0,'单位元，选填',1,107,'',10,'成本价',1,0),
	(8,4,'','图片相册','albums','','images','',0,'',1,101,'',0,'',1,0),
	(9,2,'','文章作者','author','','input','',0,'',1,101,'',50,'',1,0),
	(10,2,'','文章来源','source','','input','',0,'',1,102,'',255,'',1,0),
	(11,4,'','图片来源','source','','input','',0,'',1,100,'',50,'',1,0),
	(12,2,'','文章简介','intro','','textarea','',0,'',1,100,'',0,'',1,0),
	(13,2,'','文章内容','content','','editor','文章内容',0,'',1,103,'',0,'',1,0),
	(14,4,'','图片内容','content','','editor','图片内容',0,'',1,102,'',0,'',1,0),
	(15,3,'','产品详情','content','','editor','',0,'',1,110,'',0,'产品详情',1,0),
	(16,3,'','产品标语','slogan','','input','',0,'产品广告语或亮点描述',1,100,'',255,'产品标语',1,0),
	(17,3,'','产品相册','albums','','images','',0,'',1,109,'',0,'产品相册',1,0),
	(18,1,'','内容','content','','editor','',0,'',1,100,'',0,'',1,0),
	(19,3,'','购买链接','buy_url','','input','',0,'请填写完整的URL地址',1,108,'',1000,'购买链接',1,0),
	(20,5,'','上传视频','video','','input','',0,'',1,100,'',1000,'',1,0),
	(21,5,'','画质','vision','1:标清 270P\r\n2:高清 480P\r\n3:超清 720P\r\n4:蓝光 1080P','select','1',0,'',1,100,'',50,'',1,0),
	(22,5,'','摘要','description','','textarea','',0,'',1,100,'',0,'',1,0),
	(23,5,'','内容','content','','editor','',0,'',1,100,'',0,'',1,0),
	(24,6,'','本地下载','downfile','','file','',0,'请上传附件',1,101,'',200,'',1,0),
	(25,6,'','软件摘要','description','','textarea','',0,'',1,100,'',0,'',1,0),
	(26,6,'','授权方式','auth_type','1:免费版\r\n2:共享版\r\n3:试用版\r\n4:演示版\r\n5:注册版\r\n6:破解版\r\n7:零售版\r\n8:OEM版','checkbox','1',0,'',1,103,'',100,'',1,0),
	(27,6,'','软件语言','language','1:简体中文\r\n2:英文\r\n3:繁体中文\r\n4:简繁中文\r\n5:多国语言\r\n6:其他语言','select','1',0,'',1,104,'',0,'',1,0),
	(28,6,'','版本号','version','','input','',0,'',1,105,'',30,'',1,0),
	(29,6,'','软件平台','systems','','input','',0,'',1,106,'',50,'',1,0),
	(30,6,'','软件大小','filesize','','input','',0,'',1,107,'',20,'',1,0),
	(31,6,'','软件类型','software_type','1:国产软件\r\n2:国外软件\r\n3:汉化补丁\r\n4:程序源码\r\n5:其他','select','1',0,'',1,102,'',3,'',1,0),
	(32,6,'','内容','content','','editor','',0,'',1,108,'',0,'',1,0);


# Dump of table hisiphp_cms_form
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '表单名称',
  `table_name` varchar(30) NOT NULL DEFAULT '' COMMENT '数据库表名',
  `need_login` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '需要登录(0不需要1需要)',
  `is_menu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(50) DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1启用，0禁用）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) NOT NULL DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='表单';


# Dump of table hisiphp_cms_form_field
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_form_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned DEFAULT '0' COMMENT '所属表单',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '字段标题',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名',
  `options` text COMMENT '可选值',
  `type` varchar(20) NOT NULL DEFAULT 'input' COMMENT '表单/字段类型',
  `value` varchar(200) NOT NULL DEFAULT '' COMMENT '表单默认值',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '必填（0否,1是）',
  `tips` varchar(200) NOT NULL DEFAULT '' COMMENT '提示',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `rule` varchar(200) DEFAULT '' COMMENT '自定义验证规则',
  `max_length` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '字符串长度限制',
  `list_show` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '列表显示（0不显示，1显示）',
  `remark` varchar(100) DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1启用，0禁用）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='表单字段';


# Dump of table hisiphp_cms_link
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groups` varchar(30) DEFAULT '' COMMENT '分组',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '链接',
  `image` varchar(200) DEFAULT '' COMMENT '图片',
  `target` varchar(10) NOT NULL DEFAULT '_blank',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1显示，0隐藏）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='友情链接';


INSERT INTO `hisiphp_cms_link` (`id`, `groups`, `title`, `url`, `image`, `target`, `sort`, `status`, `delete_time`, `lang`)
VALUES
	(1,'home','hisiphp','http://www.hisiphp.com','','_blank',0,1,0,'zh-cn'),
	(2,'home','应用市场','https://store.hisiphp.com','','_blank',0,1,0,'zh-cn');


# Dump of table hisiphp_cms_model
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT '' COMMENT '名称',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '数据表名（下划线命名法）',
  `system` tinyint(1) DEFAULT '0' COMMENT '1系统模型，0自定义模型',
  `remark` varchar(50) DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1启用，0禁用）',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='模型';


INSERT INTO `hisiphp_cms_model` (`id`, `title`, `name`, `system`, `remark`, `status`, `sort`, `delete_time`)
VALUES
	(1,'单页模型','page',1,'单页模型',1,3,0),
	(2,'文章模型','article',1,'文章模型',1,1,0),
	(3,'产品模型','product',1,'产品模型',1,2,0),
	(4,'图片模型','picture',1,'图片模型',1,4,0),
	(5,'视频模型','video',1,'视频模型',1,5,0),
	(6,'下载模型','download',1,'下载模型',1,6,0);


# Dump of table hisiphp_cms_nav
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `groups` varchar(30) DEFAULT '' COMMENT '分组',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '链接',
  `image` varchar(200) DEFAULT '' COMMENT '图片',
  `target` varchar(10) DEFAULT '_self' COMMENT '打开方式',
  `childs` varchar(500) DEFAULT '' COMMENT '子ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='导航';

# Dump of table hisiphp_cms_rec
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_rec` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1推荐位，2推荐内容',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `content_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容ID',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `sub_title` varchar(200) DEFAULT '' COMMENT '副标题',
  `name` varchar(50) DEFAULT '' COMMENT '别名',
  `image` varchar(200) DEFAULT '' COMMENT '主图',
  `sub_image` varchar(200) DEFAULT '' COMMENT '副图',
  `url` varchar(200) DEFAULT '' COMMENT '链接',
  `file` varchar(200) DEFAULT '' COMMENT '文件',
  `childs` varchar(3000) NOT NULL DEFAULT '' COMMENT '子ID',
  `target` varchar(10) DEFAULT '_blank' COMMENT '打开方式',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  `remark` varchar(200) DEFAULT '' COMMENT '备注',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='推荐位';


# Dump of table hisiphp_cms_slide
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groups` varchar(30) DEFAULT '' COMMENT '分组',
  `type` varchar(3) NOT NULL DEFAULT 'pc' COMMENT '设备类型(pc，wap)',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(200) NOT NULL DEFAULT '' COMMENT '主图',
  `sub_image` varchar(200) DEFAULT '' COMMENT '副图',
  `url` varchar(300) DEFAULT '' COMMENT '链接',
  `remark` varchar(500) DEFAULT '' COMMENT '备注',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(1显示，0隐藏)',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='幻灯片';


# Dump of table hisiphp_cms_tag
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '标签名',
  `search_count` int(10) unsigned NOT NULL DEFAULT '0',
  `doc_count` int(10) unsigned NOT NULL DEFAULT '1',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mid` (`mid`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='标签库';


# Dump of table hisiphp_cms_type
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `params` text COMMENT '详细参数JSON',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态（1启用，0禁用）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='栏目类型';

# Dump of table hisiphp_cms_attribute_index
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_attribute_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned DEFAULT '0' COMMENT '内容ID',
  `item` int(10) unsigned DEFAULT '0' COMMENT '属性项ID',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '属性值ID',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `content_id` (`content_id`,`item`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='属性索引';

# Dump of table hisiphp_cms_attribute_item
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_attribute_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `form_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '表单类型(1单选，2复选，3输入框)',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '属性名',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `search` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支持筛选(0否，1是)',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='属性项';

# Dump of table hisiphp_cms_attribute_value
# ------------------------------------------------------------

CREATE TABLE `hisiphp_cms_attribute_value` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性项ID',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '属性值',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='属性值';