<?php

/**
 *      Copyright 2001-2099 DisM!应用中心.
 *      This is NOT a freeware, use is subject to license terms
 *      $Id: mobile.class.php 2017-05-12 13:24:02Z DisM.Taobao.Com $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/* 插件代码开始 */

class mobileplugin_tshuz_attachdowntimes {
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