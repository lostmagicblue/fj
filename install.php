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
CREATE TABLE `cdb_tshuz_attachdowntimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  `tid` int(8) DEFAULT NULL,
  `ip` int(20) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `attachname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`username`,`dateline`,`tid`,`ip`,`aid`)
) ENGINE=MyISAM;
EOF;
runquery($sql);
$identifier = 'tshuz_attachdowntimes';
/* 删除文件 */
$extras = array("SC_UTF8","SC_GBK","TC_UTF8","TC_BIG5");
$entrydir = DISCUZ_ROOT.'./source/plugin/'.$identifier;
foreach($extras as $extra){
  @unlink($entrydir.'/discuz_plugin_'.$identifier."_".$extra.'.xml');
}
@unlink($entrydir.'/discuz_plugin_'.$identifier.'.xml');
@unlink($entrydir.'/install.php');
@unlink($entrydir.'/upgrade.php');
$finish = true;
?>