# Dump of table hisiphp_cms_attribute_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_attribute_index`;

CREATE TABLE `hisiphp_cms_attribute_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned DEFAULT '0' COMMENT '内容ID',
  `item` int(10) unsigned DEFAULT '0' COMMENT '属性项ID',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '属性值ID',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `content_id` (`content_id`,`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性索引';



# Dump of table hisiphp_cms_attribute_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_attribute_item`;

CREATE TABLE `hisiphp_cms_attribute_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `form_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '表单类型(1单选，2复选，3输入框)',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '属性名',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `search` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支持筛选(0否，1是)',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性项';



# Dump of table hisiphp_cms_attribute_value
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_attribute_value`;

CREATE TABLE `hisiphp_cms_attribute_value` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性项ID',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '属性值',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性值';



# Dump of table hisiphp_cms_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_block`;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `hisiphp_cms_block` (`id`, `title`, `name`, `type`, `content`, `url`, `delete_time`, `lang`)
VALUES
	(1,'页脚-二维码','footer_qrcode',3,'/theme/cms/net/static/image/erweima.jpg','',0,'zh-cn'),
	(2,'页脚-联系电话','footer_phone',2,'400-8888888  (9:00-18:00)','',0,'zh-cn'),
	(3,'页脚-联系邮箱','footer_email',2,'chenf4hua12@qq.com','',0,'zh-cn');


# Dump of table hisiphp_cms_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_category`;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='栏目';

LOCK TABLES `hisiphp_cms_category` WRITE;
/*!40000 ALTER TABLE `hisiphp_cms_category` DISABLE KEYS */;

INSERT INTO `hisiphp_cms_category` (`id`, `pid`, `mid`, `type_id`, `name`, `alias`, `subtitle`, `url`, `content_limit`, `image`, `intro`, `seo_title`, `seo_keywords`, `seo_description`, `jump_link`, `poly_template`, `list_template`, `show_template`, `target`, `sort`, `pagesize`, `childs`, `status`, `create_time`, `update_time`, `delete_time`, `lang`)
VALUES
	(1,0,3,0,'产品展示','','Product Display','product',2,'','','','','','','','product.html','product.html','_blank',100,20,'1',1,0,0,0,'zh-cn'),
	(2,0,2,0,'实时新闻','','Real-time News','news',2,'','','','','','','','news.html','news.html','_blank',100,20,'2',1,0,0,0,'zh-cn'),
	(3,0,4,0,'成功案例','','Successful Case','case',2,'','','','','','','','case.html','','_blank',100,3,'3',1,0,0,0,'zh-cn'),
	(4,0,1,0,'关于我们','','About Us','about',0,'','','','','','','about.html','','','_blank',100,20,'4,5,6,7',1,0,0,0,'zh-cn'),
	(5,4,1,0,'公司简介','','','gongsijianjie',1,'','','','','','','','','','_blank',100,20,'5',1,0,0,0,'zh-cn'),
	(6,4,2,0,'招贤纳士','','','zhaoxiannashi',2,'','','','','','','','','','_blank',100,20,'6',1,0,0,0,'zh-cn'),
	(7,4,2,0,'发展历程','','','fazhanlicheng',2,'','','','','','','','','','_blank',100,20,'7',1,0,0,0,'zh-cn');

# Dump of table hisiphp_cms_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_comment`;

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

DROP TABLE IF EXISTS `hisiphp_cms_content`;

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='内容';

