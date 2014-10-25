<?php

namespace pemapmodder\spicycapacitor;

use pocketmine\plugin\PluginBase;

class SpicyCapacitor extends PluginBase{
	/** @var Configuration */
	private $configuration;
	/** @var database\Database */
	private $db;
	public function onEnable(){
		$this->configuration = new Configuration($this);
		$this->initDb();
	}
	private function initDb(){
		$this->db = $this->configuration->newDatabase();
	}
	public function getFile(){
		return parent::getFile();
	}
}
