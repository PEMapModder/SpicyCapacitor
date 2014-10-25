<?php

namespace pemapmodder\spicycapacitor\database;

use pemapmodder\spicycapacitor\Report;
use pemapmodder\spicycapacitor\Warning;

interface Database{
	const REPORT_CLOSED = 0x01;
	const REPORT_RESOLVED = 0x02;
	/**
	 * @return ..\SpicyCapacitor
	 */
	public function getPlugin();
	/**
	 * @param Report $report
	 * @return int report ID
	 */
	public function addReport(Report $report);
	/**
	 * @param int $rid
	 * @return Report
	 */
	public function getReport($rid);
	/**
	 * @param int $rid
	 * @param string $assignee
	 * @param bool $fromObj
	 */
	public function setAssignee($rid, $assignee = "", $fromObj = false);
	/**
	 * @param int $rid
	 * @param string $remarks
	 * @param bool $fromObj
	 */
	public function setRemarks($rid, $remarks, $fromObj = false);
	/**
	 * @param int $rid
	 * @param bool $bool
	 * @param bool $fromObj
	 */
	public function setClosed($rid, $bool, $fromObj = false);
	/**
	 * @param int $rid
	 * @param bool $bool
	 * @param bool $fromObj
	 */
	public function setResolved($rid, $bool, $fromObj = false);
	/**
	 * @param Warning $warning
	 * @return int warning ID
	 */
	public function addWarning(Warning $warning);
	/**
	 * @param int $wid
	 */
	public function rmWarning($wid);
	/**
	 * @param $ip
	 * @return int
	 */
	public function getWarningPoints($ip);
}
