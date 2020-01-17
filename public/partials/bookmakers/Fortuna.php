<?php

require_once plugin_dir_path( __FILE__ ) . '../utils/Method.php';
require_once plugin_dir_path( __FILE__ ) . '../utils/Util.php';

class Fortuna extends Bookmaker {

	private static $dataToReturn = array( 'name' => '', 'odds' => '', 'matchid' => '' );

	private $matchName;
	private $odds;
	private $matchId;
	
	public function __construct($matchName, $odds, $matchId) {
		
		$this->matchName = $matchName;
		$this->odds = $odds;
		$this->matchId = $matchId;
		
	}
	
	public function getBookmakerName() {
		
		return "Fortuna";
		
	}
	
	public function getMatchName() {
		
		return $this->matchName;
		
	}
	
	public function getOdds() {
		
		return ($this->odds)[0]['value'];
		
	}

	public function getLink() {

		if ( Util::detectDevice()->isMobile() ) {
			return 'https://gm.efortuna.pl/zaklady_bukmacherskie/pi%C5%82ka-nozna/1-anglia/' . $this->matchId;
		} else {
			return 'https://www.efortuna.pl/pl/strona_glowna/pilka-nozna/' . substr($this->matchId, 3);
		}

	}

	protected static function loadDataFromAPI() {
		
		$url = 'https://gm.efortuna.pl/api/aos/PL/prematch/leagues/competition/matches';
		
		$customHeaders = array(
			'X-Sportid: MPL3',
			'X-Leagueid: MPL11',
			'X-Competitionid: MPL17',
			'Authorization: fortunapublicapikey:xGyhGJWCh9rb/qWCt2Glf5nKHuVYIai9cOJiSwzHIHw=',
			'User-Agent: APP 3.5.1; AN 7.1.1'
		);
		
		$res = Util::getJsonData($url, Method::GET, $customHeaders, null);
		
		//parsing data
		$resMatches = $res['resData'][0]['competitions'][0]['matches'];
		$len = count($resMatches);
		$parsedData = array();
		for ($i = 0; $i < $len; $i++) {
			$data = $resMatches[$i];
			self::$dataToReturn['name'] = $data['name'];
			self::$dataToReturn['odds'] = $data['odds'];
			self::$dataToReturn['matchid'] = $data['matchid'];
			$parsedData[] = self::$dataToReturn;
		}

		return array(
			'status' => $res['statusCode'],
			'data' => $parsedData
		);
		
	}

	protected static function loadDataFromHTML() {}

	protected static function loadData() {

		$apiData = self::loadDataFromAPI();
		$htmlData = self::loadDataFromHTML();

		if ( $apiData['status'] === 200 ) {
			return $apiData['data'];
		} else if ( $htmlData['status'] === 200 ) {
			return $htmlData['data'];
		}

	}

}

?>
