/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : cofco_f

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2019-01-07 12:18:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_group_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_permissions`;
CREATE TABLE `auth_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_group_permissions_group_id_permission_id_0cd325b0_uniq` (`group_id`,`permission_id`),
  KEY `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` (`permission_id`),
  CONSTRAINT `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  CONSTRAINT `auth_group_permissions_group_id_b120cbf9_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_group_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_permission`
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission`;
CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_permission_content_type_id_codename_01ab375a_uniq` (`content_type_id`,`codename`),
  CONSTRAINT `auth_permission_content_type_id_2f476e4b_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_permission
-- ----------------------------
INSERT INTO `auth_permission` VALUES ('1', 'Can add group', '1', 'add_group');
INSERT INTO `auth_permission` VALUES ('2', 'Can change group', '1', 'change_group');
INSERT INTO `auth_permission` VALUES ('3', 'Can delete group', '1', 'delete_group');
INSERT INTO `auth_permission` VALUES ('4', 'Can add permission', '2', 'add_permission');
INSERT INTO `auth_permission` VALUES ('5', 'Can change permission', '2', 'change_permission');
INSERT INTO `auth_permission` VALUES ('6', 'Can delete permission', '2', 'delete_permission');
INSERT INTO `auth_permission` VALUES ('7', 'Can add user', '3', 'add_user');
INSERT INTO `auth_permission` VALUES ('8', 'Can change user', '3', 'change_user');
INSERT INTO `auth_permission` VALUES ('9', 'Can delete user', '3', 'delete_user');
INSERT INTO `auth_permission` VALUES ('10', 'Can add content type', '4', 'add_contenttype');
INSERT INTO `auth_permission` VALUES ('11', 'Can change content type', '4', 'change_contenttype');
INSERT INTO `auth_permission` VALUES ('12', 'Can delete content type', '4', 'delete_contenttype');
INSERT INTO `auth_permission` VALUES ('13', 'Can add science content', '5', 'add_sciencecontent');
INSERT INTO `auth_permission` VALUES ('14', 'Can change science content', '5', 'change_sciencecontent');
INSERT INTO `auth_permission` VALUES ('15', 'Can delete science content', '5', 'delete_sciencecontent');
INSERT INTO `auth_permission` VALUES ('16', 'Can add statistic_result', '6', 'add_statistic_result');
INSERT INTO `auth_permission` VALUES ('17', 'Can change statistic_result', '6', 'change_statistic_result');
INSERT INTO `auth_permission` VALUES ('18', 'Can delete statistic_result', '6', 'delete_statistic_result');
INSERT INTO `auth_permission` VALUES ('19', 'Can add sstr', '7', 'add_sstr');
INSERT INTO `auth_permission` VALUES ('20', 'Can change sstr', '7', 'change_sstr');
INSERT INTO `auth_permission` VALUES ('21', 'Can delete sstr', '7', 'delete_sstr');
INSERT INTO `auth_permission` VALUES ('22', 'Can add task', '8', 'add_task');
INSERT INTO `auth_permission` VALUES ('23', 'Can change task', '8', 'change_task');
INSERT INTO `auth_permission` VALUES ('24', 'Can delete task', '8', 'delete_task');
INSERT INTO `auth_permission` VALUES ('25', 'Can add project', '9', 'add_project');
INSERT INTO `auth_permission` VALUES ('26', 'Can change project', '9', 'change_project');
INSERT INTO `auth_permission` VALUES ('27', 'Can delete project', '9', 'delete_project');
INSERT INTO `auth_permission` VALUES ('28', 'Can add journal', '10', 'add_journal');
INSERT INTO `auth_permission` VALUES ('29', 'Can change journal', '10', 'change_journal');
INSERT INTO `auth_permission` VALUES ('30', 'Can delete journal', '10', 'delete_journal');
INSERT INTO `auth_permission` VALUES ('31', 'Can add content', '11', 'add_content');
INSERT INTO `auth_permission` VALUES ('32', 'Can change content', '11', 'change_content');
INSERT INTO `auth_permission` VALUES ('33', 'Can delete content', '11', 'delete_content');
INSERT INTO `auth_permission` VALUES ('34', 'Can add sp', '12', 'add_sp');
INSERT INTO `auth_permission` VALUES ('35', 'Can change sp', '12', 'change_sp');
INSERT INTO `auth_permission` VALUES ('36', 'Can delete sp', '12', 'delete_sp');
INSERT INTO `auth_permission` VALUES ('37', 'Can add word_dict', '13', 'add_word_dict');
INSERT INTO `auth_permission` VALUES ('38', 'Can change word_dict', '13', 'change_word_dict');
INSERT INTO `auth_permission` VALUES ('39', 'Can delete word_dict', '13', 'delete_word_dict');
INSERT INTO `auth_permission` VALUES ('40', 'Can add log', '14', 'add_log');
INSERT INTO `auth_permission` VALUES ('41', 'Can change log', '14', 'change_log');
INSERT INTO `auth_permission` VALUES ('42', 'Can delete log', '14', 'delete_log');
INSERT INTO `auth_permission` VALUES ('43', 'Can add test scrapy', '15', 'add_testscrapy');
INSERT INTO `auth_permission` VALUES ('44', 'Can change test scrapy', '15', 'change_testscrapy');
INSERT INTO `auth_permission` VALUES ('45', 'Can delete test scrapy', '15', 'delete_testscrapy');
INSERT INTO `auth_permission` VALUES ('46', 'Can add task progress', '16', 'add_taskprogress');
INSERT INTO `auth_permission` VALUES ('47', 'Can change task progress', '16', 'change_taskprogress');
INSERT INTO `auth_permission` VALUES ('48', 'Can delete task progress', '16', 'delete_taskprogress');

-- ----------------------------
-- Table structure for `auth_user`
-- ----------------------------
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_bin NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_user
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_groups`;
CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_user_groups_user_id_group_id_94350c0c_uniq` (`user_id`,`group_id`),
  KEY `auth_user_groups_group_id_97559544_fk_auth_group_id` (`group_id`),
  CONSTRAINT `auth_user_groups_group_id_97559544_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  CONSTRAINT `auth_user_groups_user_id_6a12ed8b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_user_groups
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_user_user_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_user_permissions`;
CREATE TABLE `auth_user_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_user_user_permissions_user_id_permission_id_14a6b632_uniq` (`user_id`,`permission_id`),
  KEY `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` (`permission_id`),
  CONSTRAINT `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  CONSTRAINT `auth_user_user_permissions_user_id_a95ead1b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of auth_user_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `django_content_type`
-- ----------------------------
DROP TABLE IF EXISTS `django_content_type`;
CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_label` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `django_content_type_app_label_model_76bd3d3b_uniq` (`app_label`,`model`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of django_content_type
-- ----------------------------
INSERT INTO `django_content_type` VALUES ('11', 'SpiderApp', 'content');
INSERT INTO `django_content_type` VALUES ('10', 'SpiderApp', 'journal');
INSERT INTO `django_content_type` VALUES ('14', 'SpiderApp', 'log');
INSERT INTO `django_content_type` VALUES ('9', 'SpiderApp', 'project');
INSERT INTO `django_content_type` VALUES ('5', 'SpiderApp', 'sciencecontent');
INSERT INTO `django_content_type` VALUES ('12', 'SpiderApp', 'sp');
INSERT INTO `django_content_type` VALUES ('7', 'SpiderApp', 'sstr');
INSERT INTO `django_content_type` VALUES ('6', 'SpiderApp', 'statistic_result');
INSERT INTO `django_content_type` VALUES ('8', 'SpiderApp', 'task');
INSERT INTO `django_content_type` VALUES ('16', 'SpiderApp', 'taskprogress');
INSERT INTO `django_content_type` VALUES ('15', 'SpiderApp', 'testscrapy');
INSERT INTO `django_content_type` VALUES ('13', 'SpiderApp', 'word_dict');
INSERT INTO `django_content_type` VALUES ('1', 'auth', 'group');
INSERT INTO `django_content_type` VALUES ('2', 'auth', 'permission');
INSERT INTO `django_content_type` VALUES ('3', 'auth', 'user');
INSERT INTO `django_content_type` VALUES ('4', 'contenttypes', 'contenttype');

-- ----------------------------
-- Table structure for `django_migrations`
-- ----------------------------
DROP TABLE IF EXISTS `django_migrations`;
CREATE TABLE `django_migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `applied` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of django_migrations
-- ----------------------------
INSERT INTO `django_migrations` VALUES ('1', 'SpiderApp', '0001_initial', '2018-01-24 07:44:38.214562');
INSERT INTO `django_migrations` VALUES ('2', 'contenttypes', '0001_initial', '2018-01-24 07:44:38.291336');
INSERT INTO `django_migrations` VALUES ('3', 'contenttypes', '0002_remove_content_type_name', '2018-01-24 07:44:38.368644');
INSERT INTO `django_migrations` VALUES ('4', 'auth', '0001_initial', '2018-01-24 07:44:38.720349');
INSERT INTO `django_migrations` VALUES ('5', 'auth', '0002_alter_permission_name_max_length', '2018-01-24 07:44:38.760696');
INSERT INTO `django_migrations` VALUES ('6', 'auth', '0003_alter_user_email_max_length', '2018-01-24 07:44:38.796518');
INSERT INTO `django_migrations` VALUES ('7', 'auth', '0004_alter_user_username_opts', '2018-01-24 07:44:38.811187');
INSERT INTO `django_migrations` VALUES ('8', 'auth', '0005_alter_user_last_login_null', '2018-01-24 07:44:38.850434');
INSERT INTO `django_migrations` VALUES ('9', 'auth', '0006_require_contenttypes_0002', '2018-01-24 07:44:38.854031');
INSERT INTO `django_migrations` VALUES ('10', 'auth', '0007_alter_validators_add_error_messages', '2018-01-24 07:44:38.879109');
INSERT INTO `django_migrations` VALUES ('11', 'auth', '0008_alter_user_username_max_length', '2018-01-24 07:44:38.915939');
INSERT INTO `django_migrations` VALUES ('12', 'SpiderApp', '0002_testscrapy', '2018-05-15 08:33:30.340413');
INSERT INTO `django_migrations` VALUES ('13', 'SpiderApp', '0003_auto_20180518_0709', '2018-05-18 07:09:42.972422');
INSERT INTO `django_migrations` VALUES ('14', 'SpiderApp', '0004_auto_20180518_1022', '2018-05-18 10:22:08.549601');
INSERT INTO `django_migrations` VALUES ('15', 'SpiderApp', '0005_auto_20180518_1538', '2018-05-18 15:39:29.143458');
INSERT INTO `django_migrations` VALUES ('16', 'SpiderApp', '0002_auto_20180527_0506', '2018-05-27 05:08:02.818576');
INSERT INTO `django_migrations` VALUES ('17', 'SpiderApp', '0003_auto_20180529_0833', '2018-05-29 08:38:00.128691');
INSERT INTO `django_migrations` VALUES ('18', 'SpiderApp', '0004_auto_20180529_0901', '2018-05-29 09:03:14.154697');
INSERT INTO `django_migrations` VALUES ('19', 'SpiderApp', '0005_auto_20180529_0902', '2018-05-29 09:03:14.189589');
INSERT INTO `django_migrations` VALUES ('20', 'SpiderApp', '0006_auto_20180529_0920', '2018-05-29 09:20:38.659898');
INSERT INTO `django_migrations` VALUES ('21', 'SpiderApp', '0007_auto_20180529_0931', '2018-05-29 09:31:40.552700');
INSERT INTO `django_migrations` VALUES ('22', 'SpiderApp', '0008_auto_20180529_0935', '2018-05-29 09:35:39.217521');
INSERT INTO `django_migrations` VALUES ('23', 'SpiderApp', '0009_auto_20180529_0941', '2018-05-29 09:41:05.360387');
INSERT INTO `django_migrations` VALUES ('24', 'SpiderApp', '0002_delete_journal', '2018-05-29 11:51:16.091594');
INSERT INTO `django_migrations` VALUES ('25', 'SpiderApp', '0003_journal', '2018-05-29 11:52:34.886420');

-- ----------------------------
-- Table structure for `hisi_admin_annex`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_annex`;
CREATE TABLE `hisi_admin_annex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的数据ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `group` varchar(100) NOT NULL DEFAULT 'sys' COMMENT '文件分组',
  `file` varchar(255) NOT NULL COMMENT '上传文件',
  `hash` varchar(64) NOT NULL COMMENT '文件hash值',
  `size` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '附件大小KB',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '使用状态(0未使用，1已使用)',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 上传附件';

-- ----------------------------
-- Records of hisi_admin_annex
-- ----------------------------

-- ----------------------------
-- Table structure for `hisi_admin_annex_group`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_annex_group`;
CREATE TABLE `hisi_admin_annex_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '附件分组',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `size` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '附件大小kb',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 附件分组';

-- ----------------------------
-- Records of hisi_admin_annex_group
-- ----------------------------
INSERT INTO `hisi_admin_annex_group` VALUES ('1', 'sys', '0', '0.00');

-- ----------------------------
-- Table structure for `hisi_admin_config`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_config`;
CREATE TABLE `hisi_admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统配置(1是，0否)',
  `group` varchar(20) NOT NULL DEFAULT 'base' COMMENT '分组',
  `title` varchar(20) NOT NULL COMMENT '配置标题',
  `name` varchar(50) NOT NULL COMMENT '配置名称，由英文字母和下划线组成',
  `value` text NOT NULL COMMENT '配置值',
  `type` varchar(20) NOT NULL DEFAULT 'input' COMMENT '配置类型()',
  `options` text NOT NULL COMMENT '配置项(选项名:选项值)',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件上传接口',
  `tips` varchar(255) NOT NULL COMMENT '配置提示',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='[系统] 系统配置';

