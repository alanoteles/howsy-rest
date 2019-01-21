<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Property;
use App\Http\Resources\Property as PropertyResource;
use App\Utilities\GMaps;

class PropertyController extends Controller
{
    /**
     * Get all properties.
     *
     * @params    Request    $request
     * @return    Response
     */
    public function index(Request $request){

    	$properties = Property::orderBy('created_at', 'desc')->paginate(5);
    	
    	return PropertyResource::collection($properties);

    }

    /**
     * Creates a property
     *
     * @param    int $id
     * @return    Response
     */
    public function store(Request $request)
	{
	    $property = $request->isMethod('put') ? Property::findOrFail($request->id) : new Property ;

	    $coordinates = GMaps::geoAddress( 	$request->input('address_1' . ', ' . 'address_2') , 
	    									$request->input('city'), 
	    									$request->input('postcode'));

	    $property->address_1 	= $request->input('address_1');
	    $property->address_2 	= !empty($request->input('address_2')) ? $request->input('address_2') : null ;
	    $property->city 	 	= !empty($request->input('city')) ? $request->input('city') : null ;
	    $property->postcode  	= !empty($request->input('postcode')) ? $request->input('postcode') : null ;
	    $property->latitude		= !empty($coordinates['lat']) ? $coordinates['lat'] : null ;
	    $property->longitude	= !empty($coordinates['lng']) ? $coordinates['lng'] : null ;
	    
	    if($property->save()){
	    	return new PropertyResource($property);
	    }
	}

	/**
     * Get the specified Property.
     *
     * @param    int $id
     * @return    Response
     */
	public function show($id)
	{
	    $property = Property::findOrFail($id);
	    return new PropertyResource($property);
	}


	/**
     * Delete the specified group.
     *
     * @param    int $id
     * @return    Response
     */
	public function destroy($id)
	{
	    $deletePropertyById = Property::findOrFail($id);

	    if($deletePropertyById->delete()){
	    	return new PropertyResource($deletePropertyById);
	    }

	    return response()->json([], 204);
	    
	}
}
