<?php

declare(strict_types=1);

namespace ru\listeners;

use PocketMine\{
    player\Player,
    entity\Skin,
    event\Listener,
    event\player\PlayerChatEvent,
    event\player\PlayerJoinEvent,
    event\player\PlayerQuitEvent,
    event\player\PlayerDeathEvent,
    event\player\PlayerExhaustEvent,
    event\entity\EntityDeathEvent
};

use ru\MainClass;
use ru\Utils;

use function json_decode;

class PlayerEvents implements Listener 
{

    public function __construct(private MainClass $plugin){ }

    /*
    * chatTratament String
    * Trata as mensagens do servidor contra CAIXA-ALTA e palavrões pré-configurados em dois estágios.
    * O primeiro estágio retira a caixa-alta, o segundo os palavrões são trocados por 'bobba'.
    * @return text
    */
    private function chatTratament(String $message): string
    {
        $s1=ucfirst(strtolower($message));
        $file=file_get_contents('ur\data\badworlds.json');
        $badword=json_decode($file['badworlds'], true);
        $count=count($badword);
        for($i=0; $i < $count; $i++)
        {
        $text=str_ireplace($badword[$i], 'bobba', $s1);
        } 
        return $text;
    }

    public function onChat(PlayerChatEvent $event) : void 
    {
        $event->setMessage($this->chatTratament($event->getMessage()));
        if(!ru\Utils::getGlobalMute())
        {
            $event->getPlayer()->sendMessage(\ru\Utils::BLOCK_CHAT);
            $event->setCancelled();
        }
    }

    public function onJoin(PlayerJoinEvent $event): void 
    {
        $player=$event->getPlayer();
        $event->setJoinMessage('');
        $player->sendMessage(ru\Utils::WELCOME_PLAYER);
        Utils::teleport($player, MainClass::LOBBY);
        
        #Remove cape player
        $oldSkin = $player->getSkin();
        $newSkin = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), '', $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
        $player->setSkin($newSkin);
        $player->sendSkin();
    }

    public function onQuit(PlayerQuitEvent $event): void 
    {
        $event->setQuitMessage('');
    }

    public function onDeath(PlayerDeathEvent $event): void 
    {
        $event->setDeathMessage('');
    }

    public function onExhaust(PlayerExhaustEvent $event): void
    {
		$event->setCancelled();
	}

    public function onEntityDeath(EntityDeathEvent $event): void
    {
		$entity=$event->getEntity();
		if(!$entity instanceof Player){
			$event->setDrops([]);
		}
	}

}