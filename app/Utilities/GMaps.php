<?php

namespace App\Utilities;

/**
 * Class to access Google Maps API and return lat/long coordinates.
 */
class GMaps
{
	
	/**
	*  Static method to return lat/long coordinates.
	*/
	public static function geoAddress($address, $city, $postcode){

		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . \
		urlencode( $address . ' ' . $city . ', ' . $postcode ) .'&key=' . env( 'GOOGLE_MAPS_KEY' );

		$client = new \GuzzleHttp\Client();

		$geoResponse = $client->get( $url )->getBody();
		$geoData = json_decode( $geoResponse );

		$coordinates['lat'] = null;
  		$coordinates['lng'] = null;

  		if( !empty( $geoData ) && 
  			$geoData->status != 'ZERO_RESULTS' && 
  			isset($geoData->results) && 
  			isset($geoData->results[0]))
  		{
    		$coordinates['lat'] = $geoData->results[0]->geometry->location->lat;
    		$coordinates['lng'] = $geoData->results[0]->geometry->location->lng;
  		}

	  return $coordinates;

	}
}