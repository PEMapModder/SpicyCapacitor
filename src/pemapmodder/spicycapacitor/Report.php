<?php

namespace pemapmodder\spicycapacitor;

use pemapmodder\spicycapacitor\database\Database;

class Report{
	/** @var Database  */
	private $db;
	/** @var int|null */
	private $rid = null;
	/** @var string */
	private $reporter, $target, $reporterIp, $targetIp, $message, $attachment, $remarks, $assignee;
	/** @var int */
	private $flags;
	/** @var bool */
	private $closed, $resolved;
	/**
	 * @param Database $db
	 * @param string $reporter
	 * @param string $reporterIp
	 * @param string $target
	 * @param string $targetIp
	 * @param string $message
	 * @param string $attachment
	 * @param string $remarks
	 * @param string $assignee
	 * @param int $flags
	 * @param int $state
	 */
	public function __construct(Database $db, $reporter, $reporterIp, $target, $targetIp, $message, $flags, $attachment, $remarks, $assignee, $state){
		$this->db = $db;
		$this->reporter = $reporter;
		$this->reporterIp = $reporterIp;
		$this->target = $target;
		$this->targetIp = $targetIp;
		$this->message = $message;
		$this->flags = $flags;
		$this->attachment = $attachment;
		$this->remarks = $remarks;
		$this->closed = ($state & Database::REPORT_CLOSED) > 0;
		$this->resolved = ($state & Database::REPORT_RESOLVED) > 0;
		$this->assignee = $assignee;
	}
	/**
	 * @param int $rid
	 */
	public function validate($rid){
		$this->rid = $rid;
	}
	public function isValid(){
		return is_int($this->rid);
	}
	/**
	 * @return string
	 */
	public function getReporter(){
		return $this->reporter;
	}
	/**
	 * @return string
	 */
	public function getReporterIp(){
		return $this->reporterIp;
	}
	/**
	 * @return string
	 */
	public function getTarget(){
		return $this->target;
	}
	/**
	 * @return string
	 */
	public function getTargetIp(){
		return $this->targetIp;
	}
	/**
	 * @return string
	 */
	public function getMessage(){
		return $this->message;
	}
	/**
	 * @return string
	 */
	public function getAttachment(){
		return $this->attachment;
	}
	public function getRemarks(){
		return $this->remarks;
	}
	public function setRemarks($remarks, $fromDb = false){
		if(!$fromDb){
			$this->db->setRemarks($this->getID(), $remarks);
		}
		$this->remarks = $remarks;
	}
	/**
	 * @return string
	 */
	public function getAssignee(){
		return $this->assignee;
	}
	public function setAssignee($assignee, $fromDb = false){
		if($fromDb){
			$this->db->setAssignee($this->getID(), $assignee);
		}
		$this->assignee = $assignee;
	}
	public function clearAssignee($fromDb = false){
		$this->setAssignee("", $fromDb);
	}
	/**
	 * @return int
	 */
	public function getFlags(){
		return $this->flags;
	}
	/**
	 * @return boolean
	 */
	public function isClosed(){
		return $this->closed;
	}
	public function setClosed($bool = true, $fromDb = false){
		if(!$fromDb){
			$this->db->setClosed($this->getID(), $bool, true);
		}
		$this->closed = $bool;
	}
	/**
	 * @return boolean
	 */
	public function isResolved(){
		return $this->resolved;
	}
	public function setResolved($bool = true, $fromDb = false){
		if(!$fromDb){
			$this->db->setResolved($this->getID(), $bool, true);
		}
		$this->resolved = $bool;
	}
	public function getID(){
		if(!$this->isValid()){
			throw new \RuntimeException("ID not validated!");
		}
		return $this->rid;
	}
}
