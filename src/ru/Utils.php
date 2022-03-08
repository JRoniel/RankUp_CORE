<?php

declare(strict_types=1);

namespace ru;

use ru\MainClass;

class Utils 
{

	const BLOCKED_CHAT = '§cChat global pausado, você não pode enviar mensagens.';
	const JOIN_MESSAGE = '';
	const WELCOME_PLAYER = '§bWelcome to RankUp Server';

    public static function setGlobalMute(bool $bool)
    {
		ru\MainClass::getInstance()->globalMute=$bool;
	}

	public static function getGlobalMute(): bool
    {
		return ru\MainClass::getInstance()->globalMute;
	}
}