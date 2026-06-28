<?php

/**
 *      Copyright 2001-2099 DisM!应用中心.
 *      This is NOT a freeware, use is subject to license terms
 *      $Id: hook.class.php 2017-05-12 13:23:54Z DisM.Taobao.Com $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/* 插件代码开始 */

class plugin_tshuz_attachdowntimes {
	function common(){
		global $_G;
		if(CURSCRIPT == 'forum' && CURMODULE == 'attachment' && $_GET['aid']){
			include DISCUZ_ROOT.'./source/plugin/tshuz_attachdowntimes/common.php';
		}
		return '';
	}
}
//From: Dism_taobao-com
?>