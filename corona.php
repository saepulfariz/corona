<?php


class Colors {
	private $foreground_colors = array();
	private $background_colors = array();

	public function __construct() {
		// Set up shell colors
		$this->foreground_colors['black'] = '0;30';
		$this->foreground_colors['dark_gray'] = '1;30';
		$this->foreground_colors['blue'] = '0;34';
		$this->foreground_colors['light_blue'] = '1;34';
		$this->foreground_colors['green'] = '0;32';
		$this->foreground_colors['light_green'] = '1;32';
		$this->foreground_colors['cyan'] = '0;36';
		$this->foreground_colors['light_cyan'] = '1;36';
		$this->foreground_colors['red'] = '0;31';
		$this->foreground_colors['light_red'] = '1;31';
		$this->foreground_colors['purple'] = '0;35';
		$this->foreground_colors['light_purple'] = '1;35';
		$this->foreground_colors['brown'] = '0;33';
		$this->foreground_colors['yellow'] = '1;33';
		$this->foreground_colors['light_gray'] = '0;37';
		$this->foreground_colors['white'] = '1;37';

		$this->background_colors['black'] = '40';
		$this->background_colors['red'] = '41';
		$this->background_colors['green'] = '42';
		$this->background_colors['yellow'] = '43';
		$this->background_colors['blue'] = '44';
		$this->background_colors['magenta'] = '45';
		$this->background_colors['cyan'] = '46';
		$this->background_colors['light_gray'] = '47';
	}

	// Returns colored string
	public function getColoredString($string, $foreground_color = null, $background_color = null) {
		$colored_string = "";

		// Check if given foreground color found
		if (isset($this->foreground_colors[$foreground_color])) {
			$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
		}
		// Check if given background color found
		if (isset($this->background_colors[$background_color])) {
			$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
		}

		// Add string and end coloring
		$colored_string .=  $string . "\033[0m";

		return $colored_string;
	}

	// Returns all foreground color names
	public function getForegroundColors() {
		return array_keys($this->foreground_colors);
	}

	// Returns all background color names
	public function getBackgroundColors() {
		return array_keys($this->background_colors);
	}
}

class epul {

	function menu(){
		$warna_huruf = "0;31";
		$kata_huruf = "Selamat Datang di app COVID-19";
		$ujung_huruf = "\033[0m";
		$bg_huruf = "42";
		echo "\033[". $warna_huruf."m"."\033[". $bg_huruf."m".$kata_huruf.$ujung_huruf;
		echo "\n\n";
		echo ">> 1.Data COVID-19 Sedunia \n";
		echo ">> 2.Data COVID-19 Di Tiap Seluruh Negara \n";
		echo ">> 3.Data COVID-19 Indonesia \n";
		echo ">> 4.Data COVID-19 Provinsi Indonesia \n";
	}

	function content($menu){
		
	}

