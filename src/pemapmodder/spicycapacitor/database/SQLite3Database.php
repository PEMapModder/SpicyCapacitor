<?php

namespace pemapmodder\spicycapacitor\database;

use pemapmodder\spicycapacitor\Report;
use pemapmodder\spicycapacitor\SpicyCapacitor;
use pemapmodder\spicycapacitor\Warning;

class SQLite3Database extends CachedDatabase{
	const VERSION_INITIAL = 0;
	const VERSION_CUR = self::VERSION_INITIAL;
	private $db;
	private $tblReports, $tblWarnings, $tblFigures;
	public function __construct(SpicyCapacitor $plugin, \SQLite3 $db, $prefix = ""){
		$this->db = $db;
		$this->tblReports = $prefix . "reports";
		$this->tblWarnings = $prefix . "warnings";
		$this->tblFigures = $prefix . "figures";
		$this->initDb();
	}
	private function initDb(){
		$this->db->exec("CREATE TABLE IF NOT EXISTS {$this->tblReports} (
				rid INT PRIMARY KEY
				);");
		$this->db->exec("CREATE TABLE IF NOT EXISTS {$this->tblWarnings} (
				wid INT PRIMARY KEY
				);");
		$this->db->exec("CREATE TABLE IF NOT EXISTS {$this->tblFigures} (
				name CHAR(3) PRIMARY KEY,
				value INT
				);");
		$this->db->exec("INSERT INTO {$this->tblFigures} (name, value)
				SELECT 'rid', 0
				WHERE NOT EXISTS (
					SELECT name FROM {$this->tblFigures} WHERE name='rid'
				) LIMIT 1;");
		$this->db->exec("INSERT INTO {$this->tblFigures} (name, value)
				SELECT 'wid', 0
				WHERE NOT EXISTS (
					SELECT name FROM {$this->tblFigures} WHERE name='wid'
				) LIMIT 1;");
		$array = $this->db->query("SELECT value FROM {$this->tblFigures} WHERE name='version';")->fetchArray(SQLITE3_ASSOC);
		if(is_array($array)){
			$version = $array["value"];
			if($version !== self::VERSION_CUR){
				// TODO implement this on later versions
			}
		}
		$op = $this->db->prepare("INSERT OR REPLACE INTO {$this->tblFigures} (name, value) VALUES (:name, :value);");
		$op->bindValue(":name", "version");
		$op->bindValue(":value", self::VERSION_CUR);
		$op->execute();
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
