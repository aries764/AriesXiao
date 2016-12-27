<?php 
/*	圖片比對整理說明
admin部份：

項目				檔名						圖片路徑						Table欄位							記錄格式
1		sql_advertisement.php 	public/img/advertisement		advertisement.images、item裡的icon		僅單一圖片，json內的icon值
2		sql_brand_group.php		public/img/logo					brand_group.logo			僅單一圖片
3		sql_qanda_item.php		public/img/qanda				qanda_item.images			多個對應的images json值

4		sql_floors.php			public/img/template				floors.item					多個對應的item json值
5		sql_global_item.php		public/img/template				global_item.item			一個icon json值
6		sql_goods_category.php	public/img/template				category.icon				僅單一圖片
7		sql_main_item.php		public/img/template				main_item.images			僅單一圖片



store部份：

項目				檔名						圖片路徑						Table欄位										記錄格式
1		sql_logi_form.php		public/img/shipping				store_shipping.images						僅單一圖片
2		sql_picking.php			public/img/picking				store_picking.title_images、ending_images	多個對應的 json值
3		sql_product.php			public/img/goods				goods_index.images							多個對應的images json值
4		sql_store.php			public/img/store				store.images								僅單一圖片


前台： 

項目				檔名						圖片路徑							Table欄位						記錄格式
1		cart.php				public/img/W8bqSraWZHtyz8xVJaMQ order_form.identity			多個對應的identity json值,member0~9內
2		member.php				public/img/member				member_index.picture		僅單一圖片
3		member.php				public/img/application			order_application.images	僅單一圖片,member0~9 table內
*/

	//本程式若用GET方式帶入mode參數為delete，則刪除「圖片目錄內用不到的圖片」！

	$path2_array = array('/var/www/html/crazy2go_com/public/js','/var/www/html/crazy2go_com/public/css');
	$exclude = array('PHPExcel','HTMLPurifier','PHPMailer','pscws');
	$path2 = '/var/www/html/crazy2go_com/swop';
	dirToArray2($path2,$exclude);
	
	//echo "<PRE>".$path2 ."內的目錄數量：".count($path2_array)."<BR>";
	//print_r($path2_array);
	//foreach ($path2_array as $key => $value)
		//echo $key.'  /  '.$value."<BR>";
	
	$file_array = array();			//將要搜尋的目錄內所有檔案開檔後存在陣列中
	foreach($path2_array as $value1)
	{
		$path2_file_array = glob($value1.'/*.*');
		foreach ($path2_file_array as $value)
			$file_array[$value] = file_get_contents($value);
	}
	//print_r($file_array);

	include 'backend/config.php';
	require_mark("swop/library/dba.php");
	$dba=new dba();
	
	$con = mysqli_connect("localhost","global2user","wRusUdRAjesWuqE3rech");
	if(mysqli_connect_errno()) { echo "Failed to connect to MySQL: ".mysqli_connect_error(); }
	mysqli_query($con,"SET NAMES 'UTF8'"); 
	mysqli_query($con,"SET CHARACTER SET UTF8");
	mysqli_query($con,"SET CHARACTER_SET_RESULTS=UTF8");

	if ($_GET['mode'] == 'delete')
		echo "正在刪除「圖片目錄內用不到的圖片」...<BR><BR>";
	else
		echo "列出「圖片目錄內用不到的圖片」清單：<BR><BR>";

	match_advertisement($dba);
	match_logo($dba);
	match_qanda_item($dba);
	match_template($dba);
	match_shipping($dba);
	match_picking($dba);
	match_goods($dba);
	match_store($dba);
	match_identity($con);
	match_member($dba);
	match_application($con);
	

	function match_advertisement($dba)
	{
		//取得advertisement裡所有images欄位的值
		$sql = "SELECT `images` FROM `advertisement` order by `fi_no`";
		$images = $dba->query($sql);
		$sql = "SELECT `item` FROM `advertisement` order by `fi_no`";
		$item = $dba->query($sql);
	
		$db_files = array();
		//將advertisement裡所有images欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)$value1['images'] as $value2)
				$db_files[] = $value2;
				
		//echo "<PRE>";
		foreach ($item as $value)
		{
			$tmp = json_decode($value['item']);
			if ($tmp->icon)
				$db_files[] = $tmp->icon;
		}
			
		$path = realpath("public/img/advertisement").'/';
		$path_files = dirToArray($path);
		$db_str = 'advertisement.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}

	function match_logo($dba)
	{
		//取得brand_group裡所有logo欄位的值
		$sql = "SELECT `logo` FROM `brand_group` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將brand_group裡所有logo欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)$value1['logo'] as $value2)
				$db_files[] = $value2;
		
		$path = realpath("public/img/logo").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'brand_group.logo';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_qanda_item($dba)
	{
		//取得qanda_item裡所有images欄位的值
		$sql = "SELECT `images` FROM `qanda_item` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將qanda_item裡所有images欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)json_decode($value1['images']) as $value2)
				$db_files[] = $value2;
		
		$path = realpath("public/img/qanda").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'qanda_item.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_template($dba)
	{
		//取得floors.item、global_item.item、category.icon和main_item.images內的圖檔，以上資料表欄位的圖檔路徑均在 public/img/template 內。
	
		//判斷從floors.item裡取得的內容為圖檔的正規表示式patten
		$match = '/^[a-zA-Z0-9_]*\.(jpg|JPG|png|PNG|gif|GIF|jpeg|JPEG)$/';
		
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
		
		$db_str = 'floors.item、global_item.item、category.icon、main_item.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}

	function match_shipping($dba)
	{
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
		
		$db_str = 'store_shipping.images';

		Show_Result($db_files, $path_files, $db_str, $path);

	}
	
	function match_picking($dba)
	{
		//取得store_picking裡所有title_images、ending_images欄位的值
		$sql = "SELECT `title_images`,`ending_images` FROM `store_picking` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將store_picking裡所有title_images、ending_images欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
		{
			foreach ((array)json_decode($value1['title_images']) as $value2)
				$db_files[] = $value2;
			foreach ((array)json_decode($value1['ending_images']) as $value2)
				$db_files[] = $value2;
		}
		
		$path = realpath("public/img/picking").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'store_picking.title_images、ending_images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_goods($dba)
	{
		//取得goods_index裡所有images欄位的值
		$sql = "SELECT `images` FROM `goods_index` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將goods_index裡所有images欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)json_decode($value1['images']) as $value2)
				$db_files[] = $value2;
		
		$path = realpath("public/img/goods").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'goods_index.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_store($dba)
	{
		//取得store裡所有images欄位的值
		$sql = "SELECT `images` FROM `store` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將store裡所有images欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)$value1['images'] as $value2)
				$db_files[] = $value2;
		
		$path = realpath("public/img/store").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'store.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}	
	
	function match_identity($con)
	{
		//從member0~9中取得各identity值
		for($i=0;$i<=9;$i++){
			$mem = "member".$i;
			mysqli_select_db($con,$mem);
			$sql = "SELECT `identity` FROM `order_form`";
			$result = mysqli_query($con, $sql);
			$$mem = array();
			while($row = mysqli_fetch_array($result))
				foreach((array)json_decode($row['identity'])as $value)
					array_push($$mem,$value);
		}
		//合併member0~9的各identity值
		$db_files = array_merge($member0,$member1,$member2,$member3,$member4,$member5,$member6,$member7,$member8,$member9);
		
		$path = realpath("public/img/W8bqSraWZHtyz8xVJaMQ").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'order_form.identity';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_member($dba)
	{
		//取得member_index裡所有picture欄位的值
		$sql = "SELECT `picture` FROM `member_index` order by `fi_no`";
		$images = $dba->query($sql);
	
		$db_files = array();
		//將member_index裡所有picture欄位的圖片檔名全部存成一個陣列
		foreach ($images as $value1)
			foreach ((array)$value1['picture'] as $value2)
				$db_files[] = $value2;
		
		$path = realpath("public/img/member").'/';
		$path_files = dirToArray($path);
		
		$db_str = 'member_index.picture';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}
	
	function match_application($con)
	{
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
		
		$db_str = 'order_application.images';
		
		Show_Result($db_files, $path_files, $db_str, $path);
	}

	//共用的顯示結果的Function
	function Show_Result($db_files, $path_files, $db_str, $path, $mode='show')
	{
		
		//template和goods目錄下，要過濾掉不顯示的檔案
		/*$skip = array('arrow_deepgray.png','arrow_gray2.png','arrow_icon.png','arrow_red.png','arrow_red2.png','caveat.png','change_icon.png','check_button.png',
				'check_icon.png','checkout_button.png','checkout_button2.png','favorite_icon.jpg','favorite_icon2.jpg','home_icon.jpg','home_icon.png','hotsale_icon.png',
				'icon_freefee.png','icon_hotsale.png','icon_recommand.png','identity_card.jpg','identity_card.jpg','left.jpg','line.png','magnify.png','order_icon.png',
				'order_icon2.png','pay_icon1.jpg','pay_icon2.jpg','pay_icon3.jpg','product-opinion_icon.png','red_star.png','right.jpg','sale_icon_flower.png','sale_icon.png',
				'search_icon.png','service_icon_1.jpg','service_icon_2.jpg','service_icon.jpg','service_icon.png','share_icon1.jpg','share_icon2.jpg','share_icon3.jpg',
				'share_icon4.jpg','share_icon5.jpg','share_icon6.jpg','shop_icon.png','shop_icon2.png','star_gray.png','star_red.png','step1.png','step2.png','step3.png',
				'uncheck_button.png','arrow1.jpg','arrow2.jpg','arrow3.jpg','arrow4.png','arrow_left.png','arrow_right.png','birth.png','button.png','button2.png','button3.png',
				'button_change.png','cancel_button.png','car.png','check.png','check2.png','click_icon.jpg','click_icon2.jpg','delete.png','direct_delivery.jpg',
				'favorite.png','gray.png','green.jpg','hot.png','icon.jpg','icon.png','icon1.jpg','icon2.jpg','icon3.jpg','icon4.jpg','icon1.png','icon2.png',
				'icon3.png','icon4.png','icon_arrow_switch.png','icon_chart_bar.png','icon_evaluate.png','icon_mail_server_setting.png','index.png','left_arrow.jpg',
				'login.png','login_ad.jpg','logo.jpg','m_check.png','m_check2.png','modify.png','money_icon.png','myaccount.png','myaccount_1-3.png','point.png',
				'product_icon.png','product_icon2.png','red.jpg','reflash.png','sale.png','search.png','service.png','service_icon5.png','service_icon6.png','service_icon7.png',
				'sharp_arrow.jpg','shopcart.png','shopping_bag.png','sideicon_top.png','signin_icon.png','sitemap.png','top_arrow.jpg','type_hot.png','type_youlike.png','visa.jpg');
		*/
		$skip = array();
		
		//取得兩者陣列中的差異檔案
		$diff1 = array_diff(array_filter($db_files),array_filter($path_files));
		sort($diff1);
		$diff2 = array_diff(array_filter($path_files),array_filter($db_files));
		sort($diff2);
		$diff3 = array_diff($diff2,$skip);
		sort($diff3);
		//$diff3 = $diff2;	//此行註解拿掉，不過濾$skip
		
		echo "<PRE>";//echo $db_str."內的檔案：<BR>";print_r($db_files);echo $path."內的檔案：<BR>";print_r($path_files);
		if ($_GET['mode'] != 'delete')
		{
			echo "僅 $db_str 內有的檔案：<BR>";
			print_r($diff1);
			echo "<BR>僅 $path 內有的檔案：<BR>";
			print_r($diff2);
		}
		echo "<BR>過濾掉網頁用icon圖後，僅 $path 內有的檔案：<BR>";
		print_r($diff3);

		foreach($diff3 as $key => $file)
		{
			global $file_array;
			foreach($file_array as $value)
			{
				if (stripos($value,$file) !== false)
				{
					unset($diff3[$key]);
					break;
				}
			}
		}
		echo "<BR>掃描swop和js目錄後，僅 $path 內有的檔案：<BR>";
		print_r($diff3);
		
		//刪除圖片目錄裡，DB和網頁都用不到的圖片
		foreach($diff3 as $value)
		{

			//echo $i."<BR>".$tmp."<BR>";
			if ($_GET['mode'] != 'delete')
				echo "將被刪除的檔案：".$path.$value."<BR>";
			else
			{
				if (unlink($path.$value));
					echo $path.$value." 已刪除！<BR>";
			}
		}
		echo "<HR>";
		
	}		

	//資料夾檔案結構陣列化
	function dirToArray($dir, $exclude=array()) {
		$result = array();
		$cdir = array_diff(scandir($dir), $exclude);
		foreach($cdir as $key => $value) {
			if(!in_array($value, array(".", "..",".DS_Store"))) {
				if(is_dir($dir.DIRECTORY_SEPARATOR.$value)) {
					$result[$value] = dirToArray($dir.DIRECTORY_SEPARATOR.$value, $exclude);
				}
				else {
					$result[] = $value;
				}
			}
		}
		return $result;
	}
	
	function dirToArray2($dir, $exclude=array())
	{ //資料夾檔案結構陣列化
		global $path2_array;
		$result = array();
		$cdir = array_diff(scandir($dir), $exclude);
		foreach($cdir as $key => $value) {
			if(!in_array($value, array(".", ".."))) {
				if(is_dir($dir.DIRECTORY_SEPARATOR.$value)) {
					$result[$value] = dirToArray2($dir.DIRECTORY_SEPARATOR.$value, $exclude);
					//將目錄存到外部的$path2_array陣列中
					$path2_array[] = $dir.DIRECTORY_SEPARATOR.$value;
				}
				//else {
					//$result[] = $value;
				//}
			}
		}
		return $result;
	}
?>













