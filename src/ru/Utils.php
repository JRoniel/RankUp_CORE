<?php

declare(strict_types=1);

namespace ru;

use PocketMine\{
	player\Player,
	world\WorldManager,
	Server
};
use ru\MainClass;

class Utils 
{
	const WELCOME_PLAYER = '§bWelcome to RankUp Server';
	const NO_PERM = '§eVocê não tem permissão para usar isto!';
	const BLOCKED_CHAT = '§cChat global pausado, você não pode enviar mensagens.';
	const CHAT_OFF = '§cChat global do servidor foi desativado.';
	const CHAT_ON = '§aChat global do servidor foi liberado.';
	const HELP_1 = '\n
		§aComandos do Servidor (Página 1-2)\n
		- /help - Obtenha ajuda com comandos do servidor\n';
	const HELP_2 = '';
	const BROADCAST = [
		'§aBroadcast Message',
		'§aBroadcast Message',
		'§aBroadcast Message',
		'§aBroadcast Message'
	];
	#TODO MESSAGES

	public static function getFlyAllow(): bool
	{
		return ru\MainClass::getInstance()->flyAllowed;
	}

    public static function setGlobalMute(bool $bool)
    {
		ru\MainClass::getInstance()->globalMute=$bool;
	}

	public static function getGlobalMute(): bool
    {
		return ru\MainClass::getInstance()->globalMute;
	}

	public static function teleport(String $player, String $to)
	{
		if($player instanceof Player)
		{
			$world=MainClass::getInstance()->getServer()->getWorldByName($to);
			$player->teleport($world->getSafeSpawn());
		}
	}
}