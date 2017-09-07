<?php

/**
 * 递归转义
 * @param $data
 * @param $except
 */
function _addslashes($data,$except){
	if(is_string($data)){
		return addslashes($data);
	}else if(is_array($data)){
		foreach ($data as $k=>$d){
			if(empty(array_keys($except,$k))){
				$data[$k]=_addslashes($d,$except);
			}	
		}
	}
	
	return $data;
}


function _addslashes0($data,$except){
	foreach ($data as $k=>$d){
		if(empty(array_keys($except,$k))){
			if(is_string($d)){
				$data[$k] = addslashes($d);
			}else if(is_array($d)){
				$data[$k]=_addslashes($d,$except);
			}
		}
	}
	
	return $data;
}