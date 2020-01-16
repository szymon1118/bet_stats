<?php

require_once plugin_dir_path( __FILE__ ) . '../utils/Method.php';
require_once plugin_dir_path( __FILE__ ) . '../utils/Util.php';

class Sts extends Bookmaker {
	
	private $matchName;
	private $stats;
	private $matchId;
	
	public function __construct($matchName, $stats, $matchId) {
		
		$this->matchName = $matchName;
		$this->stats = $stats;
		$this->matchId = $matchId;
		
	}
	
	public function getBookmakerName() {
		
		return "Sts";
		
	}
	
	public function getName() {
		
		return $this->matchName;
		
	}
	
	public function getStats() {
		
		return ($this->stats)[0]['odds_value'];
		
	}

	public function getLink() {

		if ( Util::detectDevice()->isMobile() ) {
			return 'https://m.sts.pl/pl/sport/184/6521/74157/' . $this->matchId;
		} else {
			return 'https://www.sts.pl/pl/oferta/zaklady-bukmacherskie/zaklady-sportowe/?action=offer&sport=184&region=6521&league=74157&oppty=' . $this->matchId;
		}

	}

	protected static function loadData() {
		
		$url = 'https://mapi.sts.pl/';
		
		$payload = '{"app-id":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","id":1,"jsonrpc":"2.0","lang":"pl","method":"prematch.league","params":{"league":"74157","opptyType":"0"},"session":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","station-name":"androidapp"}';
		
		$res = Util::getJsonData($url, Method::POST, null, $payload);
		
		return $res['result'];
		
	}
	
	public static function getMatches() {
		
		$matchesOld = Sts::loadData();
		$len = count($matchesOld);
		
		$matchesNew = array();
		
		for ($i = 0; $i < $len; $i++) {
			$m = $matchesOld[$i];
			$matchesNew[$i] = new Sts($m['oppty_name'], $m['odds'], $m['id_opportunity']);
		}
		
		return $matchesNew;
		
	}

}

?>
