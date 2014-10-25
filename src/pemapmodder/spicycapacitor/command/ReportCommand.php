<?php

namespace pemapmodder\spicycapacitor\command;

use pemapmodder\spicycapacitor\SpicyCapacitor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class ReportCommand extends Command implements PluginIdentifiableCommand{
	private $plugin;
	public function __construct(SpicyCapacitor $plugin){
		parent::__construct("report", "Report a player", "use '/sc help report' for help", ["rep"]);
		$this->setPermission("spicycap.report");
		$this->plugin = $plugin;
	}
	public function getPlugin(){
		return $this->plugin;
	}
	public function execute(CommandSender $sender, $alias, array $args){
		// TODO: Implement execute() method.
	}
}
