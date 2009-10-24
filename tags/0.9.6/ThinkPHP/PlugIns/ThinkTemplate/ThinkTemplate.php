<?php 
/*
Plugin Name: ThinkTemplate
Plugin URI: http://thinkphp.cn
Description: Think模版引擎 ThinkPHP框架开发的性能卓越的编译型模版引擎 支持XML标签库.
Author: 流年
Version: 1.0
Author URI: http://blog.liu21st.com/
*/ 
//--------------------------------------------------
// TMPL_ENGINE_TYPE 模版引擎类型定义为 Think
//--------------------------------------------------

function ThinkTemplate($templateFile,$templateVar,$charset,$varPrefix='') 
{
        import('Template.ThinkTemplate',dirname(__FILE__));
        $tpl = new ThinkTemplate();
        $templateCacheFile  =  $tpl->loadTemplate($templateFile,$charset);
        // 模板阵列变量分解成为独立变量
        extract($templateVar, empty($varPrefix)? EXTR_OVERWRITE : EXTR_PREFIX_ALL,$varPrefix); 
        //载入模版缓存文件
        include_once($templateCacheFile);  	            	
        return ;
}

if(!defined('TMPL_ENGINE_TYPE') || 'THINK'== strtoupper(TMPL_ENGINE_TYPE)) {
    // 增加模版引擎
    // add_compiler(模版引擎定义变量,'模版引擎解析方法');
    add_compiler('Think','ThinkTemplate');
}
?>