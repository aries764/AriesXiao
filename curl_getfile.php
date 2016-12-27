<?php
	//要curl傳送檔案的相對路徑
	$uploaddir = realpath($_POST['dest_path']).'/';
	$error = '';
	foreach($_FILES as $key => $file)
	{
		if (file_exists($uploaddir.basename($file['name'])))
		{
			//若上傳的檔案和目的端檔案大小不同，則強制執行覆蓋動作！
			if ($file['size'] != filesize($uploaddir.basename($file['name'])))
			{
				move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name']));
				$error .= '目的端檔案'.$file['name'].'已被覆蓋!!';
			}
		}
		else
		{
			move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name']));
			$error .= '檔案：'.$file['name'].'上傳成功!!';
		}
	}
	if(!empty($error))
		echo $error;
?>