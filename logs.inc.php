<?php

/**
 *      Copyright 2001-2099 DisM!应用中心.
 *      This is NOT a freeware, use is subject to license terms
 *      $Id: logs.inc.php 2017-05-12 13:24:24Z DisM.Taobao.Com $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

/* 插件代码开始 */
$perpage = 15;
$page = intval ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1;
$start = ($page - 1) * $perpage;
if ($start < 0)
$start = 0;
$count = C::t("#tshuz_attachdowntimes#log")->count();
$multi=	multi($count, $perpage, $page, ADMINSCRIPT.'?action=plugins&operation=config&do='.$_GET['do'].'&identifier='.$_GET['identifier'].'&pmod='.$_GET['pmod']);
$list = C::t("#tshuz_attachdowntimes#log")->fetch_all($start,$perpage);
showtableheader(lang('plugin/tshuz_attachdowntimes','P01YyJ'));
showsubtitle(array(lang('plugin/tshuz_attachdowntimes','Ha1Yn6'),lang('plugin/tshuz_attachdowntimes','hZ1zZm'),lang('plugin/tshuz_attachdowntimes','I7eEY0'),lang('plugin/tshuz_attachdowntimes','cNbbNa'),lang('plugin/tshuz_attachdowntimes','uflaAY')));
$tids = array();
foreach($list as $key=>$log){
	if(!in_array($log['tid'],$tids) ) $tids[] = $log['tid'];
}
$threads = C::t("forum_thread")->fetch_all_by_tid($tids);
foreach($list as $key=>$log){
	$tid = $log['tid'];
	showtablerow('', array(
		'width="140"',
		'',
		'width="300"',
		'class="td31"',
		'class="td24"',
	) , array(
		'<a href="home.php?mod=space&uid='.$log['uid'].'" target="_blank">'.$log['username'].'</a>',
		'<a href="forum.php?mod=viewthread&tid='.$log['tid'].'" target="_blank">'.$threads[$tid]['subject']."</a>",
		$log['attachname'],
		date("Y-m-d H:i:s",$log['dateline']),
		ctype_digit($log['ip']) ? long2ip($log['ip']) : $log['ip'],
	));
}
if($multi)	showtablerow('',array('colspan=5 style="text-align: right;"'), array($multi));
showtablefooter(); /*dism · taobao · com*/
?>