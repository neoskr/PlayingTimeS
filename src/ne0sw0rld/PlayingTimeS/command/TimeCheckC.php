<?php


namespace ne0sw0rld\PlayingTimeS\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use ne0sw0rld\PlayingTimeS\PlayingTimes;



class TimeCheckC extends Command
{


    public function __construct ()
    {

		parent::__construct ('접속시간 확인', '나 혹은 다른 유저의 접속시간을 확인합니다', '접속시간 확인 (유저)', ['playtime']);

    }

	public function execute (CommandSender $player, string $label, array $args) : bool
    {

		$target = strtolower (($args[0] ?? $player->getName()));
		PlayingTimeS::updateAllPlayers ();

		if (! isset (PlayingTimeS::$playerD [$target]))
		{
			
			$player->sendMessage ('§b§l[접속시간] §r§7' . $target . '(이)라는 유저는 서버에 접속한 적이 없습니다');
			return true;
			
		}

		$player->sendMessage ('§b§l[접속시간] §r§7' . $target . '님의 누적 접속 시간: ' . PlayingTimeS::getKoreanTime ($target));
		return true;

    }

}