<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name","id"]);
        return response()->json($data);
    }
}
