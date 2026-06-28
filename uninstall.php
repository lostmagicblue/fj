<?php
/**
 * Copyright 2001-2099 DisM!应用中心.
 * This is NOT a freeware, use is subject to license terms
 * 应用更新支持：https://dism.taobao.com
 * 最新插件：http://t.cn/Aiux1Jx1
 * 本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 * 如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_tshuz_attachdowntimes`;
EOF;
runquery($sql);
if(!function_exists('cloudaddons_deltree')) require libfile('function/cloudaddons');
cloudaddons_deltree(DISCUZ_ROOT .'./source/plugin/tshuz_attachdowntimes/');
$finish = true;
?>