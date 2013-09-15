<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/location/:id', function ($id) {
    
    include 'lib/Model/Location.php';
    
    $location = new Model\Location();
    
    $locationInfo = $location->getLocationById($id);
   
    echo $locationInfo;
    
});

$app->get('/location', function () {
    
    include 'lib/Model/Location.php';
    
    $location = new Model\Location();
    
    $amenity = $_GET['amenity'];
    
    $locations = $location->getLocationsByAmenity($amenity);
    
    echo $locations;
    
});

$app->run();

?>
