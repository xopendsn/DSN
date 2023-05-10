<?php

foreach ($donnees[0] as $key => $value){
	$method = 'set'.ucfirst($key);    
	if (method_exists($this, $method)){
		$this->$method($value);

	}
}
?>
