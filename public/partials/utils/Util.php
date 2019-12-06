<?php

class Util {
	
	public static function getJsonData($url, $method, $headers, $payload) {
		
		//Create a cURL handle.
		$ch = curl_init($url);
		
		//maybe use something like Enum instead of strings for method
		switch ($method) {
			case 'GET':
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true);
				break;
			default:
				curl_setopt($ch, CURLOPT_HTTPGET, true);
		}
		
		//payload for POST request
		if ($method == 'POST' && $payload != null) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		}
		
		//custom headers for request if needed
		if ($headers != null) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}
		 
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