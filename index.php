<?php

// define the site path constant

$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', $site_path);

$config_path = realpath(dirname($_SERVER['DOCUMENT_ROOT']));
define ('__CONFIG_PATH', $config_path);

// load packages

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
