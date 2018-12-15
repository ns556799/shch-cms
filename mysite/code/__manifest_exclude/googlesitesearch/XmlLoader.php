<?php

class XmlLoader {

	public function pullXml($url, $parameters, $useCurl) {
		$urlString = $url."?".$this->buildParamString($parameters);
		
		if (!$useCurl) {
			$rawXML = $this->loadCurlData($urlString);
			$rawXML = mb_convert_encoding($rawXML, 'UTF-8');
			$xmlString = simplexml_load_string($rawXML);
			return $xmlString;
		} else {
			$rawXML = file_get_contents($urlString);
			//$rawXML = htmlentities($rawXML);
			$rawXML = mb_convert_encoding($rawXML, 'UTF-8');
			$xmlString = simplexml_load_string($rawXML);
			return $xmlString;
		}           
	}

	private function loadCurlData($urlString) {
	
		if ($urlString == -1) {
			echo "No url supplied<br/>"."/n";
			return(-1);
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlString);
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
	
	
		return $data;       
	}
	
	private function buildParamString($parameters) {
		$urlString = "";
		
		foreach ($parameters as $key => $value) {
			$urlString .= urlencode($key)."=".urlencode($value)."&";
		}
		
		if (trim($urlString) != "") {
			$urlString = preg_replace("/&$/", "", $urlString);
			return $urlString;   
		} else {
			return (-1);
		}
	}   

}