<?php 
declare(strict_types=1);
namespace flavio100\DeathChest;

use pocketmine\plugin\PluginBase;
use flavio100\DeathChest\listener\PlayerDeathEventListener;
use pocketmine\utils\Config;

class Main extends PluginBase{	
	
	/**@var string[]*/
	private $enabledWorlds = [];
	
	public function onEnable():void{
		$this->saveResource ("worlds.yml");
		$worldsConfig = new Config($this->getDataFolder()."worlds.yml");
		foreach($worldsConfig->get("worlds") as $worldName){
			$this->enabledWorlds[] = $worldName;
		}
		$this->getServer()->getPluginManager()->registerEvents(new PlayerDeathEventListener($this), $this);
	}
	
	public function isWorldEnabled(String $levelName):bool{
		return in_array($levelName, $this->enabledWorlds, true);
	}
}
