<?php

/**
 *      Copyright 2001-2099 DisM!应用中心.
 *      This is NOT a freeware, use is subject to license terms
 *      $Id: common.php 2017-05-12 13:28:53Z DisM.Taobao.Com $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/* 插件代码开始 */
if($_G['uid']){
	$pvars = $_G['cache']['plugin']['tshuz_attachdowntimes'];
	$groups = dunserialize($pvars['groups']);
	$forums = dunserialize($pvars['forums']);
	$maxtimes = (int)dintval($groups[$_G['groupid']]);
	if($maxtimes){
		$oldGet = $_GET;
		@list($_GET['aid'], $_GET['k'], $_GET['t'], $_GET['uid'], $_GET['tid']) = daddslashes(explode('|', base64_decode($_GET['aid'])));
		$aid = dintval($_GET['aid']);
		$k = $_GET['k'];
		$t = $_GET['t'];
		$authk = substr(md5($aid.md5($_G['config']['security']['authkey']).$t.$_GET['uid']), 0, 8);
		if($k != $authk) showmessage('attachment_nonexistence');
		$tid = $_GET['tid'];
		if($tid){
			$tableid = substr($tid,-1);
		}else{
			$attach = C::t("forum_attachment")->fetch($aid);
			$tableid = $attach['tableid'];
		}
		$filter = unserialize($pvars['filter']);
		$attach = C::t("forum_attachment_n")->fetch($tableid,$aid);
		if(!$attach) showmessage('attachment_nonexistence');
		if(!in_array($attach['isimage'],$filter)){
			$tid = $attach['tid'];
			$thread = C::t("forum_thread")->fetch($tid);
			$pvars['second'] = $pvars['second'] < 3 ? 3 : $pvars['second'];
			if (in_array($thread['fid'], $forums) && $_G['uid'] != $attach['uid']) {
				$check = C::t("#tshuz_attachdowntimes#log")->fetch_by_uid_aid($_G['uid'], $aid);
				if (!$check || ($pvars['second'] && TIMESTAMP - $check['dateline'] > $pvars['second'])) {
					$today = strtotime(date("Y-m-d", TIMESTAMP));
					$count = C::t("#tshuz_attachdowntimes#log")->count_by_uid_dateline($_G['uid'], $today);
					if ($count >= $maxtimes) showmessage($pvars['tip'], '', array("max" => $maxtimes));
					$data = array();
					$data['uid'] 		= $_G['uid'];
					$data['username'] 	= $_G['username'];
					$data['tid'] 		= $tid;
					$data['aid'] 		= (int)$aid;
					$data['attachname'] = $attach['filename'];
					$data['ip'] 		= addslashes($_G['clientip']);
					$data['dateline'] 	= TIMESTAMP;
					C::t("#tshuz_attachdowntimes#log")->insert($data);
				}
			}
		}
		$_GET = $oldGet;
	}
}