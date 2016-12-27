<?php
function arr_url_json($arr) {
	if(is_array($arr)) {
		$b_key5str = false;

		if((bool)count(array_filter(array_keys($arr), 'is_string'))) {
			$b_key5str = true;
		}

		foreach($arr as $key => $val) {
			if($b_key5str) {
				$json .= '"'.$key.'":';
			}

			if(is_array($val)) {
				$json .= arr_url_json($val).",";
			}
			else if(is_string($val)) {
					$json .= '"'.$val.'",';
				}
			else if(is_numeric($val)) {
					$json .= $val.',';
				}
		}

		if($b_key5str) {
			return "{".substr($json,0,-1)."}";
		}
		else {
			return "[".substr($json,0,-1)."]";
		}
	}
	else {
		throw new exception("It's not an array!");
	}
}

$a["background"] = "150302104013_0_206x530_1.jpg";
$a["logo"]['image'][] = "150302104013_0_206x530_2.jpg";
$a["logo"]['image'][] = "150302104013_0_206x530_3.jpg";
$a["logo"]['image'][] = "150302104013_0_206x530_4.jpg";
$a["logo"]['url'][] = "#";
$a["logo"]['url'][] = "#";
$a["logo"]['url'][] = "#";
$a["box"]['text'][] = "寶寶用品";
$a["box"]['text'][] = "媽咪用品";
$a["box"]['url'][] = "#";
$a["box"]['url'][] = "#";
$a["goods"]['fi_no'][] = "1";
$a["goods"]['fi_no'][] = "2";
$a["goods"]['fi_no'][] = "3";
$a["goods"]['fi_no'][] = "4";
$a["goods"]['fi_no'][] = "5";
$a["goods"]['fi_no'][] = "6";
$a["goods"]['fi_no'][] = "7";
$a["goods"]['fi_no'][] = "8";
$a["focus"]['fi_no'][] = "1";
$a["focus"]['fi_no'][] = "2";
$a["focus"]['fi_no'][] = "3";
$a["other"]['text'][] = "兒童餐具";
$a["other"]['text'][] = "收納包袋";
$a["other"]['text'][] = "居家用品";
$a["other"]['url'][] = "#";
$a["other"]['url'][] = "#";
$a["other"]['url'][] = "#";
$a["more"] = "#";
$a["color"]["text_title"] = "EE7B8C";
$a["color"]["text_other"] = "F17B8D";
$a["color"]["text_box"] = "F07990";
$a["color"]["line_deep"] = "EE7A8E";
$a["color"]["line_light"] = "F39BAA";
$a["color"]["button_deep"] = "DF6C83";
$a["color"]["button_light"] = "F4849A";
$a["color"]["button_order"] = "F4849A";
$a["color"]["icon_grab"] = "FC4E6C";

//echo arr_url_json($a);

