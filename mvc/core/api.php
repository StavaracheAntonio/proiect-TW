<?php

require_once("apiCache.php");


class teleportApi
{

    public function getImage($href)
    {
        $url =  $href;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);

        $decoded = json_decode($res, true);


        return $decoded['photos'][0]['image']['web'];
    }

    public function getDescription($href)
    {
        $url =  $href;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);

        $decoded = json_decode($res, true);


        return $decoded['summary'];
    }

    public function getTeleportHref($location)
    {
        $url =  'https://api.teleport.org/api/cities/?search=' . $location;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);

        $decoded = json_decode($res, true);

        if (array_key_exists('0', $decoded['_embedded']['city:search-results'])) {
            return $decoded['_embedded']['city:search-results'][0]['_links']['city:item']['href'];
        } else {
            return null;
        }
    }

    public function bkupImage($location)
    {
        $key = "f51b34016a13bc74fff52659421b59d0b0955a3b6ba1144b5da8b036c1474d29";
        $unsplash_url = 'https://api.unsplash.com/search/photos?query=' . $location . '&per_page=1&client_id=' . $key;
        $maps_json = file_get_contents($unsplash_url);
        $maps_array = json_decode($maps_json, true);
        if (array_key_exists('0',  $maps_array['results'])) {
            $source = $maps_array['results']['0']['urls']['regular'];
            return $source;
        }
        return null;
    }

    public function bkupDescription($location)
    {

        $url = "https://en.wikipedia.org/w/api.php?action=opensearch&search=" . $location . "&limit=1&namespace=0&format=json";

        $maps_json = file_get_contents($url);
        $maps_array = json_decode($maps_json, true);

        return $maps_array[2][0];
    }

    public function getTeleportUrbanHref($location)
    {
        $telHref = $this->getTeleportHref($location);
        if ($telHref == null) {
            return null;
        }

        $url =  $telHref;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);

        $decoded = json_decode($res, true);

        if (array_key_exists('city:urban_area',  $decoded['_links'])) {
            return $decoded['_links']['city:urban_area']['href'];
        } else {
            return null;
        }
    }

    public function getTeleportInfo($location)
    {
        $element = array('name' => ' ', 'image' => ' ', 'description' => ' ');

        $urbRef = $this->getTeleportUrbanHref($location);
        if ($urbRef == null) {

            return null;

            $element['name'] = $location;

            $element['image'] = $this->bkupImage($location);
            $element['description'] = $this->bkupDescription($location);

            if ($element['image'] != null)
                return $element;
            return null;
        }

        $image = $this->getImage($urbRef . 'images/');
        $description = $this->getDescription($urbRef . 'scores/');

        $element['name'] = $location;
        $element['image'] = $image;
        $element['description'] = $description;

        return $element;
    }
}


class MyApi
{

    public function getByCategory($category)
    {
        $url = 'https://api.skypicker.com/locations?type=hashtag&hashtag=' . $category . '&locale=en-US&limit=50&active_only=true';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);


        $decoded = json_decode($res, true);

        $result = array();
        $cities = array();

        $apiTel = new teleportApi();

        foreach ($decoded['locations'] as $location) {
            if (array_key_exists('city', $location)) {

                if (in_array($location['city']['name'], $cities) == false) {

                    $cityName = str_replace(' ', '%20', $location['city']['name']);
                    $element = array('name' => ' ', 'image' => ' ', 'description' => ' ');
                    $hm = new HomeModel();
                    $dbCity = $hm->getCitiesByName($location['city']['name']);
                    if ($dbCity == null) {


                        $element = $apiTel->getTeleportInfo($cityName);
                        if ($element['image'] != null) {
                            $element['name'] = $location['city']['name'];
                            if ($element['image'] != null)
                                array_push($result, $element);
                        }

                        //echo $element['name'].$element['description'].$element['image'];


                        $hm->insertCity($location['city']['name'], $element['description'], $element['image']);
                    } else {
                        $element = $dbCity;
                        if ($element[0]['image'] != null)
                            array_push($result, $element[0]);
                    }
                    array_push($cities, $location['city']['name']);
                }
            }
        }
        //header("Content-type: application/json");
        //$result = json_encode($result[0]);
        //echo "<PRE>";
        //echo $result;
        //print_r($result);

