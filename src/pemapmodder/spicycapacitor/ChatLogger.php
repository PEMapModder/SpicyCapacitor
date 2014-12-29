<?php

namespace pemapmodder\spicycapacitor;

use pocketmine\Player;

interface ChatLogger{
	public function __construct(SpicyCapacitor $spicyCapacitor);
	public function getChatFromPlayer(Player $player);
}
