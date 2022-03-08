<?php

declare(strict_types=1);

namespace ru\tasks;

use pocketmine\scheduler\Task;
use ru\MainClass;
use ru\Utils;

class BroadcastTask extends Task{
	
	public function __construct(MainClass $plugin){
		$this->plugin=$plugin;
		$this->line=-1;
	}
	public function onRun(int $tick): void
    {
		$cast=[
		Utils::BROADCAST[0],
		Utils::BROADCAST[1],
		Utils::BROADCAST[2],
		Utils::BROADCAST[3]
        ];
		$this->line++;
		$msg=$cast[$this->line];
		foreach($this->plugin->getServer()->getOnlinePlayers() as $online)
        {
			$online->sendMessage($msg);
		}
		if($this->line===count($cast) - 1) $this->line = -1;
	}
}