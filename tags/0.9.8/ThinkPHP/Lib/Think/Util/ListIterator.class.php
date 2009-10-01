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
// $Id$

if(version_compare(PHP_VERSION, '5.0.0', '<')){
    /**
     +------------------------------------------------------------------------------
     * Iterator接口实现类 PHP5以上内置了Iterator接口 无需使用该类
     +------------------------------------------------------------------------------
     * @author    liu21st <liu21st@gmail.com>
     * @version   $Id$
     +------------------------------------------------------------------------------
     */
    class ListIterator extends Base
    {//类定义开始

        /**
         +----------------------------------------------------------
         * 元素集合
         +----------------------------------------------------------
         * @var array
         * @access protected
         +----------------------------------------------------------
         */
        var $_values = array();

        /**
         +----------------------------------------------------------
         * 当前指针位置
         +----------------------------------------------------------
         * @var integer
         * @access protected
         +----------------------------------------------------------
         */
        var $_index;

        /**
         +----------------------------------------------------------
         * 当前指针有效性
         +----------------------------------------------------------
         * @var boolen
         * @access protected
         +----------------------------------------------------------
         */
        var $_valid = True;


        /**
         +----------------------------------------------------------
         * 架构函数  
         * 初始化数组元素 并初始化指针位置
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param array $values  初始化数组元素
         +----------------------------------------------------------
         */
        function __construct(&$values)
        {
            if (is_array($values)) {
                $this->_values = &$values;
            }
            $this->_index = 0;
        }

        /**
         +----------------------------------------------------------
         * 当前元素
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @return mixed
         +----------------------------------------------------------
         */
        function current()
        {
            return current($this->_values); 
        }

        /**
         +----------------------------------------------------------
         * 当前元素键名，没有键名返回索引
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @return mixed
         +----------------------------------------------------------
         */
        function key ()
        {
            return key($this->_values); 
        }

        /**
         +----------------------------------------------------------
         * 指针移动到下一个
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         */
        function next()
        {
            $this->_index ++;
            $this->_valid = (FALSE !== next($this->_values)); 
            //return $this->_valid;
        }

        /**
         +----------------------------------------------------------
         * 指针向上移动一位 PHP5的Iterator接口没有实现该方法
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         */
        function prev()
        {
            $this->_index --;
            $this->_valid = (FALSE !== prev($this->_values)); 
            //return $this->_valid;
        }

        /**
         +----------------------------------------------------------
         * 重置指针位置 回到开始位置
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         */
        function rewind()
        {
            $this->_index = 0;
            $this->_valid = (FALSE !== reset($this->_values)); 
        }

        /**
         +----------------------------------------------------------
         * 指针移动最后 PHP5的Iterator接口没有实现该方法
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         */
        function end()
        {
            $this->_index = count($this->_values)-1;
            $this->_valid = (FALSE !== end($this->_values)); 
        }

        /**
         +----------------------------------------------------------
         * 指针位置是否有效
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         */
        function valid()
        {
            return $this->_valid;
        }

    }//类定义结束
}else {
    //引入PHP5支持的FileIterator类
	import("Think.Util._ListIterator");	
}
?>