<?php 

declare(strict_types=1);

namespace YTBJero\NoFarmlandDecay;

use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\event\Listener as Event;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;

class Main extends Plugin implements Event{

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}

	public function onPlayerTrample(EntityTrampleFarmlandEvent $event){
		$entity = $event->getEntity();
		if(empty($this->getConfig()->get("worlds", []))){
			$event->cancel();
		} else{
			foreach ($this->getConfig()->getAll() as $key) {
				$from = $entity->getWorld()->getFolderName();
				if($key == $from){
					$event->cancel();
				}
			}
		}
	}
}