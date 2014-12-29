<?php

namespace pemapmodder\spicycapacitor\command;

use pemapmodder\spicycapacitor\SpicyCapacitor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class GeneralCommand extends Command implements PluginIdentifiableCommand{
	private $plugin;
	public function __construct(SpicyCapacitor $plugin){
		parent::__construct("spicycapacitor", "SpicyCapacitor information command", "/scinfo [sc|report|warning]", ["scinfo"]);
		$this->plugin = $plugin;
	}
	public function execute(CommandSender $sender, $commandLabel, array $args){
		// everyone has permission to use this plugin
		if(!isset($args[0])){
			$args[0] = "sc";
		}
		switch($args[0]){
			case "sc":
				$sender->sendMessage("SpicyCapacitor is an admin tool that allows players to " .
					"report other players to server moderators. Whether or not a moderator is online, " .
					"the report will be added into a list that moderators should read reports from.\n" .
					"This tool also allows moderators to issue warning points to players, and players " .
					"will be automatically banned if they have too many warning points.\n" .
					"For information about reporting, send `/scinfo report`.\n" .
					"For information about warnings, send `/scinfo warning`.\n" .
					"If you are a moderator, use `/scmodinfo`.");
				break;
			case "report":
				$sender->sendMessage("You can send a report with the command " .
					"`/rep <target> <type[:<time>]>[message ...]`.\n" .
					"<target> is the player you want to report.\n" .
					"<type> is the type of the report. Different types of reports contain different data for moderators to investigate.\n" .
					"One type is \"chat\" reports, where the conversation on the server in the past " .
					"30 seconds are attached to the report. You can change the time using the " .
					"<time> field.\n" .
					"Another type is \"motion\" reports, where the reported player's motions in the last " .
					"30 seconds are attached to the report. Again, you can change the <time> field.\n" .
					"You can add any message you want moderators-in-charge to see in the [message] field.\n" .
					"View the reports you made with the `/mrep` command");
				break;
			case "warning":
				$sender->sendMessage("TODO");
				break;
			default:
				$sender->sendMessage("Info not found. Usage: /scinfo [sc|report|warning]");
		}
	}
	public function getPlugin(){
		return $this->plugin;
	}
}