if(count($_FILES['file']['name']) > 0) {
	print_r($_FILES['file']);
}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="http://www.crazy2go.com/public/js/jquery-2.1.1.min.js"></script>
<script src="http://www.crazy2go.com/backend/js/jquery-te/jquery-te-1.4.0.min.js"></script>
<script src="http://www.crazy2go.com/backend/js/jquery.transit.js"></script>
<link type="text/css" rel="stylesheet" href="http://www.crazy2go.com/backend/js/jquery-te/jquery-te-1.4.0.css">
<style>
.jqte_editor_x, .jqte_source {
	height:400px; overflow-y:auto; background-color:#fff; padding:5px;
}
.jqte_image {
	height:270px; width:390px; overflow-y:auto; position:absolute; padding:5px; background:#FFF; border:#AAA 1px solid; box-shadow:0 0 5px #AAA; -webkit-box-shadow:0 0 5px #AAA; -moz-box-shadow:0 0 5px #AAA; z-index:100; text-align:center; opacity:0; pointer-events:none;
}
.jqte_plus_tool {
	width:50px; height:280px; position:absolute; background-color:#D8D8D8; z-index:101; opacity:0; pointer-events:none;
}
.jqte_table {
	height:245px; width:293px; overflow-y:auto; position:absolute; padding:5px; background:#FFF; border:#AAA 1px solid; box-shadow:0 0 5px #AAA; -webkit-box-shadow:0 0 5px #AAA; -moz-box-shadow:0 0 5px #AAA; z-index:100; opacity:0; pointer-events:none;
}
.jqte_tool_22 > .jqte_tool_icon {
	background:none; width:45px; line-height:22px; text-align:center;
}
.jqte_tool_23 > .jqte_tool_icon {
	background:none; width:45px; line-height:22px; text-align:center;
}
.file_box {
	position:relative; width:50px; line-height:69px; color:gray; text-align:center; font-size:9pt;
}
.file_border {
	border-top:1px solid #fff;
}
.file_add {
	 position:absolute; top:0px; left:0px; width:50px; height:69px; opacity:0.0;
}
.jqte_box {
	position:relative; width:150px; height:100px; border:1px solid #D8D8D8; border-radius:2px; overflow:hidden; margin:10px; float:left;
}
.jqte_image_box {
	position:relative; top:0px; left:0px; width:100px; height:100px; line-height:100px; color:gray; font-size:10pt;
}
.file_post {
	position:absolute; top:0px; left:0px; width:100px; height:100px; opacity:0.0;
}
.jqte_image_size {
	position:absolute; top:0px; left:100px; width:50px; height:100px;
}
.jqte_image_width {
	margin:0px; padding:0px; border:0px; background-color:#E8E8E8; width:100%; height:30px; color:gray; text-align:center; font-size:9pt;
}
.jqte_image_height {
	margin:0px; padding:0px; border:0px; background-color:#E8E8E8; width:100%; height:30px; border-top:1px solid #fff; color:gray; text-align:center; font-size:9pt;
}
.jqte_image_insert {
	margin:0px; padding:0px; border:0px; background-color:#D8D8D8; width:100%; line-height:38px; border-top:1px solid #fff; color:gray; font-size:9pt;
}
.jqte_image_select {
	position:absolute; top:3px; left:3px; margin:0px; padding:0px; border:0px; background-color:rgba(216, 216, 216, 0.75); width:20px; height:20px; line-height:20px; border:1px solid rgba(255, 255, 255, 0.50); color:gray; font-size:9pt;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.jqte-test').jqte();
	$('.jqte-test2').jqte();
	
	$('.jqte').css({'margin':'0'});
	
	$('.jqte_editor').attr('class', 'jqte_editor_x');
	
	$('.unselectable:contains("Picture URL")').css({'display':'none'});
	
	$('.jqte_tool_21').after('<div class="jqte_tool jqte_tool_22 unselectable" role="button" data-tool="20" unselectable="on" style="-webkit-user-select: none;">'+
								'<a class="jqte_tool_icon unselectable" unselectable="on" style="-webkit-user-select:none;">貼圖+</a>'+
							'</div>');
	$('.jqte_tool_21').after('<div class="jqte_tool jqte_tool_23 unselectable" role="button" data-tool="20" unselectable="on" style="-webkit-user-select: none;">'+
								'<a class="jqte_tool_icon unselectable" unselectable="on" style="-webkit-user-select:none;">表格+</a>'+
							'</div>');
	
	
	
	
	
	var jqte_image_number = 1;
	$('.jqte_source').after('<div class="jqte_plus_tool">'+
								'<div class="file_box">新增<input type="file" class="file_add" name="jqte_image" accept="image/*" multiple /></div>'+
								'<div class="file_all file_box file_border">全選</div>'+
								'<div class="file_ins file_box file_border">插入</div>'+
								'<div class="file_del file_box file_border">刪除</div>'+
							'</div>'+
							'<div id="jqte_image" class="jqte_image" data-number="0">'+
							'</div>');
							
	$('.jqte_source').after('<div id="jqte_table" class="jqte_table" data-number="0">'+
							    '<div style="float:left; margin:10px 18px 10px 10px;">'+
							        '<div>'+
							            '<div style="color: gray;font-size: 9pt;">行 數</div>'+
							            '<div><input class="table_row" type="text" value="3" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width:109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							        '<div style="margin-top: 3px;">'+
							            '<div style="color: gray;font-size: 9pt;">列 數</div>'+
							            '<div><input class="table_column" type="text" value="2" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width:109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							    '</div>'+
							    '<div style="float: left;margin: 10px 18px 10px 10px;">'+
							        '<div>'+
							            '<div style="color: gray;font-size: 9pt;">寬 度</div>'+
							            '<div><input class="table_width" type="text" value="500" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width: 109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							        '<div style="margin-top: 3px;">'+
							            '<div style="color: gray;font-size: 9pt;">高 度</div>'+
							            '<div><input class="table_height" type="text" value="300" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width: 109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							    '</div>'+
							    '<div style="float: left;margin: 10px 18px 10px 10px;">'+
							        '<div>'+
							            '<div style="color: gray;font-size: 9pt;">間 距</div>'+
							            '<div><input class="table_cellspacing" type="text" value="1" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width: 109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							        '<div style="margin-top: 3px;">'+
							            '<div style="color: gray;font-size: 9pt;">內 距</div>'+
							            '<div><input class="table_cellpadding" type="text" value="1" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width: 109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"></div>'+
							        '</div>'+
							    '</div>'+
							    '<div style="float: left;margin: 10px 18px 10px 10px;">'+
							        '<div>'+
							            '<div style="color: gray;font-size: 9pt;">邊 框</div>'+
										'<div><input class="talbe_border" type="text" value="1" style="  margin: 0px;  padding: 0px;  border: 0px;  background-color: #E8E8E8;  width: 109px;  height: 30px;  color: gray;  text-align: center;  font-size: 9pt;  border: 1px solid #D8D8D8;  border-radius: 2px;"><div>'+
							        '</div>'+
							    '</div>'+
							    '<div style="clear:both;"></div>'+
							    '<div style="position: absolute;right: 0px;bottom: 0px;background-color: #D8D8D8;">'+
							        '<div class="table_def" style="width: 70px;line-height: 50px;color: gray;text-align: center;font-size: 9pt;float: left; -webkit-user-select: none;">默認</div>'+
							        '<div class="table_ins" style="width: 70px;line-height: 50px;color: gray;text-align: center;font-size: 9pt;float: left; -webkit-user-select: none; border-left:1px solid #fff;">插入</div>'+
							        '<div style="clear:both;"></div>'+
							    '</div>'+
							'</div>');
	
	$('.jqte_source').after('<div class="jqte_massage" style="z-index:200; padding:30px; background-color: rgb(238, 238, 238); border: 1px solid white; border-radius: 5px; box-shadow: 0 0 3px #999; -webkit-box-shadow: 0 0 3px #999; -moz-box-shadow: 0 0 3px #999; top: 145px; left: 450px; position: absolute; text-align: center; color: rgb(255, 90, 90); font-size: 10pt; pointer-events: none; opacity: 0.0;"></div>');
	
	function jqte_massage(index, massage) {
		$('.jqte_massage:eq('+index+')').html(massage);
		$('.jqte_massage:eq('+index+')').css({'top':($('.jqte:eq('+index+')').offset().top+($('.jqte:eq('+index+')').outerHeight()/2)-($('.jqte_massage:eq('+index+')').outerHeight()/2))+'px',
											'left':($('.jqte:eq('+index+')').offset().left+($('.jqte:eq('+index+')').outerWidth()/2)-($('.jqte_massage:eq('+index+')').outerWidth()/2))+'px',
											'opacity':'1.0'});
		$('.jqte_massage:eq('+index+')').transition({opacity:0, delay:1500});
	}
	
	
	
	
	
	var focus_check = "off";
	var focus_number = "";
	$(document).on("focus", ".jqte_editor_x", function() {
		focus_check = "on";
		focus_number = $('.jqte_editor_x').index(this);
	});
	
	$(document).on("focusout", ".jqte_editor_x", function() {
		focus_check = "off";
		focus_number = "";
	});
	
	
	
	
	
	$(document).on('click', '.jqte_tool_22', function() {
		var ix = $('.jqte_tool_22').index(this);
		$('.jqte_image:eq('+ix+')').css({'top':($(this).offset().top+$(this).outerHeight()+1)+'px', 'left':($(this).offset().left+1)+'px'});
		$('.jqte_plus_tool:eq('+ix+')').css({'top':($(this).offset().top+$(this).outerHeight()+2)+'px', 'left':($(this).offset().left+352)+'px'});
		
		if($('.jqte_image:eq('+ix+')').css('opacity') == '0') {
			$('.jqte_image:eq('+ix+'), .jqte_plus_tool:eq('+ix+')').transition({opacity:100}).css({'pointer-events':'auto'});
		}
		else {
			$('.jqte_image:eq('+ix+'), .jqte_plus_tool:eq('+ix+')').transition({opacity:0}).css({'pointer-events':'none'});
		}
	});
	
	$(document).on('click', '.jqte_tool_23', function() {
		var ix = $('.jqte_tool_23').index(this);
		$('.jqte_table:eq('+ix+')').css({'top':($(this).offset().top+$(this).outerHeight()+1)+'px', 'left':($(this).offset().left+1)+'px'});
		
		if($('.jqte_table:eq('+ix+')').css('opacity') == '0') {
			$('.jqte_table:eq('+ix+')').transition({opacity:100}).css({'pointer-events':'auto'});
		}
		else {
			$('.jqte_table:eq('+ix+')').transition({opacity:0}).css({'pointer-events':'none'});
		}
	});
	
	$(document).on('click', '.jqte_image_select', function() {
		if($(this).attr('data-select') == '0') {
			$(this).html('√').attr('data-select', '1').css({'background-color':'rgba(255, 102, 102, 0.75)', 'color':'#fff'});
		}
		else {
			$(this).html('').attr('data-select', '0').css({'background-color':'rgba(216, 216, 216, 0.75)', 'color':'gray'});
		}
	});
	
	$(document).on('click', '.jqte_image_insert', function() {
		//var ix = $('.jqte_image_insert').index(this);
		var i = $(this).attr('data-jqte').split("_");
		var ix = i[0];
		if(ix == focus_number && focus_check == "on") {
			var nu = $(this).attr('data-jqte');
			var nu_width = ($('#jqte_image_'+nu+'_width').val()!="") ? $('#jqte_image_'+nu+'_width').val() : $('#jqte_image_'+nu+'_width').attr('placeholder');
			var nu_height = ($('#jqte_image_'+nu+'_height').val()!="") ? $('#jqte_image_'+nu+'_height').val() : $('#jqte_image_'+nu+'_height').attr('placeholder');
			pasteHtmlAtCaret('<img id="jqte_use_'+nu+'" style="width:'+nu_width+'px; height:'+nu_height+'px;" src="'+$('#jqte_image_'+nu+' > img').attr('src')+'"/>');
		}
		else {
			jqte_massage(ix, "請選擇插入位置");
		}
	});
	
	
	
	
	
	var temp_data = $('#jqte_image');
	
	$(document).on("change", ".file_add", function() {
		var ix = $('.file_add').index(this);
		var f = $(this)[0].files;
		
		for(i=0; i<f.length; i++) {
			if(!f[i].type.match('image.*')) { continue; }
			
			temp_data.data(ix+'_'+(parseInt($('.jqte_image:eq('+ix+')').attr('data-number'))+i), $(this).prop('files')[i]);
			
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) {
					var n = parseInt($('.jqte_image:eq('+ix+')').attr('data-number'));
					var nu = ix+'_'+n;
					$('.jqte_image:eq('+ix+')').append('<div id="jqte_box_'+nu+'" class="jqte_box">'+
															'<div id="jqte_image_'+nu+'" class="jqte_image_box"><img style="width:100%; height:100%;" src="'+e.target.result+'" title="'+escape(theFile.name)+'"/></div>'+
															'<input type="file" class="file_post" name="jqte_image_'+nu+'" data-jqte="'+nu+'" accept="image/*" title="請選擇檔案"/>'+
															'<div class="jqte_image_size">'+
																'<div><input id="jqte_image_'+nu+'_width" class="jqte_image_width" type="text"></div>'+
																'<div><input id="jqte_image_'+nu+'_height" class="jqte_image_height" type="text"></div>'+
																'<div class="jqte_image_insert" data-jqte="'+nu+'" data-insert="0">插入</div>'+
															'</div>'+
															'<div class="jqte_image_select" data-jqte="'+nu+'" data-select="0"></div>'+
														'</div>');
					var image = new Image();
					image.src = e.target.result;
					image.onload = function() {
						$('#jqte_image_'+nu+'_width').val(image.width);
						$('#jqte_image_'+nu+'_width').attr('placeholder', image.width);
						$('#jqte_image_'+nu+'_height').val(image.height);
						$('#jqte_image_'+nu+'_height').attr('placeholder', image.height);
					}
					$('.jqte_image:eq('+ix+')').attr('data-number', (n+1));
				};
			})(f[i]);
			reader.readAsDataURL(f[i]);
		}
		
		$(this).val('').clone(true);
	});
	
	$(document).on("click", ".file_all", function() {
		var ix = $('.file_all').index(this);
		if($('.jqte_image_select[data-jqte^="'+ix+'_"]').attr('data-select') == '0') {
			$('.jqte_image_select[data-jqte^="'+ix+'_"]').html('√').attr('data-select', '1').css({'background-color':'rgba(255, 102, 102, 0.75)', 'color':'#fff'});
		}
		else {
			$('.jqte_image_select[data-jqte^="'+ix+'_"]').html('').attr('data-select', '0').css({'background-color':'rgba(216, 216, 216, 0.75)', 'color':'gray'});
		}
	});
	
	$(document).on("click", ".file_ins", function() {
		var ix = $('.file_ins').index(this);
		if(ix == focus_number && focus_check == "on") {
			$.each($('.jqte_image_select[data-jqte^="'+ix+'_"][data-select="1"]'), function(){
				var nu = $(this).attr('data-jqte');
				var nu_width = ($('#jqte_image_'+nu+'_width').val()!="") ? $('#jqte_image_'+nu+'_width').val() : $('#jqte_image_'+nu+'_width').attr('placeholder');
				var nu_height = ($('#jqte_image_'+nu+'_height').val()!="") ? $('#jqte_image_'+nu+'_height').val() : $('#jqte_image_'+nu+'_height').attr('placeholder');
				pasteHtmlAtCaret('<img id="jqte_use_'+nu+'" style="width:'+nu_width+'px; height:'+nu_height+'px;" src="'+$('#jqte_image_'+nu+' > img').attr('src')+'"/>');
			});
		}
		else {
			jqte_massage(ix, "請選擇插入位置");
		}
	});
	
	$(document).on("click", ".file_del", function() {
		var ix = $('.file_del').index(this);
		$.each($('.jqte_image_select[data-jqte^="'+ix+'_"][data-select="1"]'), function(){
			var nu = $(this).attr('data-jqte');
			temp_data.removeData(nu);
			$('#jqte_box_'+nu+', #jqte_use_'+nu).remove();
		});
	});
	
	$(document).on("change", ".file_post", function() {	
		var file_name = $('#'+$(this).attr('name'));
		var str_name = '#'+$(this).attr('name');
		var f = $(this)[0].files;
		for(i=0; i<f.length; i++) {
			if(!f[i].type.match('image.*')) { continue; }
			
			temp_data.data(''+$(this).attr('data-jqte'), $(this).prop('files')[i]);
			
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) {
					var image = new Image();
					image.src = e.target.result;
					image.onload = function() {
						$(str_name+'_width').val(image.width);
						$(str_name+'_height').val(image.height);
					}
					file_name.html('<img style="width:100%; height:100%;" src="'+e.target.result+'" title="'+escape(theFile.name)+'"/>');
					$(replaceAll(str_name, 'image', 'use')).attr('src', e.target.result);
				};
			})(f[i]);
			reader.readAsDataURL(f[i]);
		}
	});
	
	
	
	
	
	$(document).on("click", ".table_ins", function() {
		var ix = $('.table_ins').index(this);
		if(ix == focus_number && focus_check == "on") {
			$('.jqte_editor_x:eq('+ix+')').html();
			var table_html = '<table border="'+$('.talbe_border:eq('+ix+')').val()+'" cellspacing="'+$('.table_cellspacing:eq('+ix+')').val()+'" cellpadding="'+$('.table_cellpadding:eq('+ix+')').val()+'" width="'+$('.table_width:eq('+ix+')').val()+'" height="'+$('.table_height:eq('+ix+')').val()+'">';
			for(i=0; i<$('.table_row:eq('+ix+')').val(); i++) {
				table_html += '<tr>';
				for(j=0; j<$('.table_column:eq('+ix+')').val(); j++) {
					table_html += '<td>&nbsp;</td>';
				}
				table_html += '</tr>';
			}
			table_html += '</table>';
			pasteHtmlAtCaret(table_html);
		}
		else {
			jqte_massage(ix, "請選擇插入位置");
		}
	});
	
	$(document).on("click", ".table_def", function() {
		var ix = $('.table_def').index(this);
		$('.table_row:eq('+ix+')').val(3);
		$('.table_column:eq('+ix+')').val(2);
		$('.table_cellspacing:eq('+ix+')').val(1);
		$('.table_cellpadding:eq('+ix+')').val(1);
		$('.table_width:eq('+ix+')').val(500);
		$('.table_height:eq('+ix+')').val(300);
		$('.talbe_border:eq('+ix+')').val(1);
	});
	
	$(document).on("mousedown selectstart", ".table_ins, .table_def, .file_add, .file_all, .file_ins, .file_del, .file_post, .jqte_image_select, .jqte_image_insert", function() {
		return false;
	});
	
	
	
	
	
	$(document).on("click", "#testa", function() {
		var form_data = new FormData();
		for(var key in temp_data.data()) {
			console.log(key);
			form_data.append('file[jqte_box_'+key+'][]', temp_data.data()[key]);
		}
		$.ajax({
			url: 'demo_jqte.php',
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
	
	
	
	
	
	
	//fix 原始碼的textarea在固定高度下，不會出現scrollbar
	$(document).on("click", ".jqte_tool_21", function() {
		var ix = $('.jqte_tool_21').index(this);
		var e = $.Event("keydown");
		e.which = 50;
		$(".jqte_source:eq("+ix+") > textarea").trigger(e);
	});
	
	//fix 自動隱藏貼圖模組
	$(document).on("click", ".jqte_tool:not(.jqte_tool_22)", function() {
		var ix;
		if($(".jqte_editor_x").index(this) >= 0) {
			ix = $(".jqte_editor_x").index(this);
		}
		else {
			var class_name = $(this).attr('class').split(" ")
			ix = $('.'+class_name[1]).index(this);
		}
		$('.jqte_image:eq('+ix+'), .jqte_plus_tool:eq('+ix+')').transition({opacity:0}).css({'pointer-events':'none'});
	});
	
	//fix 自動隱藏表格模組
	$(document).on("click", ".jqte_tool:not(.jqte_tool_23)", function() {
		var ix;
		if($(".jqte_editor_x").index(this) >= 0) {
			ix = $(".jqte_editor_x").index(this);
		}
		else {
			var class_name = $(this).attr('class').split(" ")
			ix = $('.'+class_name[1]).index(this);
		}
		$('.jqte_table:eq('+ix+')').transition({opacity:0}).css({'pointer-events':'none'});
	});
	
	function replaceAll(txt, replace, with_this) {
		return txt.replace(new RegExp(replace, 'g'),with_this);
	}
	
	function pasteHtmlAtCaret(html) {
	    var sel, range;
	    if(window.getSelection) {
	        sel = window.getSelection();
	        if(sel.getRangeAt && sel.rangeCount) {
	            range = sel.getRangeAt(0);
	            range.deleteContents();
	
	            var el = document.createElement("div");
	            el.innerHTML = html;
	            var frag = document.createDocumentFragment(), node, lastNode;
	            while( (node = el.firstChild) ) {
	                lastNode = frag.appendChild(node);
	            }
	            range.insertNode(frag);
	            
	            if(lastNode) {
	                range = range.cloneRange();
	                range.setStartAfter(lastNode);
	                range.collapse(true);
	                sel.removeAllRanges();
	                sel.addRange(range);
	            }
	        }
	    }
	    else if(document.selection && document.selection.type != "Control") {
	        document.selection.createRange().pasteHTML(html);
	    }
	}
	
})
</script>
</head>

<body>
<textarea name="textarea" class="jqte-test"></textarea>
<br />

<textarea name="textarea" class="jqte-test2"></textarea>
<br />

<div id="testa" style="text-align: center; width: 200px;line-height: 45px; /* background-color: rgb(255, 50, 50); */border: 1px solid red;border-radius: 5px;overflow: hidden;background: linear-gradient(top,rgb(255, 129, 129),rgb(255, 50, 50)); background: -moz-linear-gradient(top, rgb(255, 129, 129),rgb(255, 50, 50)); background: -webkit-linear-gradient(top,rgb(255, 129, 129),rgb(255, 50, 50));">
  <div style="border-top: 1px solid rgba(255, 255, 255, 0.5); font-size: 12pt; color: #fff; border-radius: 5px;">送出</div>
</div>
<br />

<div style="width:1225px; height:529px; border-bottom:1px solid red;">
	<div style="float:left; width:206px; height:529px; background-color:#ffd0d0;">
		<div style="margin-top:194px; width:206px; height:252px;">
			<div style="position:absolute;"></div>
			<div style="position:absolute;"></div>
			<div style="position:relative;"></div>
		</div>
		<div style="position:relative; width:206px; height:83px;">
			<div style="position:absolute; left:0px; top:0px; width:103px; height:41px; background-color:rgba(255, 0, 0, 0.5)"></div>
			<div style="position:absolute; right:0px; top:0px; width:102px; height:41px; background-color:rgba(255, 0, 0, 0.5)"></div>
			<div style="position:absolute; left:0px; bottom:0px; width:103px; height:41px; background-color:rgba(255, 0, 0, 0.5)"></div>
			<div style="position:absolute; right:0px; bottom:0px; width:102px; height:41px; background-color:rgba(255, 0, 0, 0.5)"></div>
		</div>
	</div>
	<div style="float:left; width:1019px; height:529px;">
		<div style="border-bottom:2px solid red;">
			<div style="float:left; width:330px; line-height:32px;"></div>
			<div style="float:left; width:600px; height:16px; margin-top:16px;"></div>
			<div style="float:left; width:89px; height:16px; margin-top:16px;"></div>
			<div style="clear:both;"></div>
		</div>
		<div style="border-right:1px solid red;">
			<div style="float:left; width:660px; height:456px; margin:35px 0 4px 27px;">
				<?php for($i=0; $i<8; $i++) { ?>
				<div style="float:left; margin:0 27px 31px 0;">
					<div style="width:136px; height:136px; border:1px solid red;"></div>
					<div style="width:138px; height:59px;">
						<div style="width:136px; height:32px; line-height:16px; margin:3px 1px;"></div>
						<div style="position:relative; width:136px; height:18px; margin:3px 1px 0 1px;">
							<div style="position:relative; width:98px; height:18px;"></div>
							<div style="position:absolute; right:0px; bottom:0px; width:38px; height:16px; margin-top:2px; background-color:purple;"></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div style="clear:both;"></div>
			</div>
			<div style="float:left; width:302px; height:423px; margin:35px 27px 35px 0; border:1px solid red;">
				<div style="position:relative; width:302px; height:302px; border-bottom:1px solid red;">
					<div style="position:absolute;"></div>
					<div style="position:absolute;"></div>
					<div style="position:relative;"></div>
				</div>
				<div style="border-bottom:1px solid red; width:302px; height:40px; line-height:40px;"></div>
				<div style="width:302px; height:64px; margin:11px 0 4px 0;">
					<div style="width:302px; height:18px; margin-bottom:10px;">
						<div style="float:left; width:100px; height:18px; border-right:1px solid red;"></div>
						<div style="float:left; width:100px; height:18px; border-right:1px solid red;"></div>
						<div style="float:left; width:100px; height:18px;"></div>
						<div style="clear:both;"></div>
					</div>
					<div style="width:290px; height:34px; border:1px solid red; margin:0 5px; border-radius:2px;">
						<div style="float:left; width:119px; height:36px; margin:0 15px;"></div>
						<div style="float:left; width:117px; height:25px; margin:5px 24px 4px 0; background-color:yellow;"></div>
						<div style="clear:both;"></div>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>

</body>
</html>
<?php
}
?>