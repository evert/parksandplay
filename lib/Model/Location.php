<?php

namespace Model;

class Location {

	public $id;
	public $name;
	public $address;
	public $city;
	public $province;
	public $lat;
	public $lng;
	public $externalId;
	public $externalUrl;
	public $description;
	public $schedule;
	public $tags;
	public $cost;
	public $likes;
	public $phone;
	
	public function getLocationById() {
		
		echo "Looking for location with ID ". $this->id; 
		
	}


}

?>