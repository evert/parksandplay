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

        $record = $stmt->fetch(\PDO::FETCH_ASSOC);

        // add some other handy version of the name

        $record['shortname'] = str_replace(' ', '', $record['name']);
        $urlName = str_replace(' ', '-', $record['name']);
        $record['urlName'] = str_replace('.', '', $record['urlName']);

        $record['amenities'] = array();

        foreach($record as $key=>$value) {

            // if a field starts with 'has'
            if (substr($key, 0, 3) === 'has') {

                // if that field has a value of one, let's grab that amenity name
                if ($value) {
                    $record['aminities'][] = substr($key,3);
                }

                // Removing the original hasX item from the array
                unset($record[$key]);

            }

        }

        return $record;

    }


    public function getLocationsByAmenity($amenity) {

        $info = 'A list of locations that have '. $amenity;

        return $info;

    }


}

?>
