


# 版本要求
mysql >=5.7
php>=7.0


# 安装教程
1、复制 `app/database.php.example` 为 `app/database.php`并更改数据库配置
2、复制 `.htaccess.example` 为 `.htaccess`。如果是windowns平台的apache，需要将第7行改为
```
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
```
3、新建数据库，将`cofco_f.sql`恢复到数据库

4、配置服务器环境启动即可

