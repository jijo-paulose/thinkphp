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
// $Id: ArrayObject.class.php 79 2007-04-01 05:32:36Z liu21st $

/**
 +------------------------------------------------------------------------------
 * ArrayObject实现类 PHP5以上内置了ArrayObject类
 +------------------------------------------------------------------------------
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id: ArrayObject.class.php 79 2007-04-01 05:32:36Z liu21st $
 +------------------------------------------------------------------------------
 */

if(!class_exists('ArrayObject')){//PHP5以上内置了ArrayObject类，不需要重新定义

    import("Think.Util.ListIterator");

    class ArrayObject extends Base 
    {//类定义开始

        /**
         +----------------------------------------------------------
         * 架构函数
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param string $array  初始化数组元素
         +----------------------------------------------------------
         */
        function __construct($array)
        {
            foreach ($array as $key=>$val){
                $this->$key = $val;
            }
        }

        /**
         +----------------------------------------------------------
         * 追加对象
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param mixed $object  要添加的对象
         +----------------------------------------------------------
         * @return boolen
         +----------------------------------------------------------
         */
        function append($object)
        {
            $index = $this->count();
            $this->$index = $object;
        }

        /**
         +----------------------------------------------------------
         * 统计列表中对象数目
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @return integer
         +----------------------------------------------------------
         */
        function count()
        {
            return count(get_object_vars($this));
        }

        /**
         +----------------------------------------------------------
         * 获得迭代因子
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @return ListIterator
         +----------------------------------------------------------
         */
        function getIterator()
        {
             return new ListIterator(get_object_vars($this));
        }


        /**
         +----------------------------------------------------------
         * 是否存在对象索引
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param mixed $index 索引
         +----------------------------------------------------------
         * @return boolen
         +----------------------------------------------------------
         */
        function offsetExists($index)
        {
            return isset($this->$index);
        }

        /**
         +----------------------------------------------------------
         * 更新索引对象
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param mixed $index 索引
         * @param integer $object 对象
         +----------------------------------------------------------
         * @return boolen
         +----------------------------------------------------------
         */
        function offsetSet($index,$object)
        {
            $this->$index = $object;
        }

        /**
         +----------------------------------------------------------
         * 注销对象
         * 
         +----------------------------------------------------------
         * @access public 
         +----------------------------------------------------------
         * @param mixed $index 索引
         +----------------------------------------------------------
         */
        function offsetUnset($index)
        {
            unset($this->$index);
        }

    }//类定义结束
}
?>