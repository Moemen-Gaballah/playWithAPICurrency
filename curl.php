<?php 

class curl
{
	public $curl;
	public $url;

	public function __construct($url)
	{
		$this->url = $url;
		$this->curl = curl_init($this->url);
	}

	public function setOption()
	{
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_HEADER, 0);
		curl_setopt_array($this->curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $this->url
		));
	}

	public function curlExec()
	{
		$this->setOption();
		$result = curl_exec($this->curl);
		return $result;
	}

	public function __destruct()
	{
		curl_close($this->curl);
	}
}

// all data 
$curl = new curl('http://api.currencylayer.com/live?access_key=1d234eef6d48298fb039f4ddc8d52a3a');

// convert currency but api this not free only all data
// $curl = new curl('http://api.currencylayer.com/convert?access_key=1d234eef6d48298fb039f4ddc8d52a3a&from=USD&to=EGP&amount=1&format=1');


// json_decode($curl->curlExec())->quotes 
$data = json_decode($curl->curlExec());

print_r($data->quotes);
echo "<br>";

$EGP = 5;
$USD_to_EGP = $data->quotes->USDEGP * $EGP;

	echo "USD to EGP: " . $USD_to_EGP;

