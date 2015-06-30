# 一个基于ThinkPHP的简易企业展示型CMS
## 2015-06-25更新
玩具程序，不靠谱，要靠谱的请转到 [http://github.com/dusu/ot10](http://github.com/dusu/ot10)

#### 相关依赖：
* 框架：ThinkPHP v3.2.3
* 后台模板：Yahoo Purecss v0.6.0

#### 实现的功能：
* 文章
* 产品（带封面图片的文章）
* 单页
* 留言板
* 首页banner图
* 简单的权限划分

#### 安装方法：
1. 新建数据库
2. 导入table.sql文件
3. 修改`Application/Common/Conf/config.php`中数据库相关配置
4. 从浏览器访问程序，会自动跳转到安装界面，安装后自动跳转到登陆界面
5. 默认用户名：`admin`，密码：`admin`
6. 剩下的自己进去玩儿吧