/******************************************************************************
 Javascript Utilities
 author Olaf Hannemann
 license GPL V3
 version 0.1.0

 This file is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This file is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License (http://www.gnu.org/licenses/)for more details.
 ******************************************************************************/

function setCookie(key, value) {
	var expireDate = new Date;
	expireDate.setMonth(expireDate.getMonth() + 6);
	document.cookie = key + "=" + value + ";" + "expires=" + expireDate.toGMTString() + ";";
}

function getCookie(argument) {
	var buff = document.cookie;
	var args = buff.split(";");
	for(i = 0; i < args.length; i++) {
		var a = args[i].split("=");
		if(trim(a[0]) == argument) {
			return trim(a[1]);
		}
	}
	return "-1";
}

function checkKeyReturn(e) {
	if (e.keyCode == 13) {
		return true;
	} else {
		return false;
	}
}

function trim(buffer) {
	  return buffer.replace(/^\s+/, '').replace(/\s+$/, '');
}

function convert2Web(buffer) {
	buffer = buffer.replace('&', '&amp;');
	buffer = buffer.replace('<', '&lt;');
	buffer = buffer.replace('>', '&gt;');
	buffer = buffer.replace('\'', '&apos;');
	buffer = buffer.replace('\"', '&quot;');
	
	return buffer
}
