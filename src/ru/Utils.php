<?php

declare(strict_types=1);

namespace ru;

use ru\MainClass;

class Utils 
{
	const JOIN_MESSAGE = '';
	const WELCOME_PLAYER = '§bWelcome to RankUp Server';
	const NO_PERM = '§eVocê não tem permissão para usar isto!';
	const BLOCKED_CHAT = '§cChat global pausado, você não pode enviar mensagens.';
	const CHAT_OFF = '§cChat global do servidor foi desativado.';
	const CHAT_ON = '§aChat global do servidor foi liberado.';
	#TODO MESSAGES

    public static function setGlobalMute(bool $bool)
    {
		ru\MainClass::getInstance()->globalMute=$bool;
	}

	public static function getGlobalMute(): bool
    {
		return ru\MainClass::getInstance()->globalMute;
	}
}