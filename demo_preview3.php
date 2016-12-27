<?php


print_r($_FILES['file']);

if(count($_FILES['file']['name']) > 0) {
	foreach($_FILES['file']['name'] as $k => $v) {
		for($i=0; $i<count($_FILES['file']['name'][$k]); $i++) {
			if(0 < $_FILES['file']['error'][$k][$i]) {
				echo "Error: ".$_FILES['file']['error'][$k][$i]."\r\n\r\n";
			}
			else {
				move_uploaded_file($_FILES['file']['tmp_name'][$k][$i], ''.$_FILES['file']['name'][$k][$i]);
				echo "Message: ".$_FILES['file']['name'][$k][$i]." Upload OK\r\n\r\n";
			}
		}
	}
}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="http://www.crazy2go.com/public/js/jquery-2.1.1.min.js"></script>
<style>
.thumb {
	
}
</style>
<script type="text/javascript">
$(document).ready(function(){

	$(document).on("change", ".file_post", function() {	
		var file_name = $("#"+$(this).attr('name'));
		file_name.css({'-webkit-filter':'grayscale(0)', 'filter':'grayscale(0)', 'background':'none'});
		
		var f = $(this)[0].files;
		for(i=0; i<f.length; i++) {
			if(!f[i].type.match('image.*')) { continue; }
			
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) {
					file_name.html('<img style="width:100%; height:100%;" src="'+e.target.result+'" title="'+escape(theFile.name)+'"/>');
				};
			})(f[i]);
			reader.readAsDataURL(f[i]);
		}
	});
	
	$(document).on("click", "#upload", function() {	
		var form_data = new FormData();
		$.each($(".file_post"), function(){
			for(i=0; i<$(this)[0].files.length; i++) {
				form_data.append('file['+$(this).attr('name')+'][]', $(this).prop('files')[i]);
			}
		});
		
		$.ajax({
			url: 'demo_preview3.php',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,						 
			type: 'post',
			success: function(str){
				console.log(str);
			}
		});
	});
	
})
</script>
</head>

<body>
	<div style="position:relative; width:100px; height:100px; border:1px solid #D8D8D8; border-radius:3px; overflow:hidden; margin-right:10px; float:left;">
		<div id="test_1" style="position:relative; top:0px; left:0px; width:100%; height:100%; -webkit-filter:grayscale(1); filter:grayscale(1); background:url(http://www.crazy2go.com/icon_arrow_switch.png) no-repeat center;"></div>
		<input type='file' class="file_post" name="test_1" accept="image/*" style="position:absolute; top:0px; left:0px;width:100%; height:100%; opacity:0.0;" />
	</div>
	
	<div style="position:relative; width:100px; height:100px; border:1px solid #D8D8D8; border-radius:3px; overflow:hidden; margin-right:10px; float:left;">
		<div id="test_2" style="position:relative; top:0px; left:0px; width:100%; height:100%; -webkit-filter:grayscale(1); filter:grayscale(1); background:url(http://www.crazy2go.com/icon_arrow_switch.png) no-repeat center"></div>
		<input type='file' class="file_post" name="test_2" accept="image/*" style="position:absolute; top:0px; left:0px;width:100%; height:100%; opacity:0.0;" />
	</div>
	
	<input type="button" id="upload" value="上傳檔案" style="width:102px; height:102px; border: 1px solid #D8D8D8; border-radius:3px; background-color:#D8D8D8; float:left;">
</body>
</html>
<?php
}
?>