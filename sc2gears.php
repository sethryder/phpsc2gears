<?php

class SC2Gears
{

	private $api_url = 'https://sc2gearsdb.appspot.com/parsing';
	private $api_key = '';

	public function __construct($api_key=NULL)
	{
		if($api_key)
		{
			$this->api_key = $api_key;
		}
	}

	public function parseReplay($replay, $size, $options='default')
	{
		$parsed = $this->call("protVer=1&op=parseRep&apiKey=$this->api_key&parseMessages=true&sendActionsBuild=true&sendActionsTrain=true&sendActionsUpgrade=true&sendActionsResearch=true&parseActions=true&fileContent=$replay&fileLength=$size");
		
		return $parsed;
	}

	public function profileInfo($player)
	{

	}

	public function info()
	{
		$info = $this->call("protVer=1&op=info&apiKey=$this->api_key");
		
		return $info;
	}

	public function mapInfo($map)
	{

	}

	private function call($args, $decode=TRUE)
	{
		$postdata = $args;
		try
		{
			$ch = curl_init($this->api_url);
			curl_setopt_array($ch,  array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postdata,
				));
			$raw_result = curl_exec($ch);
			$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if(curl_errno($ch) != 0) {
				$errtxt = curl_error($ch);
				curl_close($ch);
				throw new Exception('cURL error: ' . $errtxt);
			}
			if($http_status != "200") {
				$errtxt = curl_error($ch);
				curl_close($ch);
				throw new Exception('HTTP error: ' . $http_status . '| Result: ' . $raw_result);
			}
			curl_close($ch);
			
			return $raw_result;
		}
		catch(Exception $e)
		{
			return array('error' => $e->getMessage());
		}

	}

	private function encodeReplay($replay)
	{

	}
	
	private function buildOptions($options)
	{
		if($options == 'default')
		{
			return 'parseMessages=true&sendActionsBuild=true&sendActionsTrain=true&sendActionsUpgrade=true&sendActionsResearch=true&parseActions=true';
		}
		else
		{
			foreach($options as $option)
			{
				
			}
		}
	}
}