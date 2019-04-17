<?php

	$location = $_GET["location"]; 
	
	$unsplash_url = 'https://api.unsplash.com/search/photos?query='
					.$location.
					'&per_page=1&client_id=ENTER_PUBLIC_KEY';

	$maps_json = file_get_contents($unsplash_url);
	$maps_array = json_decode($maps_json, true);

	$source = $maps_array['results']['0']['urls']['regular'];
	echo '<img src ="'
		 .$source.
		 '"alt=""/>' ;


	


 ?>
