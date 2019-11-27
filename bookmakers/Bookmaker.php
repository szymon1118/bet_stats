<?php

abstract class Bookmaker {
	// public $matches;
	// public function __construct($matches) {
		// $this->matches = $matches;
	// }
	abstract protected function loadData();
	public function getData() {
		return $this->loadData();
	}
}

class Fortuna extends Bookmaker {
	protected function loadData() {
		$url = 'https://gm.efortuna.pl/api/aos/PL/prematch/leagues/competition/matches';
 
		//Create a cURL handle.
		$ch = curl_init($url);
		 
		//Create an array of custom headers.
		$customHeaders = array(
			'X-Sportid: MPL3',
			'X-Leagueid: MPL11',
			'X-Competitionid: MPL17',
			'Authorization: fortunapublicapikey:xGyhGJWCh9rb/qWCt2Glf5nKHuVYIai9cOJiSwzHIHw=',
			'User-Agent: APP 3.5.1; AN 7.1.1'
		);
		
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		 
		//Use the CURLOPT_HTTPHEADER option to use our
		//custom headers.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeaders);
		 
		//Set options to follow redirects and return output
		//as a string.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		 
		//Execute the request.
		$result = curl_exec($ch);
		 
		$jsonRes = json_decode($result, true);
		return $jsonRes;
		
		curl_close($ch);
	}
}

class Sts extends Bookmaker {
	protected function loadData() {
		$url = 'https://mapi.sts.pl/';
 
		//Create a cURL handle.
		$ch = curl_init($url);
		
		//Set request type to POST
		curl_setopt($ch, CURLOPT_POST, true);
		
		//Set POST payload
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"app-id":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","id":1,"jsonrpc":"2.0","lang":"pl","method":"prematch.league","params":{"league":"74157","opptyType":"0"},"session":"fb52b2d7-abbd-4d49-b18a-f3936a7f0805","station-name":"androidapp"}');
		
		//Set payload to be a JSON one
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		 
		//Set options to follow redirects and return output
		//as a string.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		 
		//Execute the request.
		$result = curl_exec($ch);
		 
		$jsonRes = json_decode($result, true);
		return $jsonRes;
		
		curl_close($ch);
	}
}

?>