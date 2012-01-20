<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 +------------------------------------------------------------------------------
 * ThinkPHP 运行时文件 编译后不再加载
 +------------------------------------------------------------------------------
 */
if (!defined('THINK_PATH')) exit();
//  版本信息
define('THINK_VERSION', '3.0RC1');
//   系统信息
if(version_compare(PHP_VERSION,'5.4.0','<') ) {
    @set_magic_quotes_runtime (0);
    define('MAGIC_QUOTES_GPC',get_magic_quotes_gpc()?True:False);
}
define('IS_CGI',substr(PHP_SAPI, 0,3)=='cgi' ? 1 : 0 );
define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
define('IS_CLI',PHP_SAPI=='cli'? 1   :   0);

if(!IS_CLI) {
    // 当前文件名
    if(!defined('_PHP_FILE_')) {
        if(IS_CGI) {
            //CGI/FASTCGI模式下
            $_temp  = explode('.php',$_SERVER["PHP_SELF"]);
            define('_PHP_FILE_',  rtrim(str_replace($_SERVER["HTTP_HOST"],'',$_temp[0].'.php'),'/'));
        }else {
            define('_PHP_FILE_',    rtrim($_SERVER["SCRIPT_NAME"],'/'));
        }
    }
    if(!defined('__ROOT__')) {
        // 网站URL根目录
        if( strtoupper(APP_NAME) == strtoupper(basename(dirname(_PHP_FILE_))) ) {
            $_root = dirname(dirname(_PHP_FILE_));
        }else {
            $_root = dirname(_PHP_FILE_);
        }
        define('__ROOT__',   (($_root=='/' || $_root=='\\')?'':$_root));
    }

    //支持的URL模式
    define('URL_COMMON',      0);   //普通模式
    define('URL_PATHINFO',    1);   //PATHINFO模式
    define('URL_REWRITE',     2);   //REWRITE模式
    define('URL_COMPAT',      3);   // 兼容模式
}

// 路径设置 可在入口文件中重新定义 所有路径常量都必须以/ 结尾
if(!defined('COMMON_PATH')) define('COMMON_PATH',    APP_PATH.'Common/'); // 项目公共目录
if(!defined('LIB_PATH')) define('LIB_PATH',    APP_PATH.'Lib/'); //
if(!defined('CACHE_PATH')) define('CACHE_PATH',   RUNTIME_PATH.'Cache/'); //
if(!defined('CONF_PATH')) define('CONF_PATH',  APP_PATH.'Conf/'); //
if(!defined('LOG_PATH')) define('LOG_PATH',  RUNTIME_PATH.'Logs/'); //
if(!defined('LANG_PATH')) define('LANG_PATH', APP_PATH.'Lang/'); //
if(!defined('TEMP_PATH')) define('TEMP_PATH', RUNTIME_PATH.'Temp/'); //
if(!defined('DATA_PATH')) define('DATA_PATH', RUNTIME_PATH.'Data/'); //
if(!defined('CORE_PATH')) define('CORE_PATH',THINK_PATH.'Lib/');
if(!defined('TMPL_PATH')) define('TMPL_PATH',APP_PATH.'Tpl/');
if(!defined('HTML_PATH')) define('HTML_PATH',APP_PATH.'Html/');
if(!defined('EXTEND_PATH')) define('EXTEND_PATH',THINK_PATH.'Extend/');
if(!defined('MODE_PATH')) define('MODE_PATH',EXTEND_PATH.'Mode/');
if(!defined('VENDOR_PATH')) define('VENDOR_PATH',EXTEND_PATH.'Vendor/');
if(!defined('LIBRARY_PATH')) define('LIBRARY_PATH',EXTEND_PATH.'Library/');

// 加载运行时所需要的文件 并负责自动目录生成
function load_runtime_file() {
    // 加载系统基础函数库
    require THINK_PATH.'Common/common.php';
    // 读取核心编译文件列表
    $list = array(
        CORE_PATH.'Core/Think.class.php',
        CORE_PATH.'Core/ThinkException.class.php',  // 异常处理类
        CORE_PATH.'Core/Behavior.class.php',
    );
    // 加载模式文件列表
    foreach ($list as $key=>$file){
        if(is_file($file))  require_cache($file);
    }
    // 加载系统类库别名定义
    alias_import(include THINK_PATH.'Conf/alias.php');

    // 检查项目目录结构 如果不存在则自动创建
    if(!is_dir(LIB_PATH)) {
        // 创建项目目录结构
        build_app_dir();
    }elseif(!is_dir(CACHE_PATH)){
        // 检查缓存目录
        check_runtime();
    }elseif(APP_DEBUG){
        // 调试模式切换删除编译缓存
        if(is_file(RUNTIME_FILE))   unlink(RUNTIME_FILE);
    }
}

