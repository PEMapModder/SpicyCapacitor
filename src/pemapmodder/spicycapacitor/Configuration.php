<?php

namespace pemapmodder\spicycapacitor;

use pemapmodder\spicycapacitor\database\MysqlDatabase;
use pemapmodder\spicycapacitor\database\SQLite3Database;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Configuration{
	/** @var SpicyCapacitor */
	private $plugin;
	/** @var Config */
	private $config;
	public function __construct(SpicyCapacitor $plugin){
		$this->plugin = $plugin;
		$this->config = $plugin->getConfig();
	}
	/**
	 * @return database\Database
	 */
	public function newDatabase(){
		$type = $this->config->get("database");
		switch(strtolower($type)){
			case "mysql":
				$config = $this->config->get("mysql");
				$conn = $config["connection"];
				$mysqli = new \mysqli($conn["address"], $conn["username"], $conn["password"], $conn["database"], $conn["port"]);
				if($mysqli->connect_error){
					$this->plugin->getLogger()->warning("Cannot connect to MySQL database ({$mysqli->connect_error})! Using SQLite3 database instead");
				}
				else{
					return new MysqlDatabase($this->plugin, $mysqli);
				}
			case "sqlite3":
				$config = $this->config->get("sqlite3");
				$path = $this->evalPath($config["database path"]);
				return new SQLite3Database($this->plugin, new \SQLite3($path));
			default:
				throw new \RuntimeException(TextFormat::YELLOW . "Unknown database type $type" . TextFormat::RED);
		}

	}
	public function evalPath($path){
		$pos = strpos($path, "://");
		if($pos === false){
			$full = $this->plugin->getDataFolder() . $path;
		}
		else{
			$subpath = substr($path, $pos + 3);
			switch(strtolower(substr($path, 0, $pos))){
				case "file":
					$full = $subpath;
					break;
				case "res":
					$full = rtrim($this->plugin->getFile(), "/\\") . "/" . "resources/$subpath";
					break;
				default:
					$full = $path;
					break;
			}
		}
		return $full;
	}
}
