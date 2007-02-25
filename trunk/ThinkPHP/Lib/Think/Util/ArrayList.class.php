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

import("Think.Util.ListIterator");
import("Think.Util.ArrayObject");

/**
 +------------------------------------------------------------------------------
 * ArrayList实现类 
 +------------------------------------------------------------------------------
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class ArrayList extends Base
{//类定义开始

    /**
     +----------------------------------------------------------
     * 集合元素
     +----------------------------------------------------------
     * @var array
     * @access protected
     +----------------------------------------------------------
     */
    var $_elements = array();

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $elements  初始化数组元素
     +----------------------------------------------------------
     */
    function __construct($elements = array())
    {
        if (!empty($elements)) {
            $this->_elements = $elements;
        }
    }


    /**
     +----------------------------------------------------------
     * ArrayList本身继承于ListIterator类
     * 若要获得迭代因子，通过getIterator方法实现
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return ArrayObject
     +----------------------------------------------------------
     */
    function getIterator() 
    {
        return getIterator($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 增加元素
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param mixed $element  要添加的元素
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    function add($element)
    {
        return (array_push($this->_elements, $element)) ? TRUE : FALSE;
    }

    function unshift($element) 
    {
    	return (array_unshift($this->_elements,$element))?TRUE : FALSE;
    }

    function pop() 
    {
    	return array_pop($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 增加元素列表
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param ArrayList $list  元素列表
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    function addAll($list)
    {
        $before = $this->size();
        if (is_instance_of($list, get_class($this))) {
            $iterator = $list->getIterator();
            foreach( $iterator as $element) {
                $this->add($element);
            }
        }
        $after = $this->size();
        return ($before < $after);
    }

    /**
     +----------------------------------------------------------
     * 清楚所有元素
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function clear()
    {
        $this->_elements = array();
    }

    /**
     +----------------------------------------------------------
     * 是否包含某个元素
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param mixed $element  查找元素
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    function contains($element)
    {
        return (array_search($element, $this->_elements) !== false );
    }

    /**
     +----------------------------------------------------------
     * 根据索引取得元素
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param integer $index 索引
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    function get($index)
    {
        return $this->_elements[$index];
    }

    /**
     +----------------------------------------------------------
     * 查找匹配元素，并返回第一个元素所在位置
     * 注意 可能存在0的索引位置 因此要用===False来判断查找失败
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param mixed $element  查找元素
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    function indexOf($element)
    {
        return array_search($element, $this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 判断元素是否为空
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    function isEmpty()
    {
        return empty($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 最后一个匹配的元素位置
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param mixed $element  查找元素
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     */
    function lastIndexOf($element)
    {
        for ($i = (count($this->_elements) - 1); $i > 0; $i--) {
            if ($element == $this->get($i)) { return $i; }
        }
    }

    function toJson() 
    {
        return json_encode($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 根据索引移除元素
     * 返回被移除的元素
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param integer $index 索引
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    function remove($index)
    {
        $element = $this->get($index);
        if (!is_null($element)) { array_splice($this->_elements, $index, 1); }
        return $element;
    }

    /**
     +----------------------------------------------------------
     * 移出一定范围的数组列表
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param integer $offset  开始移除位置
     * @param integer $length  移除长度
     +----------------------------------------------------------
     */
    function removeRange($offset , $length)
    {
        array_splice($this->_elements, $offset , $length);
    }

    /**
     +----------------------------------------------------------
     * 取出一定范围的数组列表
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param integer $offset  开始位置
     * @param integer $length  长度
     +----------------------------------------------------------
     */
    function range($offset,$length=NULL)
    {
        return array_slice($this->_elements,$offset,$length);
    }

    /**
     +----------------------------------------------------------
     * 设置列表元素
     * 返回修改之前的值
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param integer $index 索引
     * @param mixed $element  元素
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    function set($index, $element)
    {
        $previous = $this->get($index);
        $this->_elements[$index] = $element;
        return $previous;
    }

    /**
     +----------------------------------------------------------
     * 获取列表长度
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     */
    function size()
    {
        return count($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 转换成数组
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     */
    function toArray()
    {
        return $this->_elements;
    }

    /**
     +----------------------------------------------------------
     * 列表排序
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function ksort()
    {
        ksort($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 列表排序
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function asort()
    {
        asort($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 列表逆向排序
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function rsort()
    {
        rsort($this->_elements);
    }

    /**
     +----------------------------------------------------------
     * 自然排序
     * 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     */
    function natsort()
    {
        natsort($this->_elements);
    }

}//类定义结束
?>