INSERT INTO `hisiphp_cms_content` (`id`, `cid`, `mid`, `extend_id`, `user_id`, `title`, `title_color`, `tag`, `seo_title`, `seo_keywords`, `seo_description`, `params`, `url`, `image`, `flag`, `template`, `views`, `likes`, `dislike`, `comments`, `favs`, `sort`, `status`, `timing`, `create_time`, `update_time`, `delete_time`, `lang`)
VALUES
	(1,2,2,1,0,'一直在你身边对你好，你却没有发现。','','','','','','','1','/theme/cms/net/static/image/news_img1.jpg',',,','',1,0,0,0,0,100,1,1555736944,1555736999,1555736999,0,'zh-cn'),
	(2,2,2,2,0,'写经验交流材料的技巧全在这了！','','','','','','','2','/theme/cms/net/static/image/news_img1.jpg',',,','',0,0,0,0,0,100,1,1555737031,1555737040,1555737040,0,'zh-cn'),
	(3,2,2,3,0,'经验分享：我是如何做好每日计划的','','','','','','','3','/theme/cms/net/static/image/news_img1.jpg',',,','',0,0,0,0,0,100,1,1555737044,1555737059,1555737059,0,'zh-cn'),
	(4,2,2,4,0,'女人过了三十岁，一定要明白的12个道理！','','','','','','','4','/theme/cms/net/static/image/news_img1.jpg',',,','',0,0,0,0,0,100,1,1555737063,1555737075,1555737075,0,'zh-cn'),
	(5,2,2,5,0,'脾气不好的妈妈好好读读这篇文章，真的是细思极恐','','','','','','','5','/theme/cms/net/static/image/news_img1.jpg',',,','',1,0,0,0,0,100,1,1555737079,1555737091,1555737091,0,'zh-cn'),
	(6,2,2,6,0,'睡前千万不要给孩子吃这6种食物，不仅会影响睡眠。','','','','','','','6','/theme/cms/net/static/image/news_img1.jpg',',,','',0,0,0,0,0,100,1,1555737095,1555737105,1555737105,0,'zh-cn'),
	(7,2,2,7,0,'养女儿，一定要让她漂亮！','','','','','','','7','/theme/cms/net/static/image/news_img1.jpg',',,','',1,0,0,0,0,100,1,1555737109,1555737121,1555737121,0,'zh-cn'),
	(8,2,2,8,0,'见好友在同一趟高铁 粗心男子“串门”聊天','','','','','','','8','/theme/cms/net/static/image/news_img1.jpg',',,','',0,0,0,0,0,100,1,1555737125,1555737136,1555737136,0,'zh-cn'),
	(9,2,2,9,0,'一直在你身边对你好，你却没有发现。','','','','','','','9','/theme/cms/net/static/image/news_img1.jpg',',,','',2,0,0,0,0,100,1,1555737140,1555737151,1555737151,0,'zh-cn'),
	(10,2,2,10,0,'写经验交流材料的技巧全在这了！','','','','','','','10','/theme/cms/net/static/image/news_img1.jpg',',,','',16,0,0,0,0,100,1,1555737155,1555737164,1555737164,0,'zh-cn'),
	(11,3,4,54,0,'名牌工厂店1','','','','','','','11','/theme/cms/net/static/image/case1.jpg',',,','',0,0,0,0,0,100,1,1555737187,1555737212,1555737212,0,'zh-cn'),
	(12,3,4,55,0,'名牌工厂店2','','','','','','','12','/theme/cms/net/static/image/case2.jpg',',,','',0,0,0,0,0,100,1,1555737214,1555737229,1555737229,0,'zh-cn'),
	(13,3,4,56,0,'名牌工厂店3','','','','','','','13','/theme/cms/net/static/image/case3.jpg',',,','',0,0,0,0,0,100,1,1555737232,1555737245,1555737245,0,'zh-cn'),
	(14,3,4,57,0,'名牌工厂店4','','','','','','','14','/theme/cms/net/static/image/case4.jpg',',,','',0,0,0,0,0,100,1,1555737249,1555737268,1555737268,0,'zh-cn'),
	(15,3,4,58,0,'名牌工厂店5','','','','','','','15','/theme/cms/net/static/image/case5.jpg',',,','',0,0,0,0,0,100,1,1555737272,1555737281,1555737281,0,'zh-cn'),
	(16,3,4,59,0,'名牌工厂店6','','','','','','','16','/theme/cms/net/static/image/case6.jpg',',,','',0,0,0,0,0,100,1,1555737285,1555737295,1555737295,0,'zh-cn'),
	(17,3,4,60,0,'名牌工厂店7','','','','','','','17','/theme/cms/net/static/image/case7.jpg',',,','',0,0,0,0,0,100,1,1555737299,1555737307,1555737307,0,'zh-cn'),
	(18,3,4,61,0,'名牌工厂店8','','','','','','','18','/theme/cms/net/static/image/case8.jpg',',,','',0,0,0,0,0,100,1,1555737311,1555737319,1555737319,0,'zh-cn'),
	(19,3,4,62,0,'名牌工厂店9','','','','','','','19','/theme/cms/net/static/image/case9.jpg',',,','',0,0,0,0,0,100,1,1555737323,1555737336,1555737336,0,'zh-cn'),
	(20,1,3,13,0,'JS基础库','','','','','','','20','/theme/cms/net/static/image/Product_img1.jpg',',,','',2,0,0,0,0,100,1,1555739493,1555739533,1555739533,0,'zh-cn'),
	(21,1,3,14,0,'CSS处理','','','','','','','21','/theme/cms/net/static/image/Product_img2.jpg',',,','',2,0,0,0,0,100,1,1555739541,1555739562,1555739562,0,'zh-cn'),
	(22,1,3,15,0,'兼容性','','','','','','','22','/theme/cms/net/static/image/Product_img3.jpg',',,','',12,0,0,0,0,100,1,1555739564,1555739574,1555739574,0,'zh-cn'),
	(23,5,1,3,0,'公司简介','','','','','','','23','','','',0,0,0,0,0,100,1,0,1555817991,1555820947,0,'zh-cn'),
	(24,6,2,11,0,'IOS开发工程师','','','','','','','24','',',,','',0,0,0,0,0,100,1,1555819571,1555819597,1555819597,0,'zh-cn'),
	(25,7,2,12,0,'2017 年 6 月','','','','','','','25','/theme/cms/net/static/image/us_img7.png',',,','',0,0,0,0,0,100,1,0,1555820388,1555820647,0,'zh-cn'),
	(26,7,2,13,0,'2019 年 8 月','','','','','','','26','/theme/cms/net/static/image/us_img6.png','','',0,0,0,0,0,100,1,1555821025,1555821049,1555821322,0,'zh-cn'),
	(27,1,3,16,0,'响应式','','','','','','','27','/theme/cms/net/static/image/Product_img4.jpg','','',1,0,0,0,0,100,1,1555858738,1555858741,1555858848,0,'zh-cn');


