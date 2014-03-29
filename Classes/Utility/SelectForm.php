<?php
namespace Comuno\Nodedb2\Utility;

class SelectForm {

	/**
	* Add values to channel select
	*
	* For now only add channels 1-13  
	*
	* @param array $PA
	* @return array $PA array with our channels added
	*/

    public function getChannelList($PA, $fObj) {
		for ($x = 1; $x <= 13; $x++) {
			$PA['items'][] = array($x, $x);
		}
	}
	
} 

?>