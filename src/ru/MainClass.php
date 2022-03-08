<?php

declare(strict_types=1);

namespace ru;

use ru\{
	listeners\PlayerEvents,

	tasks\BroadcastTask,

	commands\muteChatCommand,
	commands\helpCommand
};
use PocketMine\{
	world\WorldManager,
    plugin\PluginBase,
    Server
};
use function array_diff;
use function scandir;

class MainClass extends PluginBase {

    public $globalMute = false;
	public $flyAllowed = false;

	private WorldManager $worldmanager;

    private static $instance;

	const PREFIX = '[RU]';
	const VERSION = '0.2-alpha';
    const LOBBY = 'lobby';
	const RPG_WORLD = 'rpg';

	public function getWorldManager() : WorldManager{
		return $this->worldManager;
	}

    public static function getInstance(): MainClass
	{
		return self::$instance;
	}
    
    public function onEnable(): void 
    {
		self::$instance = $this; 
		$this->disableCommands();
		$this->setCommands();
		$this->getServer()->getPluginManager()->registerEvents(new PlayerEvents($this), $this);
		$this->getScheduler()->scheduleDelayedRepeatingTask(new BroadcastTask($this), 200, 11000);
		foreach (array_diff(scandir($this->getServer()->getDataPath() . "worlds"), ["..", "."]) as $worldName) {
            $this->getWorldManager()->loadWorld($worldName);
        }
		foreach($this->getServer()->getLevels() as $levels){
			foreach($levels->getEntities() as $entity){
				$entity->close();
			}
		}
        $this->getLogger()->info('RU >> Núcleo funcional e assicróno, RankUp_Class '.self::VERSION);
    }


	
	public function setCommands()
	{
		$map=$this->getServer()->getCommandMap();
		$map->register("mute", new muteChatCommand($this));
		$map->register("help", new helpCommand($this));
	}

    public function disableCommands()
    {
		$map = $this->getServer()->getCommandMap();
		$map->unregister($map->getCommand("kill"));
		$map->unregister($map->getCommand("me"));
		$map->unregister($map->getCommand("op"));
		$map->unregister($map->getCommand("deop"));
		$map->unregister($map->getCommand("enchant"));
		$map->unregister($map->getCommand("effect"));
		$map->unregister($map->getCommand("defaultgamemode"));
		$map->unregister($map->getCommand("difficulty"));
		$map->unregister($map->getCommand("title"));
		$map->unregister($map->getCommand("seed"));
		$map->unregister($map->getCommand("particle"));
		$map->unregister($map->getCommand("gamemode"));
		$map->unregister($map->getCommand("say"));
		$map->unregister($map->getCommand("version"));
		$map->unregister($map->getCommand("help"));
	}
}