# Dump of table hisiphp_cms_diy_article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_diy_article`;

CREATE TABLE `hisiphp_cms_diy_article` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intro` text,
  `source` varchar(255) DEFAULT '',
  `author` varchar(50) DEFAULT '',
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章模型';

INSERT INTO `hisiphp_cms_diy_article` (`eid`, `intro`, `source`, `author`, `content`, `delete_time`)
VALUES
	(1,'找老婆要找爱发脾气的女人。永远不会发脾气的女人就如同一杯白开水，解渴，却无味。而发脾气的女人正如烈酒般，刺激而令人无法忘怀。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(2,'看不到您的原稿，这样对空发议论，估计对您的指导性是不大的。建议您将原稿贴出来，好让老师们针对指导。这里简单给出意见：','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(3,'在日常的工作中，不知道大家有没有遇到以下这些问题：面对这样的问题，我养成了一个习惯就是每天写工作计划。想在此与大家分享，希望对你们有所帮助，同时欢迎指正及共同探讨。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(4,'有些人再好，如果他不属于你，就什么用也没有。别再为一个得不到的人辗转难眠，你熬夜到天亮，对他来说也无关痛痒。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(5,'一个母亲要是控制不了自己的情绪，会发生多可怕的事情？去年一个9岁的男孩，因为弄丢了手机，遭受了亲妈捆绑殴打一整晚，第二天再也没能睁开眼睛。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(6,'孩子正处于长身体的重要阶段，对于营养的需求自然不小。很多家长怕孩子半夜饿，喜欢在睡前补充一些食物。但是，以下6种食物，孩子如果在睡前吃，不仅会危害身体健康，还会导致孩子睡不好觉，影响长个。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(7,'闹市街头，一位爸爸领着一对双胞胎女儿吸引住了我的目光。两个女儿五六岁，长得像天使一般动人。让人遗憾的是，家长给他们穿的衣服---大妈们买菜或做饭时穿的长袍式的家居服，看上去十分滑稽可笑。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(8,'出门在外若发现好友在同一趟高铁邂逅，你会如何做？近日，一男子上高铁后，打电话给一位久未联系好友，竟然得知出行乘坐同一趟车。于是，该男子兴奋地“串门”。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(9,'找老婆要找爱发脾气的女人。永远不会发脾气的女人就如同一杯白开水，解渴，却无味。而发脾气的女人正如烈酒般，刺激而令人无法忘怀。','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(10,'看不到您的原稿，这样对空发议论，估计对您的指导性是不大的。建议您将原稿贴出来，好让老师们针对指导。这里简单给出意见：','','','&lt;p&gt;文章内容&lt;/p&gt;',0),
	(11,'','','','&lt;ol class=&quot; list-paddingleft-2&quot;&gt;&lt;li&gt;&lt;p&gt;前端开发及维护工作；&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;有良好的技术基础，熟悉 Web 标准，熟练掌握多种 Web 前端技术；&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;掌握行业内流行的类库，Vue.js， React 等主流框架；&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;参与公司前端工程的设计、研发；&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;了解不同浏览器之间的差异，移动设备之间的差异。&lt;/p&gt;&lt;/li&gt;&lt;/ol&gt;',0),
	(12,'','','','&lt;p&gt;我们成立了，来到了杭州西湖这个美丽的地方。&lt;/p&gt;',0),
	(13,'','','','&lt;p&gt;我们成立了，来到了杭州西湖这个美丽的地方。&lt;/p&gt;',0);

# Dump of table hisiphp_cms_diy_download
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_diy_download`;

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

