<?php


namespace ne0sw0rld\PlayingTimeS;


use pocketmine\plugin\PluginBase;

use pocketmine\Player;
use pocketmine\Server;

use ne0sw0rld\PlayingTimeS\command\TimeRankC;
use ne0sw0rld\PlayingTimeS\command\TimeCheckC;



class PlayingTimeS extends PluginBase
{


	public static $playerD = [];
	public static $time = [];


    public function onEnable () : void
    {
		
		if (file_exists ($this->getDataFolder() . 'playerD.json'))
		{

			self::$playerD = json_decode (file_get_contents ($this->getDataFolder() . 'playerD.json'), true);

		}

		foreach ([
		
			new TimeCheckC (), new TimeRankC ()
			
		] as $k => $v) {

			$this->getServer()->getCommandMap()->register ('c', $v);

		}

		$this->getServer()->getPluginManager()->registerEvents (new PluginListener (), $this);

    }
	
	public function onDisable () : void
	{
		
		self::updateAllPlayers ();
		file_put_contents ($this->getDataFolder() . 'playerD.json', json_encode (self::$playerD));
		
	}

	public static function updateTime ($player)
	{
		
		$name =	$player instanceof Player ? strtolower ($player->getName()) : strtolower ($player);

		if (isset (self::$time [$name]))
		{
			
			if (! isset (self::$playerD [$name]))
			{
				
				self::$playerD [$name] = 0;
				
			}

			self::$playerD [$name] += time() - self::$time [$name];
			
		}
		
		self::$time [$name] = time ();

	}
	
	public static function updateAllPlayers ()
	{

		foreach (self::$time as $player => $time)
		{
			
			self::updateTime ($player);
			
		}

		return self::$playerD;
		
	}
	
	public static function getTime ($player) : int
	{
		
		$name =	$player instanceof Player ? strtolower ($player->getName()) : strtolower ($player);
		
		self::updateTime ($player);
		return self::$playerD [$name] ?? 0;
		
	}
	
	public static function getKoreanTime ($player) : string
	{

		return self::koreanTimeFormat (self::getTime ($player));

	}
	
	public static function koreanTimeFormat (int $time, string $h = '시간', string $m = '분', string $s = '초') : string
	{

		$hour = floor ($time / 60 / 60);
		$minute = floor ($time / 60 - ($hour * 60));
		$second = $time - ($hour * 60 * 60 + $minute * 60);

		return "{$hour}{$h} {$minute}{$m} {$second}{$s}";

	}


}