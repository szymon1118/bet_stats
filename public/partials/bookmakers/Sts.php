<?php

require_once plugin_dir_path( __FILE__ ) . '../utils/Method.php';
require_once plugin_dir_path( __FILE__ ) . '../utils/Util.php';

class Sts extends Bookmaker {
	
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
		
		return "Sts";
		
	}
	
	public function getMatchName() {
		
		return $this->matchName;
		
	}
	
	public function getOdds() {
		
		return ($this->odds)[0]['odds_value'];
		
	}

	public function getLink() {

		if ( Util::detectDevice()->isMobile() ) {
			return 'https://m.sts.pl/pl/sport/184/6521/74157/' . $this->matchId;
		} else {
			return 'https://www.sts.pl/pl/oferta/zaklady-bukmacherskie/zaklady-sportowe/?action=offer&sport=184&region=6521&league=74157&oppty=' . $this->matchId;
		}

	}

	protected static function loadDataFromAPI() {
		
		$url = 'https://mapi.sts.pl/';

		$payload = '{"app-id":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","id":1,"jsonrpc":"2.0","lang":"pl","method":"prematch.league","params":{"league":"74157","opptyType":"0"},"session":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","station-name":"androidapp"}';

		$res = Util::getJsonData($url, Method::POST, null, $payload);
		
		//parsing data
		$resMatches = $res['resData']['result'];
		$len = count($resMatches);
		$parsedData = array();
		for ($i = 0; $i < $len; $i++) {
			$data = $resMatches[$i];
			self::$dataToReturn['name'] = $data['oppty_name'];
			self::$dataToReturn['odds'] = $data['odds'];
			self::$dataToReturn['matchid'] = $data['id_opportunity'];
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