        return $result;
    }

    public function getIDByName($name)
    {
        $url = 'https://api.skypicker.com/locations?term=' . $name . '&locale=en-US&location_types=airport&limit=5&active_only=true&sort=name';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

        $res = curl_exec($c);

        //echo $res;
        curl_close($c);
        $decoded = json_decode($res, true);

        return $decoded['locations'][0]['city']['id'];
    }

    public function getCountryOfCity($name)
    {
        $url = 'https://api.skypicker.com/locations?term=' . $name . '&locale=en-US&location_types=airport&limit=5&active_only=true&sort=name';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);
        $decoded = json_decode($res, true);

        return $decoded['locations'][0]['city']['country']['name'];
    }

    public function flightsFromAtoB($name1, $name2, $city1, $city2, $departDate, $budgetMin, $budgetMax, $duration)
    {
        $date = new DateTime($departDate);
        $departDate = $date->format('d/m/Y');

        $url = 'https://api.skypicker.com/flights?fly_from=' . $city1 . '&fly_to=' . $city2 . '&dateFrom=' . $departDate . '&dateTo=' . $departDate . '&max_fly_duration=' . $duration . '&curr=USD&price_from=' . $budgetMin . '&price_to=' . $budgetMax . '&limit=10&partner=picky';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);

        $decoded = json_decode($res);
        $tz = date_default_timezone_get();
        date_default_timezone_set('UTC');

        $result = array();
        $element = array('fromid' => ' ', 'toid' => ' ', 'from' => ' ', 'to' => ' ', 'departHour' => ' ', 'duration' => ' ', 'arriveHour' => ' ', 'price' => ' ');
        $element['from'] = $name1;
        $element['to'] = $name2;

        //print_r( $decoded);


        foreach ($decoded->data as $data) {

            $element['departHour'] = date("d M H:i", $data->dTime);
            $element['duration'] = $data->fly_duration;
            $element['arriveHour'] = date("d M H:i", $data->aTime);
            $element['price'] = $data->price;
            $element['fromid'] = $data->flyFrom;
            $element['toid'] = $data->flyTo;

            array_push($result, $element);

            /*echo '<p>' . $data->cityFrom .' ' . date("H:i",$data->dTime). ' -> '.$data->cityTo.' '. date("H:i",$data->aTime).' durata zbor: ' .$data->fly_duration.' pret: '. $data->price. '</p>';*/
        }
        return $result;
    }

    public function flightsBetweenTwoCities($city1, $city2, $departDate, $arriveDate, $budgetMin, $budgetMax, $duration)
    {
        $sCity1 = $city1;
        $sCity2 = $city2;

        $city1 = $this->getIDByName($city1);
        $city2 = $this->getIDByName($city2);

        $result = array(
            'from' => $this->flightsFromAtoB($sCity1, $sCity2, $city1, $city2, $departDate, $budgetMin, $budgetMax, $duration),
            'to' => $this->flightsFromAtoB($sCity2, $sCity1, $city2, $city1, $arriveDate, $budgetMin, $budgetMax, $duration)
        );

        return $result;
    }
}

class InfoApi
{

    public function getWeather($city)
    {
        $element = array('location' => ' ', 'description' => ' ', 'image' => ' ', 'temperature' => array('value' => ' ', 'icon' => ' ', 'description' => ' '),  'currency' => array('name' => ' ', 'symbol' => ' '), 'language' => ' ');

        $url = 'api.openweathermap.org/data/2.5/weather?q=' . $city . '&units=metric&appid=d00c7aecc7b75459729d61b58e842e7a';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);
        $decoded = json_decode($res, true);


        $element["temperature"]["value"] = $decoded["main"]["temp"];
        $element["temperature"]["icon"] = 'http://openweathermap.org/img/w/' . $decoded["weather"][0]["icon"] . '.png';
        $element["temperature"]["description"] = $decoded["weather"][0]["description"];

        //print_r ( $element);

        return $element;
    }

    public function getDestInfo($city)
    {
        $result = $this->getWeather($city);

        $kiApi = new MyApi();
        $country = $kiApi->getCountryOfCity($city);

        $url = 'https://restcountries.eu/rest/v2/name/' . $country;

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($c);
        curl_close($c);
        $decoded = json_decode($res, true);

        //currName' => ' ', 'currSymbol' => ' ', 'Language
        $result['currency']['name'] = $decoded[0]['currencies'][0]['name'];
        $result['currency']['symbol'] = $decoded[0]['currencies'][0]['symbol'];
        $result['language'] = $decoded[0]['languages'][0]['name'];

        $telApi = new teleportApi();
        $e = $telApi->getTeleportInfo($city);

        $result['location'] = str_replace('%20', ' ', $city);
        $result['description'] = $e['description'];
        $result['image'] = $e['image'];

        //echo json_encode($result);

        //$kiApi -> 

        return $result;
    }
}
