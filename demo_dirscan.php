<?php
class Library_DIR {

	public function __construct() {
		$this->str = '';
		$this->arr = array();
	}

	public function scan() {
		ini_set("display_errors", "On");
		error_reporting(E_ALL & ~E_NOTICE);
		date_default_timezone_set("Asia/Taipei");
		
		$directory = '/var/www/html/crazy2go_com/jackson';
		$exclude = array('..', '.', '._.DS_Store', '.DS_Store', '._123.txt', '._123 .txt', '._123  .txt', '._Thumbs.db', 'Thumbs.db'); //陣列排除檔案
		for($i=0; $i<20; $i++) {
			$exclude[] = "._p".$i.".jpg";
			$exclude[] = "._p".$i.".jpeg";
			$exclude[] = "._p".$i.".png";
			$exclude[] = "._p".$i.".bmp";
		}
		
		$new_arr = $this->dirToArray($directory, $exclude);
		
		$this->runarr($new_arr);
		$arr = array_unique($this->arr);
		
		$fin = array();
		foreach($arr as $k => $v) {
			$fin[$v] = "/".implode("/", array_reverse($this->getkeypath($new_arr, $v)));
		}
		
		return $fin;
	}

	public function dirToArray($dir, $exclude) { //資料夾檔案結構陣列化
		$result = array();
		$cdir = array_diff(scandir($dir), $exclude);
		foreach($cdir as $key => $value) {
			if(!in_array($value, array(".", ".."))) {
				if(is_dir($dir.DIRECTORY_SEPARATOR.$value)) {
					$result[$value] = $this->dirToArray($dir.DIRECTORY_SEPARATOR.$value, $exclude);
				}
				else {
					$result[] = $value;
				}
			}
		}
		return $result;
	}

	public function runarr($arr) { //取得陣列末端索引名稱
		foreach($arr as $key => $value) {
			if(is_array($value)) {
				$this->str = $key;
				$this->runarr($value);
			}
			else {
				$this->arr[] = $this->str;
			}
		}
	}

	public function getkeypath($arr, $lookup) { //轉換完整陣列路徑
		if (array_key_exists($lookup, $arr)) {
			return array($lookup);
		}
		else {
			foreach ($arr as $key => $subarr) {
				if (is_array($subarr)) {
					$ret = $this->getkeypath($subarr, $lookup);
					if($ret) {
						$ret[] = $key;
						return $ret;
					}
				}
			}
		}
		return null;
	}
}
?>