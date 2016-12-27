<?php
	//取得floors.item、global_item.item、category.icon和main_item.images內的圖檔，以上資料表欄位的圖檔路徑均在 public/img/template 內。
	
	//判斷從floors.item裡取得的內容為圖檔的正規表示式patten
	$match = '/^[a-zA-Z0-9_]*\.(jpg|JPG|png|PNG|gif|GIF|jpeg|JPEG)$/';
		
	include 'backend/config.php';
	require_mark("swop/library/dba.php");
	$dba=new dba();
	
	//取得floors裡所有item欄位的值
	$sql = "SELECT `item` FROM `floors` order by `fi_no`";
	$images = $dba->query($sql);
	$db_files1 = array();
	//將floors裡所有item欄位的圖片檔名全部存成一個陣列
	foreach ($images as $value1){
		foreach ((array)json_decode($value1['item']) as $value2){
			foreach($value2->item as $value3){
				if (preg_match($match,$value3))
					$db_files1[] = $value3;
			}
		}
	}
	$db_files1 = array_filter($db_files1);
	
	//取得global_item裡所有item欄位的值
	$sql = "SELECT `item` FROM `global_item` order by `fi_no`";
	$images = $dba->query($sql);
	$db_files2 = array();
	//將global_item裡所有item欄位的圖片檔名全部存成一個陣列
	foreach ($images as $value1){
		foreach ((array)json_decode($value1['item']) as $value2){
			foreach($value2 as $value3){
				if (preg_match($match,$value3))
					$db_files2[] = $value3;
			}
		}
	}
	$db_files2 = array_filter($db_files2);
	
	//取得category裡所有icon欄位的值
	$sql = "SELECT `icon` FROM `category` order by `fi_no`";
	$images = $dba->query($sql);
	$db_files3 = array();
	//將global_item裡所有item欄位的圖片檔名全部存成一個陣列
	foreach ($images as $value1)
		foreach ((array)$value1['icon'] as $value2)
				$db_files3[] = $value2;
	$db_files3 = array_filter($db_files3);
	
	//取得main_item裡所有images欄位的值
	$sql = "SELECT `images` FROM `main_item` order by `fi_no`";
	$images = $dba->query($sql);
	$db_files4 = array();
	//將main_item裡所有images欄位的圖片檔名全部存成一個陣列
	foreach ($images as $value1)
		foreach ((array)$value1['images'] as $value2)
				$db_files4[] = $value2;
	$db_files4 = array_filter($db_files4);
	
	//將上述四個共用template目錄的資料庫圖檔陣列合併
	$db_files = array_merge($db_files1,$db_files2,$db_files3,$db_files4);
	
	/*echo "<PRE>";
	print_r($db_files1);print_r($db_files2);print_r($db_files3);print_r($db_files4);
	echo "<HR>";
	print_r($db_files);
	echo "<HR>";*/
	
	
	//取得template目錄下所有圖檔
	$path = realpath("public/img/template").'/';
	$path_files = dirToArray($path);
	
	//取得兩者陣列中的差異檔案
	$diff1 = array_diff(array_filter($db_files),array_filter($path_files));
	sort($diff1);
	$diff2 = array_diff(array_filter($path_files),array_filter($db_files));
	sort($diff2);
	
	echo "<PRE>";//print_r($db_files);print_r($path_files);echo "<HR>";
	echo "僅DB內有的檔案：<BR>";
	print_r($diff1);
	echo "<BR>僅 $path 內有的檔案：<BR>";
	print_r($diff2);
	
	function dirToArray($dir, $exclude=array()) { //資料夾檔案結構陣列化
		$result = array();
		$cdir = array_diff(scandir($dir), $exclude);
		foreach($cdir as $key => $value) {
			if(!in_array($value, array(".", "..",".DS_Store"))) {
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
?>