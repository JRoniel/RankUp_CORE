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
	const TELEPORT_MESSAGE = '';
	const CHAT_OFF = '§cChat global do servidor foi desativado.';
	const CHAT_ON = '§aChat global do servidor foi liberado.';
	const HELP_1 = '';
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

	public static function teleport(Player $player, String $to)
	{
		$world=MainClass::getInstance()->getServer()->getWorldByName($to);
		$player->teleport($world->getSafeSpawn());
	}
}