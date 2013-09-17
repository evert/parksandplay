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
				
				$obj = $result->fetch_object();
				
				// add some other handy version of the name
				
				$obj->shortname = str_replace(' ', '', $obj->name);
				$urlName = str_replace(' ', '-', $obj->name);
				$obj->urlName = str_replace('.', '', $urlName);
				
				// create array of amenities
				
				$i = 0;
				
				while ($finfo = $result->fetch_field()) {
			
			        $amenityName = $finfo->name;
			                
			        // if a field starts with 'has'        
			                
			        if (substr($amenityName, 0, 3) == "has") {
			        
			        	// if that field has a value of one, let's grab that amenity name
			        	
			        	if ($obj->$amenityName == 1) {
				        	
				        	// strip 'has' off field name
			        	
							$amenityName = substr($amenityName, 3);
														
							// turn camel case into separate words
							
							$pattern = '/(.*?[a-z]{1})([A-Z]{1}.*?)/';
							$replace = '${1} ${2}'; 
							$amenity = preg_replace($pattern, $replace, $amenityName);
			
							// add the amenity to a handy array
				        
				    	    $amenities[$i] = $amenity;
				    	    
				    	    $i++;
				    	    
			        	}
				        
			        }
			    
			    }
				
				// add the amenity array to the object
				
				$obj->amenities = $amenities;
				
				$json = json_encode($obj);
					
				/* free result set */
				$result->close();	
			
			}
		
			// close connection
			
			$mysqli->close();
		
		}
		
		return $json;	
		
	}

	
	public function getLocationsByAmenity($amenity) {
		
		$info = 'A list of locations that have '. $amenity;
		
		return $info;
		
	}


}

?>