DROP TABLE IF EXISTS `hisiphp_cms_diy_page`;

CREATE TABLE `hisiphp_cms_diy_page` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='单页模型';


INSERT INTO `hisiphp_cms_diy_page` (`eid`, `content`, `delete_time`)
VALUES
	(3,'&lt;div class=&quot;content&quot;&gt;&lt;div class=&quot;img layui-inline&quot;&gt;&lt;img src=&quot;/theme/cms/net/static/image/us_img1.jpg&quot;/&gt;&lt;/div&gt;&lt;div class=&quot;layui-inline panel&quot;&gt;&lt;p&gt;身处在前端社区的繁荣之下，我们都在有意或无意地追逐。而 layui 偏偏回望当初，奔赴在返璞归真的漫漫征途，自信并勇敢着，追寻于原生态的书写指令，试图以最简单的方式诠释高效。&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;content&quot;&gt;&lt;div class=&quot;layui-inline p_block panel&quot;&gt;&lt;p&gt;如果眼下还是一团零星之火，那运筹帷幄之后，迎面东风，就是一场烈焰燎原吧，那必定会是一番尽情的燃烧。待，秋风萧瑟时，散作满天星辰，你看那四季轮回，正是Layui不灭的执念。&lt;/p&gt;&lt;/div&gt;&lt;div class=&quot;img layui-inline&quot;&gt;&lt;img src=&quot;/theme/cms/net/static/image/us_img2.jpg&quot;/&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;content&quot;&gt;&lt;div class=&quot;img layui-inline&quot;&gt;&lt;img src=&quot;/theme/cms/net/static/image/us_img3.jpg&quot;/&gt;&lt;/div&gt;&lt;div class=&quot;layui-inline panel&quot;&gt;&lt;p&gt;拥有双面的不仅是人生，还有Layui。一面极简，一面丰盈。极简是视觉所见的外在，是开发所念的简易。丰盈是倾情雕琢的内在，是信手拈来的承诺。一切本应如此，简而全，双重体验。&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;',0);


# Dump of table hisiphp_cms_diy_picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_diy_picture`;

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='图片模型';


