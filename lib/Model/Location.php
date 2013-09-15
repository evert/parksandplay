<?php

namespace Model;

class Location {
	
	public function getLocationById($id) {
		
		// create mysqli object
		
		include(__CONFIG_PATH.'/config.php');
		
		$mysqli = new \mysqli($host, $user, $pass, $db);
		
		// check for connection errors
		
		if (mysqli_connect_errno()) {
			
		    die("Unable to connect!");
		
		} else {
		
			$query = "SELECT * FROM `locations` WHERE id = " . $id;
		
			$result = $mysqli->query($query);
			
			if (!$result) {
				
				die("Invalid query: " . $mysqli->error);
			
			} else {
			
				$i = 0; //for iterating the amenities array
		
				/* fetch object array */
				while ($obj = $result->fetch_object()) {
				
					while ($finfo = $result->fetch_field()) {
				
				        $amenityName = $finfo->name;
				                
				        if (substr($amenityName, 0, 3) == "has") {
				        
				        	if ($obj->$amenityName == 1) {
					        	
					        	$amenitiesDb[$i] = $amenityName; //as stored in DB
					    	    
					    	    //strip 'has' off field name
				        	
								$name = substr($name, 3);
								
								//turn camel case into separate words
								
								$pattern = '/(.*?[a-z]{1})([A-Z]{1}.*?)/';
								$replace = '${1} ${2}'; 
								
								$amenity = preg_replace($pattern, $replace, $name);
								
								$amenities[$i] = $amenity;

					    	    $i++;
					        	
				        	}
					        
				        }
				    
				    }
		
					// TODO: build a location object to pass around instead of a bunch of vars
		
					$id = $obj->id;
					$name = $obj->name;
					$address = $obj->address;
					$city = $obj->city;
					$province = $obj->province;
					$lat = $obj->lat;
					$lng = $obj->lng;
					$externalId = $obj->externalId;
					$externalUrl = $obj->externalUrl;
					$description = $obj->description;
					$schedule = $obj->schedule;
					$tags = $obj->tags;
					$cost = $obj->cost;
					$likes = $obj->recommended;
					$schedule = $obj->schedule;
					$phone = $obj->phone;
					
				}
			
			/* free result set */
			$result->close();	
			
			}
		
			// close connection
			
			// pretty up some other useful vars
			
			$shortname = str_replace(' ', '', $name);
			$urlName = str_replace(' ', '-', $name); 
			$urlName = str_replace('.', '', $urlName);
		
			$mysqli->close();
		
		}
		
		return $name;	
		
	}

	
	public function getLocationsByAmenity($amenity) {
		
		$info = 'A list of locations that have '. $amenity;
		
		return $info;
		
	}


}

?>