<?php

/**
 *      Copyright 2001-2099 DisM!应用中心.
 *      This is NOT a freeware, use is subject to license terms
 *      $Id: table_log.php 2017-05-12 13:41:53Z DisM.Taobao.Com $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/* 插件代码开始 */

class table_log extends discuz_table
{
	public function __construct() {

		$this->_table = 'tshuz_attachdowntimes';
		$this->_pk    = 'id';
		parent::__construct(); /*dism·taobao·com*/
	}
	
	public function count_by_uid_dateline($uid,$dateline){
		return DB::result_first("SELECT count(*) FROM %t WHERE uid=%d AND dateline>=%d",array($this->_table,$uid,$dateline));
	}

	public function fetch_by_uid_aid($uid,$aid){
		return DB::fetch_first("SELECT * FROM %t WHERE uid=%d AND aid=%d ORDER BY dateline DESC",array($this->_table,$uid,$aid));
	}

	public function fetch_all($start,$perpage){
		return DB::fetch_all("SELECT * FROM %t ORDER BY dateline DESC LIMIT %d,%d",array($this->_table,$start,$perpage));
	}
	
}
//From: Dism_taobao-com
?>
