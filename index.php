<?php

// define the site path constant

$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', $site_path);

$config_path = realpath(dirname($_SERVER['DOCUMENT_ROOT']));
define ('__CONFIG_PATH', $config_path);

// load packages

require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->config = include __DIR__ . '/config/config.php';

// Setting up the database.
$app->db = new PDO(
    'mysql:host=' . $app->config['db.host'] . ';dbname=' . $app->config['db.db'],
    $app->config['db.user'],
    $app->config['db.pass']
);

// Automatically throwing errors when a mistake was made.
$app->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Database

$app->get('/location/:id', function ($id) use ($app) {
    
    $location = new Model\Location($app);
    
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
