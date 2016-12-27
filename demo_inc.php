<?php

$this->js = array("abc");

function include_mark($a) {
	
	print_r($a);
}

include_mark($this);
?>