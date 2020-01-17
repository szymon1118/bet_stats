<?php

abstract class Bookmaker {

	abstract public function getBookmakerName();
	abstract public function getTeamAName();
	abstract public function getTeamBName();
	abstract public function getOdds();
	abstract public function getLink();
	abstract protected static function loadData();
	abstract protected static function loadDataFromAPI();
	abstract protected static function loadDataFromHTML();

	public static function getMatches() {

		$data = static::loadData();
		$len = count($data);

		$matches = array();

		for ($i = 0; $i < $len; $i++) {
			$m = $data[$i];
			$matches[$i] = new static($m['teamA'], $m['teamB'], $m['odds'], $m['matchid']);
		}

		return $matches;

	}

}
