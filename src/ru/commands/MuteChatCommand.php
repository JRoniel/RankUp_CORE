<?php

namespace ru\commands;

use pocketmine\{
    command\CommandSender,
    command\PluginCommand,
    Player
};

use ru\Utils;
use ru\MainClass;

class MuteChatCommand extends PluginCommand
{
	
	private $plugin;
	
	public function __construct(MainClass $plugin)
    {
		parent::__construct('mute', $plugin);
		$this->plugin=$plugin;
		$this->setDescription('Silencie o chat global do servidor.');
		$this->setPermission('ru.mutechat');
		$this->setAliases(['muteall']);
	}
    
	public function execute(CommandSender $player, string $commandLabel, array $args)
    {
		if(!$player->hasPermission('ru.mutechat'))
        {
			$player->sendMessage('§cVocê não pode executar esse comando.');
			return;
		}
		if(Utils::getGlobalMute()==false)
        {
            Utils::setGlobalMute(true);
			$player->sendMessage('§cChat global foi bloquado aos jogadores...');
            $this->plugin->getServer()->broadcastMessage('§c'.$player->getName().' silênciou o chat global!');
        } else {
            Utils::setGlobalMute(false);
			$player->sendMessage('§aChat global foi liberado aos jogadores...');
            $this->plugin->getServer()->broadcastMessage('§c'.$player->getName().' liberou o chat global!');
		} 
	}
}