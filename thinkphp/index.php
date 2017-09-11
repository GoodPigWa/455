<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 绑定默认的访问模块，系统默认是Home模块
// define('BIND_MODULE','Admin');
// 自动生成模块
// define('BUILD_MODULE','Home');
// // 自动生成控制器文件列表
// define('BUILD_CONTROLLER_LIST','Index,Category,Product,Order,Article');
// // 自动生成模块文件列表
// define('BUILD_MODEL_LIST','User,Product,Category,Order,Article');

// define('BIND_CONTROLLER','Article');
// 定义应用目录
define('APP_PATH','./Application/');


// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单