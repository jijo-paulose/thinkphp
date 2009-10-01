<?php 
// +----------------------------------------------------------------------+
// | ThinkPHP                                                             |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 liu21st.com All rights reserved.                  |
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
// $Id: index.php 11 2007-01-04 03:57:34Z liu21st $
/**
 +------------------------------------------------------------------------------
 * 项目入口文件
 +------------------------------------------------------------------------------
 * @package    Core
 * @link       http://www.fcs.org.cn
 * @copyright  Copyright (c) 2005-2006 liu21st.com.  All rights reserved. 
 * @author     liu21st <liu21st@gmail.com>
 * @version    $Id: index.php 11 2007-01-04 03:57:34Z liu21st $
 +------------------------------------------------------------------------------
 */

$GLOBALS['_beginTime'] = array_sum(split(' ', microtime()));
define('FCS_PATH', '../ThinkPHP');
define('WEB_ROOT','../');

//定义项目名称，如果不定义，默认为入口文件名称
define('APP_NAME', 'Admin');
define('APP_PATH', '.');
// 加载配置文件 
require("../config.php");
// 加载FCS框架公共入口文件 
require("../ThinkPHP/ThinkPHP.php");
//实例化一个网站应用实例

$App = new App(); 
//应用程序初始化
$App->init();

//启动应用程序
$App->exec();

if(SHOW_RUN_TIME) {
echo '<div style="text-align:center;width:100%">Process: '.number_format((array_sum(split(' ', microtime())) - $GLOBALS['_beginTime']), 6).'s</div>';
}
?>