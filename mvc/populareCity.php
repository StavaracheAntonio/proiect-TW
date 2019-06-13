<?php


require_once("core/api.php");

set_time_limit(2000);

$categories = array("beach", "family%20fun", "sightseeing&culture", "nightlife", "events", "sports", "romance", "nature");
$apiInstance = new MyApi();


foreach ($categories as $category) {
    $apiInstance->getByCategory($category);
}
