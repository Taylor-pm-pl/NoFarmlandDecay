<?php

declare(strict_types=1);

namespace YTBJero\NoFarmlandDecay;

use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\event\Listener as Event;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;

class Main extends Plugin implements Event
{
    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onEntityTrample(EntityTrampleFarmlandEvent $event): void
    {
        $entity = $event->getEntity();
        $config = $this->getConfig()->get("worlds", []);
        $condition = empty($config) || in_array($entity->getWorld()->getDisplayName(), $config);
        if ($condition) {
            $event->cancel();
        }
    }
}