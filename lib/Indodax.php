<?php
define("VERSION", "2.0");
/**
 * Indodax Check Realtime Virtual Money Currency
 * Powered by Denny Septian
 */
class Indodax
{
	function __construct(){
		# code...
	}

	private function clearScreen() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			system('cls');
		} else {
			system('clear');
		}
	}

	private $typeVM;

	private function optionVM()
	{
		echo "=------ Option Virtual Money ------=\n";
		echo "[ ? ] 1. Bitcoin\n";
		echo "[ ? ] 2. Bitcoin Cash\n";
		echo "[ ? ] 3. Bitcoin Gold\n";
		echo "[ ? ] 4. Bitcoin Diamond\n";
		echo "[ ? ] 5. Ethereum\n";
		echo "[ ? ] 6. Ethereum Classic\n";
		echo "[ ? ] 7. Litecoin\n";
		echo "[ ? ] 8. NXT\n";
		echo "[ ? ] 9. Waves\n";
		echo "[ ? ] 10. Stellar Lumens\n";
		echo "[ ? ] 11. Ripple\n";
		echo "[ ? ] 12. ZCoin\n";
		echo "[ ? ] 13. Cardano\n";
		echo "[ ? ] 14. Achain\n";
		echo "[ ? ] 15. Tokenomy\n";
		echo "[ ? ] 16. Ignis\n";
		echo "[ ? ] 17. Storiqa\n";
		echo "[ ? ] 18. Tron\n";
		echo "> ";

		$option = trim(fgets(STDIN));
		switch ($option) {
			case '1':
				$this->typeVM = "btc";
				return $this->typeVM;
				break;
			case '2':
				$this->typeVM = "bch";
				return $this->typeVM;
				break;
			case '3':
				$this->typeVM = "btg";
				return $this->typeVM;
				break;
			case '4':
				$this->typeVM = "bcd";
				return $this->typeVM;
				break;
			case '5':
				$this->typeVM = "eth";
				return $this->typeVM;
				break;
			case '6':
				$this->typeVM = "etc";
				return $this->typeVM;
				break;
			case '7':
				$this->typeVM = "ltc";
				return $this->typeVM;
				break;
			case '8':
				$this->typeVM = "nxt";
				return $this->typeVM;
				break;
			case '9':
				$this->typeVM = "waves";
				return $this->typeVM;
				break;
			case '10':
				$this->typeVM = "str";
				return $this->typeVM;
				break;
			case '11':
				$this->typeVM = "xrp";
				return $this->typeVM;
				break;
			case '12':
				$this->typeVM = "xzc";
				return $this->typeVM;
				break;
			case '13':
				$this->typeVM = "ada";
				return $this->typeVM;
				break;
			case '14':
				$this->typeVM = "act";
				return $this->typeVM;
				break;
			case '15':
				$this->typeVM = "ten";
				return $this->typeVM;
				break;
			case '16':
				$this->typeVM = "ignis";
				return $this->typeVM;
				break;
			case '17':
				$this->typeVM = "stq";
				return $this->typeVM;
				break;
			case '18':
				$this->typeVM = "trx";
				return $this->typeVM;
				break;
			default:
				$this->typeVM = "btc";
				return $this->typeVM;
				break;
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
[ * ] Created by Denny Septian ( https://github.com/hexageek1337 )
[ * ] Version '.VERSION;
		
		// meneruskan hasil art
		print_r($art);
	}

	public function usage($file)
	{
		echo "\tParameter Tidak Valid\n\n";
		echo "Usage : php ".$file." [type]\n";
		echo "Example : php ".$file." btc\n";
		echo "Type : btc, bch, btg, eth, etc, ltc, nxt, waves, str, xrp, xzc";
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
		$this->clearScreen();
		$this->banner();
		echo "\n";
		echo "\n";
		$this->optionVM();
		echo "\n";
		$url = "https://indodax.com/api/".$this->typeVM."_idr/ticker";
		$echo = json_decode($this->curl($url), true);
		$vieWCOEK = $echo['ticker'];

		// Print
		echo "\033[32m[+]\033[0m Last Price Ripple : Rp. ".number_format($vieWCOEK['last'],2,",",".");
		echo "\n";
		echo "\033[32m[-]\033[0m High Price Ripple : Rp. ".number_format($vieWCOEK['high'],2,",",".");
		echo "\n";
		echo "\033[32m[-]\033[0m Low Price Ripple : Rp. ".number_format($vieWCOEK['low'],2,",",".");
	}
}