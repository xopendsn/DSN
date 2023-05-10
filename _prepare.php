<?php
global $BDD;	
$keys = (implode("`, `", array_keys(get_object_vars($this))));
$data = implode("' , '", str_replace("'", "\'",get_object_vars($this)));

?>