	function getWorld(){
		$ch = curl_init('https://api.kawalcorona.com/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		$res_world = json_decode($result, true);
		
		if( !$res_world ){
			echo " \n";
			echo "Tidak Ada Internetnya bro";
			return false;
		}
		
		$a = 1;
		foreach( $res_world as $world ){
			echo ">> ".$a++." ".$world['attributes']['Country_Region'];
			echo "\n";
		}

		echo " \n";
		$cari = readline("Cari berdasarkan nama negara = ");
		echo " \n";
		foreach( $res_world as $world ){
			if( $world['attributes']['Country_Region'] == $cari ){
				echo ">> Negara : ".$world['attributes']['Country_Region']."\n";
				echo ">> Kasus Positif : ".$world['attributes']['Confirmed']." \n";
				echo ">> Kasus Sembuh : ".$world['attributes']['Recovered']." \n";
				echo ">> Kasus Meninggal : ".$world['attributes']['Deaths']." \n";
			}
		}
	}

	function getIndo(){
		$ch = curl_init('https://api.kawalcorona.com/indonesia/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$res_indo = json_decode($result, true);
		echo "\n";
		echo ">> Jumlah Positif = ".$res_indo[0]["positif"];
		echo "\n";
		echo ">> Jumlah Sembuh = ".$res_indo[0]["sembuh"];
		echo "\n";
		echo ">> Jumlah Meninggal = ".$res_indo[0]["meninggal"];
		
	}

	function getProvinsi(){
		
		$ch = curl_init('https://api.kawalcorona.com/indonesia/provinsi/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$res_provinsi = json_decode($result, true);
		
		$a = 1;
		foreach( $res_provinsi as $prov ){
			echo ">> ".$a++." ".$prov['attributes']['Provinsi'];
			echo "\n";
		}

		echo " \n";
		$cari = readline("Cari berdasarkan nama provinsi = ");
		echo " \n";
		foreach( $res_provinsi as $prov ){
			if( $prov['attributes']['Provinsi'] == $cari ){
				echo ">> Provinsi : ".$prov['attributes']['Provinsi']."\n";
				echo ">> Kasus Positif : ".$prov['attributes']['Kasus_Posi']." \n";
				echo ">> Kasus Sembuh : ".$prov['attributes']['Kasus_Semb']." \n";
				echo ">> Kasus Meninggal : ".$prov['attributes']['Kasus_Meni']." \n";
			}
		}


	}

	function getAll(){
		$ch = curl_init('https://api.kawalcorona.com/positif/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$res_positif = json_decode($result, true);
		
		$ch = curl_init('https://api.kawalcorona.com/sembuh/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$res_sembuh = json_decode($result, true);
		
		$ch = curl_init('https://api.kawalcorona.com/meninggal/');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$res_meninggal = json_decode($result, true);
		
		echo ">> Total Positif : ". $res_positif['value'];
		echo " \n";
		echo ">> Total Sembuh : ". $res_sembuh['value'];
		echo " \n";
		echo ">> Total Meninggal : ". $res_meninggal['value'];
		echo " \n";
	}

	function clearScreen(){
		/*
		try{
			if(System.getProperty("os.name").constains("Windows")){
				new ProcessBuilder( ..command: "cmd", "/c", "cls").inheritIo().start().waitFor();
			}else{
				System.out.print("\033\143");
			}
		} catch(Exception ex){
			System.err.println(" Tidak bisa clearscreen");
		}
		*/
		echo "\033\143";

	}

	function getYesorNo($pesan){
		$lanjutkan = readline( $pesan.' (y/n)? ');
		if( $lanjutkan == "Y" ){
			$ulangi = true;
		}else if( $lanjutkan == "y" ){
			$ulangi = true;
		}else if( $lanjutkan == "N" ){
			$ulangi = false;
		}else if( $lanjutkan == "n" ){
			$ulangi = false;
		}else{
			echo "Silahkan Pilih (y/n)!";
			$ulangi = true;
		}
		
		return $ulangi;
		
	}


}

$epul = new epul();
$color = new Colors();

$ulangi = true;

/*
// red = 0;31
$warna_huruf = "0;31";
$kata_huruf = "zailbaiz";
$ujung_huruf = "\033[0m";
$bg_huruf = "42";
// satu huruf
// ubah warna cmd
echo "\033[". $warna_huruf."m".$kata_huruf.$ujung_huruf;
echo " \n";

// ubah bg dan color cmd
echo "\033[". $warna_huruf."m"."\033[". $bg_huruf."m".$kata_huruf.$ujung_huruf;


do {
	if( $ulangi == false
    echo "Selamat Datang di app sederhana\n";
    $ulangi = true;
} while ($ulangi == false );
*/

while($ulangi){
	// system('cls');
	$epul->clearScreen();
	$epul->menu();
	echo "\n";
	$menu = readline('Pilihan Anda: ');
	
	switch($menu) {
		case 1 :
			echo "\n";
			echo "==============================";
			echo "\n";
			echo "Data COVID-19 Di Seluruh Dunia";
			echo "\n";
			echo "==============================";
			echo "\n";
			$epul->getAll();
			break;
		case 2 :
			echo "\n";
			echo "==========================";
			echo "\n";
			echo "Data COVID-19 Di Tiap Negara";
			echo "\n";
			echo "==========================";
			echo "\n";
			$epul->getWorld();
			break;
		case 3 :
			echo "\n";
			echo "==========================";
			echo "\n";
			echo "Data COVID-19 Di Indonesia";
			echo "\n";
			echo "==========================";
			echo "\n";
			$epul->getIndo();
			break;
		case 4 :
			echo "\n";
			echo "===================================";
			echo "\n";
			echo "Data COVID-19 Di Provinsi Indonesia";
			echo "\n";
			echo "===================================";
			echo "\n";
			echo "\n";
			$epul->getProvinsi();
			break;
		default:
			echo "Menu Tidak ada!!\nSilahkan Pilih 1-4\n";
	}
	echo " \n";
	echo " \n";
	$ulangi = $epul->getYesorNo("Apakah anda ingin melanjutkan bro");
}






die();

$ch = curl_init('https://api.kawalcorona.com/indonesia/');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$res_indo = json_decode($result, true);

$ch = curl_init('https://api.kawalcorona.com/indonesia/provinsi/');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$res_provinsi = json_decode($result, true);

if( !$res_indo ){
	echo "Aktifkan Data Internetnya Bro ^_^\n";
	exit();
}

echo "Aplikasi Lihat Data Covid-19 \n";
echo "Di Indonesia\n";

echo ">> Jumlah Positif = ".$res_indo[0]["positif"];
echo "\n";
echo ">> Jumlah Meninggal = ".$res_indo[0]["meninggal"];
echo "\n";
echo ">> Jumlah Sembuh = ".$res_indo[0]["sembuh"];
echo "\n";
echo "\n";

echo "Daftar Provinsi\n";
$a = 1;
foreach( $res_provinsi as $prov ){
	echo ">> ".$a++." ".$prov['attributes']['Provinsi'];
	echo "\n";
}

echo " \n";
$cari = readline("cari berdasarkan provinsi = ");
foreach( $res_provinsi as $prov ){
	if( $prov['attributes']['Provinsi'] == $cari ){
		echo ">> Provinsi : ".$prov['attributes']['Provinsi']."\n";
		echo ">> Kasus Positif : ".$prov['attributes']['Kasus_Posi']." \n";
		echo ">> Kasus Sembuh : ".$prov['attributes']['Kasus_Semb']." \n";
		echo ">> Kasus Meninggal : ".$prov['attributes']['Kasus_Meni']." \n";
	}
}






// $zail = file_get_content('https://api.kawalcorona.com/indonesia/');
// var_dump($res);

?>
