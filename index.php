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
    
    $location = new Model\Location();
    
    $locationInfo = $location->getLocationById($id);
  
    print_r($locationInfo);
    
});

$app->get('/location', function () use ($app) {
    
    $location = new Model\Location($app);
    
    $amenity = $_GET['amenity'];
    
    $locations = $location->getLocationsByAmenity($amenity);
    
    echo $locations;
    
});

$app->run();

?>
