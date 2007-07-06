// +---------------------------------------------------------------------------+
// | FCS -- Fast,Compatible & Simple OOP PHP Framework                         |
// | FCS JS 基类库                                                             |
// +---------------------------------------------------------------------------+
// | Copyright (c) 2005-2006 liu21st.com.  All rights reserved.                |
// | Website: http://www.fcs.org.cn/                                           |
// | Author : Liu21st 流年 <liu21st@gmail.com>                                 |
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
 * 下拉列表多选类
 +------------------------------------------------------------------------------
 * @package    Form
 * @link       http://www.fcs.org.cn
 * @copyright  Copyright (c) 2005-2006 liu21st.com.  All rights reserved. 
 * @author     liu21st <liu21st@gmail.com>
 * @version    $Id: MoveLayer.js 73 2006-11-08 10:08:01Z fcs $
 +------------------------------------------------------------------------------
 */
var theobject = null; //This gets a value as soon as a resize start

function resizeObject() {
	this.el        = null; //pointer to the object
	this.dir    = "";      //type of current resize (n, s, e, w, ne, nw, se, sw)
	this.grabx = null;     //Some useful values
	this.graby = null;
	this.width = null;
	this.height = null;
	this.left = null;
	this.top = null;
}
	

//Find out what kind of resize! Return a string inlcluding the directions
function getDirection(el) {
	var xPos, yPos, offset, dir;
	dir = "";

	xPos = window.event.offsetX;
	yPos = window.event.offsetY;

	offset = 8; //The distance from the edge in pixels

	if (yPos<offset) dir += "n";
	else if (yPos > el.offsetHeight-offset) dir += "s";
	if (xPos<offset) dir += "w";
	else if (xPos > el.offsetWidth-offset) dir += "e";

	return dir;
}

function doDown() {
	var el = getReal(event.srcElement, "className", "resizeMe");

	if (el == null) {
		theobject = null;
		return;
	}		

	dir = getDirection(el);
	if (dir == "") return;

	theobject = new resizeObject();
		
	theobject.el = el;
	theobject.dir = dir;

	theobject.grabx = window.event.clientX;
	theobject.graby = window.event.clientY;
	theobject.width = el.offsetWidth;
	theobject.height = el.offsetHeight;
	theobject.left = el.offsetLeft;
	theobject.top = el.offsetTop;

	window.event.returnValue = false;
	window.event.cancelBubble = true;
}

function doUp() {
	if (theobject != null) {
		theobject = null;
	}
}

function doMove() {
	var el, xPos, yPos, str, xMin, yMin;
	xMin = 8; //The smallest width possible
	yMin = 8; //             height

	el = getReal(event.srcElement, "className", "resizeMe");

	if (el.className == "resizeMe") {
		str = getDirection(el);
	//Fix the cursor	
		if (str == "") str = "default";
		else str += "-resize";
		el.style.cursor = str;
	}
	
//Dragging starts here
	if(theobject != null) {
		if (dir.indexOf("e") != -1)
			theobject.el.style.width = Math.max(xMin, theobject.width + window.event.clientX - theobject.grabx) + "px";
	
		if (dir.indexOf("s") != -1)
			theobject.el.style.height = Math.max(yMin, theobject.height + window.event.clientY - theobject.graby) + "px";

		if (dir.indexOf("w") != -1) {
			theobject.el.style.left = Math.min(theobject.left + window.event.clientX - theobject.grabx, theobject.left + theobject.width - xMin) + "px";
			theobject.el.style.width = Math.max(xMin, theobject.width - window.event.clientX + theobject.grabx) + "px";
		}
		if (dir.indexOf("n") != -1) {
			theobject.el.style.top = Math.min(theobject.top + window.event.clientY - theobject.graby, theobject.top + theobject.height - yMin) + "px";
			theobject.el.style.height = Math.max(yMin, theobject.height - window.event.clientY + theobject.graby) + "px";
		}
		
		window.event.returnValue = false;
		window.event.cancelBubble = true;
	} 
}


function getReal(el, type, value) {
	temp = el;
	while ((temp != null) && (temp.tagName != "BODY")) {
		if (eval("temp." + type) == value) {
			el = temp;
			return el;
		}
		temp = temp.parentElement;
	}
	return el;
}

document.onmousedown = doDown;
document.onmouseup   = doUp;
document.onmousemove = doMove;
/*
if (moz) {
	extendElementModel();
	extendEventObject();
	emulateEventHandlers(["mousemove", "mousedown", "mouseup"]);
}*/