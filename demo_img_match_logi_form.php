<?php
	include 'backend/config.php';
	require_mark("swop/library/dba.php");
	$dba=new dba();
	
	//取得store_shipping裡所有images欄位的值
	$sql = "SELECT `images` FROM `store_shipping` order by `fi_no`";
	$images = $dba->query($sql);

	$db_files = array();
	//將store_shipping裡所有images欄位的圖片檔名全部存成一個陣列
	foreach ($images as $value1)
		foreach ((array)$value1['images'] as $value2)
			$db_files[] = $value2;
	
	$path = realpath("public/img/shipping").'/';
	$path_files = dirToArray($path);
	
	//取得兩者陣列中的差異檔案
	$diff1 = array_diff(array_filter($db_files),array_filter($path_files));
	sort($diff1);
	$diff2 = array_diff(array_filter($path_files),array_filter($db_files));
	sort($diff2);
	
	echo "<PRE>";
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