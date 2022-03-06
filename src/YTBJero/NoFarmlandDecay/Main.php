<?php 

declare(strict_types=1);

namespace YTBJero\NoFarmlandDecay;

use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\event\Listener as Event;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;

class Main extends Plugin implements Event{

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onPlayerTrample(EntityTrampleFarmlandEvent $event){
		$event->cancel();
	}
}