INSERT INTO `hisiphp_cms_diy_picture` (`eid`, `source`, `format`, `size`, `resolution`, `albums`, `content`, `delete_time`)
VALUES
	(54,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(55,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(56,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(57,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(58,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(59,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(60,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(61,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0),
	(62,'','','','','[]','&lt;p&gt;&lt;span style=&quot;color: rgb(80, 80, 80); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 18px; text-align: center; background-color: rgb(255, 255, 255);&quot;&gt;一家工厂企业的商品展示网站，主要以卖高端服饰为主。主要以卖高端服饰为主。主要以卖高端服饰为主。&lt;/span&gt;&lt;/p&gt;',0);


# Dump of table hisiphp_cms_diy_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_diy_product`;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='产品模型';


INSERT INTO `hisiphp_cms_diy_product` (`eid`, `buy_url`, `albums`, `slogan`, `cost_price`, `price`, `mkprice`, `stock`, `weight`, `factory`, `model`, `content`, `delete_time`)
VALUES
	(13,'','[]','从小屏逐步扩展到大屏，最终实现所有屏幕适配，最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。','','','',0,'','','','',0),
	(14,'','[]','从小屏逐步扩展到大屏，最终实现所有屏幕适配，最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。','','','',0,'','','','',0),
	(15,'','[]','从小屏逐步扩展到大屏，最终实现所有屏幕适配，最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。','','','',0,'','','','',0),
	(16,'','[]','从小屏逐步扩展到大屏，最终实现所有屏幕适配，最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。','','','',0,'','','','&lt;p&gt;从小屏逐步扩展到大屏，最终实现所有屏幕适配，最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。最终实现所有屏幕适配，适应移动互联潮流。&lt;/p&gt;',0);


# Dump of table hisiphp_cms_diy_video
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_diy_video`;

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

DROP TABLE IF EXISTS `hisiphp_cms_field`;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='模型字段';


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

DROP TABLE IF EXISTS `hisiphp_cms_form`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表单';



# Dump of table hisiphp_cms_form_field
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_form_field`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表单字段';



# Dump of table hisiphp_cms_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_link`;

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

DROP TABLE IF EXISTS `hisiphp_cms_model`;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='模型';


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

DROP TABLE IF EXISTS `hisiphp_cms_nav`;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='导航';

INSERT INTO `hisiphp_cms_nav` (`id`, `pid`, `groups`, `title`, `url`, `image`, `target`, `childs`, `sort`, `delete_time`, `lang`)
VALUES
	(1,0,'','产品','/product','','_self','1',101,0,'zh-cn'),
	(2,0,'','动态','/news','','_self','2',102,0,'zh-cn'),
	(3,0,'','案例','/case','','_self','3',103,0,'zh-cn'),
	(4,0,'','关于','/about','','_self','4',104,0,'zh-cn'),
	(5,0,'','首页','/','','_self','5',100,0,'zh-cn');


# Dump of table hisiphp_cms_rec
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_rec`;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='推荐位';


INSERT INTO `hisiphp_cms_rec` (`id`, `type`, `pid`, `mid`, `content_id`, `title`, `sub_title`, `name`, `image`, `sub_image`, `url`, `file`, `childs`, `target`, `sort`, `remark`, `delete_time`, `lang`)
VALUES
	(1,1,0,0,0,'专业服务','为客户打造完美的专业服务','service','','','','','1,2,3,4,5','_blank',100,'',0,'zh-cn'),
	(2,2,1,0,0,'1 对 1前端指导','','','/theme/cms/net/static/image/home_img1.jpg','','','','2','_blank',100,'更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。',0,'zh-cn'),
	(3,2,1,0,0,'1 对 1前端指导','','','/theme/cms/net/static/image/home_img2.jpg','','','','3','_blank',100,'更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。',0,'zh-cn'),
	(4,2,1,0,0,'1 对 1前端指导','','','/theme/cms/net/static/image/home_img3.jpg','','','','4','_blank',100,'更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。',0,'zh-cn'),
	(5,2,1,0,0,'1 对 1前端指导','','','/theme/cms/net/static/image/home_img4.jpg','','','','5','_blank',100,'更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。',0,'zh-cn'),
	(6,1,0,0,0,'核心产品','','product','','','','','6,7,8,9,10','_blank',100,'',0,'zh-cn'),
	(7,2,6,0,0,'JS基础库','','','/theme/cms/net/static/image/Big_icon1.png','','/product/20','','7','_blank',100,'从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。',0,'zh-cn'),
	(8,2,6,0,0,'CSS处理','','','/theme/cms/net/static/image/Big_icon2.png','','/product/21','','8','_blank',100,'从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。',0,'zh-cn'),
	(9,2,6,0,0,'兼容性','','','/theme/cms/net/static/image/Big_icon3.png','','/product/22','','9','_blank',100,'从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。',0,'zh-cn'),
	(10,2,6,0,0,'响应式','','','/theme/cms/net/static/image/Big_icon4.png','','/product/27','','10','_blank',100,'从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。',0,'zh-cn');


# Dump of table hisiphp_cms_slide
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_slide`;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='幻灯片';


INSERT INTO `hisiphp_cms_slide` (`id`, `groups`, `type`, `title`, `image`, `sub_image`, `url`, `remark`, `sort`, `status`, `delete_time`, `lang`)
VALUES
	(1,'','pc','HisiPHP','/theme/cms/net/static/image/banner1.jpg','','/','开源后台管理框架',100,1,0,'zh-cn'),
	(2,'','pc','HisiCMS','/theme/cms/net/static/image/banner2.jpg','','/','通用内容管理系统',100,1,0,'zh-cn');


# Dump of table hisiphp_cms_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_tag`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签库';



# Dump of table hisiphp_cms_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hisiphp_cms_type`;

CREATE TABLE `hisiphp_cms_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `params` text COMMENT '详细参数JSON',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态（1启用，0禁用）',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn' COMMENT '多语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目类型';