-- ----------------------------
-- Records of hisi_admin_config
-- ----------------------------
INSERT INTO `hisi_admin_config` VALUES ('1', '1', 'sys', '扩展配置分组', 'config_group', 'spider:爬虫设置\r\nlabeldata:标注设置\r\ndataanalyse:分析设置', 'array', ' ', '', '请按如下格式填写：&lt;br&gt;键值:键名&lt;br&gt;键值:键名&lt;br&gt;&lt;span style=&quot;color:#f00&quot;&gt;键值只能为英文、数字、下划线&lt;/span&gt;', '10', '1', '1492140215', '1492140215');
INSERT INTO `hisi_admin_config` VALUES ('13', '1', 'base', '网站域名', 'site_domain', 'http://localhisi.com', 'input', '', '', '', '2', '1', '1492140215', '1492140215');
INSERT INTO `hisi_admin_config` VALUES ('14', '1', 'upload', '图片上传大小限制', 'upload_image_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '3', '1', '1490841797', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('15', '1', 'upload', '允许上传图片格式', 'upload_image_ext', 'jpg,png,gif,jpeg,ico', 'input', '', '', '多个格式请用英文逗号（,）隔开', '4', '1', '1490842130', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('16', '1', 'upload', '缩略图裁剪方式', 'thumb_type', '2', 'select', '1:等比例缩放\r\n2:缩放后填充\r\n3:居中裁剪\r\n4:左上角裁剪\r\n5:右下角裁剪\r\n6:固定尺寸缩放\r\n', '', '', '5', '1', '1490842450', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('17', '1', 'upload', '图片水印开关', 'image_watermark', '1', 'switch', '0:关闭\r\n1:开启', '', '', '6', '1', '1490842583', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('18', '1', 'upload', '图片水印图', 'image_watermark_pic', '/upload/sys/image/93/08cd7b08cedda8b4c48f1078318790.png', 'image', '', '', '', '7', '1', '1490842679', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('19', '1', 'upload', '图片水印透明度', 'image_watermark_opacity', '50', 'input', '', '', '可设置值为0~100，数字越小，透明度越高', '8', '1', '1490857704', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('20', '1', 'upload', '图片水印图位置', 'image_watermark_location', '9', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '9', '1', '1490858228', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('21', '1', 'upload', '文件上传大小限制', 'upload_file_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '1', '1', '1490859167', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('22', '1', 'upload', '允许上传文件格式', 'upload_file_ext', 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip', 'input', '', '', '多个格式请用英文逗号（,）隔开', '2', '1', '1490859246', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('23', '1', 'upload', '文字水印开关', 'text_watermark', '1', 'switch', '0:关闭\r\n1:开启', '', '', '10', '1', '1490860872', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('24', '1', 'upload', '文字水印内容', 'text_watermark_content', '百变魔君 将心独运@izhangxm', 'input', '', '', '', '11', '1', '1490861005', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('25', '1', 'upload', '文字水印字体', 'text_watermark_font', '', 'file', '', '', '不上传将使用系统默认字体', '12', '1', '1490861117', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('26', '1', 'upload', '文字水印字体大小', 'text_watermark_size', '400', 'input', '', '', '单位：px(像素)', '13', '1', '1490861204', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('27', '1', 'upload', '文字水印颜色', 'text_watermark_color', '#000000', 'input', '', '', '文字水印颜色，格式:#000000', '14', '1', '1490861482', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('28', '1', 'upload', '文字水印位置', 'text_watermark_location', '7', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '11', '1', '1490861718', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('29', '1', 'upload', '缩略图尺寸', 'thumb_size', '300x300;500x500', 'input', '', '', '为空则不生成，生成 500x500 的缩略图，则填写 500x500，多个规格填写参考 300x300;500x500;800x800', '4', '1', '1490947834', '1491040778');
INSERT INTO `hisi_admin_config` VALUES ('30', '1', 'develop', '开发模式', 'app_debug', '1', 'switch', '0:关闭\r\n1:开启', '', '', '0', '1', '1491005004', '1492093874');
INSERT INTO `hisi_admin_config` VALUES ('31', '1', 'develop', '页面Trace', 'app_trace', '0', 'switch', '0:关闭\r\n1:开启', '', '', '0', '1', '1491005081', '1492093874');
INSERT INTO `hisi_admin_config` VALUES ('33', '1', 'sys', '富文本编辑器', 'editor', 'ckeditor', 'select', 'ueditor:UEditor\r\numeditor:UMEditor\r\nkindeditor:KindEditor\r\nckeditor:CKEditor', '', '', '20', '1', '1491142648', '1492140215');
INSERT INTO `hisi_admin_config` VALUES ('35', '1', 'databases', '备份目录', 'backup_path', './backup/database/', 'input', '', '', '数据库备份路径,路径必须以 / 结尾', '0', '1', '1491881854', '1491965974');
INSERT INTO `hisi_admin_config` VALUES ('36', '1', 'databases', '备份分卷大小', 'part_size', '20971520', 'input', '', '', '用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '0', '1', '1491881975', '1491965974');
INSERT INTO `hisi_admin_config` VALUES ('37', '1', 'databases', '备份压缩开关', 'compress', '1', 'switch', '0:关闭\r\n1:开启', '', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '0', '1', '1491882038', '1491965974');
INSERT INTO `hisi_admin_config` VALUES ('38', '1', 'databases', '备份压缩级别', 'compress_level', '4', 'radio', '1:最低\r\n4:一般\r\n9:最高', '', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '0', '1', '1491882154', '1491965974');
INSERT INTO `hisi_admin_config` VALUES ('39', '1', 'base', '网站状态', 'site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '站点关闭后将不能访问，后台可正常登录', '1', '1', '1492049460', '1494690024');
INSERT INTO `hisi_admin_config` VALUES ('40', '1', 'sys', '后台管理路径', 'admin_path', 'admin.php', 'input', '', '', '必须以.php为后缀', '5', '1', '1492139196', '1492140215');
INSERT INTO `hisi_admin_config` VALUES ('41', '1', 'base', '网站标题', 'site_title', '中粮数据分析', 'input', '', '', '网站标题是体现一个网站的主旨，要做到主题突出、标题简洁、连贯等特点，建议不超过28个字', '6', '1', '1492502354', '1494695131');
INSERT INTO `hisi_admin_config` VALUES ('42', '1', 'base', '网站关键词', 'site_keywords', 'hisiphp,hisiphp框架,php开源框架', 'input', '', '', '网页内容所包含的核心搜索关键词，多个关键字请用英文逗号&quot;,&quot;分隔', '7', '1', '1494690508', '1494690780');
INSERT INTO `hisi_admin_config` VALUES ('43', '1', 'base', '网站描述', 'site_description', '', 'textarea', '', '', '网页的描述信息，搜索引擎采纳后，作为搜索结果中的页面摘要显示，建议不超过80个字', '8', '1', '1494690669', '1494691075');
INSERT INTO `hisi_admin_config` VALUES ('44', '1', 'base', 'ICP备案信息', 'site_icp', '', 'input', '', '', '请填写ICP备案号，用于展示在网站底部，ICP备案官网：&lt;a href=&quot;http://www.miibeian.gov.cn&quot; target=&quot;_blank&quot;&gt;http://www.miibeian.gov.cn&lt;/a&gt;', '9', '1', '1494691721', '1494692046');
INSERT INTO `hisi_admin_config` VALUES ('45', '1', 'base', '站点统计代码', 'site_statis', '', 'textarea', '', '', '第三方流量统计代码，前台调用时请先用 htmlspecialchars_decode函数转义输出', '10', '1', '1494691959', '1494694797');
INSERT INTO `hisi_admin_config` VALUES ('46', '1', 'base', '网站名称', 'site_name', '中粮数据分析', 'input', '', '', '将显示在浏览器窗口标题等位置', '3', '1', '1494692103', '1494694680');
INSERT INTO `hisi_admin_config` VALUES ('47', '1', 'base', '网站LOGO', 'site_logo', '/upload/sys/image/93/08cd7b08cedda8b4c48f1078318790.png', 'image', '', '', '网站LOGO图片', '4', '1', '1494692345', '1494693235');
INSERT INTO `hisi_admin_config` VALUES ('48', '1', 'base', '网站图标', 'site_favicon', '/favicon.ico', 'image', '', '/admin/annex/favicon', '又叫网站收藏夹图标，它显示位于浏览器的地址栏或者标题前面，&lt;strong class=&quot;red&quot;&gt;.ico格式&lt;/strong&gt;，&lt;a href=&quot;https://www.baidu.com/s?ie=UTF-8&amp;wd=favicon&quot; target=&quot;_blank&quot;&gt;点此了解网站图标&lt;/a&gt;', '5', '1', '1494692781', '1494693966');
INSERT INTO `hisi_admin_config` VALUES ('49', '1', 'base', '手机网站', 'wap_site_status', '0', 'switch', '0:关闭\r\n1:开启', '', '如果有手机网站，请设置为开启状态，否则只显示PC网站', '2', '1', '1498405436', '1498405436');
INSERT INTO `hisi_admin_config` VALUES ('50', '1', 'sys', '云端推送', 'cloud_push', '0', 'switch', '0:关闭\r\n1:开启', '', '关闭之后，无法通过云端推送安装扩展', '30', '1', '1504250320', '1504250320');
INSERT INTO `hisi_admin_config` VALUES ('51', '0', 'base', '手机网站域名', 'wap_domain', '中粮数据分析', 'input', '', '', '手机访问将自动跳转至此域名', '2', '1', '1504304776', '1504304837');
INSERT INTO `hisi_admin_config` VALUES ('52', '0', 'sys', '多语言支持', 'multi_language', '0', 'switch', '0:关闭\r\n1:开启', '', '开启后你可以自由上传多种语言包', '40', '1', '1506532211', '1506532211');
INSERT INTO `hisi_admin_config` VALUES ('59', '0', 'spider', '爬虫管理说明', 'spider_welcome_info', '&lt;p&gt;&lt;span style=&quot;font-size:22px&quot;&gt;&lt;span style=&quot;background-color:#2ecc71&quot;&gt;&lt;span style=&quot;color:#ffffff&quot;&gt;请到系统设置中的爬虫设置选项卡设置本说明&lt;/span&gt;，&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:22px&quot;&gt;&lt;span style=&quot;background-color:#2ecc71&quot;&gt;本说明由&lt;span style=&quot;color:#c0392b&quot;&gt;富文本编辑器&lt;/span&gt;生成，支持复杂样式描述。&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:22px&quot;&gt;&lt;span style=&quot;background-color:#2ecc71&quot;&gt;aaaa&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;', 'multi_textarea', '', '', '', '0', '1', '1522336126', '1522336126');
INSERT INTO `hisi_admin_config` VALUES ('60', '0', 'spider', '爬虫列表', 'spider_list', '\'pubmed\':PUBMED爬虫\r\n\'science_d\':science\r\n\'all\':所有', 'array', '\'science_d\':\'science\'\r\n\'all\':\'所有\'', '', '', '0', '1', '1522383247', '1527563932');
INSERT INTO `hisi_admin_config` VALUES ('61', '0', 'labeldata', '标注说明', 'label_welcome_info', '&lt;p&gt;&lt;span style=&quot;font-size:24px&quot;&gt;请到系统设置中的&lt;span style=&quot;color:#ffffff&quot;&gt;&lt;span style=&quot;background-color:#c0392b&quot;&gt;标注设置&lt;/span&gt;&lt;/span&gt;选项卡设置本说明，&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:24px&quot;&gt;本说明由富文本编辑器生成，支持复杂样式描述。&lt;/span&gt;&lt;/p&gt;', 'multi_textarea', '', '', '', '0', '1', '1522386794', '1522387669');
INSERT INTO `hisi_admin_config` VALUES ('62', '0', 'dataanalyse', '使用说明', 'dataanalyse_welcome_info', '&lt;p&gt;&lt;span style=&quot;font-size:26px&quot;&gt;请到系统设置中的&lt;span style=&quot;color:#ffffff&quot;&gt;&lt;span style=&quot;background-color:#c0392b&quot;&gt;分析设置&lt;/span&gt;&lt;/span&gt;选项卡设置本说明，&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:26px&quot;&gt;本说明由富文本编辑器生成，支持复杂样式描述。&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:26px&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/upload/sys/image/bd/2cee4a4f8dfbe7d4d3810ed60a3c2c.JPG&quot; style=&quot;height:221px; width:224px&quot; /&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;/upload/sys/image/50/abc1c1bf2d9f21fb88894e60fb219b.JPG&quot; style=&quot;height:183px; width:419px&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;/upload/sys/image/47/fbe148f4542c1a4d40e9464354125d.png&quot; style=&quot;height:195px; width:334px&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;/upload/sys/image/47/fbe148f4542c1a4d40e9464354125d.png&quot; style=&quot;height:136px; width:234px&quot; /&gt;&lt;/p&gt;', 'multi_textarea', '', '', '', '0', '1', '1522387319', '1522387910');
INSERT INTO `hisi_admin_config` VALUES ('63', '0', 'sys', '首页欢迎', 'sys_welcome_info', '&lt;div style=&quot;border-bottom:solid #b4a38a 1.0pt; padding:0cm 0cm 11.0pt 0cm&quot;&gt;\r\n&lt;p style=&quot;text-align:left&quot;&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:22.5pt&quot;&gt;&lt;span style=&quot;color:#b4a38a&quot;&gt;关于中粮&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:15.0pt&quot;&gt;&lt;span style=&quot;color:#b4a38a&quot;&gt;中粮集团有限公司（COFCO）是立足中国的国际大粮商，是全球布局、全产业链、拥有最大市场和发展潜力的农业及粮油食品企业，集贸易、加工、销售、研发于一体的投资控股公司。中粮集团以&amp;ldquo;确保国家粮食安全，把中国人的饭碗牢牢端在自己手中&amp;rdquo;为己任，致力于打造具有全球竞争力的世界一流大粮商，担当服务国家宏观调控、维护国家粮食和食品安全，构建具有中粮特色的国有资本投资公司。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;作为与新中国同龄的国有企业，中粮集团历经六十余年发展，在中国市场上占据领先优势，业务遍及全球140多个国家和地区，以粮、油、糖、棉为核心主业，覆盖稻谷、小麦、玉米、油脂油料、糖、棉花等农作物品种以及生物能源，同时涉及食品、金融、地产行业。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;目前，中粮集团资产总额5373.6亿元，年营业收入4426.5亿元，年经营总量近1.6亿吨，全球仓储能力3100万吨，年加工能力9000万吨，年港口中转能力6500万吨。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;在中国，中粮集团综合加工能力超过6000万吨，是中国最大的农产品加工企业，涵盖了中国人日常消费的主要农产品品类，包括稻谷、小麦、玉米、油脂油料、糖、棉花、肉制品、乳制品、酒、茶叶等。形成了包括种植养殖、仓储、物流、贸易、加工、分销等环节的上下游一体化网络，搭建起 &amp;ldquo;北粮南运&amp;ldquo;的大动脉。在维护中国粮油市场稳定中，发挥着重要的支撑作用。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;在全球，中粮集团形成了覆盖全球主要粮油产区、销区的粮油设施布局，拥有包括种植、采购、仓储、物流和港口在内的全球生产采购平台和贸易网络，在南美、黑海等全球粮食主产区和亚洲新兴市场间建立起稳定的粮食走廊，集团50%以上营业收入来自于海外业务。为统筹利用国际国内两种资源、两个市场，稳定中国市场供应、保障粮食安全打下坚实基础。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;在做强做优做大粮、油、糖、棉核心业务同时，中粮集团建立了食品、金融和地产三大主营业务。在食品领域，作为优质产品的生产者，优质品牌的创造者，业务涵盖奶制品、肉食、酒、茶叶、食品包装，拥有福临门、蒙牛、长城、中茶等具有影响力的品牌，230万家终端售点遍布中国952个大中城市、十几万个县乡村，将世界四分之一以上人口的餐桌与全世界的农场紧密地联系在一起。创造性地为农业发展提供金融服务，已经形成信托、期货交易代理、保险、风险管理咨询、银行、基金等金融业务链。同时也是卓越生活空间的建设者，建设商业地产、住宅地产、酒店、旅游地产以及区域综合开发。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;作为国有资本投资公司改革试点企业，中粮集团积极推进企业体制机制改革，构建中国农粮食品领域的国有资本投资平台、资源整合平台和海外投资平台，不断聚焦核心主业，推进专业化经营，形成了以核心产品为主线的十八个专业化公司。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;作为投资控股企业，中粮集团旗下拥有13家上市公司，其中包括中国食品（00506.HK）、中粮控股（00606.HK）、蒙牛乳业（02319.HK）、中粮包装（00906.HK）、大悦城地产（00207.HK）、中粮肉食（01610.HK）、福田实业（00420.HK）、雅士利国际（01230.HK）、现代牧业（01117.HK）九家香港上市公司，以及中粮糖业（600737.SH）、酒鬼酒（000799.SZ）、中粮地产（000031.SZ）、中粮生化（000930.SZ）四家内地公司。&lt;br /&gt;\r\n&lt;br /&gt;\r\n在十九大精神指引下，中粮集团瞄准世界一流企业，大力弘扬&amp;ldquo;忠于国计，良于民生&amp;rdquo;的战略使命、&amp;ldquo;严、实、廉&amp;rdquo;的工作作风、&amp;ldquo;品牌、品质、品格&amp;rdquo;的企业经营理念，聚焦事关国家粮食安全、食品安全的粮油食品领域，通过主业、品牌、资本三大拉动，全面实现四个转型：从恢复性增长转变为聚焦主业的常态发展，从传统国有企业经营模式转变为投资公司的专业化经营，从国内政策市经营转变为完全市场化的国际国内两个市场经营，从传统农贸企业转变为新型生产服务经营主体。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;background-color:white&quot;&gt;&lt;span style=&quot;font-size:12.0pt&quot;&gt;&lt;span style=&quot;color:#999999&quot;&gt;&amp;ldquo;十三五&amp;rdquo;期间，中粮集团在农粮食品领域国有资本占比将提高到80%以上，实现&amp;ldquo;321155&amp;rdquo;经营目标，即年经营玉米3000万吨、年加工2000万吨大豆、1000万吨水稻、1000万吨小麦，年经营食糖500万吨，国外一手粮源5000万吨。更好地发挥在国家宏观调控中的主力军作用，切实提升国家粮食安全保障能力，服务农业供给侧结构性改革，在新时代谱写中国特色社会主义新篇章，为实现 &amp;ldquo;两个一百年&amp;rdquo;奋斗目标的宏伟蓝图做出贡献。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'multi_textarea', '', '', '', '0', '1', '1522389117', '1522389117');
INSERT INTO `hisi_admin_config` VALUES ('64', '0', 'spider', '爬虫任务列表', 'spider_api_all', 'http://47.105.46.213:9001/spider/all', 'input', '', '', '爬虫任务列表API地址', '0', '1', '1527507656', '1527733593');
INSERT INTO `hisi_admin_config` VALUES ('65', '0', 'spider', '爬虫任务添加', 'spider_api_add', 'http://47.105.46.213:9001/spider/add', 'input', '', '', '爬虫任务添加API', '0', '1', '1527565811', '1527565811');
INSERT INTO `hisi_admin_config` VALUES ('66', '0', 'spider', '爬虫任务停止', 'spider_api_stop', 'http://47.105.46.213:9001/spider/stop', 'input', '', '', '爬虫任务停止API', '0', '1', '1528108920', '1528113229');
INSERT INTO `hisi_admin_config` VALUES ('67', '0', 'spider', '爬虫任务重启', 'spider_api_startforce', 'http://47.105.46.213:9001/spider/startforce', 'input', '', '', '爬虫任务重启API', '0', '1', '1528109097', '1528109097');
INSERT INTO `hisi_admin_config` VALUES ('68', '0', 'spider', '爬虫任务暂停', 'spider_api_pause', 'http://47.105.46.213:9001/spider/pause', 'input', '', '', '爬虫任务暂停API', '0', '1', '1528109202', '1528109202');
INSERT INTO `hisi_admin_config` VALUES ('69', '0', 'spider', '爬虫任务继续', 'spider_api_continue', 'http://47.105.46.213:9001/spider/continue', 'input', '', '', '爬虫任务继续API', '0', '1', '1528109291', '1528109291');
INSERT INTO `hisi_admin_config` VALUES ('70', '0', 'spider', '爬虫任务删除', 'spider_api_remove', 'http://47.105.46.213:9001/spider/remove', 'input', '', '', '爬虫任务删除API', '0', '1', '1528109337', '1528109337');
INSERT INTO `hisi_admin_config` VALUES ('71', '0', 'spider', '辅助输入', 'spider_api_crawurl', 'http://47.105.46.213:9001/spider/crawurl', 'input', '', '', '辅助输入API', '0', '1', '1528109654', '1528109654');

-- ----------------------------
-- Table structure for `hisi_admin_finaly`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_finaly`;
CREATE TABLE `hisi_admin_finaly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doi` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '文章唯一标识',
  `source` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '爬取该⽂文章时所使⽤用的⽹网站 ',
  `pmid` longtext COLLATE utf8_bin COMMENT '该⽂文章在所爬取⽹网站的id值',
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '⽂文章标题',
  `author` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '⽂文章作者',
  `journal` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '⽂文章所属期刊（⽀支持期刊模糊名称） ',
  `ojournal` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '⽂文章所属期刊（官⽅方名称）',
  `impact_factor` float(10,3) NOT NULL COMMENT '所在期刊影响因⼦',
  `journal_zone` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '期刊所在分区',
  `issue` longtext COLLATE utf8_bin COMMENT '⽂文章发表时间，请转换为时间戳后再存贮 ',
  `abstract` text COLLATE utf8_bin NOT NULL COMMENT '文章摘要',
  `keyword` longtext COLLATE utf8_bin NOT NULL COMMENT '⽂文章关键词',
  `institue` longtext COLLATE utf8_bin COMMENT '⽂文章发表机构',
  `country` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '⽂文章发表机构所在国家',
  `flink` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '⽂文章所在的原⽹网址',
  `ctime` int(11) NOT NULL COMMENT '爬取时间[时间戳]',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `tag_id` longtext COLLATE utf8_bin,
  `tabstract` text COLLATE utf8_bin COMMENT '摘要翻译',
  `project` longtext COLLATE utf8_bin,
  `sstr` longtext COLLATE utf8_bin,
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of hisi_admin_finaly
-- ----------------------------
INSERT INTO `hisi_admin_finaly` VALUES ('53', '10.1111/j.1600-0765.2004.00743.x', '', 0x3135333234333530, 'Inhibitory effects of green tea polyphenol (-)-epigallocatechin gallate on the expression of matrix metalloproteinase-9 and on the formation of osteoclasts.', 'Yun JH,Pang EK,Kim CS,Yoo YJ,Cho KS,Chai JK,Kim CK,Choi SH', 'Journal of periodontal research.', null, '2.878', '3', '', 0x4241434B47524F554E443A20416C76656F6C617220626F6E65207265736F727074696F6E20697320612063686172616374657269737469632066656174757265206F6620706572696F646F6E74616C20646973656173657320616E6420696E766F6C766573207468652072656D6F76616C206F6620626F746820746865206D696E6572616C20616E64206F7267616E696320636F6E7374697475656E7473206F662074686520626F6E65206D61747269782C2077686963682069732063617573656420627920656974686572206D756C74696E75636C6561746564206F7374656F636C6173742063656C6C73206F72206D6174726978206D6574616C6C6F70726F7465696E6173657320284D4D5073292E20546865206772616D2D6E656761746976652062616374657269756D2C20506F72706879726F6D6F6E61732067696E676976616C697320686173206265656E207265706F7274656420746F207374696D756C6174652074686520616374697669747920616E642065787072657373696F6E206F66207365766572616C2067726F757073206F66204D4D50732C207768657265617320282D292D65706967616C6C6F636174656368696E2067616C6C617465202845474347292C20746865206D61696E20636F6E7374697475656E74206F6620677265656E2074656120706F6C797068656E6F6C732C20686173206265656E207265706F7274656420746F206861766520696E68696269746F72792065666665637473206F6E2074686520616374697669747920616E642065787072657373696F6E206F66204D4D50732E4F424A454354495645533A20496E207468652070726573656E742073747564792C20776520696E76657374696761746564207468652065666665637473206F662074686520677265656E2074656120706F6C797068656E6F6C2C20454743472C206F6E207468652067656E652065787072657373696F6E206F66206F7374656F626C6173742D64657269766564204D4D502D322C202D3920616E64202D31332C207374696D756C6174656420627920502E2067696E676976616C69732C20616E64206F6E2074686520666F726D6174696F6E206F66206F7374656F636C617374732E4D4554484F44533A2054686520656666656374206F662045474347206F6E207468652067656E652065787072657373696F6E206F66204D4D507320776173206578616D696E6564206279207472656174696E67206D6F7573652063616C76617269616C207072696D617279206F7374656F626C61737469632063656C6C732077697468204547434720283230206D6963726F4D2920696E207468652070726573656E6365206F6620736F6E69636174656420502E2067696E676976616C69732065787472616374732E20546865207472616E736372697074696F6E206C6576656C73206F66204D4D502D322C202D3920616E64202D313320776572652061737365737365642062792072657665727365207472616E736372697074696F6E2D706F6C796D657261736520636861696E207265616374696F6E202852542D504352292E2054686520656666656374206F662045474347206F6E206F7374656F636C61737420666F726D6174696F6E2077617320636F6E6669726D65642062792074617274726174652D726573697374616E7420616369642070686F73706861746173652028545241502920737461696E696E6720696E206120636F2D63756C747572652073797374656D206F66206D6F75736520626F6E65206D6172726F772063656C6C7320616E642063616C76617269616C207072696D617279206F7374656F626C61737469632063656C6C732E524553554C54533A2054726561746D656E7420776974682074686520736F6E69636174656420502E2067696E676976616C6973206578747261637473207374696D756C61746564207468652065787072657373696F6E206F66204D4D502D39206D524E4120616E6420746869732065666665637420776173207369676E69666963616E746C79207265647563656420627920454743472C207768657265617320746865207472616E736372697074696F6E206C6576656C73206F66204D4D502D3220616E64204D4D502D31332077657265206E6F74206166666563746564206279206569746865722074686520736F6E69636174656420502E2067696E676976616C6973206578747261637473206F7220454743472E20496E206164646974696F6E2C2045474347207369676E69666963616E746C7920696E68696269746564206F7374656F636C61737420666F726D6174696F6E20696E2074686520636F2D63756C747572652073797374656D206174206120636F6E63656E74726174696F6E206F66203230206D6963726F4D2E434F4E434C5553494F4E533A2054686573652066696E64696E6773207375676765737420746861742045474347206D61792070726576656E742074686520616C76656F6C617220626F6E65207265736F727074696F6E2074686174206F636375727320696E20706572696F646F6E74616C20646973656173657320627920696E6869626974696E67207468652065787072657373696F6E206F66204D4D502D3920696E206F7374656F626C6173747320616E642074686520666F726D6174696F6E206F66206F7374656F636C617374732E, '', 0x4465706172746D656E74206F6620506572696F646F6E746F6C6F67792C20526573656172636820496E73746974757465206620506572696F646F6E74616C20526567656E65726174696F6E2C20436F6C6C656765206F662044656E7469737472792C20596F6E73656920556E69766572736974792C2053656F756C2C204B6561, 'Kea', 'https://onlinelibrary.wiley.com/resolve/openurl genre=article&amp;amp;amp;amp;amp;sid=nlm:pubmed&amp;amp;amp;amp;amp;issn=0022-3484&amp;amp;amp;amp;amp;date=2004&amp;amp;amp;amp;amp;volume=39&amp;amp;amp;amp;amp;issue=5&amp;amp;amp;amp;amp;spage=300', '1537481635', '3', 0x3430233432233739233223323523332334372334382334233332233333, 0xE98791E5B19EE89B8BE799BDE985B6E4BC9AE5BDB1E5938DE9AAA8E8B4A8E79A84E5868DE7949FEFBC8CE9809AE8BF87E794A8E7BBBFE88CB6E5A49AE9859AE4BD93E5A496E5A484E79086E5B08FE9BCA0E7BB86E8839EE58F91E78EB0E88CB6E5A49AE9859AE883BDE5A49FE68A91E588B6E59FBAE8B4A8E98791E5B19EE89B8BE799BDE985B6E59FBAE59BA0EFBC884D4D50EFBC89E8A1A8E8BEBEE6B0B4E5B9B3EFBC8CE585B6E4B8AD4D4D502D39E79BB8E6AF94E4BA8E4D4D502D32E4B88E4D4D502D3133E698BEE89197E58F97E588B0E68A91E588B6EFBC8CE999A4E6ADA4E4B98BE5A496EFBC8CE59CA8E585B1E59FB9E585BBE4BD93E7B3BBE4B8AD3230E6AFABE691A9E79A84E5A49AE9859AE5A484E79086E883BDE5A49FE698BEE89197E68A91E588B6E7A0B4E9AAA8E7BB86E8839EE79A84E5BDA2E68890E38082, '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('52', '10.3892/mmr.2018.9437', '', 0x3330323231373134, 'Epigallocatechin‑3‑gallate protects against secondary osteoporosis in a mouse model via the Wnt/β‑catenin signaling pathway.', 'Xi J,Li Q,Luo X,Li J,Guo L,Xue H,Wu G', 'Molecular medicine reports.', null, '1.922', '4', 0x31353339323630323830, 0x45706967616C6C6F636174656368696EE2809133E2809167616C6C61746520284547434729206973206120706F6C797068656E6F6C696320636F6D706F756E642065787472616374656420616E642069736F6C617465642066726F6D20677265656E207465612C2077686963682068617320612076617269657479206F6620696D706F7274616E742062696F6C6F676963616C206163746976697469657320696EC2A0766974726F20616E6420696EC2A07669766F2C20696E636C7564696E6720616E7469E2809174756D6F722C20616E7469E280916F7869646174696F6E2C20616E7469E28091696E666C616D6D6174696F6E20616E64206C6F776572696E6720626C6F6F642070726573737572652E205468652061696D206F66207468652070726573656E742073747564792077617320746F20696E766573746967617465207468652070726F7465637469766520656666656374206F66204547434720616761696E7374207365636F6E64617279206F7374656F706F726F73697320696E2061206D6F757365206D6F64656C207669612074686520576E742FCEB2E28091636174656E696E207369676E616C696E6720706174687761792E2052657665727365207472616E736372697074696F6EE280917175616E746974617469766520706F6C796D657261736520636861696E207265616374696F6E20285254E28091715043522920616E64207765737465726E20626C6F7474696E672077657265207573656420746F20616E616C797A652072756E74E2809172656C61746564207472616E736372697074696F6E20666163746F72203220616E64206F737465726978206D524E412065787072657373696F6E2C20616E64207468652070726F7465696E2065787072657373696F6E206F66206379636C696E2044312C20576E7420616E6420CEB2E28091636174656E696E2C20616E642073757070726573736564207065726F7869736F6D652070726F6C6966657261746F72E28091616374697661746564207265636570746F7220CEB32070726F7465696E2065787072657373696F6E2E205468652070726F7465637469766520656666656374206F66204547434720616761696E7374207365636F6E64617279206F7374656F706F726F73697320776173206578616D696E656420616E642069747320706F74656E7469616C206D656368616E69736D2077617320616E616C797A65642E2054726561746D656E7420776974682045474347207369676E69666963616E746C792064656372656173656420736572756D2063616C6369756D2C207572696E6172792063616C6369756D2C20626F64792077656967687420616E6420626F6479206661742C20616E6420696E63726561736564206C657074696E206C6576656C7320696E206D6963652077697468207365636F6E64617279206F7374656F706F726F7369732E20496E206164646974696F6E2C20454743472074726561746D656E74207369676E69666963616E746C7920696E6869626974656420746865207374727563747572652073636F7265206F66206172746963756C61722063617274696C61676520616E642063616E63656C6C6F757320626F6E6520696E2070726F78696D616C207469626961206D65746170687973697320696E206D6963652077697468207365636F6E64617279206F7374656F706F726F7369732E2054726561746D656E7420616C736F207369676E69666963616E746C792064656372656173656420616C6B616C696E652070686F73706861746173652061637469766974792C2072756E74E2809172656C61746564207472616E736372697074696F6E20666163746F72203220616E64206F737465726978206D524E412065787072657373696F6E2E204547434720616C736F207369676E69666963616E746C7920696E6475636564207468652070726F7465696E2065787072657373696F6E206F66206379636C696E2044312C20576E7420616E6420CEB2E28091636174656E696E2C20616E642073757070726573736564207065726F7869736F6D652070726F6C6966657261746F72E28091616374697661746564207265636570746F7220CEB32070726F7465696E2065787072657373696F6E20696E206D6963652077697468207365636F6E64617279206F7374656F706F726F7369732E2054616B656E20746F6765746865722C20746865736520726573756C7473207375676765737420746861742045474347206D6179206265206120706F737369626C65206E6577206472756720696E20636C696E6963616C2073657474696E67732E, '', 0x4465706172746D656E74206F66204D696E696D616C6C7920496E766173697665205370696E616C20537572676572792C2054686520333039746820486F73706974616C206F66205468652050656F706C6573204C696265726174696F6E2041726D792C204265696A696E67203130303039312C205052204368696E612C4465706172746D656E74206F66204F7274686F7065646963732C2054686520466F7572746820416666696C696174656420486F73706974616C206F6620486562656920556E69766572736974792C2042616F64696E672C204865626569203037313030302C205052204368696E61, 'China', 'http://www.spandidos-publications.com/10.3892/mmr.2018.9437', '1537480049', '3', 0x3430233432233739233223323223323423323523332334372335302334233332233333, 0x45474347E698AFE4BB8EE7BBBFE88CB6E4B8ADE68F90E58F96E79A84E9859AE7B1BBE789A9E8B4A8EFBC8CE59CA8E4BD93E58685E5928CE4BD93E5A496E983BDE585B7E5A487E8AEB8E5A49AE7949FE789A9E6B4BBE680A7EFBC8CE58C85E68BACE68A97E882BFE798A4EFBC8CE68A97E6B0A7E58C96EFBC8CE6B688E7828EE4BBA5E58F8AE9998DE8A180E58E8BE79A84E4BD9CE794A8E38082E8BF99E7AF87E69687E7ABA0E79A84E7A094E7A9B6E4B8BBE8A681E585B3E4BA8E45474347E5AFB9E4BA8EE9AAA8E8B4A8E7968FE69DBEE79A84E5BDB1E5938DE38082E9809AE8BF87E5AE9AE9878F504352E4BBA5E58F8AE89B8BE799BDE5858DE796ABE58DB0E8BFB9E6B395E58886E69E90E4BA86576E74E4BFA1E58FB7E9809AE8B7AFE4B8ADE79BB8E585B3E59FBAE59BA0E79A84E58F98E58C96EFBC8CE8BF9BE4B880E6ADA5E9AA8CE8AF81E4BA8645474347E68AB5E5BEA1E9AAA8E8B4A8E7968FE69DBEE79A84E58886E5AD90E69CBAE588B6E3808245474347E883BDE5A49FE68A91E588B6E7A2B1E680A7E7A3B7E985B8E985B6E79A84E6B4BBE680A7EFBC8CE5908CE697B6EFBC8C45474347E883BDE5A49FE8AFB1E5AFBC6379636C696E204431EFBC8C576E74E5928C636174656E696EE79A84E59FBAE59BA0E8A1A8E8BEBEEFBC8CE680BBE8808CE8A880E4B98BEFBC8C45474347E883BDE5A49FE4BD9CE4B8BAE6BD9CE59CA8E79A84E88DAFE789A9E99DB6E6A087E38082, '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('51', '10.1111/jre.12600', '', 0x3330313539393835, 'Effects of theaflavins on tissue inflammation and bone resorption on experimental periodontitis in rats.', 'Wu YH,Kuraji R,Taya Y,Ito H,Numabe Y', 'Journal of periodontal research.', null, '2.878', '3', '', 0x4241434B47524F554E4420414E44204F424A4543544956453A2054686561666C6176696E732028544673292C20746865206D616A6F7220706F6C797068656E6F6C20696E20626C61636B207465612C206861766520746865206162696C69747920746F2072656475636520696E666C616D6D6174696F6E20616E6420626F6E65207265736F727074696F6E2E205468652061696D206F6620746869732073747564792077617320746F206576616C75617465207468652065666665637473206F6620544673206F6E206578706572696D656E74616C20706572696F646F6E746974697320696E20726174732E4D4154455249414C20414E44204D4554484F44533A2054686972747920726174732077657265206469766964656420696E746F20666976652067726F7570733A20436F6E74726F6C2028676C796365726F6C206170706C69636174696F6E20776974686F7574206C69676174696F6E292C204C696761747572652028676C796365726F6C206170706C69636174696F6E2077697468206C69676174696F6E292C20544631202831C2A06D672F6D4C205446206170706C69636174696F6E2077697468206C69676174696F6E292C205446313020283130C2A06D672F6D4C205446206170706C69636174696F6E2077697468206C69676174696F6E292C20616E642054463130302028313030C2A06D672F6D4C205446206170706C69636174696F6E2077697468206C69676174696F6E292E20546F20696E64756365206578706572696D656E74616C20706572696F646F6E74697469732C206C6967617475726573207765726520706C616365642061726F756E64206D6178696C6C617279206669727374206D6F6C6172732062696C61746572616C6C792E204166746572206C6967617475726520706C6163656D656E742C20313030C2A0CEBC4C20676C796365726F6C206F7220544673207765726520746F706963616C6C79206170706C69656420746F207468652072617473206461696C792C20616E64207261747320776572652065757468616E697A65642037C2A064617973206166746572206C6967617475726520706C6163656D656E742E204D6963726F2D636F6D707574656420746F6D6F67726170687920776173207573656420746F206D65617375726520626F6E65207265736F727074696F6E20696E20746865206C6566742073696465206F6620746865206D6178696C6C612C20616E64207175616E746974617469766520706F6C796D657261736520636861696E207265616374696F6E20776173207573656420746F206D656173757265207468652065787072657373696F6E206F6620696E7465726C65756B696E2028494C292D362C2067726F7774682D726567756C617465642067656E652070726F647563742F6379746F6B696E652D696E6475636564206E657574726F7068696C206368656D6F61747472616374616E74202847726F2F43696E632D312C20726174206571756976616C656E74206F6620494C2D38292C206D6174726978206D6574616C6C6F70726F7465696E6173652D3920284D6D702D39292C207265636570746F7220616374697661746F72206F66206E75636C65617220666163746F722D6B6170706120CE92206C6967616E64202852616E6B6C292C206F7374656F70726F7465676572696E20284F7067292C20616E64207468652052616E6B6C2F4F706720726174696F20696E2067696E676976616C207469737375652E2057697468207469737375652066726F6D207468652072696768742073696465206F6620746865206D6178696C6C612C2068656D61746F78796C696E20616E6420656F73696E20737461696E696E6720776173207573656420666F7220686973746F6C6F676963616C20616E616C797369732C20696D6D756E6F686973746F6368656D6963616C20737461696E696E6720666F72206C65756B6F6379746520636F6D6D6F6E20616E746967656E2028434434352920776173207573656420746F2061737365737320696E666C616D6D6174696F6E2C20616E642074617274726174652D726573697374616E7420616369642070686F73706861746173652028545241502920737461696E696E6720776173207573656420746F206F62736572766520746865206E756D626572206F66206F7374656F636C617374732E524553554C54533A20546865205446313020616E64205446313030C2A067726F7570732C20627574206E6F7420746865205446312067726F75702C20686164207369676E69666963616E7420696E6869626974696F6E206F6620616C76656F6C617220626F6E65206C6F73732C20726564756374696F6E20696E20696E666C616D6D61746F72792063656C6C20696E66696C74726174696F6E20696E2074686520706572696F646F6E7469756D2C20616E64207369676E69666963616E746C792072656475636564206E756D62657273206F6620434434352D706F7369746976652063656C6C7320616E6420545241502D706F736974697665206F7374656F636C6173747320636F6D7061726564207769746820746865204C696761747572652067726F75702E20436F72726573706F6E64696E676C792C20746865205446313020616E642054463130302067726F75707320686164207369676E69666963616E746C7920646F776E726567756C617465642067656E652065787072657373696F6E206F6620494C2D362C2047726F2F43696E632D3128494C2D38292C204D6D702D392C20616E642052616E6B6C2C20627574206E6F74206F66204F70672E20436F6E73657175656E746C792C2052616E6B6C2F4F70672065787072657373696F6E20776173207369676E69666963616E746C7920696E6372656173656420696E20746865204C69676174696F6E2067726F7570206275742077617320617474656E756174656420696E20746865205446313020616E642054463130302067726F7570732E434F4E434C5553494F4E3A2054686520726573756C7473206F6620746869732073747564792073756767657374207468617420746F706963616C206170706C69636174696F6E206F6620544673206D61792072656475636520696E666C616D6D6174696F6E20616E6420626F6E65207265736F727074696F6E20696E206578706572696D656E74616C20706572696F646F6E74697469732E205468657265666F72652C20544673206861766520746865726170657574696320706F74656E7469616C20696E207468652074726561746D656E74206F6620706572696F646F6E74616C20646973656173652EC2A920323031382054686520417574686F72732E204A6F75726E616C206F6620506572696F646F6E74616C205265736561726368205075626C6973686564206279204A6F686E2057696C65792026616D703B616D703B616D703B616D703B20536F6E73204C74642E, 0x6379746F6B696E65732C6578706572696D656E74616C20706572696F646F6E74697469732C706572696F646F6E74616C20646973656173652C74686561666C6176696E, 0x4465706172746D656E74206F6620506572696F646F6E746F6C6F67792C20546865204E6970706F6E2044656E74616C20556E6976657273697479205363686F6F6C206F66204C6966652044656E74697374727920617420546F6B796F2C20546F6B796F2C204A6170616E2C4465706172746D656E74206F66204C69666520536369656E63652044656E7469737472792C20546865204E6970706F6E2044656E74616C20556E69766572736974792C20546F6B796F2C204A6170616E2C4465706172746D656E74206F6620506174686F6C6F67792C20546865204E6970706F6E2044656E74616C20556E6976657273697479205363686F6F6C206F66204C6966652044656E74697374727920617420546F6B796F2C20546F6B796F2C204A6170616E, 'Japan', 'https://doi.org/10.1111/jre.12600', '1537480010', '3', 0x3430233432233830233223323523332334372339322334322333, 0xE88CB6E9BB84E7B4A0E4BD9CE4B8BAE7BAA2E88CB6E4B8ADE4B8BBE8A681E79A84E5A49AE9859AE68890E58886EFBC8CE585B7E69C89E5878FE5B091E7828EE79787E79A84E4BD9CE794A8E38082E69CACE7AF87E7A094E7A9B6E698AFE4B8BAE4BA86E8AF84E4BCB0E88CB6E9BB84E7B4A0E5AFB9E4BA8EE5B08FE9BCA0E78999E591A8E7828EE79A84E5BDB1E5938DE38082E9809AE8BF87E5AFB9E5B08FE9BCA0E8BF9BE8A18CE4B88DE5908CE6B593E5BAA6E79A84E88CB6E9BB84E7B4A0E5A484E79086EFBC8CE5908CE697B6E8AFB1E5AFBCE78999E591A8E7828EE5B9B6E7BB9FE8AEA1E58F91E79785E68385E586B5E38082E9809AE8BF87E696ADE5B182E69184E5BDB1E68A80E69CAFE7BB9FE8AEA1E4B88AE9A28CE9AAA8E79A84E9AAA8E590B8E694B6E7BB93E59088504352E6B58BE9878FE78999E7BB84E7BB87E79A84E799BDE7BB86E8839EE4BB8BE7B4A0E4BBA5E58F8AE7949FE995BFE59BA0E5AD90E79BB8E585B3E79A84E59FBAE59BA0E8A1A8E8BEBEE68385E586B5E38082E69C80E5908EE9809AE8BF87E5858DE796ABE58C96E5ADA6E69F93E889B2E7A1AEE5AE9AE78999E7BB84E7BB87E79A84E7828EE79787E58F91E7949FE68385E586B5E4BBA5E58F8AE7A0B4E9AAA8E7BB86E8839EE79A84E5BDA2E68890E68385E586B5E38082E7A094E7A9B6E58F91E78EB0EFBC8C3130E6AFABE5858BE4BBA5E58F8A313030E6AFABE5858BE79A84E5A484E79086E7BB84E79BB8E6AF94E4BA8EE5AFB9E785A7E883BDE5A49FE698BEE89197E68A91E588B6E7828EE79787E79A84E4BAA7E7949FEFBC8CE68A91E588B6E7A0B4E9AAA8E7BB86E8839EE79A84E5BDA2E68890E38082E5908CE697B6E7828EE79787E79BB8E585B3E79A84E59FBAE59BA0E8A1A8E8BEBEE4B99FE698BEE89197E9998DE4BD8EE38082E8AFB4E6988EE88CB6E9BB84E7B4A0E585B7E69C89E6B2BBE79697E78999E591A8E79785E79A84E6BD9CE58A9BE38082, '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('49', '10.3945/ajcn.113.058255', '', 0x7465726D3D312E2530395465612B616E642B626F6E652B6865616C74682533412B73746570732B666F72776172642B696E2B7472616E736C6174696F6E616C2B6E7574726974696F6E, 'Tea and bone health: steps forward in translational nutrition.', 'Shen CL,Chyu MC,Wang JS', 'The American journal of clinical nutrition.', null, '0.000', '', 0x31353337313836333830, 0x4F7374656F706F726F7369732069732061206D616A6F72206865616C74682070726F626C656D20696E20746865206167696E6720706F70756C6174696F6E20776F726C64776964652E2043726F73732D73656374696F6E616C20616E6420726574726F73706563746976652065766964656E636520696E6469636174657320746861742074656120636F6E73756D7074696F6E206D617920626520612070726F6D6973696E6720617070726F61636820696E206D697469676174696E6720626F6E65206C6F737320616E6420696E207265647563696E67207269736B206F66206F7374656F706F726F7469632066726163747572657320616D6F6E67206F6C646572206164756C74732E2054656120706F6C797068656E6F6C7320656E68616E6365206F7374656F626C6173746F67656E6573697320616E64207375707072657373206F7374656F636C6173746F67656E6573697320696E20766974726F2E20416E696D616C20737475646965732072657665616C207468617420696E74616B65206F662074656120706F6C797068656E6F6C7320686176652070726F6E6F756E63656420706F7369746976652065666665637473206F6E20626F6E652061732073686F776E2062792068696768657220626F6E65206D61737320616E6420747261626563756C617220626F6E6520766F6C756D652C206E756D6265722C20616E6420746869636B6E65737320616E64206C6F77657220747261626563756C61722073657061726174696F6E2076696120696E6372656173696E6720626F6E6520666F726D6174696F6E20616E6420696E6869626974696F6E206F6620626F6E65207265736F727074696F6E2C20726573756C74696E6720696E206772656174657220626F6E6520737472656E6774682E205468657365206F7374656F70726F7465637469766520656666656374732061707065617220746F206265206D65646961746564207468726F75676820616E74696F786964616E74206F7220616E7469696E666C616D6D61746F727920706174687761797320616C6F6E67207769746820746865697220646F776E73747265616D207369676E616C696E67206D656368616E69736D732E20412073686F72742D7465726D20636C696E6963616C20747269616C206F6620677265656E2074656120706F6C797068656E6F6C7320686173207472616E736C61746564207468652066696E64696E67732066726F6D206F766172696563746F6D697A656420616E696D616C7320746F20706F73746D656E6F70617573616C206F7374656F70656E696320776F6D656E207468726F756768206576616C756174696F6E206F662062696F617661696C6162696C6974792C207361666574792C20626F6E65207475726E6F766572206D61726B6572732C206D7573636C6520737472656E6774682C20616E64207175616C697479206F66206C6966652E20466F722066757475726520737475646965732C20707265636C696E6963616C20616E696D616C207374756469657320746F206F7074696D697A652074686520646F7365206F662074656120706F6C797068656E6F6C7320666F72206D6178696D756D206F7374656F70726F7465637469766520656666696361637920616E64206120666F6C6C6F772D75702073686F72742D7465726D20646F73652D726573706F6E736520747269616C20696E20706F73746D656E6F70617573616C206F7374656F70656E696320776F6D656E20617265206E656365737361727920746F20696E666F726D207468652064657369676E206F662072616E646F6D697A656420636F6E74726F6C6C6564207374756469657320696E2061742D7269736B20706F70756C6174696F6E732E20416476616E63656420696D6167696E6720746563686E6F6C6F67792073686F756C6420616C736F20636F6E7472696275746520746F2064657465726D696E696E67207468652065666665637469766520646F7365206F662074656120706F6C797068656E6F6C7320696E20616368696576696E672062657474657220626F6E65206D6173732C206D6963726F61726368697465637475726520696E746567726974792C20616E6420626F6E6520737472656E6774682C2077686963682061726520637269746963616C20737465707320666F72207472616E736C6174696E67207468652070757461746976652062656E65666974206F662074656120636F6E73756D7074696F6E20696E206F7374656F706F726F736973206D616E6167656D656E7420696E746F20636C696E6963616C20707261637469636520616E6420646965746172792067756964656C696E65732E, '', 0x4465706172746D656E74206F6620506174686F6C6F677920434C5320204D43432020746865204C617572612057204275736820496E73746974757465206620576F6D656E73204865616C746820434C532C205465786173205465636820556E6976657273697479204865616C746820536369656E6365732043656E7465722C204C7562626F636B2C20545820746865204465706172746D656E74206F66204D656368616E6963616C20456E67696E656572696E672020746865204772616475617465204865616C74686361726520456E67696E656572696E67204F7074696F6E2C205465786173205465636820556E69766572736974792C204C7562626F636B2C205458204D43432020746865204465706172746D656E74206F6620456E7669726F6E6D656E74616C204865616C746820536369656E63652C20556E6976657273697479206F662047656769612C20417468656E732C204741204A5357, '', 'https://academic.oup.com/ajcn/article-lookup/doi/10.3945/ajcn.113.058255,https://www.ncbi.nlm.nih.gov/pmc/articles/pmid/24172296/', '1537191798', '3', 0x3430233432233223343323353923332334372334382334233332233423333223322333233432233437233438, 0x74657374, '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('54', '10.1002/art.23594', '', 0x3138353736333435, '(-)-Epigallocatechin-3-gallate suppresses osteoclast differentiation and ameliorates experimental arthritis in mice.', 'Minobu A,Biao W,Tanaka S,Hiuchi M,Jun L,Tsuji G,Sakai Y,Kurosaka M,Kumagai S', 'Arthritis and rheumatism.', null, '0.000', '未', 0x31353433343933323830, 0x4F424A4543544956453A20546F20766572696679207468652065666665637473206F6620282D292D65706967616C6C6F636174656368696E2D332D67616C6C61746520284547434729206F6E206F7374656F636C61737420646966666572656E74696174696F6E20616E64206F6E206578706572696D656E74616C2061727468726974697320696E206D6963652E4D4554484F44533A2048756D616E206F7374656F636C61737473207765726520646966666572656E7469617465642066726F6D207065726970686572616C20626C6F6F64206D6F6E6F63797465732E205468652065666665637473206F6620454743472077657265206578616D696E65642062792074617274726174652D726573697374616E7420616369642070686F73706861746173652028545241502920737461696E696E672C20626F6E65207265736F727074696F6E2061737361792C205765737465726E20626C6F7474696E672C20616E64207175616E7469746174697665207265616C2D74696D6520706F6C796D657261736520636861696E207265616374696F6E2E204172746872697469732077617320696E647563656420696E206D69636520627920696E6A656374696E67206120636F636B7461696C206F66206D6F6E6F636C6F6E616C20616E7469626F6469657320616761696E737420636F6C6C6167656E2E204547434720283230206D6963726F672F676D20626F64792077656967687429207761732061646D696E6973746572656420696E74726170657269746F6E65616C6C79206576657279206461792066726F6D206461792030207468726F7567682074686520656E64206F6620746865206578706572696D656E74732028646179203135292E205468652065666665637473206F66204547434720776572652064657465726D696E6564206279206173736573736D656E7473206F66206A6F696E74207377656C6C696E672C20686973746F6C6F676963206368616E6765732C20616E64205452415020737461696E696E67206F6E206461792031352E524553554C54533A20454743472072656475636564207468652067656E65726174696F6E206F6620545241502D706F736974697665206D756C74696E75636C65617465642063656C6C732C20626F6E65207265736F727074696F6E2061637469766974792C20616E64206F7374656F636C6173742D73706563696669632067656E652065787072657373696F6E20776974686F757420616666656374696E672063656C6C2076696162696C6974792E204547434720646F776E2D726567756C617465642065787072657373696F6E206F66206E75636C65617220666163746F72206F662061637469766174656420542063656C6C7320633120284E462D41546331292C20627574206E6F74206F66204E462D6B61707061422C20632D466F732C20616E6420632D4A756E2C2073756767657374696E67207468617420646F776E2D726567756C6174696F6E206F66204E462D41546331206973206F6E65206F6620746865206D6F6C6563756C6172206261736573206F66204547434720616374696F6E2E204164646974696F6E616C6C792C20454743472074726561746D656E7420616D656C696F726174656420636C696E6963616C2073796D70746F6D7320616E64207265647563656420686973746F6C6F6769632073636F72657320696E20617274687269746963206D6963652028502026616D703B616D703B6C743B20302E3035292E2054686520696E207669766F20656666656374206F662045474347206F6E206F7374656F636C61737420646966666572656E74696174696F6E20776173206E6F7420636C65617220696E2074686973206D6F64656C2C2070726F6261626C792062656361757365204547434720737570707265737365642074686520696E666C616D6D6174696F6E20697473656C662E434F4E434C5553494F4E3A20454743472073757070726573736564206F7374656F636C61737420646966666572656E74696174696F6E20616E6420616D656C696F7261746564206578706572696D656E74616C2061727468726974697320696E206D696365206F766572207468652073686F7274207465726D2E2049742072656D61696E7320746F2062652065737461626C6973686564207768657468657220454743472069732075736566756C20666F72207468652070726576656E74696F6E20616E642074726561746D656E74206F66206F7374656F706F726F73697320616E6420726865756D61746F6964206172746872697469732E, '', 0x45766964656E63654261736564204C6162617479204D65646963696E652C204B6F626520556E6976657273697479204772616475617465205363686F6F6C206F66204D65646963696E652C204B6F62652C204A6170616E, '', 'https://doi.org/10.1002/art.23594', '1537481904', '3', 0x3430233432233739233223323523332334372339322334322333, '', '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('55', '10.1007/s00198-005-1995-0', '', 0x3136313730343434, 'Green tea catechin enhances osteogenesis in a bone marrow mesenchymal stem cell line.', 'Chen CH,Ho ML,Chang JK,Hung SH,Wang GJ', 'Osteoporosis international : a journal established as result of cooperation between the European Foundation for Osteoporosis and the National Osteoporosis Foundation of the USA.', null, '3.856', '2', 0x31353433343933313030, 0x477265656E2074656120686173206265656E207265706F7274656420746F20706F737365737320616E74696F786964616E742C20616E746974756D6F726967656E69632C20616E6420616E746962616374657269616C207175616C6974696573207468617420726567756C6174652074686520656E646F6372696E652073797374656D2E2050726576696F75732065706964656D696F6C6F676963616C207374756469657320666F756E6420746861742074686520626F6E65206D696E6572616C2064656E736974792028424D4429206F6620706F73746D656E6F70617573616C20776F6D656E20776974682061206861626974206F6620746561206472696E6B696E672077617320686967686572207468616E2074686174206F6620776F6D656E20776974686F757420686162697475616C2074656120636F6E73756D7074696F6E2E20486F77657665722C207468652065666665637473206F6620677265656E2074656120636174656368696E73206F6E206F7374656F67656E69632066756E6374696F6E206861766520726172656C79206265656E20696E766573746967617465642E20496E20746869732073747564792C2077652074657374656420282D292D65706967616C6C6F636174656368696E2D332D67616C6C617465202845474347292C206F6E65206F662074686520677265656E2074656120636174656368696E732C206F6E2063656C6C2070726F6C696665726174696F6E2C20746865206D524E412065787072657373696F6E73206F662072656C6576616E74206F7374656F67656E6963206D61726B6572732C20616C6B616C696E652070686F73706861746173652028414C502920616374697669747920616E64206D696E6572616C697A6174696F6E2E20496E2061206D7572696E6520626F6E65206D6172726F77206D6573656E6368796D616C207374656D2063656C6C206C696E652C2044312C20746865206D524E412065787072657373696F6E73206F6620636F72652062696E64696E6720666163746F7273206131202843626661312F52756E7832292C206F7374657269782C206F7374656F63616C63696E2C20414C5020696E637265617365642061667465722034382068206F6620454743472074726561746D656E742E20414C502061637469766974792077617320616C736F207369676E69666963616E746C79206175676D656E7465642075706F6E20454743472074726561746D656E7420666F72203420646179732C2037206461797320616E6420313420646179732E20467572746865726D6F72652C206D696E6572616C697A6174696F6E73206173736179656420627920416C697A6172696E20526564205320616E6420766F6E204B6F73736120737461696E207765726520656E68616E63656420616674657220454743472074726561746D656E7420666F7220322D34207765656B7320696E2044312063656C6C2063756C74757265732E20486F77657665722C20612032342D682074726561746D656E74206F66204547434720696E68696269746564207468796D6964696E6520696E636F72706F726174696F6E206F662044312063656C6C732E20546865736520726573756C74732064656D6F6E737472617465642074686174206C6F6E672D7465726D2074726561746D656E74206F66204547434720696E63726561736573207468652065787072657373696F6E73206F66206F7374656F67656E69632067656E65732C20656C65766174657320414C5020616374697669747920616E64206576656E7475616C6C79207374696D756C61746573206D696E6572616C697A6174696F6E2C20696E207370697465206F662069747320696E68696269746F727920656666656374206F6E2070726F6C696665726174696F6E2E20546869732066696E64696E67207375676765737473207468617420746865207374696D756C61746F72792065666665637473206F662045474347206F6E206F7374656F67656E65736973206F66206D6573656E6368796D616C207374656D2063656C6C73206D6179206265206F6E65206F6620746865206D656368616E69736D73207468617420616C6C6F7720746561206472696E6B65727320746F20706F73736573732068696768657220424D442E, '', 0x4465706172746D656E74206F66204F7274686F7065646963732C20466163756C7479206F66204D65646963616C205363686F6F6C2C20436F6C6C656765206F66204D65646963696E652C204B616F687369756E67204D65646963616C20556E69766572736974792C204E6F20313030205368696820436875616E2031737420526F61642C204B616F687369756E6720436974792C2054616977616E, 'Taiwan', 'https://dx.doi.org/10.1007/s00198-005-1995-0', '1537482053', '3', 0x343023343223322332342333233437233933233423333223333323342334322339332333332333, '', '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('56', '10.1007/s00198-010-1209-2', '', 0x3230333036303230, 'Green tea polyphenols attenuate deterioration of bone microarchitecture in female rats with systemic chronic inflammation.', 'Shen CL,Yeh JK,Samathanam C,Cao JJ,Stoecker BJ,Dagda RY,Chyu MC,Dunn DM,Wang JS', 'Osteoporosis international : a journal established as result of cooperation between the European Foundation for Osteoporosis and the National Osteoporosis Foundation of the USA.', null, '3.856', '2', 0x32303131, 0x477265656E2074656120706F6C797068656E6F6C73202847545029206172652070726F6D6973696E67206167656E747320666F722070726576656E74696E6720626F6E65206C6F73732E2047545020737570706C656D656E746174696F6E207375737461696E6564206D6963726F61726368697465637475726520616E6420696D70726F76656420626F6E65207175616C69747920766961206120646563726561736520696E20696E666C616D6D6174696F6E2E2046696E64696E677320737567676573742061207369676E69666963616E7420726F6C6520666F722047545020696E20736B656C6574616C206865616C7468206F662070617469656E74732077697468206368726F6E696320696E666C616D6D6174696F6E2E494E54524F44554354494F4E3A2054686973207374756479206576616C75617465642077686574686572204754502063616E20726573746F726520626F6E65206D6963726F73747275637475726520616C6F6E6720776974682061206D6F6C6563756C6172206D656368616E69736D20696E20726174732077697468206368726F6E696320696E666C616D6D6174696F6E2E20412032205B706C616365626F2076732E206C69706F706F6C797361636368617269646520284C5053295DC397E2808932205B6E6F204754502076732E20302E3525204754502028772F762920696E206472696E6B696E672077617465725D20666163746F7269616C2064657369676E2077617320656D706C6F7965642E4D4554484F44533A2046656D616C65207261747320776572652061737369676E656420746F20666F75722067726F7570733A20706C616365626F2C204C50532C20706C616365626FE280892BE280894754502C20616E64204C5053E280892BE2808947545020666F72203132C2A07765656B732E20456666696361637920776173206576616C7561746564206279206578616D696E696E67206368616E67657320696E20626F6E65206D6963726F617263686974656374757265207573696E6720686973746F6D6F7270686F6D657472696320616E64206D6963726F636F6D707574656420746F6D6F6772617068696320616E616C7973657320616E6420627920626F6E6520737472656E677468207573696E67207468652074687265652D706F696E742062656E64696E6720746573742E204120706F737369626C65206D656368616E69736D20776173207374756469656420627920617373657373696E672074686520646966666572656E636520696E2074756D6F72206E6563726F73697320666163746F722DCEB12028544E462DCEB1292065787072657373696F6E20696E207469626961207573696E6720696D6D756E6F686973746F6368656D69737472792E524553554C54533A204C5053206C6F776572656420747261626563756C617220766F6C756D65206672616374696F6E2C20746869636B6E6573732C20616E6420626F6E6520666F726D6174696F6E20696E2070726F78696D616C207469626961207768696C6520696E6372656173696E67206F7374656F636C617374206E756D62657220616E64207375726661636520706572696D6574657220696E2070726F78696D616C20746962696120616E642065726F646564207375726661636520696E20656E646F636F72746963616C2074696269616C207368616674732E2047545020696E6372656173656420747261626563756C617220766F6C756D65206672616374696F6E20616E64206E756D62657220696E20626F74682066656D757220616E6420746962696120616E6420706572696F737465616C20626F6E6520666F726D6174696F6E207261746520696E2074696269616C20736861667473207768696C652064656372656173696E6720747261626563756C61722073657061726174696F6E20696E2070726F78696D616C20746962696120616E642065726F646564207375726661636520696E20656E646F636F72746963616C2074696269616C207368616674732E2054686572652077617320616E20696E746572616374696F6E206265747765656E204C505320616E642047545020696E20747261626563756C6172206E756D6265722C2073657061726174696F6E2C20626F6E6520666F726D6174696F6E2C20616E64206F7374656F636C617374206E756D62657220696E2070726F78696D616C2074696269612C20616E6420747261626563756C617220746869636B6E65737320616E64206E756D62657220696E2066656D75722E2047545020696D70726F7665642074686520737472656E677468206F662066656D75722C207768696C65207375707072657373696E6720544E462DCEB12065787072657373696F6E20696E2074696269612E434F4E434C5553494F4E3A20496E20636F6E636C7573696F6E2C2047545020737570706C656D656E746174696F6E206D6974696761746564206465746572696F726174696F6E206F6620626F6E65206D6963726F61726368697465637475726520616E6420696D70726F76656420626F6E6520696E7465677269747920696E20726174732077697468206368726F6E696320696E666C616D6D6174696F6E206279207375707072657373696E6720626F6E652065726F73696F6E20616E64206D6F64756C6174696E672063616E63656C6C6F757320616E6420656E646F636F72746963616C20626F6E6520636F6D706172746D656E74732C20726573756C74696E6720696E2061206C6172676572206E657420626F6E6520766F6C756D652E205375636820612070726F7465637469766520726F6C65206F6620475450206D61792062652064756520746F2061207375707072657373696F6E206F6620544E462DCEB12E, '', 0x4465706172746D656E74206F6620506174686F6C6F67792C205465786173205465636820556E6976657273697479204865616C746820536369656E6365732043656E7465722C204242203139382C203336303120347468205374726565742C204C7562626F636B2C205458203739343330393039372C20555341, '', 'https://dx.doi.org/10.1007/s00198-010-1209-2', '1537482386', '3', '', '', '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('57', '10.1016/j.jnutbio.2009.08.002', '', 0x3139393632323937, 'Green tea polyphenols mitigate bone loss of female rats in a chronic inflammation-induced bone loss model.', 'Shen CL,Yeh JK,Cao JJ,Tatum OL,Dagda RY,Wang JS', 'The Journal of nutritional biochemistry.', null, '0.000', '', 0x31353433343933343030, 0x54686520707572706F7365206F6620746869732073747564792077617320746F206578706C6F7265207468652062696F617661696C6162696C6974792C20656666696361637920616E64206D6F6C6563756C6172206D656368616E69736D73206F6620677265656E2074656120706F6C797068656E6F6C732028475450292072656C6174656420746F2070726576656E74696E6720626F6E65206C6F737320696E20726174732077697468206368726F6E696320696E666C616D6D6174696F6E2E20412032205B706C616365626F2076732E206C69706F706F6C797361636368617269646520284C5053295DC3973220286E6F204754502076732E20302E35252047545020696E206472696E6B696E672077617465722920666163746F7269616C2064657369676E20656E61626C656420746865206576616C756174696F6E206F662065666665637473206F66204C50532061646D696E697374726174696F6E2C20475450206C6576656C732C20616E64204C5053C39747545020696E746572616374696F6E2E205572696E6172792047545020636F6D706F6E656E747320616E6420382D687964726F78792D32272D64656F78796775616E6F73696E652028382D4F48644729206C6576656C7320776572652064657465726D696E656420627920686967682D7072657373757265206C6971756964206368726F6D61746F67726170687920666F722062696F617661696C6162696C69747920616E64206D6F6C6563756C6172206D656368616E69736D2C20726573706563746976656C792E20456666696361637920776173206576616C7561746564206279206578616D696E696E67206368616E67657320696E2066656D6F72616C206D696E6572616C20636F6E74656E742028424D432920616E642064656E736974792028424D4429207573696E67206475616C2D656E6572677920582D726179206162736F727074696F6D657472792C20616E6420626F6E65207475726E6F7665722062696F6D61726B657273205B6F7374656F63616C63696E20284F432920616E642074617274726174652D726573697374616E7420616369642070686F7370686174617365202854524150295D207573696E67207265737065637469766520454C495341206B6974732E20546865206D524E412065787072657373696F6E206F662074756D6F72206E6563726F73697320666163746F722DCEB12028544E462DCEB12920616E64206379636C6F6F787967656E6173652D322028434F582D322920696E2073706C65656E207761732064657465726D696E6564206279207265616C2D74696D652052542D5043522E204E656974686572204C50532061646D696E697374726174696F6E206E6F7220475450206C6576656C7320616666656374656420626F64792077656967687420616E642066656D6F72616C20626F6E652061726561207468726F7567686F75742074686520737475647920706572696F642E204F6E6C792047545020737570706C656D656E746174696F6E20726573756C74656420696E20696E63726561736564207572696E6172792065706967616C6C6F636174656368696E20616E6420657069636174656368696E20636F6E63656E74726174696F6E732E204C50532061646D696E697374726174696F6E206C656420746F206120646563726561736520696E2066656D757220424D4320616E6420424D442C20616E6420736572756D204F43206C6576656C732C2062757420616E20696E63726561736520696E20736572756D20545241502C207572696E61727920382D4F48644720616E642073706C65656E206D524E412065787072657373696F6E206F6620544E462DCEB120616E6420434F582D32206C6576656C732E2047545020737570706C656D656E746174696F6E20726573756C74656420696E206869676865722076616C75657320666F722066656D757220424D432C20424D4420616E6420736572756D204F432C20627574206C6F7765722076616C75657320666F7220736572756D20545241502C207572696E61727920382D4F48644720616E642073706C65656E206D524E412065787072657373696F6E206F6620544E462DCEB120616E6420434F582D32206C6576656C732E20576520636F6E636C756465207468617420475450206D697469676174657320626F6E65206C6F737320696E2061206368726F6E696320696E666C616D6D6174696F6E2D696E647563656420626F6E65206C6F7373206D6F64656C206279207265647563696E67206F7869646174697665207374726573732D696E64756365642064616D61676520616E6420696E666C616D6D6174696F6E2E, '', 0x4465706172746D656E74206F6620506174686F6C6F67792C205465786173205465636820556E6976657273697479204865616C746820536369656E6365732043656E7465722C204C7562626F636B2C205458203739343330393039372C20555341, '', 'https://linkinghub.elsevier.com/retrieve/pii/S0955-2863(09)00173-9', '1537482470', '3', 0x34302334322333233437233439233423333223333323333223343923343223333323342333, '', '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('58', '10.1093/ajcn/86.4.1243', '', 0x3137393231343131, 'Tea drinking is associated with benefits on bone density in older women.', 'Devine A,Hodgson JM,Dick IM,Prince RL', 'The American journal of clinical nutrition.', null, '0.000', '', '', 0x4241434B47524F554E443A20496D7061697265642068697020737472756374757265206173736573736564206279206475616C2D656E6572677920582D726179206162736F727074696F6D6574727920284458412920617265616C20626F6E65206D696E6572616C2064656E73697479202861424D442920697320616E20696E646570656E64656E7420707265646963746F7220666F72206F7374656F706F726F746963206869702066726163747572652E20536F6D652073747564696573207375676765737420746861742074656120696E74616B65206D61792070726F7465637420616761696E737420626F6E65206C6F73732E4F424A4543544956453A205573696E6720626F74682063726F73732D73656374696F6E616C20616E64206C6F6E6769747564696E616C2073747564792064657369676E732C207765206578616D696E6564207468652072656C6174696F6E206F662074656120636F6E73756D7074696F6E207769746820686970207374727563747572652E44455349474E3A2052616E646F6D6C792073656C656374656420776F6D656E20286E203D20313530302920616765642037302D383520792070617274696369706174656420696E206120352D792070726F737065637469766520747269616C20746F206576616C756174652077686574686572206F72616C2063616C6369756D20737570706C656D656E74732070726576656E74206F7374656F706F726F746963206672616374757265732E2061424D44206174207468652068697020776173206D65617375726564206174207965617273203120616E6420352077697468204458412E20412063726F73732D73656374696F6E616C20616E616C79736973206F662031303237206F6620746865736520776F6D656E20617420352079206173736573736564207468652072656C6174696F6E206F6620757375616C2074656120696E74616B652C206D65617375726564206279207573696E672061207175657374696F6E6E616972652C20776974682061424D442E20412070726F737065637469766520616E616C79736973206F662031363420776F6D656E206173736573736564207468652072656C6174696F6E206F662074656120696E74616B6520617420626173656C696E652C206D65617375726564206279207573696E6720612032342D68206469657461727920726563616C6C2C2077697468206368616E676520696E2061424D442066726F6D207965617273203120746F20352E524553554C54533A20496E207468652063726F73732D73656374696F6E616C20616E616C797369732C20746F74616C206869702061424D442077617320322E3825206772656174657220696E20746561206472696E6B6572732028783A203830363B203935252043493A203739372C20383135206D672F636D28322929207468616E20696E206E6F6E2D746561206472696E6B65727320283738343B203736342C20383033206D672F636D283229292028502026616D703B616D703B616D703B6C743B20302E3035292E20496E207468652070726F737065637469766520616E616C79736973206F766572203420792C20746561206472696E6B657273206C6F737420616E2061766572616765206F6620312E3625206F6620746865697220746F74616C206869702061424D4420282D33323B202D34352C202D3139206D672F636D283229292C20627574206E6F6E2D746561206472696E6B657273206C6F737420342E302520282D31333B202D32302C202D35206D672F636D283229292028502026616D703B616D703B616D703B6C743B20302E3035292E2041646A7573746D656E7420666F7220636F766172696174657320646964206E6F7420696E666C75656E63652074686520696E746572707265746174696F6E206F6620726573756C74732E434F4E434C5553494F4E3A20546561206472696E6B696E67206973206173736F636961746564207769746820707265736572766174696F6E206F66206869702073747275637475726520696E20656C6465726C7920776F6D656E2E20546869732066696E64696E672070726F766964657320667572746865722065766964656E6365206F66207468652062656E6566696369616C2065666665637473206F662074656120636F6E73756D7074696F6E206F6E2074686520736B656C65746F6E2E, '', 0x4E7574726974696F6E2050726F6772616D2C205363686F6F6C206F662045786572636973652C2042696F6D65646963616C20204865616C746820536369656E63652C20456469746820436F77616E20556E69766572736974792C20313030204A6F6F6E64616C75702044726976652C204A6F6F6E64616C75702057412036303237204175737472616C6961, '', 'https://academic.oup.com/ajcn/article-lookup/doi/10.1093/ajcn/86.4.1243', '1537482559', '3', 0x322334332335392333233437233439233423333223333223343923342333, '', '', '', null);
INSERT INTO `hisi_admin_finaly` VALUES ('59', 'https://doi.org/10.1016/j.lwt.2017.04.032', 'sciencedirect', 0x5330303233363433383137333032353137, 'Appropriately raising fermentation temperature beneficial to the increase of antioxidant activity and gallic acid content in Eurotium cristatum-fermented loose tea', 'Yanni Yao, Mengyao Wu, Yingjie Huang, Chuankai Li, Xin Pan, Wen Zhu, Youyi Huang', 'LWT - Food Science and Technology', null, '0.000', '', 0x5B5D, 0x54686572652077657265206C6974746C65207265706F727473206F6E2065666665637473206F66206665726D656E746174696F6E20636F6E646974696F6E73206F6E20746865207175616C69747920616E642066756E6374696F6E206F662046752D627269636B207465612E20496E20746869732073747564792C2067616C6C6963206163696420636F6E74656E747320616E6420616E74696F786964616E742070726F70657274696573206F66204575726F7469756D2063726973746174756D2D6665726D656E746564206C6F6F73652074656120617420646966666572656E74206665726D656E746174696F6E2074656D706572617475726573207765726520616E616C797A65642E2054686520726573756C74732073686F776564207468617420452EC382C2A063726973746174756D206665726D656E746174696F6E2068616420726573756C74656420696E20616E206F6276696F757320696E637265617365206F662074686520616E74696F786964616E74206162696C6974792C20616E64206665726D656E746174696F6E2074656D7065726174757265207369676E69666963616E746C792061666665637465642067616C6C6963206163696420616E6420616E74696F786964616E74206162696C697479206F6620452EC382C2A063726973746174756D2D6665726D656E746564206C6F6F7365207465612028702026616D703B6C743B20302E3035292E20417070726F7072696174656C792072616973696E67206665726D656E746174696F6E2074656D7065726174757265207369676E69666963616E746C7920636F6E747269627574657320746F20696E6372656173696E672067616C6C6963206163696420636F6E74656E7420616E6420616E74696F786964616E74206162696C697479206F6620452EC382C2A063726973746174756D2D6665726D656E746564206C6F6F7365207465612028702026616D703B6C743B20302E3035292E2047616C6C6963206163696420776173207369676E69666963616E746C7920636F7272656C61746564207769746820616E74696F786964616E7420616374697669747920696E20452EC382C2A063726973746174756D2D6665726D656E746564206C6F6F7365207465612028702026616D703B6C743B20302E3035292C20616E642069747320636F6E74656E74206665726D656E746564206174203337C382C2A0C382C2B043207265616368656420322E333825206F662074686520647279207765696768742C2073696D696C617220746F207468617420696E2047616C6C61206368696E656E7369732E2047616C6C69632061636964206265636F6D696E672061207072696D61727920616E74696F786964616E742063616E2062652061732061207175616C69747920696E646578206F6620452EC382C2A063726973746174756D2D6665726D656E746564206C6F6F7365207465612E2054686520726573756C74732070726F76696465206120626173697320666F7220696E6372656173696E672061637469766520636F6D706F6E656E747320616E642066756E6374696F6E616C20616374697669747920696E206D6963726F62652D6665726D656E746564207465617320627920636F6E74726F6C6C696E67206665726D656E746174696F6E2074656D70657261747572652E, 0x4575726F7469756D2063726973746174756D2C204665726D656E746174696F6E2074656D70657261747572652C2047616C6C696320616369642C20416E74696F786964616E74206162696C6974792C204665726D656E746174696F6E206D657461626F6C697465, 0x614D696E6973747279206F6620456475636174696F6E204B6579204C6162617479206F662048746963756C747572616C20506C616E742042696F6C6F67792C205374617465204B6579204C6162617479206F66204167726963756C747572616C204D6963726F62696F6C6F67792C20577568616E2043697479203433303037302C204368696E612C206254656120536369656E6365204465706172746D656E74206F662048746963756C74757265202046657374727920536369656E636520436F6C6C6567652C204875617A686F6E67204167726963756C747572616C20556E69766572736974792C20577568616E2043697479203433303037302C204368696E61, 'China', '[]', '1537625948', '3', 0x342333322333382334233332, 0xE586A0E7AA81E695A3E59B8AE88F8CE695A3E88CB6E58F91E88AB1EFBC8CE6B8A9E5BAA6E4B88EE68A97E6B0A7E58C96E883BDE58A9BE5A29EE5BCBAE698BEE89197E79BB8E585B3E38082E6B2A1E9A39FE5AD90E985B8E590ABE9878FE4B88EE68A97E6B0A7E58C96E6B4BBE680A7E6ADA3E79BB8E585B3EFBC8CE59BA0E6ADA4E58FAFE4BBA5E4BD9CE4B8BAE98791E88AB1E88CB6E79A84E59381E8B4A8E58F82E695B0E38082, 0x434F46434F, 0x467520627269636B20746561, null);

-- ----------------------------
-- Table structure for `hisi_admin_hook`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_hook`;
CREATE TABLE `hisi_admin_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统插件',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子来源[plugins.插件名，module.模块名]',
  `intro` varchar(200) NOT NULL DEFAULT '' COMMENT '钩子简介',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子表';

-- ----------------------------
-- Records of hisi_admin_hook
-- ----------------------------
INSERT INTO `hisi_admin_hook` VALUES ('1', '1', 'system_admin_index', '', '后台首页', '1', '1490885108', '1490885108');
INSERT INTO `hisi_admin_hook` VALUES ('2', '1', 'system_admin_tips', '', '后台所有页面提示', '1', '1490885108', '1490885108');
INSERT INTO `hisi_admin_hook` VALUES ('3', '1', 'system_annex_upload', '', '附件上传钩子，可扩展上传到第三方存储', '1', '1490885108', '1490885108');
INSERT INTO `hisi_admin_hook` VALUES ('4', '1', 'system_member_login', '', '会员登陆成功之后的动作', '1', '1490885108', '1490885108');
INSERT INTO `hisi_admin_hook` VALUES ('5', '1', 'system_member_register', '', '会员注册成功后的动作', '1', '1490885108', '1490885108');

-- ----------------------------
-- Table structure for `hisi_admin_hook_plugins`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_hook_plugins`;
CREATE TABLE `hisi_admin_hook_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(32) NOT NULL COMMENT '钩子id',
  `plugins` varchar(32) NOT NULL COMMENT '插件标识',
  `ctime` int(11) unsigned NOT NULL DEFAULT '0',
  `mtime` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子-插件对应表';

-- ----------------------------
-- Records of hisi_admin_hook_plugins
-- ----------------------------
INSERT INTO `hisi_admin_hook_plugins` VALUES ('1', 'system_admin_index', 'hisiphp', '1510063011', '1510063011', '0', '1');

-- ----------------------------
-- Table structure for `hisi_admin_id`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_id`;
CREATE TABLE `hisi_admin_id` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_id
-- ----------------------------
INSERT INTO `hisi_admin_id` VALUES ('36', '10011', '13');
INSERT INTO `hisi_admin_id` VALUES ('42', '10011', '17');
INSERT INTO `hisi_admin_id` VALUES ('43', '10011', '11');
INSERT INTO `hisi_admin_id` VALUES ('44', '10011', '15');
INSERT INTO `hisi_admin_id` VALUES ('45', '10012', '13');
INSERT INTO `hisi_admin_id` VALUES ('46', '10012', '11');
INSERT INTO `hisi_admin_id` VALUES ('47', '10013', '17');
INSERT INTO `hisi_admin_id` VALUES ('48', '10013', '15');
INSERT INTO `hisi_admin_id` VALUES ('49', '10011', '5');
INSERT INTO `hisi_admin_id` VALUES ('50', '10011', '7');
INSERT INTO `hisi_admin_id` VALUES ('51', '10012', '5');
INSERT INTO `hisi_admin_id` VALUES ('52', '10013', '13');
INSERT INTO `hisi_admin_id` VALUES ('53', '10013', '15');
INSERT INTO `hisi_admin_id` VALUES ('54', '10013', '5');
INSERT INTO `hisi_admin_id` VALUES ('70', '332239', '0');
INSERT INTO `hisi_admin_id` VALUES ('71', '332239', '0');
INSERT INTO `hisi_admin_id` VALUES ('72', '332239', '0');
INSERT INTO `hisi_admin_id` VALUES ('73', '324533', '0');
INSERT INTO `hisi_admin_id` VALUES ('74', '324533', '0');
INSERT INTO `hisi_admin_id` VALUES ('75', '324533', '0');
INSERT INTO `hisi_admin_id` VALUES ('76', '324532', '0');
INSERT INTO `hisi_admin_id` VALUES ('77', '324532', '0');
INSERT INTO `hisi_admin_id` VALUES ('78', '324532', '0');
INSERT INTO `hisi_admin_id` VALUES ('79', '390862', '0');
INSERT INTO `hisi_admin_id` VALUES ('82', '324534', '2');
INSERT INTO `hisi_admin_id` VALUES ('83', '324534', '22');
INSERT INTO `hisi_admin_id` VALUES ('84', '324534', '24');
INSERT INTO `hisi_admin_id` VALUES ('85', '425195', '2');
INSERT INTO `hisi_admin_id` VALUES ('86', '425195', '5');
INSERT INTO `hisi_admin_id` VALUES ('87', '425200', '0');
INSERT INTO `hisi_admin_id` VALUES ('88', '425200', '0');
INSERT INTO `hisi_admin_id` VALUES ('89', '425200', '0');
INSERT INTO `hisi_admin_id` VALUES ('90', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('91', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('92', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('93', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('94', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('95', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('96', '349942', '0');
INSERT INTO `hisi_admin_id` VALUES ('97', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('98', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('99', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('100', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('101', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('102', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('103', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('104', '353762', '0');
INSERT INTO `hisi_admin_id` VALUES ('105', '425279', '40');
INSERT INTO `hisi_admin_id` VALUES ('106', '425279', '42');
INSERT INTO `hisi_admin_id` VALUES ('107', '425279', '2');
INSERT INTO `hisi_admin_id` VALUES ('108', '425279', '43');
INSERT INTO `hisi_admin_id` VALUES ('109', '425279', '3');
INSERT INTO `hisi_admin_id` VALUES ('110', '425279', '29');
INSERT INTO `hisi_admin_id` VALUES ('111', '425279', '4');
INSERT INTO `hisi_admin_id` VALUES ('112', '425279', '32');
INSERT INTO `hisi_admin_id` VALUES ('113', '425279', '33');
INSERT INTO `hisi_admin_id` VALUES ('114', '425279', '2');
INSERT INTO `hisi_admin_id` VALUES ('115', '425522', '0');
INSERT INTO `hisi_admin_id` VALUES ('116', '425522', '0');
INSERT INTO `hisi_admin_id` VALUES ('120', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('121', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('122', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('123', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('124', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('125', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('126', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('127', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('128', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('129', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('130', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('131', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('132', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('133', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('134', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('135', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('136', '428552', '0');
INSERT INTO `hisi_admin_id` VALUES ('137', '425523', '0');
INSERT INTO `hisi_admin_id` VALUES ('138', '440710', '0');
INSERT INTO `hisi_admin_id` VALUES ('139', '440709', '0');
INSERT INTO `hisi_admin_id` VALUES ('140', '440711', '0');
INSERT INTO `hisi_admin_id` VALUES ('141', '440712', '0');
INSERT INTO `hisi_admin_id` VALUES ('142', '440713', '0');
INSERT INTO `hisi_admin_id` VALUES ('143', '440714', '0');
INSERT INTO `hisi_admin_id` VALUES ('144', '440715', '0');
INSERT INTO `hisi_admin_id` VALUES ('145', '440716', '0');
INSERT INTO `hisi_admin_id` VALUES ('151', '439731', '0');
INSERT INTO `hisi_admin_id` VALUES ('152', '439731', '0');
INSERT INTO `hisi_admin_id` VALUES ('153', '439731', '0');
INSERT INTO `hisi_admin_id` VALUES ('154', '439731', '0');
INSERT INTO `hisi_admin_id` VALUES ('155', '439731', '0');

-- ----------------------------
-- Table structure for `hisi_admin_kw`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_kw`;
CREATE TABLE `hisi_admin_kw` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_kw
-- ----------------------------
INSERT INTO `hisi_admin_kw` VALUES ('57', '茯茶', 'Fu brick tea', '1', '1537429369');
INSERT INTO `hisi_admin_kw` VALUES ('56', '蜂蜜', 'honey\r\nchild\r\nhealth', '1', '1537428112');
INSERT INTO `hisi_admin_kw` VALUES ('46', '健康问题', 'diabetes\r\nnaked oats', '1', '1533127357');
INSERT INTO `hisi_admin_kw` VALUES ('47', '试验类型', 'enzyme\r\ncell line\r\ndigetive simulator\r\nC-elegant\r\nrat\r\nmice\r\ndog\r\npig\r\nobservational study\r\ncase report\r\ncase analysis\r\ncross-sectional study\r\ncase-control study\r\ncohort study\r\nexperimental study\r\nclinical trail\r\npreventive trail\r\nintervention trail\r\noperative study\r\ntreatment studies\r\nrandomized controlled trail\r\nadaptive clinical trail\r\nnon-randomized  trail\r\ncohort study\r\ncase-control study\r\ncross-sectional study\r\necological study', '1', '1535347587');
INSERT INTO `hisi_admin_kw` VALUES ('48', '试验类型', 'enzyme\r\ncell line\r\ndigetive simulator\r\nC-elegant\r\nrat\r\nmice\r\ndog\r\npig\r\nobservational study\r\ncase report\r\ncase analysis\r\ncross-sectional study\r\ncase-control study\r\ncohort study\r\nexperimental study\r\nclinical trail\r\npreventive trail\r\nintervention trail\r\noperative study\r\ntreatment studies\r\nrandomized controlled trail\r\nadaptive clinical trail\r\nnon-randomized  trail\r\ncohort study\r\ncase-control study\r\ncross-sectional study\r\necological study', '1', '1535347590');
INSERT INTO `hisi_admin_kw` VALUES ('49', '糖代谢-作用机制', 'α-mylase\r\nGlucosidase\r\nsucrase\r\nDPPIV\r\nCaco-2\r\nGLP-1\r\nPPAR\r\ninsulin secretion\r\naldose reductase\r\nglucokinase\r\nglucose uptake', '1', '1535347625');
INSERT INTO `hisi_admin_kw` VALUES ('50', '茶', 'green tea\r\nwhite tea \r\nblack tea\r\ndark tea\r\npu-erh tea\r\nOloong tea', '1', '1535347676');
INSERT INTO `hisi_admin_kw` VALUES ('51', '茶叶成分', 'theaflavin\r\ntea Polyphenols\r\ncatechin\r\nepicatechin\r\nepigallocatechin\r\nEpigallocatechin gallate\r\nEpicatechin gallate\r\ntheaflavin-3-gallate\r\ntheaflavin-3′-gallate\r\ntheaflavin-3,3′-digallate\r\ndietary fiber\r\ncaffeine\r\ntheanine\r\nthearubigins\r\ntheabrownine\r\ntea polysaccharide\r\ntheasinesin\r\ngallic acid', '1', '1535347692');
INSERT INTO `hisi_admin_kw` VALUES ('52', '糖代谢异常类型', 'type 2 diabetes\r\ntype 1 diabetes\r\nprediabetes\r\ninsulin resistance\r\nimpaired glucose tolerance\r\nimpaired fasting glycaemia\r\npostprandial \r\nfasting\r\nglucose variability', '1', '1535347716');
INSERT INTO `hisi_admin_kw` VALUES ('54', '杂粮', 'Naked oats\r\noats\r\nTartary buckwheat, green buckwheat, bitter buckwheat\r\ncommon buckwheat，Japanese buckwheat，silverhull buckwheat\r\nbarley\r\nhighland barley\r\nFoxtail millet\r\nproso millet, broomcorn millet, common millet, broomtail millet, hog millet, Kashfi millet, red millet, white millet\r\n\r\nBlack rice\r\nbrown rice\r\nRed yeast rice\r\nseed of Jobs tears\r\nsorghum\r\ncorn\r\nRye\r\nwheat bran\r\nsoybean\r\nblack soybean\r\nadzuki bean;red mung bean;\r\nmung bean;moong bean, green gram\r\nAsparagus bean\r\npea\r\nkidney bean\r\nbroad bean, fava bean, faba bean, field bean, bell bean,  tic bean\r\nhyacinth bean, lablab-bean, bonavist bean/pea, dolichos bean, seim bean, lablab bean, Egyptian kidney bean, Indian bean, bataw and Australian pea\r\nKonjak\r\npotato\r\nsweet potato\r\nChinese yam\r\nTaro\r\namaranth\r\nSesame', '0', '1537421013');
INSERT INTO `hisi_admin_kw` VALUES ('55', '裸燕麦', 'naked oats', '1', '1537421137');
INSERT INTO `hisi_admin_kw` VALUES ('58', '藜麦', 'Chenopodium\r\nnutrition\r\nhealth', '1', '1537436095');
INSERT INTO `hisi_admin_kw` VALUES ('59', '茶与铁吸收', 'tea\r\niron\r\nabsorption\r\nanaemia', '1', '1537623084');
INSERT INTO `hisi_admin_kw` VALUES ('60', '红茶 餐后血糖', 'black tea\r\npostprandial glucose \r\ndiabetes\r\nhealth', '1', '1537626087');
INSERT INTO `hisi_admin_kw` VALUES ('61', '茶 体外发酵 便秘', 'tea \r\nin vitro fermentation\r\nconstipation', '1', '1537627095');
INSERT INTO `hisi_admin_kw` VALUES ('63', '茶  便秘', 'Camellia sinensis\r\nconstipation\r\ntea\r\nhealth', '1', '1537668800');
INSERT INTO `hisi_admin_kw` VALUES ('64', '茶 体外发酵 便秘', 'tea\r\nin vitro fermentation\r\nconstipation\r\nCamellia sinensis', '1', '1537668831');
INSERT INTO `hisi_admin_kw` VALUES ('66', '茶与肠道菌群', 'tea\r\ngut microbiota\r\nCamellia sinensis (L.) O. Ktze.', '1', '1541991032');
INSERT INTO `hisi_admin_kw` VALUES ('67', '茶与肠道菌群', 'tea\r\ngut microbiota\r\nCamellia sinensis', '1', '1542164835');
INSERT INTO `hisi_admin_kw` VALUES ('68', '姜', 'ginger\r\natherosclerosis', '1', '1543153596');
INSERT INTO `hisi_admin_kw` VALUES ('69', '姜-痛经', 'ginger\r\ndysmenorrhea', '1', '1543153634');
INSERT INTO `hisi_admin_kw` VALUES ('70', '黑茶 血脂', 'dark tea\r\nblood lipid\r\nclinical trial', '1', '1545486087');
INSERT INTO `hisi_admin_kw` VALUES ('72', '苦荞 糖', 'Fagopyrum tataricum\r\ndiabetes', '1', '1545615916');
INSERT INTO `hisi_admin_kw` VALUES ('71', '乌龙茶 减肥', 'oolong tea\r\nweight control\r\nobesity\r\nCamellia sinensis (L.) O. Ktze.\r\nclinical trial', '1', '1545486395');

-- ----------------------------
-- Table structure for `hisi_admin_label`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_label`;
CREATE TABLE `hisi_admin_label` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_label
-- ----------------------------
INSERT INTO `hisi_admin_label` VALUES ('13', '生物学', '生物学是研究生物(包括植物、动物和微生物)的结构、功能、发生和发展规律的科学。', '1', '1526895695');
INSERT INTO `hisi_admin_label` VALUES ('14', '化学', '化学是自然科学的一种，在分子、原子层次上研究物质的组成、性质、结构与变化规律；创造新物质的科学。', '1', '1526895741');
INSERT INTO `hisi_admin_label` VALUES ('15', '物理学', '物理学是研究物质运动最一般规律和物质基本结构的学科。', '1', '1526895781');
INSERT INTO `hisi_admin_label` VALUES ('16', '信息技术学', '信息技术学是研究计算机的设计与制造和利用计算机进行信息获取、表示、存储、处理、控制等的理论、原则、方法和技术的学科。', '1', '1526895910');
INSERT INTO `hisi_admin_label` VALUES ('17', '数学', '数学是研究数量、结构、变化、空间以及信息等概念的一门学科。', '1', '1526895946');

-- ----------------------------
-- Table structure for `hisi_admin_language`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_language`;
CREATE TABLE `hisi_admin_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '语言包名称',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '编码',
  `locale` varchar(255) NOT NULL DEFAULT '' COMMENT '本地浏览器语言编码',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT '图标',
  `pack` varchar(100) NOT NULL DEFAULT '' COMMENT '上传的语言包',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 语言包';

-- ----------------------------
-- Records of hisi_admin_language
-- ----------------------------
INSERT INTO `hisi_admin_language` VALUES ('1', '简体中文', 'zh-cn', 'zh-CN,zh-CN.UTF-8,zh-cn', '', '1', '1', '1');

-- ----------------------------
-- Table structure for `hisi_admin_levellabel`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_levellabel`;
CREATE TABLE `hisi_admin_levellabel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `score` float(10,0) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_levellabel
-- ----------------------------
INSERT INTO `hisi_admin_levellabel` VALUES ('1', '0', '根标签', '1', '0', '0');
INSERT INTO `hisi_admin_levellabel` VALUES ('2', '1', '实验类型', '1', '7', '1530870489');
INSERT INTO `hisi_admin_levellabel` VALUES ('3', '1', '健康类型', '1', '7', '1530870511');
INSERT INTO `hisi_admin_levellabel` VALUES ('4', '1', '原料类型', '1', '7', '1530870539');
INSERT INTO `hisi_admin_levellabel` VALUES ('5', '2', '物理实验', '1', '1', '1530870724');
INSERT INTO `hisi_admin_levellabel` VALUES ('6', '2', '化学实验', '1', '1', '1530870742');
INSERT INTO `hisi_admin_levellabel` VALUES ('22', '2', '酶生化', '1', '1', '1535347851');
INSERT INTO `hisi_admin_levellabel` VALUES ('24', '2', '细胞试验', '1', '2', '1535349650');
INSERT INTO `hisi_admin_levellabel` VALUES ('25', '2', '动物试验', '1', '3', '1535349698');
INSERT INTO `hisi_admin_levellabel` VALUES ('29', '3', '肥胖', '1', '1', '1536472199');
INSERT INTO `hisi_admin_levellabel` VALUES ('30', '3', '糖代谢异常', '1', '1', '1536472223');
INSERT INTO `hisi_admin_levellabel` VALUES ('31', '3', '抑郁症', '1', '1', '1536472237');
INSERT INTO `hisi_admin_levellabel` VALUES ('32', '4', '茶', '1', '1', '1536472300');
INSERT INTO `hisi_admin_levellabel` VALUES ('33', '32', '绿茶', '1', '2', '1536472349');
INSERT INTO `hisi_admin_levellabel` VALUES ('34', '32', '白茶', '1', '2', '1536472361');
INSERT INTO `hisi_admin_levellabel` VALUES ('35', '32', '黄茶', '1', '2', '1536472372');
INSERT INTO `hisi_admin_levellabel` VALUES ('36', '32', '乌龙茶', '1', '2', '1536472386');
INSERT INTO `hisi_admin_levellabel` VALUES ('37', '32', '红茶', '1', '2', '1536472396');
INSERT INTO `hisi_admin_levellabel` VALUES ('38', '32', '茯砖茶', '1', '2', '1536472416');
INSERT INTO `hisi_admin_levellabel` VALUES ('39', '38', '普洱茶', '1', '3', '1536472427');
INSERT INTO `hisi_admin_levellabel` VALUES ('40', '1', '组分', '1', '0', '1536472484');
INSERT INTO `hisi_admin_levellabel` VALUES ('41', '1', '化学成分', '1', '0', '1536472515');
INSERT INTO `hisi_admin_levellabel` VALUES ('42', '40', '茶多酚', '1', '1', '1536472524');
INSERT INTO `hisi_admin_levellabel` VALUES ('43', '2', '人群研究', '1', '4', '1536473217');
INSERT INTO `hisi_admin_levellabel` VALUES ('47', '3', '骨健康', '1', '0', '1537069056');
INSERT INTO `hisi_admin_levellabel` VALUES ('48', '47', '骨质减少 osteopenia', '1', '-1', '1537069619');
INSERT INTO `hisi_admin_levellabel` VALUES ('49', '47', '骨密度 bone mineral density', '1', '-1', '1537069650');
INSERT INTO `hisi_admin_levellabel` VALUES ('50', '47', '骨质疏松 osteoporosis', '1', '-1', '1537069672');
INSERT INTO `hisi_admin_levellabel` VALUES ('52', '47', '骨折 fracture', '1', '-1', '1537069708');
INSERT INTO `hisi_admin_levellabel` VALUES ('53', '40', '茶黄酮', '1', '-1', '1537069762');
INSERT INTO `hisi_admin_levellabel` VALUES ('54', '40', '茶多糖', '1', '-1', '1537069774');
INSERT INTO `hisi_admin_levellabel` VALUES ('56', '43', 'observational study', '1', '0', '1537069892');
INSERT INTO `hisi_admin_levellabel` VALUES ('57', '43', 'case report', '1', '0', '1537069912');
INSERT INTO `hisi_admin_levellabel` VALUES ('58', '43', 'case analysis', '1', '0', '1537069932');
INSERT INTO `hisi_admin_levellabel` VALUES ('59', '43', 'cross-sectional study', '1', '0', '1537069961');
INSERT INTO `hisi_admin_levellabel` VALUES ('60', '43', 'case-control study', '1', '0', '1537069989');
INSERT INTO `hisi_admin_levellabel` VALUES ('61', '43', 'cohort study', '1', '0', '1537070004');
INSERT INTO `hisi_admin_levellabel` VALUES ('62', '43', 'experimental study', '1', '0', '1537070022');
INSERT INTO `hisi_admin_levellabel` VALUES ('63', '43', 'clinical trail', '1', '0', '1537070044');
INSERT INTO `hisi_admin_levellabel` VALUES ('64', '43', 'preventive trail', '1', '0', '1537070066');
INSERT INTO `hisi_admin_levellabel` VALUES ('65', '43', 'intervention trail', '1', '0', '1537070082');
INSERT INTO `hisi_admin_levellabel` VALUES ('66', '43', 'operative study', '1', '0', '1537070099');
INSERT INTO `hisi_admin_levellabel` VALUES ('67', '43', 'treatment studies', '1', '0', '1537070114');
INSERT INTO `hisi_admin_levellabel` VALUES ('68', '43', 'randomized controlled trail', '1', '0', '1537070131');
INSERT INTO `hisi_admin_levellabel` VALUES ('69', '43', 'adaptive clinical trail', '1', '0', '1537070147');
INSERT INTO `hisi_admin_levellabel` VALUES ('70', '43', 'non-randomized  trail', '1', '0', '1537070168');
INSERT INTO `hisi_admin_levellabel` VALUES ('71', '43', 'cohort study', '1', '0', '1537070183');
INSERT INTO `hisi_admin_levellabel` VALUES ('72', '43', 'ecological study', '1', '0', '1537070210');
INSERT INTO `hisi_admin_levellabel` VALUES ('73', '2', '荟萃分析 meta-analysis', '1', '7', '1537070241');
INSERT INTO `hisi_admin_levellabel` VALUES ('74', '38', '茯砖茶', '1', '0', '1537624163');
INSERT INTO `hisi_admin_levellabel` VALUES ('75', '38', '茯砖茶', '1', '-1', '1537624204');
INSERT INTO `hisi_admin_levellabel` VALUES ('76', '32', '普洱茶', '1', '-1', '1537624324');
INSERT INTO `hisi_admin_levellabel` VALUES ('77', '40', '没食子酸', '1', '-1', '1537626415');
INSERT INTO `hisi_admin_levellabel` VALUES ('79', '42', '儿茶素', '1', '-1', '1537626472');
INSERT INTO `hisi_admin_levellabel` VALUES ('80', '42', '茶黄素', '1', '-1', '1537626484');
INSERT INTO `hisi_admin_levellabel` VALUES ('81', '42', '茶红素', '1', '-1', '1537626497');
INSERT INTO `hisi_admin_levellabel` VALUES ('82', '42', '茶褐素', '1', '-1', '1537626507');
INSERT INTO `hisi_admin_levellabel` VALUES ('83', '40', '咖啡因', '1', '0', '1537626526');
INSERT INTO `hisi_admin_levellabel` VALUES ('84', '40', '茶氨酸', '1', '-1', '1537626542');
INSERT INTO `hisi_admin_levellabel` VALUES ('85', '30', '空腹血糖', '1', '-1', '1537626615');
INSERT INTO `hisi_admin_levellabel` VALUES ('86', '30', '餐后血糖', '1', '-1', '1537626632');
INSERT INTO `hisi_admin_levellabel` VALUES ('87', '30', '胰岛素抵抗', '1', '-1', '1537626648');
INSERT INTO `hisi_admin_levellabel` VALUES ('88', '3', '肠道微生态', '1', '-1', '1537626678');
INSERT INTO `hisi_admin_levellabel` VALUES ('89', '30', '2型糖尿病', '1', '-1', '1537626700');
INSERT INTO `hisi_admin_levellabel` VALUES ('90', '30', '1型糖尿病', '1', '-1', '1537626721');
INSERT INTO `hisi_admin_levellabel` VALUES ('92', '47', '骨细胞分化 osteoclast differentiation', '1', '0', '1543472815');
INSERT INTO `hisi_admin_levellabel` VALUES ('93', '47', '骨细胞分化 osteoclast differentiation', '1', '-1', '1543472817');

-- ----------------------------
-- Table structure for `hisi_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_log`;
CREATE TABLE `hisi_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `url` varchar(200) DEFAULT '',
  `param` text,
  `remark` varchar(255) DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '1',
  `ip` varchar(128) DEFAULT '',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3415 DEFAULT CHARSET=utf8 COMMENT='[系统] 操作日志';

-- ----------------------------
-- Table structure for `hisi_admin_member`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_member`;
CREATE TABLE `hisi_admin_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级ID',
  `nick` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `mobile` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '手机号',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '可用金额',
  `frozen_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
  `income` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收入统计',
  `expend` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '开支统计',
  `exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  `integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `frozen_integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '冻结积分',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别(1男，0女)',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `last_login_ip` varchar(128) NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `login_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到期时间(0永久)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0禁用，1正常)',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000002 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 会员表';

-- ----------------------------
-- Records of hisi_admin_member
-- ----------------------------
INSERT INTO `hisi_admin_member` VALUES ('1000000', '1', '123456', 'test', '0', '', '$2y$10$RqIjt7IIJW1hFrHG9zk.zeeFhZbNPYL/wq1wmDGIY0cV2DDWMDwyC', '0.00', '0.00', '0.00', '0.00', '0', '0', '0', '1', '', '', '0', '0', '0', '1', '1493274686');
INSERT INTO `hisi_admin_member` VALUES ('1000001', '1', '小2', 'people2', '13588515236', '1234567@qq.com', '$2y$10$pwsmVRBJqUlnY8vkHYPaLOKorrWhJ3DEGMXMTTP0Jk36unEHeCr3S', '0.00', '0.00', '0.00', '0.00', '0', '0', '0', '1', '', '', '0', '0', '0', '1', '1524622623');

-- ----------------------------
-- Table structure for `hisi_admin_member_level`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_member_level`;
CREATE TABLE `hisi_admin_member_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT '等级名称',
  `min_exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最小经验值',
  `max_exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最大经验值',
  `discount` int(2) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率(%)',
  `intro` varchar(255) NOT NULL COMMENT '等级简介',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认等级',
  `expire` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员有效期(天)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[系统] 会员等级';

-- ----------------------------
-- Records of hisi_admin_member_level
-- ----------------------------
INSERT INTO `hisi_admin_member_level` VALUES ('1', '注册会员', '0', '0', '100', '99', '1', '0', '1', '0', '1526628702');
INSERT INTO `hisi_admin_member_level` VALUES ('2', '高级会员', '100', '1000', '80', '', '0', '0', '1', '1524622847', '1526469517');

-- ----------------------------
-- Table structure for `hisi_admin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_menu`;
CREATE TABLE `hisi_admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID(快捷菜单专用)',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL COMMENT '模块名或插件名，插件名格式:plugins.插件名',
  `title` varchar(20) NOT NULL COMMENT '菜单标题',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-shezhi' COMMENT '菜单图标',
  `url` varchar(200) NOT NULL COMMENT '链接地址(模块/控制器/方法)',
  `param` varchar(200) NOT NULL DEFAULT '' COMMENT '扩展参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '打开方式(_blank,_self)',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `debug` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开发模式可见',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单，系统菜单不可删除',
  `nav` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为菜单显示，1显示0不显示',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示，0隐藏',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 管理菜单';

-- ----------------------------
-- Records of hisi_admin_menu
-- ----------------------------
INSERT INTO `hisi_admin_menu` VALUES ('2', '0', '0', 'admin', '系统', '', 'admin/system', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('4', '0', '2', 'admin', '快速开始', 'aicon ai-caidan', 'admin/quick', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('6', '0', '2', 'admin', '系统功能', 'aicon ai-gongneng', 'admin/system', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('7', '0', '2', 'admin', '会员管理', 'aicon ai-huiyuanliebiao', 'admin/member', '', '_self', '20', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('8', '0', '2', 'admin', '系统扩展', 'aicon ai-shezhi', 'admin/extend', '', '_self', '30', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('9', '0', '2', 'admin', '开发专用', 'aicon ai-doubleleft', 'admin/develop', '', '_self', '40', '1', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('10', '0', '6', 'admin', '系统设置', 'aicon ai-icon01', 'admin/system/index', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('11', '0', '6', 'admin', '配置管理', 'aicon ai-peizhiguanli', 'admin/config/index', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('12', '0', '6', 'admin', '系统菜单', 'aicon ai-systemmenu', 'admin/menu/index', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('13', '0', '6', 'admin', '管理员角色', '', 'admin/user/role', '', '_self', '4', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('14', '0', '6', 'admin', '系统管理员', 'aicon ai-tubiao05', 'admin/user/index', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('15', '0', '6', 'admin', '系统日志', 'aicon ai-xitongrizhi-tiaoshi', 'admin/log/index', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('16', '0', '6', 'admin', '附件管理', '', 'admin/annex/index', '', '_self', '7', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('17', '0', '8', 'admin', '模块管理', 'aicon ai-mokuaiguanli1', 'admin/module/index', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('18', '0', '8', 'admin', '插件管理', 'aicon ai-chajianguanli', 'admin/plugins/index', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('19', '0', '8', 'admin', '钩子管理', 'aicon ai-icon-test', 'admin/hook/index', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('20', '0', '7', 'admin', '会员等级', 'aicon ai-huiyuandengji', 'admin/member/level', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('21', '0', '7', 'admin', '会员列表', 'aicon ai-huiyuanliebiao', 'admin/member/index', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('22', '0', '9', 'admin', '[示例]列表模板', '', 'admin/develop/lists', '', '_self', '1', '1', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('23', '0', '9', 'admin', '[示例]编辑模板', '', 'admin/develop/edit', '', '_self', '2', '1', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('24', '0', '4', 'admin', '后台首页', 'aicon ai-shouye', 'admin/index/index', '', '_self', '100', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('25', '0', '4', 'admin', '清空缓存', '', 'admin/index/clear', '', '_self', '2', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('26', '0', '12', 'admin', '添加菜单', '', 'admin/menu/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('27', '0', '12', 'admin', '修改菜单', '', 'admin/menu/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('28', '0', '12', 'admin', '删除菜单', '', 'admin/menu/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('29', '0', '12', 'admin', '状态设置', '', 'admin/menu/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('30', '0', '12', 'admin', '排序设置', '', 'admin/menu/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('31', '0', '12', 'admin', '添加快捷菜单', '', 'admin/menu/quick', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('32', '0', '12', 'admin', '导出菜单', '', 'admin/menu/export', '', '_self', '7', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('33', '0', '13', 'admin', '添加角色', '', 'admin/user/addrole', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('34', '0', '13', 'admin', '修改角色', '', 'admin/user/editrole', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('35', '0', '13', 'admin', '删除角色', '', 'admin/user/delrole', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('36', '0', '13', 'admin', '状态设置', '', 'admin/user/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('37', '0', '14', 'admin', '添加管理员', '', 'admin/user/adduser', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('38', '0', '14', 'admin', '修改管理员', '', 'admin/user/edituser', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('39', '0', '14', 'admin', '删除管理员', '', 'admin/user/deluser', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('40', '0', '14', 'admin', '状态设置', '', 'admin/user/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('41', '0', '14', 'admin', '个人信息设置', '', 'admin/user/info', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('42', '0', '18', 'admin', '安装插件', '', 'admin/plugins/install', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('43', '0', '18', 'admin', '卸载插件', '', 'admin/plugins/uninstall', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('44', '0', '18', 'admin', '删除插件', '', 'admin/plugins/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('45', '0', '18', 'admin', '状态设置', '', 'admin/plugins/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('46', '0', '18', 'admin', '设计插件', '', 'admin/plugins/design', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('47', '0', '18', 'admin', '运行插件', '', 'admin/plugins/run', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('48', '0', '18', 'admin', '更新插件', '', 'admin/plugins/update', '', '_self', '7', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('49', '0', '18', 'admin', '插件配置', '', 'admin/plugins/setting', '', '_self', '8', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('50', '0', '19', 'admin', '添加钩子', '', 'admin/hook/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('51', '0', '19', 'admin', '修改钩子', '', 'admin/hook/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('52', '0', '19', 'admin', '删除钩子', '', 'admin/hook/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('53', '0', '19', 'admin', '状态设置', '', 'admin/hook/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('54', '0', '19', 'admin', '插件排序', '', 'admin/hook/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('55', '0', '11', 'admin', '添加配置', '', 'admin/config/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('56', '0', '11', 'admin', '修改配置', '', 'admin/config/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('57', '0', '11', 'admin', '删除配置', '', 'admin/config/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('58', '0', '11', 'admin', '状态设置', '', 'admin/config/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('59', '0', '11', 'admin', '排序设置', '', 'admin/config/sort', '', '_self', '50', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('60', '0', '10', 'admin', '基础配置', '', 'admin/system/index', 'group=base', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('61', '0', '10', 'admin', '系统配置', '', 'admin/system/index', 'group=sys', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('62', '0', '10', 'admin', '上传配置', '', 'admin/system/index', 'group=upload', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('63', '0', '10', 'admin', '开发配置', '', 'admin/system/index', 'group=develop', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('64', '0', '17', 'admin', '设计模块', '', 'admin/module/design', '', '_self', '6', '1', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('65', '0', '17', 'admin', '安装模块', '', 'admin/module/install', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('66', '0', '17', 'admin', '卸载模块', '', 'admin/module/uninstall', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('67', '0', '17', 'admin', '状态设置', '', 'admin/module/status', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('68', '0', '17', 'admin', '设置默认模块', '', 'admin/module/setdefault', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('69', '0', '17', 'admin', '删除模块', '', 'admin/module/del', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('70', '0', '21', 'admin', '添加会员', '', 'admin/member/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('71', '0', '21', 'admin', '修改会员', '', 'admin/member/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('72', '0', '21', 'admin', '删除会员', '', 'admin/member/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('73', '0', '21', 'admin', '状态设置', '', 'admin/member/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('74', '0', '21', 'admin', '[弹窗]会员选择', '', 'admin/member/pop', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('75', '0', '20', 'admin', '添加会员等级', '', 'admin/member/addlevel', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('76', '0', '20', 'admin', '修改会员等级', '', 'admin/member/editlevel', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('77', '0', '20', 'admin', '删除会员等级', '', 'admin/member/dellevel', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('78', '0', '16', 'admin', '附件上传', '', 'admin/annex/upload', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('79', '0', '16', 'admin', '删除附件', '', 'admin/annex/del', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('80', '0', '8', 'admin', '在线升级', 'aicon ai-iconfontshengji', 'admin/upgrade/index', '', '_self', '4', '0', '1', '1', '1', '1491352728');
INSERT INTO `hisi_admin_menu` VALUES ('81', '0', '80', 'admin', '获取升级列表', '', 'admin/upgrade/lists', '', '_self', '0', '0', '1', '1', '1', '1491353504');
INSERT INTO `hisi_admin_menu` VALUES ('82', '0', '80', 'admin', '安装升级包', '', 'admin/upgrade/install', '', '_self', '0', '0', '1', '1', '1', '1491353568');
INSERT INTO `hisi_admin_menu` VALUES ('83', '0', '80', 'admin', '下载升级包', '', 'admin/upgrade/download', '', '_self', '0', '0', '1', '1', '1', '1491395830');
INSERT INTO `hisi_admin_menu` VALUES ('84', '0', '6', 'admin', '数据库管理', 'aicon ai-shujukuguanli', 'admin/database/index', '', '_self', '8', '0', '1', '1', '1', '1491461136');
INSERT INTO `hisi_admin_menu` VALUES ('85', '0', '84', 'admin', '备份数据库', '', 'admin/database/export', '', '_self', '0', '0', '1', '1', '1', '1491461250');
INSERT INTO `hisi_admin_menu` VALUES ('86', '0', '84', 'admin', '恢复数据库', '', 'admin/database/import', '', '_self', '0', '0', '1', '1', '1', '1491461315');
INSERT INTO `hisi_admin_menu` VALUES ('87', '0', '84', 'admin', '优化数据库', '', 'admin/database/optimize', '', '_self', '0', '0', '1', '1', '1', '1491467000');
INSERT INTO `hisi_admin_menu` VALUES ('88', '0', '84', 'admin', '删除备份', '', 'admin/database/del', '', '_self', '0', '0', '1', '1', '1', '1491467058');
INSERT INTO `hisi_admin_menu` VALUES ('89', '0', '84', 'admin', '修复数据库', '', 'admin/database/repair', '', '_self', '0', '0', '1', '1', '1', '1491880879');
INSERT INTO `hisi_admin_menu` VALUES ('90', '0', '21', 'admin', '设置默认等级', '', 'admin/member/setdefault', '', '_self', '0', '0', '1', '1', '1', '1491966585');
INSERT INTO `hisi_admin_menu` VALUES ('91', '0', '10', 'admin', '数据库配置', '', 'admin/system/index', 'group=databases', '_self', '5', '0', '1', '0', '1', '1492072213');
INSERT INTO `hisi_admin_menu` VALUES ('92', '0', '17', 'admin', '模块打包', '', 'admin/module/package', '', '_self', '7', '0', '1', '1', '1', '1492134693');
INSERT INTO `hisi_admin_menu` VALUES ('93', '0', '18', 'admin', '插件打包', '', 'admin/plugins/package', '', '_self', '0', '0', '1', '1', '1', '1492134743');
INSERT INTO `hisi_admin_menu` VALUES ('94', '0', '17', 'admin', '主题管理', '', 'admin/module/theme', '', '_self', '8', '0', '1', '1', '1', '1492433470');
INSERT INTO `hisi_admin_menu` VALUES ('95', '0', '17', 'admin', '设置默认主题', '', 'admin/module/setdefaulttheme', '', '_self', '9', '0', '1', '1', '1', '1492433618');
INSERT INTO `hisi_admin_menu` VALUES ('96', '0', '17', 'admin', '删除主题', '', 'admin/module/deltheme', '', '_self', '10', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('97', '0', '6', 'admin', '语言包管理', '', 'admin/language/index', '', '_self', '11', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('98', '0', '97', 'admin', '添加语言包', '', 'admin/language/add', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('99', '0', '97', 'admin', '修改语言包', '', 'admin/language/edit', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('100', '0', '97', 'admin', '删除语言包', '', 'admin/language/del', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('101', '0', '97', 'admin', '排序设置', '', 'admin/language/sort', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('102', '0', '97', 'admin', '状态设置', '', 'admin/language/status', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('103', '0', '16', 'admin', '收藏夹图标上传', '', 'admin/annex/favicon', '', '_self', '3', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('104', '0', '17', 'admin', '导入模块', '', 'admin/module/import', '', '_self', '11', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('105', '0', '4', 'admin', '系统信息', 'aicon ai-icon01', 'admin/index/sysinfo', '', '_self', '100', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('106', '0', '4', 'admin', '布局切换', '', 'admin/user/iframe', '', '_self', '100', '0', '0', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('107', '0', '15', 'admin', '删除日志', '', 'admin/log/del', 'table=admin_log', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('108', '0', '15', 'admin', '清空日志', '', 'admin/log/clear', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('109', '0', '17', 'admin', '编辑模块', '', 'admin/module/edit', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('110', '0', '17', 'admin', '模块图标上传', '', 'admin/module/icon', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('111', '0', '18', 'admin', '导入插件', '', 'admin/plugins/import', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('112', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('113', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('114', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('115', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('116', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('117', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('118', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('119', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('120', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('121', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('122', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('123', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('124', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('125', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('126', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('127', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('128', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('129', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('130', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('131', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('132', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('133', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('134', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('135', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('136', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('137', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('138', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('139', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('140', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('141', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('142', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('143', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('144', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('145', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('146', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('147', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('148', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('149', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('150', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('151', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('152', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('153', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('154', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('155', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('156', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('157', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('158', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('159', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('160', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('161', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('162', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('163', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('164', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('165', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('166', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('167', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('168', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('169', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('170', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('171', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('172', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('173', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('174', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('175', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('176', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('177', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('178', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('179', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('180', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('181', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('182', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('183', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('184', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('185', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('186', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('187', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('188', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('189', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('190', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('191', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('192', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('193', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('194', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('195', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('196', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('197', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('198', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('199', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('200', '0', '4', 'admin', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_admin_menu` VALUES ('212', '0', '0', 'cofco', '数据分析', 'aicon ai-shezhi', 'cofco', '', '_self', '200', '0', '0', '1', '1', '1522326412');
INSERT INTO `hisi_admin_menu` VALUES ('213', '0', '212', 'cofco', '爬虫管理', 'aicon ai-chajianguanli', 'cofco/spider', '', '_self', '0', '0', '1', '1', '1', '1522326707');
INSERT INTO `hisi_admin_menu` VALUES ('214', '0', '213', 'cofco', '使用必读', 'aicon ai-error', 'cofco/spider/index', '', '_self', '0', '0', '1', '1', '1', '1522326764');
INSERT INTO `hisi_admin_menu` VALUES ('217', '0', '274', 'cofco', '关键词组列表', 'aicon ai-icon-test', 'cofco/spider/keywords_list', '', '_self', '5', '0', '1', '1', '1', '1522384176');
INSERT INTO `hisi_admin_menu` VALUES ('219', '0', '212', 'cofco', '数据筛选', 'aicon ai-shujukuguanli', 'cofco/labeldata', '', '_self', '10', '0', '1', '1', '1', '1522386289');
INSERT INTO `hisi_admin_menu` VALUES ('220', '0', '274', 'cofco', '文献上传', 'aicon ai-huiyuandengji', 'cofco/labeldata/pending_padd', '', '_self', '10', '0', '1', '0', '1', '1522386401');
INSERT INTO `hisi_admin_menu` VALUES ('221', '0', '274', 'cofco', '文献上传', 'aicon ai-huiyuanliebiao', 'cofco/labeldata/crawurl', '', '_self', '20', '0', '1', '1', '1', '1522386430');
INSERT INTO `hisi_admin_menu` VALUES ('222', '0', '274', 'cofco', '审核及标注', 'aicon ai-clear', 'cofco/labeldata/pending_list', '', '_self', '30', '0', '1', '1', '1', '1522386467');
INSERT INTO `hisi_admin_menu` VALUES ('223', '0', '219', 'cofco', '标签列表', 'typcn typcn-beer', 'cofco/labeldata/tag_list', '', '_self', '5', '0', '0', '0', '1', '1522386522');
INSERT INTO `hisi_admin_menu` VALUES ('224', '0', '219', 'cofco', '使用必读', 'aicon ai-error', 'cofco/labeldata/index', '', '_self', '0', '0', '1', '1', '1', '1522386631');
INSERT INTO `hisi_admin_menu` VALUES ('225', '0', '219', 'cofco', '标签分组', 'aicon ai-xitongrizhi-tiaoshi', 'cofco/labeldata/label_list', '', '_self', '2', '0', '0', '0', '1', '1522387090');
INSERT INTO `hisi_admin_menu` VALUES ('226', '0', '212', 'cofco', '数据分析', 'typcn typcn-flow-switch', 'cofco/statistic', '', '_self', '20', '0', '1', '1', '1', '1522388011');
INSERT INTO `hisi_admin_menu` VALUES ('227', '0', '226', 'cofco', '使用必读', 'aicon ai-error', 'cofco/statistic/index', '', '_self', '0', '0', '1', '1', '1', '1522388052');
INSERT INTO `hisi_admin_menu` VALUES ('229', '0', '217', 'cofco', '状态设置', 'typcn typcn-adjust-contrast', 'cofco/spider/status', '', '_self', '0', '0', '1', '0', '1', '1524719716');
INSERT INTO `hisi_admin_menu` VALUES ('230', '0', '217', 'cofco', '关键词添加', 'aicon ai-tianjia', 'cofco/spider/keywords_add', '', '_self', '0', '0', '1', '0', '1', '1524725117');
INSERT INTO `hisi_admin_menu` VALUES ('231', '0', '217', 'cofco', '关键词修改', 'aicon ai-success', 'cofco/spider/keywords_edit', '', '_self', '0', '0', '0', '1', '1', '1524730429');
INSERT INTO `hisi_admin_menu` VALUES ('232', '0', '217', 'cofco', '关键词删除', 'aicon ai-cha', 'cofco/spider/keywords_del', '', '_self', '0', '0', '1', '0', '1', '1524733912');
INSERT INTO `hisi_admin_menu` VALUES ('233', '0', '225', 'cofco', '分组添加', 'aicon ai-tianjia', 'cofco/labeldata/label_add', '', '_self', '0', '0', '1', '1', '1', '1525426394');
INSERT INTO `hisi_admin_menu` VALUES ('234', '0', '225', 'cofco', '分组删除', 'aicon ai-cha', 'cofco/labeldata/label_del', '', '_self', '0', '0', '1', '1', '1', '1525426789');
INSERT INTO `hisi_admin_menu` VALUES ('235', '0', '225', 'cofco', '分组修改', 'aicon ai-gou', 'cofco/labeldata/label_edit', '', '_self', '0', '0', '1', '1', '1', '1525426876');
INSERT INTO `hisi_admin_menu` VALUES ('236', '0', '225', 'cofco', '分组状态', 'aicon ai-icon01', 'cofco/labeldata/status', '', '_self', '0', '0', '1', '1', '1', '1525426985');
INSERT INTO `hisi_admin_menu` VALUES ('237', '0', '223', 'cofco', '标签添加', 'aicon ai-tianjia', 'cofco/labeldata/tag_add', '', '_self', '0', '0', '1', '0', '1', '1525852980');
INSERT INTO `hisi_admin_menu` VALUES ('239', '0', '223', 'cofco', '标签删除', 'aicon ai-jinyong', 'cofco/labeldata/tag_del', '', '_self', '0', '0', '1', '0', '1', '1526023405');
INSERT INTO `hisi_admin_menu` VALUES ('240', '0', '222', 'cofco', '列表删除', 'aicon ai-cha', 'cofco/labeldata/pending_del', '', '_self', '0', '0', '0', '1', '1', '1526210042');
INSERT INTO `hisi_admin_menu` VALUES ('241', '0', '222', 'cofco', '列表添加', 'aicon ai-tianjia', 'cofco/labeldata/pending_add', '', '_self', '0', '0', '0', '0', '1', '1526210288');
INSERT INTO `hisi_admin_menu` VALUES ('242', '0', '222', 'cofco', '列表批注', 'aicon ai-gou', 'cofco/labeldata/pending_edit', '', '_self', '0', '0', '0', '1', '1', '1526210363');
INSERT INTO `hisi_admin_menu` VALUES ('243', '0', '222', 'cofco', '【弹框】待审详情页', 'typcn typcn-arrow-move', 'cofco/labeldata/pop', '', '_self', '0', '0', '0', '1', '1', '1526468816');
INSERT INTO `hisi_admin_menu` VALUES ('245', '0', '274', 'cofco', '文献上传', 'aicon ai-caidan', 'cofco/labeldata/task_list1', '', '_self', '0', '0', '1', '0', '1', '1526563089');
INSERT INTO `hisi_admin_menu` VALUES ('246', '0', '245', 'cofco', '爬虫任务停止', 'aicon ai-caidan', 'cofco/labeldata/task_stop', '', '_self', '0', '0', '0', '1', '1', '1526563256');
INSERT INTO `hisi_admin_menu` VALUES ('247', '0', '245', 'cofco', '爬虫任务添加', 'aicon ai-tianjia', 'cofco/labeldata/task_add', '', '_self', '0', '0', '0', '1', '1', '1526563310');
INSERT INTO `hisi_admin_menu` VALUES ('248', '0', '245', 'cofco', '爬虫任务修改', 'aicon ai-qiyong', 'cofco/labeldata/task_edit', '', '_self', '0', '0', '0', '1', '1', '1526563357');
INSERT INTO `hisi_admin_menu` VALUES ('249', '0', '245', 'cofco', '状态设置', 'fa fa-adjust', 'cofco/labeldata/status', '', '_self', '0', '0', '1', '0', '1', '1526565176');
INSERT INTO `hisi_admin_menu` VALUES ('250', '0', '223', 'cofco', '标签修改', 'aicon ai-qiyong', 'cofco/labeldata/tag_edit', '', '_self', '0', '0', '0', '1', '1', '1526893264');
INSERT INTO `hisi_admin_menu` VALUES ('251', '0', '217', 'cofco', '【弹框】关键词选择', 'aicon ai-quanping', 'cofco/labeldata/keywords_pop', '', '_self', '0', '0', '0', '1', '1', '1527065472');
INSERT INTO `hisi_admin_menu` VALUES ('252', '0', '223', 'cofco', '标签状态', 'aicon ai-systemmenu', 'cofco/labeldata/status', '', '_self', '0', '0', '0', '0', '1', '1527243516');
INSERT INTO `hisi_admin_menu` VALUES ('253', '0', '245', 'cofco', '爬虫任务暂停', 'typcn typcn-media-pause', 'cofco/labeldata/task_pause', '', '_self', '0', '0', '0', '0', '1', '1527382562');
INSERT INTO `hisi_admin_menu` VALUES ('254', '0', '245', 'cofco', '爬虫任务继续', 'typcn typcn-media-play', 'cofco/labeldata/task_continue', '', '_self', '0', '0', '0', '0', '1', '1527382628');
INSERT INTO `hisi_admin_menu` VALUES ('255', '0', '275', 'cofco', '权重法', 'typcn typcn-calculator', 'cofco/statistic/count', '', '_self', '0', '0', '1', '1', '1', '1527488271');
INSERT INTO `hisi_admin_menu` VALUES ('256', '0', '221', 'cofco', '辅助添加', 'aicon ai-tianjia', 'cofco/labeldata/pending_padd', '', '_self', '0', '0', '0', '0', '1', '1527588814');
INSERT INTO `hisi_admin_menu` VALUES ('257', '0', '274', 'cofco', '已审核', 'aicon ai-caidan', 'cofco/labeldata/finaly_list', '', '_self', '40', '0', '1', '1', '1', '1527832308');
INSERT INTO `hisi_admin_menu` VALUES ('259', '0', '245', 'cofco', '爬虫任务重启', 'aicon ai-chu', 'cofco/labeldata/task_startforce', '', '_self', '0', '0', '0', '0', '1', '1527854157');
INSERT INTO `hisi_admin_menu` VALUES ('260', '0', '257', 'cofco', '最终列表修改', 'aicon ai-qiyong', 'cofco/labeldata/finaly_edit', '', '_self', '0', '0', '0', '0', '1', '1528721747');
INSERT INTO `hisi_admin_menu` VALUES ('261', '0', '274', 'cofco', '标签列表', 'aicon ai-caidan', 'cofco/labeldata/levellabel', '', '_self', '6', '0', '1', '1', '1', '1529751561');
INSERT INTO `hisi_admin_menu` VALUES ('262', '0', '261', 'cofco', '标签添加', 'aicon ai-tianjia', 'cofco/labeldata/levellabel_add', '', '_self', '0', '0', '0', '1', '1', '1530180752');
INSERT INTO `hisi_admin_menu` VALUES ('263', '0', '261', 'cofco', '标签状态', 'aicon ai-systemmenu', 'cofco/labeldata/status', '', '_self', '0', '0', '0', '0', '1', '1530180919');
INSERT INTO `hisi_admin_menu` VALUES ('264', '0', '261', 'cofco', '标签修改', 'aicon ai-qiyong', 'cofco/labeldata/levellabel_edit', '', '_self', '0', '0', '0', '1', '1', '1530180996');
INSERT INTO `hisi_admin_menu` VALUES ('265', '0', '261', 'cofco', '标签删除', 'aicon ai-cha', 'cofco/labeldata/levellabel_del', '', '_self', '0', '0', '0', '1', '1', '1530181050');
INSERT INTO `hisi_admin_menu` VALUES ('266', '0', '257', 'cofco', '原网址', 'aicon ai-xitongrizhi-tiaoshi', 'cofco/labeldata/finaly_url', '', '_self', '0', '0', '0', '0', '1', '1530433775');
INSERT INTO `hisi_admin_menu` VALUES ('267', '0', '261', 'cofco', '【弹框】打标签', 'aicon ai-caidan', 'cofco/labeldata/levelpop', '', '_self', '0', '0', '0', '0', '1', '1530701820');
INSERT INTO `hisi_admin_menu` VALUES ('270', '0', '275', 'cofco', '选择数据（原料）', '', 'cofco/statistic/levelpop1', '', '_self', '0', '0', '0', '0', '1', '1531917253');
INSERT INTO `hisi_admin_menu` VALUES ('271', '0', '257', 'cofco', '最终列表删除', 'aicon ai-jinyong', 'cofco/labeldata/finaly_del', '', '_self', '0', '0', '0', '1', '1', '1532311757');
INSERT INTO `hisi_admin_menu` VALUES ('273', '0', '275', 'cofco', '数据选择（健康）', '', 'cofco/statistic/levelpop2', '', '_self', '0', '0', '0', '0', '1', '1532500027');
INSERT INTO `hisi_admin_menu` VALUES ('274', '0', '212', 'cofco', '文献管理', 'aicon ai-caidan', 'cofco/wenxian', '', '_self', '0', '0', '1', '1', '1', '1534209254');
INSERT INTO `hisi_admin_menu` VALUES ('275', '0', '212', 'cofco', '证据分析', 'aicon ai-systemmenu', 'cofco/zhengju', '', '_self', '0', '0', '1', '1', '1', '1534209330');
INSERT INTO `hisi_admin_menu` VALUES ('278', '1', '4', 'cofco', '文献上传', 'aicon ai-huiyuanliebiao', 'cofco/labeldata/crawurl', '', '_self', '20', '0', '0', '1', '1', '1536547832');
INSERT INTO `hisi_admin_menu` VALUES ('279', '0', '257', 'cofco', '浏览', 'typcn typcn-news', 'cofco/labeldata/finaly_browse', '', '_self', '0', '0', '0', '0', '1', '1536753297');
INSERT INTO `hisi_admin_menu` VALUES ('280', '0', '257', 'cofco', '同爬虫关键词文献列表', 'typcn typcn-clipboard', 'cofco/labeldata/finaly_find', '', '_self', '0', '0', '0', '0', '1', '1536753434');
INSERT INTO `hisi_admin_menu` VALUES ('281', '0', '222', 'cofco', '浏览', 'typcn typcn-news', 'cofco/labeldata/pending_browse', '', '_self', '0', '0', '0', '0', '1', '1536753476');
INSERT INTO `hisi_admin_menu` VALUES ('282', '0', '222', 'cofco', '同爬虫关键词文献列表', 'typcn typcn-clipboard', 'cofco/labeldata/pending_find', '', '_self', '0', '0', '0', '0', '1', '1536753541');
INSERT INTO `hisi_admin_menu` VALUES ('283', '0', '274', 'cofco', '标签选择', '', 'cofco/labeldata/levelpop', '', '_self', '0', '0', '1', '0', '1', '1537164306');
INSERT INTO `hisi_admin_menu` VALUES ('284', '1', '4', 'admin', '后台首页', 'aicon ai-shouye', 'admin/index/index', '', '_self', '100', '0', '0', '1', '1', '1544431822');

-- ----------------------------
-- Table structure for `hisi_admin_menu_lang`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_menu_lang`;
CREATE TABLE `hisi_admin_menu_lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `lang` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '语言包',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=331 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_menu_lang
-- ----------------------------
INSERT INTO `hisi_admin_menu_lang` VALUES ('132', '2', '系统', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('134', '4', '快捷菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('136', '6', '系统功能', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('137', '7', '会员管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('138', '8', '系统扩展', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('139', '9', '开发专用', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('140', '10', '系统设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('141', '11', '配置管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('142', '12', '系统菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('143', '13', '管理员角色', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('144', '14', '系统管理员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('145', '15', '系统日志', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('146', '16', '附件管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('147', '17', '模块管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('148', '18', '插件管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('149', '19', '钩子管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('150', '20', '会员等级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('151', '21', '会员列表', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('152', '22', '[示例]列表模板', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('153', '23', '[示例]编辑模板', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('155', '25', '清空缓存', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('156', '26', '添加菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('157', '27', '修改菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('158', '28', '删除菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('159', '29', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('160', '30', '排序设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('161', '31', '添加快捷菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('162', '32', '导出菜单', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('163', '33', '添加角色', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('164', '34', '修改角色', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('165', '35', '删除角色', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('166', '36', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('167', '37', '添加管理员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('168', '38', '修改管理员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('169', '39', '删除管理员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('170', '40', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('171', '41', '个人信息设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('172', '42', '安装插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('173', '43', '卸载插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('174', '44', '删除插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('175', '45', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('176', '46', '设计插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('177', '47', '运行插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('178', '48', '更新插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('179', '49', '插件配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('180', '50', '添加钩子', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('181', '51', '修改钩子', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('182', '52', '删除钩子', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('183', '53', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('184', '54', '插件排序', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('185', '55', '添加配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('186', '56', '修改配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('187', '57', '删除配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('188', '58', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('189', '59', '排序设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('190', '60', '基础配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('191', '61', '系统配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('192', '62', '上传配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('193', '63', '开发配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('194', '64', '设计模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('195', '65', '安装模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('196', '66', '卸载模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('197', '67', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('198', '68', '设置默认模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('199', '69', '删除模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('200', '70', '添加会员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('201', '71', '修改会员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('202', '72', '删除会员', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('203', '73', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('204', '74', '[弹窗]会员选择', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('205', '75', '添加会员等级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('206', '76', '修改会员等级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('207', '77', '删除会员等级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('208', '78', '附件上传', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('209', '79', '删除附件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('210', '80', '在线升级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('211', '81', '获取升级列表', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('212', '82', '安装升级包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('213', '83', '下载升级包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('214', '84', '数据库管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('215', '85', '备份数据库', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('216', '86', '恢复数据库', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('217', '87', '优化数据库', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('218', '88', '删除备份', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('219', '89', '修复数据库', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('220', '90', '设置默认等级', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('221', '91', '数据库配置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('222', '92', '模块打包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('223', '93', '插件打包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('224', '94', '主题管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('225', '95', '设置默认主题', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('226', '96', '删除主题', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('227', '97', '语言包管理', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('228', '98', '添加语言包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('229', '99', '修改语言包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('230', '100', '删除语言包', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('231', '101', '排序设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('232', '102', '状态设置', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('233', '103', '收藏夹图标上传', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('234', '104', '导入模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('235', '105', '欢迎页面', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('236', '106', '布局切换', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('237', '107', '删除日志', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('238', '108', '清空日志', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('239', '109', '编辑模块', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('240', '110', '模块图标上传', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('241', '111', '导入插件', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('242', '112', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('243', '113', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('244', '114', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('245', '115', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('246', '116', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('247', '117', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('248', '118', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('249', '119', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('250', '120', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('251', '121', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('252', '122', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('253', '123', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('254', '124', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('255', '125', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('256', '126', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('257', '127', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('258', '128', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('259', '129', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('260', '130', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('261', '131', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('262', '132', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('263', '133', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('264', '134', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('265', '135', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('266', '136', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('267', '137', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('268', '138', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('269', '139', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('270', '140', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('271', '141', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('272', '142', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('273', '143', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('274', '144', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('275', '145', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('276', '146', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('277', '147', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('278', '148', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('279', '149', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('280', '150', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('281', '151', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('282', '152', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('283', '153', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('284', '154', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('285', '155', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('286', '156', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('287', '157', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('288', '158', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('289', '159', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('290', '160', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('291', '161', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('292', '162', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('293', '163', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('294', '164', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('295', '165', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('296', '166', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('297', '167', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('298', '168', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('299', '169', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('300', '170', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('301', '171', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('302', '172', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('303', '173', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('304', '174', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('305', '175', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('306', '176', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('307', '177', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('308', '178', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('309', '179', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('310', '180', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('311', '181', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('312', '182', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('313', '183', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('314', '184', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('315', '185', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('316', '186', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('317', '187', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('318', '188', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('319', '189', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('320', '190', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('321', '191', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('322', '192', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('323', '193', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('324', '194', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('325', '195', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('326', '196', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('327', '197', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('328', '198', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('329', '199', '预留占位', '1');
INSERT INTO `hisi_admin_menu_lang` VALUES ('330', '200', '预留占位', '1');

-- ----------------------------
-- Table structure for `hisi_admin_module`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_module`;
CREATE TABLE `hisi_admin_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
  `name` varchar(50) NOT NULL COMMENT '模块名(英文)',
  `identifier` varchar(100) NOT NULL COMMENT '模块标识(模块名(字母).开发者标识.module)',
  `title` varchar(50) NOT NULL COMMENT '模块标题',
  `intro` varchar(255) NOT NULL COMMENT '模块简介',
  `author` varchar(100) NOT NULL COMMENT '作者',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1未启用，2已启用',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
  `config` text NOT NULL COMMENT '配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='[系统] 模块';

-- ----------------------------
-- Records of hisi_admin_module
-- ----------------------------
INSERT INTO `hisi_admin_module` VALUES ('1', '1', 'admin', 'admin.hisiphp.module', '系统管理模块', '系统核心模块，用于后台各项管理功能模块及功能拓展', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `hisi_admin_module` VALUES ('2', '1', 'index', 'index.hisiphp.module', '系统默认模块', '仅供前端插件访问和应用市场推送安装，禁止在此模块下面开发任何东西。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `hisi_admin_module` VALUES ('3', '1', 'install', 'install.hisiphp.module', '系统安装模块', '系统安装模块，勿动。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `hisi_admin_module` VALUES ('6', '0', 'cofco', 'cofco.btbu.module', '数据分析', '该模块主要开发中粮的数据分析系统，包含爬虫管理、数据输入、数据筛选、结果分析等功能', 'btbu', '/static/app_icon/cofco.png', '1.0.0', '', '0', '2', '0', '', '0', '', 'default', '1522326403', '1522326403');

-- ----------------------------
-- Table structure for `hisi_admin_plugins`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_plugins`;
CREATE TABLE `hisi_admin_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL COMMENT '插件名称(英文)',
  `title` varchar(32) NOT NULL COMMENT '插件标题',
  `icon` varchar(64) NOT NULL COMMENT '图标',
  `intro` text NOT NULL COMMENT '插件简介',
  `author` varchar(32) NOT NULL COMMENT '作者',
  `url` varchar(255) NOT NULL COMMENT '作者主页',
  `version` varchar(16) NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) NOT NULL DEFAULT '' COMMENT '插件唯一标识符',
  `config` text NOT NULL COMMENT '插件配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 插件表';

-- ----------------------------
-- Records of hisi_admin_plugins
-- ----------------------------
INSERT INTO `hisi_admin_plugins` VALUES ('1', '0', 'hisiphp', '系统基础信息', '/plugins/hisiphp/hisiphp.png', '后台首页展示系统基础信息和开发团队信息', 'HisiPHP', 'http://www.hisiphp.com', '1.0.0', 'hisiphp.hisiphp.plugins', '', '0', '', '1509379331', '1509379331', '0', '2');

-- ----------------------------
-- Table structure for `hisi_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_role`;
CREATE TABLE `hisi_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `intro` varchar(200) NOT NULL COMMENT '角色简介',
  `auth` text NOT NULL COMMENT '角色权限',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理角色';

-- ----------------------------
-- Records of hisi_admin_role
-- ----------------------------
INSERT INTO `hisi_admin_role` VALUES ('1', '超级管理员', '拥有系统最高权限', '0', '1489411760', '0', '1');
INSERT INTO `hisi_admin_role` VALUES ('2', '系统管理员', '拥有系统管理员权限', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"6\":\"6\",\"7\":\"10\",\"8\":\"60\",\"9\":\"61\",\"10\":\"62\",\"11\":\"63\",\"12\":\"91\",\"13\":\"11\",\"14\":\"55\",\"15\":\"56\",\"16\":\"57\",\"17\":\"58\",\"18\":\"59\",\"27\":\"13\",\"28\":\"33\",\"29\":\"34\",\"30\":\"35\",\"31\":\"36\",\"32\":\"14\",\"33\":\"37\",\"34\":\"38\",\"35\":\"39\",\"36\":\"40\",\"37\":\"41\",\"108\":\"212\",\"109\":\"213\",\"110\":\"214\",\"111\":\"245\",\"112\":\"258\",\"113\":\"259\",\"114\":\"246\",\"115\":\"247\",\"116\":\"248\",\"117\":\"249\",\"118\":\"253\",\"119\":\"254\",\"120\":\"217\",\"121\":\"229\",\"122\":\"230\",\"123\":\"231\",\"124\":\"232\",\"125\":\"251\",\"126\":\"219\",\"127\":\"224\",\"128\":\"261\",\"129\":\"262\",\"130\":\"263\",\"131\":\"264\",\"132\":\"265\",\"133\":\"267\",\"134\":\"220\",\"135\":\"221\",\"136\":\"256\",\"137\":\"222\",\"138\":\"240\",\"139\":\"241\",\"140\":\"242\",\"141\":\"243\",\"142\":\"257\",\"143\":\"260\",\"144\":\"266\",\"145\":\"271\",\"146\":\"226\",\"147\":\"270\",\"148\":\"273\",\"149\":\"227\",\"150\":\"255\"}', '1489411760', '1534139333', '1');
INSERT INTO `hisi_admin_role` VALUES ('4', '数据标注员', '数据标注员专用角色', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"108\":\"212\",\"109\":\"274\",\"110\":\"245\",\"111\":\"259\",\"112\":\"246\",\"113\":\"247\",\"114\":\"248\",\"115\":\"249\",\"116\":\"253\",\"117\":\"254\",\"130\":\"220\",\"131\":\"221\",\"132\":\"256\",\"133\":\"222\",\"134\":\"281\",\"135\":\"282\",\"136\":\"240\",\"137\":\"241\",\"138\":\"242\",\"139\":\"243\",\"140\":\"257\",\"141\":\"260\",\"142\":\"266\",\"143\":\"271\",\"144\":\"279\",\"145\":\"280\",\"146\":\"275\",\"147\":\"270\",\"148\":\"273\",\"149\":\"255\"}', '1522463180', '1537068552', '1');
INSERT INTO `hisi_admin_role` VALUES ('5', '测试权限', '', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"6\":\"6\",\"19\":\"12\"}', '1532663157', '1532663157', '1');

-- ----------------------------
-- Table structure for `hisi_admin_tag`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_tag`;
CREATE TABLE `hisi_admin_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `label_id` int(10) NOT NULL COMMENT '分组ID',
  `value` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_admin_tag
-- ----------------------------
INSERT INTO `hisi_admin_tag` VALUES ('11', '人工智能', '16', '自动驾驶', '1', '1526896048');
INSERT INTO `hisi_admin_tag` VALUES ('12', '卷积神经网络', '16', 'LeNet', '1', '1526896095');
INSERT INTO `hisi_admin_tag` VALUES ('13', '概率学', '17', '高斯分布', '1', '1526896249');
INSERT INTO `hisi_admin_tag` VALUES ('14', '力学', '15', '大气压', '1', '1526896311');
INSERT INTO `hisi_admin_tag` VALUES ('15', '量子力学', '15', '量子通信', '1', '1526896381');
INSERT INTO `hisi_admin_tag` VALUES ('16', '结构化学', '14', '固体', '1', '1526896455');
INSERT INTO `hisi_admin_tag` VALUES ('17', '胚胎学', '13', '细胞', '1', '1526896491');
INSERT INTO `hisi_admin_tag` VALUES ('18', 'tea', '13', 'black tea', '0', '1528171457');

-- ----------------------------
-- Table structure for `hisi_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `hisi_admin_user`;
CREATE TABLE `hisi_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL,
  `nick` varchar(50) NOT NULL COMMENT '昵称',
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `auth` text NOT NULL COMMENT '权限',
  `iframe` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0默认，1框架',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `last_login_ip` varchar(128) NOT NULL COMMENT '最后登陆IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理用户';

-- ----------------------------
-- Records of hisi_admin_user
-- ----------------------------
INSERT INTO `hisi_admin_user` VALUES ('1', '1', 'admin', '$2y$10$lbBUV/DOKZfU2AgW6XyR2OG77zo8zLf9S3m/8jzUiNNpWST9MU5yu', '超级管理员', '', '', '', '0', '1', '36.112.14.5', '1546740483', '1522151228', '1546740483');
INSERT INTO `hisi_admin_user` VALUES ('3', '4', 'datalabel1', '$2y$10$M8VUg3TwQ19HJYHtwBd.ROcH3aRMw0iUuaTKEScEv336hwOs7Vsdy', '小A', '', '', '', '0', '1', '0.0.0.0', '1522463342', '1522463305', '1522463342');
INSERT INTO `hisi_admin_user` VALUES ('4', '2', 'yingjian', '$2y$10$jYd5eDwJJsP1Jxb3g36BPuV2v3BHRzwGPZNKFhxYzKz42B4xGeub2', 'Ying', '', '', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"6\":\"6\",\"7\":\"10\",\"8\":\"60\",\"9\":\"61\",\"10\":\"62\",\"11\":\"63\",\"12\":\"91\",\"13\":\"11\",\"14\":\"55\",\"15\":\"56\",\"16\":\"57\",\"17\":\"58\",\"18\":\"59\",\"19\":\"12\",\"20\":\"26\",\"21\":\"27\",\"22\":\"28\",\"23\":\"29\",\"24\":\"30\",\"25\":\"31\",\"26\":\"32\",\"27\":\"13\",\"28\":\"33\",\"29\":\"34\",\"30\":\"35\",\"31\":\"36\",\"32\":\"14\",\"33\":\"37\",\"34\":\"38\",\"35\":\"39\",\"36\":\"40\",\"37\":\"41\",\"41\":\"16\",\"42\":\"78\",\"43\":\"79\",\"44\":\"103\",\"108\":\"212\",\"109\":\"274\",\"110\":\"283\",\"111\":\"245\",\"112\":\"259\",\"113\":\"246\",\"114\":\"247\",\"115\":\"248\",\"116\":\"249\",\"117\":\"253\",\"118\":\"254\",\"119\":\"217\",\"120\":\"229\",\"121\":\"230\",\"122\":\"231\",\"123\":\"232\",\"124\":\"251\",\"125\":\"261\",\"126\":\"262\",\"127\":\"263\",\"128\":\"264\",\"129\":\"265\",\"130\":\"267\",\"131\":\"220\",\"132\":\"221\",\"133\":\"256\",\"134\":\"222\",\"135\":\"281\",\"136\":\"282\",\"137\":\"240\",\"138\":\"241\",\"139\":\"242\",\"140\":\"243\",\"141\":\"257\",\"142\":\"260\",\"143\":\"266\",\"144\":\"271\",\"145\":\"279\",\"146\":\"280\",\"147\":\"275\",\"148\":\"270\",\"149\":\"273\",\"150\":\"255\"}', '0', '1', '106.37.237.196', '1546826030', '1529562115', '1546826030');
INSERT INTO `hisi_admin_user` VALUES ('6', '4', 'wangbin', '$2y$10$3P2fNFhVtRScP1AR72u3nuQmRkK3s7h5AtLy4IgwGtwnXQJYWi2sy', 'wangbin', '', '', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"108\":\"212\",\"109\":\"274\",\"110\":\"283\",\"111\":\"245\",\"112\":\"259\",\"113\":\"246\",\"114\":\"247\",\"115\":\"248\",\"116\":\"249\",\"117\":\"253\",\"118\":\"254\",\"119\":\"217\",\"120\":\"229\",\"121\":\"230\",\"122\":\"231\",\"123\":\"232\",\"124\":\"251\",\"125\":\"261\",\"127\":\"263\",\"130\":\"267\",\"131\":\"220\",\"132\":\"221\",\"133\":\"256\",\"134\":\"222\",\"135\":\"281\",\"136\":\"282\",\"137\":\"240\",\"138\":\"241\",\"139\":\"242\",\"140\":\"243\",\"141\":\"257\",\"142\":\"260\",\"143\":\"266\",\"144\":\"271\",\"145\":\"279\",\"146\":\"280\",\"147\":\"275\",\"148\":\"270\",\"149\":\"273\",\"150\":\"255\",\"151\":\"213\",\"152\":\"214\",\"153\":\"219\",\"154\":\"224\",\"165\":\"226\",\"166\":\"227\"}', '0', '1', '130.199.121.3', '1539647605', '1533125811', '1539647605');
INSERT INTO `hisi_admin_user` VALUES ('7', '4', 'wangxi', '$2y$10$oPRaupfHoOUJj6lv9XU77OHGYLHXANvA/xRadKYX9D6hZElSEKiMq', 'wangxi', '', '', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"108\":\"212\",\"109\":\"274\",\"110\":\"245\",\"111\":\"259\",\"112\":\"246\",\"113\":\"247\",\"114\":\"248\",\"115\":\"249\",\"116\":\"253\",\"117\":\"254\",\"118\":\"217\",\"119\":\"229\",\"120\":\"230\",\"121\":\"231\",\"122\":\"232\",\"123\":\"251\",\"124\":\"261\",\"125\":\"262\",\"126\":\"263\",\"127\":\"264\",\"128\":\"265\",\"129\":\"267\",\"130\":\"220\",\"131\":\"221\",\"132\":\"256\",\"133\":\"222\",\"136\":\"240\",\"137\":\"241\",\"138\":\"242\",\"139\":\"243\",\"140\":\"257\",\"141\":\"260\",\"142\":\"266\",\"143\":\"271\",\"146\":\"275\",\"147\":\"270\",\"148\":\"273\",\"149\":\"255\"}', '0', '1', '223.71.188.222', '1546480489', '1535353972', '1546480489');
INSERT INTO `hisi_admin_user` VALUES ('8', '4', 'houcan', '$2y$10$LB2EzqO3fEUhsevUFj/xvubDytu8NUm4Q7ZCMpN9lOnlkzIAuonQG', 'houcan', '', '', '{\"0\":\"2\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"108\":\"212\",\"109\":\"274\",\"111\":\"245\",\"112\":\"259\",\"113\":\"246\",\"114\":\"247\",\"115\":\"248\",\"116\":\"249\",\"117\":\"253\",\"118\":\"254\",\"119\":\"217\",\"120\":\"229\",\"121\":\"230\",\"122\":\"231\",\"123\":\"232\",\"124\":\"251\",\"125\":\"261\",\"130\":\"267\",\"131\":\"220\",\"132\":\"221\",\"133\":\"256\",\"134\":\"222\",\"135\":\"281\",\"136\":\"282\",\"137\":\"240\",\"138\":\"241\",\"139\":\"242\",\"140\":\"243\",\"141\":\"257\",\"142\":\"260\",\"143\":\"266\",\"144\":\"271\",\"145\":\"279\",\"146\":\"280\",\"147\":\"275\",\"148\":\"270\",\"149\":\"273\",\"150\":\"255\"}', '0', '1', '114.249.134.249', '1537625555', '1537625430', '1537625555');

-- ----------------------------
-- Table structure for `spiderapp_content`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_content`;
CREATE TABLE `spiderapp_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` longtext NOT NULL,
  `sstr` longtext NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `source` longtext,
  `pmid` longtext,
  `title` longtext,
  `author` longtext,
  `journal` longtext,
  `ojournal` longtext,
  `impact_factor` longtext,
  `journal_zone` longtext,
  `issue` longtext,
  `abstract` longtext,
  `keyword` longtext,
  `institue` longtext,
  `irank` longtext,
  `country` longtext,
  `flink` longtext,
  `doi` varchar(300) DEFAULT NULL,
  `s_task_id` int(11) DEFAULT NULL,
  `tabstract` longtext,
  `tag_id` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=449469 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `spiderapp_journal`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_journal`;
CREATE TABLE `spiderapp_journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `journal` varchar(300) NOT NULL,
  `ojournal` longtext NOT NULL,
  `impact_factor` varchar(10) NOT NULL,
  `journal_zone` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7446 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `spiderapp_log`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_log`;
CREATE TABLE `spiderapp_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctime` longtext NOT NULL,
  `who` longtext NOT NULL,
  `identifier` longtext NOT NULL,
  `action` longtext NOT NULL,
  `result` longtext NOT NULL,
  `info_type` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247688 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `spiderapp_project`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_project`;
CREATE TABLE `spiderapp_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` longtext NOT NULL,
  `description` longtext NOT NULL,
  `ctime` int(11) NOT NULL,
  `sstr` longtext NOT NULL,
  `project_type` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spiderapp_project
-- ----------------------------

-- ----------------------------
-- Table structure for `spiderapp_sstr`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_sstr`;
CREATE TABLE `spiderapp_sstr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` longtext NOT NULL,
  `sstr` longtext NOT NULL,
  `ctime` int(11) NOT NULL,
  `project_type` longtext NOT NULL,
  `loop` longtext NOT NULL,
  `frequency` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spiderapp_sstr
-- ----------------------------

-- ----------------------------
-- Table structure for `spiderapp_statistic_result`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_statistic_result`;
CREATE TABLE `spiderapp_statistic_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` longtext NOT NULL,
  `source` longtext NOT NULL,
  `word_id` int(11) NOT NULL,
  `occur` longtext NOT NULL,
  `classification` longtext NOT NULL,
  `stime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spiderapp_statistic_result
-- ----------------------------

-- ----------------------------
-- Table structure for `spiderapp_task`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_task`;
CREATE TABLE `spiderapp_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` longtext CHARACTER SET utf8 NOT NULL,
  `sstr` longtext CHARACTER SET utf8 NOT NULL,
  `ctime` int(11) NOT NULL,
  `itemnum` longtext CHARACTER SET utf8,
  `mrhours` longtext CHARACTER SET utf8,
  `endwith` longtext CHARACTER SET utf8,
  `status` int(11) NOT NULL,
  `creator` longtext CHARACTER SET utf8 NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `des` longtext CHARACTER SET utf8,
  `freq_d` int(11) NOT NULL,
  `freq_m` int(11) NOT NULL,
  `s_kw_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `webdriverid` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for `spiderapp_taskprogress`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_taskprogress`;
CREATE TABLE `spiderapp_taskprogress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` longtext NOT NULL,
  `sstr` longtext NOT NULL,
  `source` longtext NOT NULL,
  `ctime` int(11) NOT NULL,
  `runtime` longtext NOT NULL,
  `totalnum` longtext NOT NULL,
  `remainnum` longtext NOT NULL,
  `creator` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `spiderapp_testscrapy`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_testscrapy`;
CREATE TABLE `spiderapp_testscrapy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of spiderapp_testscrapy
-- ----------------------------

-- ----------------------------
-- Table structure for `spiderapp_word_dict`
-- ----------------------------
DROP TABLE IF EXISTS `spiderapp_word_dict`;
CREATE TABLE `spiderapp_word_dict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` longtext COLLATE utf8mb4_bin NOT NULL,
  `wid` int(11) NOT NULL,
  `classification` longtext COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of spiderapp_word_dict
-- ----------------------------
INSERT INTO `spiderapp_word_dict` VALUES ('1', 0x70752D65726820746561, '1', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('2', 0x6461726B20746561, '2', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('3', 0x746561, '3', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('4', 0x626C61636B20746561, '4', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('5', 0x6F6F6C6F6E6720746561, '5', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('6', 0x477265656E20746561, '6', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('7', 0x507520657220746561, '7', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('8', 0x77686974652074656120, '8', 0x41E88CB6E58FB6E7A78DE7B1BB);
INSERT INTO `spiderapp_word_dict` VALUES ('9', 0x66617374696E67, '9', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('10', 0x747970652032206469616265746573, '10', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('11', 0x676C75636F736520766172696162696C697479, '11', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('12', 0x7072656469616265746573, '12', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('13', 0x696D7061697265642066617374696E6720676C796361656D6961, '13', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('14', 0x696E73756C696E20726573697374616E6365, '14', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('15', 0x706F73747072616E6469616C20, '15', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('16', 0x747970652031206469616265746573, '16', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('17', 0x696D70616972656420676C75636F736520746F6C6572616E6365, '17', 0x42E581A5E5BAB7E997AEE9A298);
INSERT INTO `spiderapp_word_dict` VALUES ('18', 0x72616E646F6D697A656420636F6E74726F6C6C656420747269616C, '18', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('19', 0x636173652D636F6E74726F6C207374756479, '19', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('20', 0x6578706572696D656E74616C207374756479, '20', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('21', 0x65636F6C6F676963616C207374756479, '21', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('22', 0x63617365207265706F7274, '22', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('23', 0x6F7065726174697665207374756479, '23', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('24', 0x54726561746D656E74207374756479, '24', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('25', 0x646F67, '25', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('26', 0x6361736520616E616C79736973, '26', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('27', 0x4E6F6E72616E646F6D697A656420747269616C, '27', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('28', 0x726174, '28', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('29', 0x636F686F7274207374756479, '29', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('30', 0x416461707469766520636C696E6963616C20747269616C, '30', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('31', 0x696E74657276656E74696F6E20747269616C, '31', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('32', 0x6F62736572766174696F6E616C207374756479, '32', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('33', 0x6D696365, '33', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('34', 0x63726F73732D73656374696F6E616C207374756479, '34', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('35', 0x70726576656E7469766520747269616C, '35', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('36', 0x636C696E6963616C20747269616C, '36', 0x43E5AE9EE9AA8CE7B1BBE59E8B);
INSERT INTO `spiderapp_word_dict` VALUES ('37', 0x474C502D31, '37', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('38', 0x616C646F736520726564756374617365, '38', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('39', 0x676C75636F736520757074616B65, '39', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('40', 0x73756372617365, '40', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('41', 0x4361636F2D32, '41', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('42', 0x676C75636F6B696E617365, '42', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('43', 0x50504152, '43', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('44', 0x476C75636F736964617365, '44', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('45', 0x416D796C617365, '45', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('46', 0x44505034, '46', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('47', 0x696E73756C696E20736563726574696F6E, '47', 0x44E4BD9CE794A8E69CBAE588B6);
INSERT INTO `spiderapp_word_dict` VALUES ('48', 0x657069636174656368696E, '48', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('49', 0x746865616E696E65, '49', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('50', 0x74686561666C6176696E2D332C33E280B22D646967616C6C617465, '50', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('51', 0x74686561666C6176696E, '51', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('52', 0x746865617275626967696E73, '52', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('53', 0x6361666665696E65, '53', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('54', 0x74656120506F6C797068656E6F6C73, '54', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('55', 0x67616C6C69632061636964, '55', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('56', 0x457069636174656368696E2067616C6C617465, '56', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('57', 0x74686561666C6176696E2D332D67616C6C617465, '57', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('58', 0x636174656368696E, '58', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('59', 0x7468656173696E6573696E, '59', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('60', 0x64696574617279206669626572, '60', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('61', 0x74686561666C6176696E2D33E280B22D67616C6C617465, '61', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('62', 0x65706967616C6C6F636174656368696E, '62', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('63', 0x7468656162726F776E696E65, '63', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('64', 0x45706967616C6C6F636174656368696E2067616C6C617465, '64', 0x45E88CB6E58FB6E68890E58886);
INSERT INTO `spiderapp_word_dict` VALUES ('65', 0x74656120706F6C7973616363686172696465, '65', 0x45E88CB6E58FB6E68890E58886);
