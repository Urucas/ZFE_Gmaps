<?php
class ZFE_Gmaps extends Zend_Form_Element {

	private $_width, $_height;

	private $_latitude, $_longitude;

	private $_appKey;

	private $_zoom = 14;

	private $_marker = null;

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

	public function setMarker($img_path) {
		$this->_marker = (string) $img_path;
	}

	public function render() {
	
		$xhtml = "";
		$xhtml.= '<label>'.$this->getLabel().'</label>';
		
		$xhtml.= '<div id="'.$this->getId().'" style="width:'.$this->_width.'px;height:'.$this->_height.'px; margin:8px;"></div>';
		$xhtml.= '<label>Latitud</label><input type="text" id="latitude-'.$this->getId().'" value="'.(float)$this->_latitude.'" /><br />';
		$xhtml.= '<label>Longitud</label><input type="text" id="longitude-'.$this->getId().'" value="'.(float)$this->_longitude.'" /><br />';
	
		$xhtml.= '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key='.$this->_appKey.'&sensor=true"></script>';
		$xhtml.= '<script type="text/javascript">';
		$xhtml.= '	var map = null; var marker = null;';
		$xhtml.= '  var myLatLng = new google.maps.LatLng('.(float)$this->_latitude.', '.$this->_longitude.');';
      	$xhtml.= '	function initialize() {';
		$xhtml.= '		var mapOptions = {';
		$xhtml.= '			center: new google.maps.LatLng('.(float)$this->_latitude.', '.(float)$this->_longitude.'),';
        $xhtml.= ' 			zoom: '.(int)$this->_zoom.',';
        $xhtml.= '		};';
		$xhtml.= '		map = new google.maps.Map(document.getElementById("'.$this->getId().'"), mapOptions);';

		if($this->_marker != null) {
			$xhtml.= 'marker = new google.maps.Marker({';
	    	$xhtml.= '	position: myLatLng,';
		    $xhtml.= ' 	map: map,';
    		$xhtml.= '	icon: "'.$this->_marker.'"';
			$xhtml.= '});';
		}

		$xhtml.= 'google.maps.event.addListener(map, "click", function(event) {';
		$xhtml.= '  marker.setPosition(new google.maps.LatLng(event.latLng.lat(),event.latLng.lng()));';
		$xhtml.= '  map.panTo(new google.maps.LatLng(event.latLng.lat(),event.latLng.lng()));';
		$xhtml.= '  document.getElementById("latitude-'.$this->getId().'").value = event.latLng.lat();';
		$xhtml.= '  document.getElementById("longitude-'.$this->getId().'").value = event.latLng.lng();';
  	    $xhtml.= '});';

		$xhtml.= '	}';
	
		$xhtml.= '  google.maps.event.addDomListener(window, "load", initialize);';
		$xhtml.= '</script>';

		return $xhtml;
	}
}

?>
