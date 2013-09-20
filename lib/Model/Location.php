<?php

namespace Model;

class Location {

    protected $app;

    public function __construct(\Slim\Slim $app) {

        $this->app = $app;

    }

    public function getLocationById($id) {

        $query = "SELECT * FROM `locations` WHERE id = ?";
        $stmt = $this->app->db->prepare($query);
        $stmt->execute(array($id));

        $obj = $stmt->fetch(\PDO::FETCH_OBJ);

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

        return $obj;

    }


    public function getLocationsByAmenity($amenity) {

        $info = 'A list of locations that have '. $amenity;

        return $info;

    }


}

?>
