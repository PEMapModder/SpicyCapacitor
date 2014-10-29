<?php

namespace pemapmodder\spicycapacitor;

use pocketmine\Player;

interface ChatLogger{
	public function getChatFromPlayer(Player $player);
}
