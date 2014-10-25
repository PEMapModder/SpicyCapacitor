<?php

namespace pemapmodder\spicycapacitor\command;

use pemapmodder\spicycapacitor\SpicyCapacitor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class GeneralCommand extends Command implements PluginIdentifiableCommand{
	private $plugin;
	public function __construct(SpicyCapacitor $plugin){
		parent::__construct("scinfo", "SpicyCapacitor information command", "/scinfo report|warning");
		$this->plugin = $plugin;
	}
	public function execute(CommandSender $sender, $commandLabel, array $args){
		// TODO: Implement execute() method.
	}
	public function getPlugin(){
		return $this->plugin;
	}
}
