<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/location/:id', function ($id) {
    
    include 'lib/Model/Location.php';
    
    $location = new Model\Location();
    
    $locationId = $location->getLocationById(1);
    
    echo $locationId;
    
});

$app->run();

?>
