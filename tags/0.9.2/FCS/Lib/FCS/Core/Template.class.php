<?php 
// +---------------------------------------------------------------------------+
// | FCS -- Fast,Compatible & Simple OOP PHP Framework                         |
// +---------------------------------------------------------------------------+
// | Copyright (c) 2005-2006 liu21st.com.  All rights reserved.                |
// | Website: http://www.fcs.org.cn/                                           |
// | Author : Liu21st <liu21st@gmail.com>                                      |
// +---------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify it   |
// | under the terms of the GNU General Public License as published by the     |
// | Free Software Foundation; either version 2 of the License,  or (at your   |
// | option) any later version.                                                |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,  but      |
// | WITHOUT ANY WARRANTY; without even the implied warranty of                |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General |
// | Public License for more details.                                          |
// +---------------------------------------------------------------------------+

/**
 +------------------------------------------------------------------------------
 * FCS
 +------------------------------------------------------------------------------
 * @package    Core
 * @link       http://www.fcs.org.cn
 * @copyright  Copyright (c) 2005-2006 liu21st.com.  All rights reserved. 
 * @author     liu21st <liu21st@gmail.com>
 * @version    $Id: Template.class.php 73 2006-11-08 10:08:01Z fcs $
 +------------------------------------------------------------------------------
 */

/**
 +------------------------------------------------------------------------------
 * 内置模板引擎类 解析模板标签并输出
 * 支持缓存和页面压缩
 +------------------------------------------------------------------------------
 * @package  core
 * @author liu21st <liu21st@gmail.com>
 * @version  0.9.0
 +------------------------------------------------------------------------------
 */
class Template extends Base
{
    /**
     +----------------------------------------------------------
     * 模板页面显示变量，未经定义的变量不会显示在页面中
     +----------------------------------------------------------
     * @var array
     * @access protected
     +----------------------------------------------------------
     */
    var $tVar        =  array();

   /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function __construct()
    {

    }

   /**
     +----------------------------------------------------------
     * 取得模板对象实例
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return Template
     +----------------------------------------------------------
     */
    function getInstance() {
        return get_instance_of(__CLASS__);
    }

    /**
     +----------------------------------------------------------
     * 模板赋值和显示部分
     +----------------------------------------------------------
     */

    /**
     +----------------------------------------------------------
     * 模板变量赋值
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param mixed $name 
     * @param mixed $value  
     +----------------------------------------------------------
     */
    function assign($name,$value=''){
        if(is_array($name)) {
        	$this->tVar   =  array_merge($this->tVar,$name);
        }else {
   	        $this->tVar[$name] = $value;
        }
    }


    /**
     +----------------------------------------------------------
     * 取得模板变量的值
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $name 
     +----------------------------------------------------------
     * @return mixed 
     +----------------------------------------------------------
     * @throws FcsException
     +----------------------------------------------------------
     */
    function get($name){
        if(isset($this->tVar[$name])) {
            return $this->tVar[$name];
        }else {
        	return false;
        }
    }

    /**
     +----------------------------------------------------------
     * 加载模板和页面输出
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $templateFile 模板文件名 留空为自动获取
     * @param string $varPrefix 模板变量前缀 
     +----------------------------------------------------------
     * @throws FcsException
     +----------------------------------------------------------
     */
    function display($templateFile='',$charset=OUTPUT_CHARSET,$contentType='text/html',$varPrefix='')
    {
        if(null===$templateFile) {
            // 使用null参数作为模版名直接返回不做任何输出
        	return ;
        }
        // 设置输出缓存
        ini_set('output_buffering',4096);
        if(COMPRESS_PAGE) {//开启页面压缩输出
            $zlibCompress   =  ini_get('zlib.output_compression');
            if(empty($zlibCompress) && function_exists('ini_set')) {
                ini_set( 'zlib.output_compression', 1 );
                $zlibCompress   =  1;
            } 
        }
        // 缓存初始化过滤
        apply_filter('ob_init');
        //页面缓存
       	ob_start(); 
        ob_implicit_flush(0); 
        // 网页字符编码
        header("Content-Type:".$contentType."; charset=".$charset);

        // 缓存开启后执行的过滤
        apply_filter('ob_start');
        // 模版文件名过滤
        $templateFile = apply_filter('template_file',$templateFile);
        if(''==$templateFile) {
            $templateFile = TMPL_FILE_NAME;
        }  
        // 模版变量过滤
        $this->tVar = apply_filter('template_var',$this->tVar);

        //根据不同模版引擎进行处理
        if('PHP'==strtoupper(TMPL_ENGINE_TYPE) || ''== TMPL_ENGINE_TYPE ) {
        	//使用PHP模版
            include_once ($templateFile);
        }else {
        	// 使用外挂模版引擎
            // 通过插件的方式扩展
            use_compiler(TMPL_ENGINE_TYPE,$templateFile,$this->tVar,$charset,$varPrefix);
        }
        // 获取并清空缓存
        $content = ob_get_clean();

        // 输出编码转换
        $content = auto_charset($content,TEMPLATE_CHARSET,$charset);
        // 输出过滤
        $content = apply_filter('ob_content',$content);

        //输出缓存内容
        echo $content;
        return ;
    }

}//
?>