<?php

namespace pemapmodder\spicycapacitor\command;

use pemapmodder\spicycapacitor\SpicyCapacitor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class GeneralCommand extends Command implements PluginIdentifiableCommand{
	private $plugin;
	public function __construct(SpicyCapacitor $plugin){
		parent::__construct("scinfo", "SpicyCapacitor information command", "/scinfo sc|report|warning");
		$this->plugin = $plugin;
	}
	public function execute(CommandSender $sender, $commandLabel, array $args){
		// everyone has permission to use this plugin
		if(!isset($args[0])){
			$args[0] = "sc";
		}
		switch($args[0]){
			case "sc":
				$sender->sendMessage(<<<EOM
SpicyCapacitor is an administrative tool.
SpicyCapacitor allows players to send reports
(about other misbehaving players, for example)
that are never missed, and for operators to issue
warning points that ban players for a period of
time when they have too many points.
For information about reporting, use
`/scinfo report`. For information about the
warning points system on this server, use
`/scinfo warning`. For op info, use `scopinfo`.
EOM
				);
				break;
			case "report":
				$sender->sendMessage(<<<EOM
SpicyCapacitor reports are guaranteed to never be
"lost" during waiting for operators to read them.
Each report consists of: your name and IP, the
reported player's name and IP, the message you
typed for the report (optional) and the attached
information. For different report types, there
is different attached information. Currently
there are two report types: chat and motion.
Chat logs contain the recent 50 lines of chat,
and motion logs contain the recent 60 seconds of
a player's motion. For op info, use `/scopinfo`.
Use the /report command to send a report:
`/report chat|motion <player> [message ...]
EOM
				);
				break;
			case "warning":
				$sender->sendMessage(<<<EOM
Warning points are issued by server operators to
record how many bad things you have done. Each
warning has its unique ID and attached message on
why the warning was issued. After a warning point
is issued, your total unexpired warning points
will be added up. If the warning points exceed a
certain amount, you will receive punishment, such
as a timed ban or permanent ban. To see the
warnings you have received, use the command
`/warnings`. For op info, use `/scopinfo`.
EOM
				);
				break;
		}
	}
	public function getPlugin(){
		return $this->plugin;
	}
}
