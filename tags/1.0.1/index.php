<?php 
// +----------------------------------------------------------------------+
// | ThinkPHP                                                             |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006~2007 http://thinkphp.cn All rights reserved.      |
// +----------------------------------------------------------------------+
// | Licensed under the Apache License, Version 2.0 (the 'License');      |
// | you may not use this file except in compliance with the License.     |
// | You may obtain a copy of the License at                              |
// | http://www.apache.org/licenses/LICENSE-2.0                           |
// | Unless required by applicable law or agreed to in writing, software  |
// | distributed under the License is distributed on an 'AS IS' BASIS,    |
// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
// | implied. See the License for the specific language governing         |
// | permissions and limitations under the License.                       |
// +----------------------------------------------------------------------+
// | Author: liu21st <liu21st@gmail.com>                                  |
// +----------------------------------------------------------------------+
// $Id$

/**
 +------------------------------------------------------------------------------
 * ThinkPHP Blog 入口文件
 +------------------------------------------------------------------------------
 */

// 定义ThinkPHP框架路径
define('THINK_PATH', './ThinkPHP');
//定义项目名称，如果不定义，默认为入口文件名称
define('APP_NAME', 'Blog');
define('APP_PATH', './Blog');
// 加载框架公共入口文件 
require(THINK_PATH."/ThinkPHP.php");

//实例化一个网站应用实例
$App = new App(); 
//应用程序初始化
$App->run();
?>