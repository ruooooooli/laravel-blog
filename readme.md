# RuoLi Laravel Blog


### 用到的包
1. [Laravel 5.3](https://laravel.com/)
2. [Semantic UI](http://semantic-ui.com/)


### 项目依赖
- [PHP >= 5.5.9](http://php.net/)
- [MySQL >= 5.6](https://www.mysql.com/)
- [Laravel >= 5.3](http://laravel.com/)


## 快速开始

### 克隆项目源码到本地
```
$ cd ~/Work/Code
$ git clone git@github.com:ruooooooli/laravel-blog.git
$ cd laravel-blog
```

### 使用 [Composer](https://getcomposer.org/) 安装项目依赖

> 如果需要加速下载 : [中国全量镜像](http://pkg.phpcomposer.com/)

```
$ composer install
```

### 配置环境变量
#### 创建 `.env` 配置文件
```
$ cp .env.example .env
$ php artisan key:generate
```

#### 修改相关配置
```
DB_HOST         = 127.0.0.1
DB_PORT         = 3306
DB_DATABASE     = blog
DB_USERNAME     = root
DB_PASSWORD     = blog
```

### 执行数据库迁移
```
$ php artisan migrate
```

### 运行
```
$ php artisan serve
$ open http://localhost:8000
```

## 尚未完成
1. 博客的前台展示 计划使用 vue 来实现
2. 计划加上 Entrust 用户权限管理
3. Redis 缓存
