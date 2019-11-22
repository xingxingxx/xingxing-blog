
## 项目概述

* 产品名称：星星的博客
* 项目代码：xingxing-blog
* 演示地址：https://xiaoxingping.top/

[星星的博客](https://github.com/xingxingxx/xingxing-blog) Laravel 5.6 版本。

## 运行环境

- Nginx 1.8+
- PHP 5.6+
- Mysql 5.7+
- Redis 3.0+
- Memcached 1.4+

## 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.6](https://doc.laravel-china.org/docs/5.6/) 开发，本地开发环境使用 [Laravel Homestead](https://doc.laravel-china.org/docs/5.1/homestead)。

下文将在假定读者已经安装好了 Homestead 的情况下进行说明。如果您还未安装 Homestead，可以参照 [Homestead 安装与设置](https://doc.laravel-china.org/docs/5.6/homestead#installation-and-setup) 进行安装配置。

### 基础安装

#### 1. 克隆源代码

克隆源代码到本地：

    > git clone git@github.com:xingxingxx/my-blog-new.git

#### 2. 配置本地的 Homestead 环境

1). 运行以下命令编辑 Homestead.yaml 文件：

```shell
homestead edit
```

2). 加入对应修改，如下所示：

```
folders:
    - map: ~/my-path/xingxing-blog/ # 你本地的项目目录地址
      to: /home/vagrant/xingxing-blog
sites:
    - map: xingxing-blog.app
      to: /home/vagrant/xingxing-blog/public

databases:
    - my-blog-new
```

3). 应用修改

修改完成后保存，然后执行以下命令应用配置信息修改：

```shell
homestead provision
```

> 注意：有时候你需要重启才能看到应用。运行 `homestead halt` 然后是 `homestead up` 进行重启。

#### 3. 安装扩展包依赖

    > composer install

#### 4. 生成配置文件

    > cp .env.example .env

#### 5. 数据库迁移

    > php  artisan migrate


至此, 安装完成。
