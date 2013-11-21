<?php
class ZFE_Gmaps extends Zend_Form_Element {

	private $_width, $_height;

	private $_latitude, $_longitude;

	private $_appKey;

	private $_zoom = 14;

	public function setAppKey($appKey) {
	
		$this->_appKey = (string) $appKey;
		return $this;
	}

	public function setSize($width, $height) {
		$this->_width = (int) $width;
		$this->_height = (int) $height;
		return $this;
	}

	public function setLatNLng($latitude, $longitude) {
		$this->_latitude = (float) $latitude;
		$this->_longitude = (float) $longitude;
		return $this;
	}

	public function render() {
	
		$xhtml = "";
		$xhtml.= '<label>'.$this->getLabel().'</label>';
		$xhtml.= '<div id="'.$this->getId().'" style="width:'.$this->_width.'px;height:'.$this->_height.'px; margin:8px;"></div>';
		$xhtml.= '<label>Latitud</label><input type="text" id="latitude-'.$this->getId().'" value="'.(float)$this->_latitude.'" /><br />';
		$xhtml.= '<label>Longitud</label><input type="text" id="longitude-'.$this->getId().'" value="'.(float)$this->_longitude.'" /><br />';
		$xhtml.= '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key='.$this->_appKey.'&sensor=true"></script>';
		$xhtml.= '<script type="text/javascript">';
      	$xhtml.= '	function initialize() {';
		$xhtml.= '		var mapOptions = {';
		$xhtml.= '			center: new google.maps.LatLng('.(float)$this->_latitude.', '.(float)$this->_longitude.'),';
        $xhtml.= ' 			zoom: '.(int)$this->_zoom.',';
        $xhtml.= '		};';
        $xhtml.= '		var map = new google.maps.Map(document.getElementById("'.$this->getId().'"), mapOptions);';
      	$xhtml.= '	}';
		$xhtml.= '  google.maps.event.addDomListener(window, "load", initialize);';
		$xhtml.= '</script>';

		return $xhtml;
	}
}

?>
