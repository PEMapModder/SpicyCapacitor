<?php

namespace pemapmodder\spicycapacitor\database;

use pemapmodder\spicycapacitor\Report;
use pemapmodder\spicycapacitor\SpicyCapacitor;
use pemapmodder\spicycapacitor\Warning;

class MysqlDatabase extends CachedDatabase{
	private $db;
	private $tblReports, $tblWarnings, $tblFigures;
	public function __construct(SpicyCapacitor $plugin, \mysqli $db, $prefix = "SpicyCapacitor"){
		$this->db = $db;
		$this->tblReports = $prefix . "reports";
		$this->tblWarnings = $prefix . "warnings";
		$this->tblFigures = $prefix . "figures";
		$this->initDb();
	}
	private function initDb(){
		// TODO: Implement initDb() method.
	}
	/**
	 * @param Report $report
	 * @return int report ID
	 */
	protected function db_addReport(Report $report){
		// TODO: Implement db_addReport() method.
	}
	/**
	 * @param $rid
	 * @return Report validated report
	 */
	protected function db_getReport($rid){
		// TODO: Implement db_getReport() method.
	}
	protected function db_setAssignee($rid, $assignee){
		// TODO: Implement db_setAssignee() method.
	}
	protected function db_setRemarks($rid, $remarks){
		// TODO: Implement db_setRemarks() method.
	}
	protected function db_setClosed($rid, $closed){
		// TODO: Implement db_setClosed() method.
	}
	protected function db_setResolved($rid){
		// TODO: Implement db_setResolved() method.
	}
	/**
	 * @param Warning $warning
	 * @return int warning ID
	 */
	public function addWarning(Warning $warning){
		// TODO: Implement addWarning() method.
	}
	/**
	 * @param int $wid
	 */
	public function rmWarning($wid){
		// TODO: Implement rmWarning() method.
	}
	/**
	 * @param $ip
	 * @return int
	 */
	public function getWarningPoints($ip){
		// TODO: Implement getWarningPoints() method.
	}
}
