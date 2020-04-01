<?php

namespace ne0sw0rld\PlayingTimeS;


use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;



class PluginListener implements Listener
{


	public function onJoin (PlayerJoinEvent $event)
	{
		
		$name = strtolower ($event->getPlayer()->getName());

		unset (PlayingTimeS::$time [$name]);
		PlayingTimeS::updateTime ($name);
		
	}
	
	public function onQuit (PlayerQuitEvent $event)
	{
		
		$name = strtolower ($event->getPlayer()->getName());
		
		PlayingTimeS::updateTime ($name);
		unset (PlayingTimeS::$time [$name]);
		
	}


}