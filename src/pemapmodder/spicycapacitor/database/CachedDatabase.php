<?php

namespace pemapmodder\spicycapacitor\database;

use pemapmodder\spicycapacitor\Report;
use pemapmodder\spicycapacitor\SpicyCapacitor;

abstract class CachedDatabase implements Database{
	/** @var Report */
	private $cachedReports = [];
	protected $plugin;
	protected function __construct(SpicyCapacitor $plugin){
		$this->plugin = $plugin;
	}
	public function getPlugin(){
		return $this->plugin;
	}
	public function addReport(Report $report){
		$id = $this->db_addReport($report);
		$this->cachedReports[$id] = $report;
		$report->validate($id);
	}
	/**
	 * @param Report $report
	 * @return int report ID
	 */
	protected abstract function db_addReport(Report $report);
	public function getReport($rid){
		if(isset($this->cachedReports[$rid])){
			return $this->cachedReports[$rid];
		}
		$report = $this->db_getReport($rid);
		$this->cachedReports[$rid] = $report;
		return $report;
	}
	/**
	 * @param $rid
	 * @return Report validated report
	 */
	protected abstract function db_getReport($rid);
	public function setAssignee($rid, $assignee = "", $fromObj = false){
		$report = $this->getReport($rid);
		if(!$fromObj){
			$report->setAssignee($assignee, true);
		}
		$this->db_setAssignee($rid, $assignee);
	}
	protected abstract function db_setAssignee($rid, $assignee);
	public function setRemarks($rid, $remarks, $fromObj = false){
		$report = $this->getReport($rid);
		if(!$fromObj){
			$report->setRemarks($remarks, true);
		}
		$this->db_setRemarks($rid, $remarks);
	}
	protected abstract function db_setRemarks($rid, $remarks);
	public function setClosed($rid, $closed, $fromObj = false){
		$report = $this->getReport($rid);
		if(!$fromObj){
			$report->setClosed($closed, true);
		}
		$this->db_setClosed($rid, $closed);
	}
	protected abstract function db_setClosed($rid, $closed);
	public function setResolved($rid, $resolved, $fromObj = false){
		$report = $this->getReport($rid);
		if(!$fromObj){
			$report->setResolved($resolved, true);
		}
		$this->db_setResolved($resolved);
	}
	protected abstract function db_setResolved($rid);
}
