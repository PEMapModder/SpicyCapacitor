<?php

namespace pemapmodder\spicycapacitor\command;

use pemapmodder\spicycapacitor\SpicyCapacitor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

abstract class AbstractSpicyCapacitorCommand extends Command implements PluginIdentifiableCommand{
	/** @var SpicyCapacitor */
	private $plugin;
	public function __construct(SpicyCapacitor $plugin, $name, $desc, $usage, $alias, $perm){
		$this->plugin = $plugin;
		parent::__construct($name, $desc, $usage, is_array($alias) ? $alias:[$alias]);
		$this->setPermission($perm);
	}
	public function execute(CommandSender $sender, $lbl, array $args){
		if(!$this->testPermission($sender)){
			return false;
		}
		if(($result = $this->onRun($args, $sender)) === false){
			$sender->sendMessage($this->getUsage());
		}
		elseif(is_string($result)){
			$sender->sendMessage($result);
		}
		return true;
	}
	protected abstract function onRun(array $args, CommandSender $sender);
	/**
	 * @return SpicyCapacitor
	 */
	public function getPlugin(){
		return $this->plugin;
	}
}
