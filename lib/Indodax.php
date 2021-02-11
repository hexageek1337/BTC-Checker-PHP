<?php
define("VERSION", "3.0");
/**
 * Indodax Check Realtime Virtual Money Currency
 * Powered by Denny Septian
 */
class Indodax
{
	function __construct(){
		$this->clearScreen();
	}

	private function clearScreen() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			system('cls');
		} else {
			system('clear');
		}
	}

	private $typeVM;
	private $arrOpt = array();
	private $arrLabel = array();

	private function optionVM(){
		$this->arrOpt = array(
			'btc' => 'Bitcoin',
			'bch' => 'Bitcoin Cash',
			'btg' => 'Bitcoin Gold',
			'bcd' => 'Bitcoin Diamond',
			'doge' => 'Dogecoin',
			'eth' => 'Ethereum',
			'etc' => 'Ethereum Classic',
			'ltc' => 'Litecoin',
			'nxt' => 'NXT',
			'waves' => 'Waves',
			'str' => 'Stellar Lumens',
			'xrp' => 'Ripple',
			'xzc' => 'ZCoin',
			'ada' => 'Cardano',
			'act' => 'Achain',
			'ten' => 'Tokenomy',
			'ignis' => 'Ignis',
			'stq' => 'Storiqa',
			'trx' => 'Tron',
			'aave' => 'Aave',
			'algo' => 'Algorand',
			'atom' => 'Cosmos',
			'eos' => 'EOS',
		);
		$this->arrLabel = array('btc','bch','btg','bcd','doge','eth','etc','ltc','nxt','waves','str','xrp','xzc','ada','act','ten','ignis','stq','trx','aave','algo','atom','eos');

		echo "=------ Option Virtual Money ------=\n";
		foreach ($this->arrLabel as $key => $value) {
			$jum = $key+1;
			echo "[ ? ] {$jum}. {$this->arrOpt[$value]}\n";
		}
		echo "> ";

		$option = intval(trim(fgets(STDIN)));
		foreach ($this->arrLabel as $keyL => $valueD) {
			$jumData = $keyL+1;
			
			if ($option === $jumData) {
				$this->typeVM = $valueD;
				return $this->typeVM;
			}
		}
	}

	private function banner() {
		$art = '
 /$$$$$$$ /$$$$$$$$/$$$$$$        /$$$$$$$$                                
| $$__  $|__  $$__/$$__  $$      |__  $$__/                                
| $$  \ $$  | $$ | $$  \__/         | $$ /$$$$$$ /$$$$$$  /$$$$$$$ /$$$$$$ 
| $$$$$$$   | $$ | $$               | $$/$$__  $|____  $$/$$_____//$$__  $$
| $$__  $$  | $$ | $$               | $| $$  \__//$$$$$$| $$     | $$$$$$$$
| $$  \ $$  | $$ | $$    $$         | $| $$     /$$__  $| $$     | $$_____/
| $$$$$$$/  | $$ |  $$$$$$/         | $| $$    |  $$$$$$|  $$$$$$|  $$$$$$$
|_______/   |__/  \______/          |__|__/     \_______/\_______/\_______/
[ * ] Created by Denny Septian Panggabean (https://github.com/hexageek1337)
[ * ] Version '.VERSION;
		
		// meneruskan hasil art
		print_r($art);
	}

	private function curl($url = '', $postdata = '',$header = array()){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0');
		if ($postdata) {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		}
		if ($header) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			curl_setopt($curl, CURLOPT_HEADER, 1);
		}
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
		// var_dump($result);
	}

	public function run(){
		$this->banner();
		echo "\n\n";
		$this->optionVM();
		echo "\n";
		$url = "https://indodax.com/api/".$this->typeVM."_idr/ticker";
		$echo = json_decode($this->curl($url), true);
		$vieWCOEK = $echo['ticker'];

		// Print
		echo "\033[32m[+]\033[0m Last Price {$this->arrOpt[$this->typeVM]} : Rp. ".number_format($vieWCOEK['last'],2,",",".");
		echo "\n";
		echo "\033[32m[-]\033[0m High Price {$this->arrOpt[$this->typeVM]} : Rp. ".number_format($vieWCOEK['high'],2,",",".");
		echo "\n";
		echo "\033[32m[-]\033[0m Low Price {$this->arrOpt[$this->typeVM]} : Rp. ".number_format($vieWCOEK['low'],2,",",".");
		echo "\n";
	}
}
