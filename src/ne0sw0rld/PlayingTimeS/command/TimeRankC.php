<?php


namespace ne0sw0rld\PlayingTimeS\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use ne0sw0rld\PlayingTimeS\PlayingTimes;


class TimeRankC extends Command
{


    public function __construct ()
    {

		parent::__construct ('접속시간 순위', '서버에 많이 접속한 유저를 확인합니다', '접속시간 순위 (페이지)', ['timerank']);

    }

	public function execute (CommandSender $player, string $label, array $args) : bool
    {

		$data = PlayingTimeS::updateAllPlayers();
		arsort ($data);

		$max = ceil (count ($data) / 5);

		$page = $args[0] ?? 1;
		$page = is_numeric ($page) ? $page : 1;
		$page = $max < $page ? $max : $page;

		$key = 0;
		$player->sendMessage ('§b§l<===== §f접속시간 순위 §b§l| §r§f' . $page . ' §b§l/ §r§f' . $max . ' §b§l=====>§r');

		foreach ($data as $k => $v)
		{

			$key ++;

			if ($key >= $page && $key <= ($page * 5))
			{

				$player->sendMessage ('§b§l[§f' . $key . '위§b] §r§7' . $k . ': 누적 ' . PlayingTimeS::koreanTimeFormat ($v));

			}

		}
		
		return true;

    }


}