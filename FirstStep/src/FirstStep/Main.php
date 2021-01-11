<?php 
namespace FirstStep;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\block\Block;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onBlock(BlockPlaceEvent $event){
		//getblock블럭정보만이 아니라 블럭이 설치되어진 맵 정보도 포함
		//getblock->getlevel 을 하게되면 해당 맵의 클래스를 얻을 수 있음
		//맵 정보를 얻고 그 맵정보를 통해 getLevel(맵의 클래스를 얻는다)을 한다.
		if($event->getBlock()->getId()==Block::GRASS)
		$event->getPlayer()->kick("ddd");
	}
	public function onJoin(PlayerJoinEvent $event){
		$event->getPlayer()->getInventory()->addItem(Item::get(Item::GOLD_ORE,0,1));
	}
	public function onBreak(BlockBreakEvent $event) {
		if($event->getBlock()->getId() == Block::GRASS)
			$event->getPlayer()->kick(":P");
	}
	public function onPlayerChatEvent(PlayerChatEvent $event){
		if(isset(explode("바보", $event->getMessage())[1]) ){
			$event->getPlayer()->getInventory()->addItem(Item::get(Item::SNOW_BLOCK));
			$event->setCancelled();
// 			$event->getPlayer()->kick("비속어 채팅");
		}
	}
}
?>