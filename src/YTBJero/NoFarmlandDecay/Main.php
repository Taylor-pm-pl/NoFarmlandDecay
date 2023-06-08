<?php

declare(strict_types=1);

namespace YTBJero\NoFarmlandDecay;

use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\event\Listener as Event;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\world\World;

class Main extends Plugin implements Event {

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @param EntityTrampleFarmlandEvent $event
     * @return void
     */
    public function onEntityTrample(EntityTrampleFarmlandEvent $event): void {
        $entity = $event->getEntity();
        $world = $entity->getWorld();
        $this->onBreakFarmLand($world, $event);
    }

    /**
     * @param BlockUpdateEvent $event
     * @return void
     */
    public function onBlockUpdate(BlockUpdateEvent $event): void {
        $block = $event->getBlock();
        $world = $block->getPosition()->getWorld();
        if ($block->getName() === VanillaBlocks::FARMLAND()->getName()) {
            $this->onBreakFarmLand($world, $event);
        }
    }

    /**
     * @param World $world
     * @param EntityTrampleFarmlandEvent|BlockUpdateEvent $event
     * @return void
     */
    protected function onBreakFarmLand(World $world, EntityTrampleFarmlandEvent|BlockUpdateEvent $event): void {
        $config = $this->getConfig()->get("worlds", []);
        $condition = empty($config) || in_array($world->getDisplayName(), $config);
        if ($condition) {
            $event->cancel();
        }
    }
}