// 检查缓存目录(Runtime) 如果不存在则自动创建
function check_runtime() {
    if(!is_dir(RUNTIME_PATH)) {
        mkdir(RUNTIME_PATH);
    }elseif(!is_writeable(RUNTIME_PATH)) {
        header("Content-Type:text/html; charset=utf-8");
        exit('目录 [ '.RUNTIME_PATH.' ] 不可写！');
    }
    mkdir(CACHE_PATH);  // 模板缓存目录
    if(!is_dir(LOG_PATH))	mkdir(LOG_PATH);    // 日志目录
    if(!is_dir(TEMP_PATH))  mkdir(TEMP_PATH);	// 数据缓存目录
    if(!is_dir(DATA_PATH))	mkdir(DATA_PATH);	// 数据文件目录
    return true;
}

// 创建编译缓存
function build_runtime_cache($append='') {
    // 生成编译文件
    $defs = get_defined_constants(TRUE);
    $content    =  '$GLOBALS[\'_beginTime\'] = microtime(TRUE);';
    if(defined('RUNTIME_DEF_FILE')) { // 编译后的常量文件外部引入
        file_put_contents(RUNTIME_DEF_FILE,'<?php '.array_define($defs['user']));
        $content  .=  'require \''.RUNTIME_DEF_FILE.'\';';
    }else{
        $content  .= array_define($defs['user']);
    }
    // 读取核心编译文件列表
    $list = array(
        THINK_PATH.'Common/common.php',
        CORE_PATH.'Core/Think.class.php',
        CORE_PATH.'Core/ThinkException.class.php',
        CORE_PATH.'Core/Behavior.class.php',
    );
    foreach ($list as $file){
        $content .= compile($file);
    }
    // 系统行为扩展文件统一编译
    if(C('APP_TAGS_ON')) {
        $content .= build_tags_cache();
    }
    $alias = include THINK_PATH.'Conf/alias.php';
    $content .= 'alias_import('.var_export($alias,true).');';
    // 编译框架默认语言包和配置参数
    $content .= $append."\nL(".var_export(L(),true).");C(".var_export(C(),true).');G(\'loadTime\');Think::Start();';
    file_put_contents(RUNTIME_FILE,strip_whitespace('<?php '.$content));
}

// 编译系统行为扩展类库
function build_tags_cache() {
    $tags = C('extends');
    $content = '';
    foreach ($tags as $tag=>$item){
        foreach ($item as $key=>$name) {
            $content .= is_int($key)?compile(CORE_PATH.'Behavior/'.$name.'Behavior.class.php'):compile($name);
        }
    }
    return $content;
}

// 创建项目目录结构
function build_app_dir() {
    // 没有创建项目目录的话自动创建
    if(!is_dir(APP_PATH)) mk_dir(APP_PATH,0777);
    if(is_writeable(APP_PATH)) {
        $dirs  = array(
            LIB_PATH,
            RUNTIME_PATH,
            CONF_PATH,
            COMMON_PATH,
            LANG_PATH,
            CACHE_PATH,
            TMPL_PATH,
            TMPL_PATH.C('DEFAULT_THEME').'/',
            LOG_PATH,
            TEMP_PATH,
            DATA_PATH,
            LIB_PATH.'Model/',
            LIB_PATH.'Action/',
            LIB_PATH.'Behavior/',
            LIB_PATH.'Widget/',
            );
        foreach ($dirs as $dir){
            if(!is_dir($dir))  mk_dir($dir,0777);
        }
        // 目录安全写入
        if(!defined('BUILD_DIR_SECURE')) define('BUILD_DIR_SECURE',false);
        if(BUILD_DIR_SECURE) {
            if(!defined('DIR_SECURE_FILENAME')) define('DIR_SECURE_FILENAME','index.html');
            if(!defined('DIR_SECURE_CONTENT')) define('DIR_SECURE_CONTENT',' ');
            // 自动写入目录安全文件
            $content = DIR_SECURE_CONTENT;
            $a = explode(',', DIR_SECURE_FILENAME);
            foreach ($a as $filename){
                foreach ($dirs as $dir)
                    file_put_contents($dir.$filename,$content);
            }
        }
        // 写入配置文件
        if(!is_file(CONF_PATH.'config.php'))
            file_put_contents(CONF_PATH.'config.php',"<?php\nreturn array(\n\t//'配置项'=>'配置值'\n);\n?>");
        // 写入测试Action
        if(!is_file(LIB_PATH.'Action/IndexAction.class.php'))
            build_first_action();
    }else{
        header("Content-Type:text/html; charset=utf-8");
        exit('项目目录不可写，目录无法自动生成！<BR>请使用项目生成器或者手动生成项目目录~');
    }
}

// 创建测试Action
function build_first_action() {
    $content = file_get_contents(THINK_PATH.'Tpl/default_index.tpl');
    file_put_contents(LIB_PATH.'Action/IndexAction.class.php',$content);
}

// 加载运行时所需文件
load_runtime_file();