<?php

declare(strict_types=1);

namespace ru\commands;

use pocketmine\{
    command\CommandSender,
    command\PluginCommand,
    Player
};

use ru\Utils;
use ru\MainClass;

class helpCommand extends PluginCommand
{
	
	private $plugin;
	
	public function __construct(MainClass $plugin)
    {
		parent::__construct('help', $plugin);
		$this->plugin=$plugin;
		$this->setDescription('Help command.');
		$this->setPermission('ru.help');
		$this->setAliases(['ajuda']);
	}
    
	public function execute(CommandSender $player, string $commandLabel, array $args)
    {
		if(isset($args[0]))
		{
			switch($args[0])
			{
				case "1":
					$player->sendMessage(Utils::HELP_1);
				break;

				case "2":
					$player->sendMessage(Utils::HELP_2);
				break;

				default:
					$player->sendMessage(Utils::HELP_1);
			}
		}
	}
}