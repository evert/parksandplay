<?php

namespace Model;

class Location {
	
	public function getLocationById($id) {
		
		$id = $id + 1;
		
		return $id;
		
	}
	
	public function getLocationsByAmenity($amenity) {
		
		$info = 'A list of locations that have '. $amenity;
		
		return $info;
		
	}


}

?>