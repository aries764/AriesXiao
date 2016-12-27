<?php
	include 'backend/config.php';
	//require_mark("swop/library/dba.php");
	//$dba=new dba();
	
	//取得order_application裡所有images欄位的值
	$con = mysqli_connect("localhost","global2user","wRusUdRAjesWuqE3rech");
	if(mysqli_connect_errno()) { echo "Failed to connect to MySQL: ".mysqli_connect_error(); }
	mysqli_query($con,"SET NAMES 'UTF8'"); 
	mysqli_query($con,"SET CHARACTER SET UTF8");
	mysqli_query($con,"SET CHARACTER_SET_RESULTS=UTF8");
	
	//從member0~9中取得各images值
	for($i=0;$i<=9;$i++){
		$mem = "member".$i;
		mysqli_select_db($con,$mem);
		$sql = "SELECT `images` FROM `order_application`";
		$result = mysqli_query($con, $sql);
		$$mem = array();
		while($row = mysqli_fetch_array($result))
	        array_push($$mem,$row['images']);
	}
	//合併member0~9的各images值
	$db_files = array_merge($member0,$member1,$member2,$member3,$member4,$member5,$member6,$member7,$member8,$member9);
	
	$path = realpath("public/img/application").'/';
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