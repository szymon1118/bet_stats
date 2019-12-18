<?php

require_once plugin_dir_path( __FILE__ ) . '../utils/Util.php';

class Fortuna extends Bookmaker {
	
	private $matchName;
	private $stats;
	private $matchId;
	
	public function __construct($matchName, $stats, $matchId) {
		
		$this->matchName = $matchName;
		$this->stats = $stats;
		$this->matchId = $matchId;
		
	}
	
	public function getBookmakerName() {
		
		return "Fortuna";
		
	}
	
	public function getName() {
		
		return $this->matchName;
		
	}
	
	public function getStats() {
		
		return ($this->stats)[0]['value'];
		
	}
	
	public function getLink() {
		
		return 'https://www.efortuna.pl/pl/strona_glowna/pilka-nozna/' . substr($this->matchId, 3);
		
	}
	
	protected static function loadData() {
		
		$url = 'https://gm.efortuna.pl/api/aos/PL/prematch/leagues/competition/matches';
		
		$customHeaders = array(
			'X-Sportid: MPL3',
			'X-Leagueid: MPL11',
			'X-Competitionid: MPL17',
			'Authorization: fortunapublicapikey:xGyhGJWCh9rb/qWCt2Glf5nKHuVYIai9cOJiSwzHIHw=',
			'User-Agent: APP 3.5.1; AN 7.1.1'
		);
		
		$res = Util::getJsonData($url, 'GET', $customHeaders, null);
		
		return $res[0]['competitions'][0]['matches'];
		
	}
	
	public static function getMatches() {
		
		$matchesOld = Fortuna::loadData();
		$len = count($matchesOld);
		
		$matchesNew = array();
		
		for ($i = 0; $i < $len; $i++) {
			$m = $matchesOld[$i];
			$matchesNew[$i] = new Fortuna($m['name'], $m['odds'], $m['matchid']);
		}
		
		return $matchesNew;
		
	}

}

?>
