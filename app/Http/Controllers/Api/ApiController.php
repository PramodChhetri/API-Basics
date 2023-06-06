<?php

namespace App\Http\Controllers\Api;

use App\Models\Club;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Create API --POST Request Type
    public function createClub(Request $request){

        $data = $request->validate([
            "clubname" => "required",
            "clubtype" => "required",
            "clubaddress" => "required",
            "clubcontact" => "required",
            "clubfee" => "required"
        ]);

        Club::create($data);

        return response()->json([
            "status" => 1,
            "message" => "Club Created Successfully!"
        ]);

    }

    // List API --GET Request Type
    public function listClubs(){
        $clubs = Club::select('clubname','clubtype','clubaddress','clubfee')->get();

        return response()->json([
            "status" => 1,
            "message" => "Listing All Clubs",
            "data" => $clubs
        ], 200);
    }

    // Single Detail API --GET Request Type
    public function getSingleClub($id){
        if(Club::where("id", $id)->exists()){
            $club = Club::where("id", $id)->first();

            return response()->json([
                "status" => 1,
                "message" => "Club Detail",
                "data" => $club
            ]);

        }else{
            return response()->json([
                "status" => 0,
                "message" => "Club Not Found"
            ], 404);
        }

    }

    // Update API --PATCH Request Type
    public function updateClub(Request $request, $id){
        if(Club::where("id", $id)->exists()){
            $club = Club::find($id);

            $club->clubname = !empty($request->clubname) ? $request->clubname : $club->clubname;
            $club->clubtype = !empty($request->clubtype) ? $request->clubtypee : $club->clubtype;
            $club->clubaddress = !empty($request->clubaddress) ? $request->clubaddress : $club->clubaddress;
            $club->clubcontact = !empty($request->clubcontact) ? $request->clubcontact : $club->clubcontact;
            $club->clubfee = !empty($request->clubfee) ? $request->clubfee : $club->clubfee;
            $club->save();

            return response()->json([
                "status" => 1,
                "message" => "Club Updated Successfully"
            ]);

        }else{
            return response()->json([
                "status" => 0,
                "message" => "Club Not Found"
            ], 404);
        }
    }

    // Delete API --DELETE Request Type
    public function deleteClub($id){
        if(Club::where("id", $id)->exists()){
            $club = Club::find($id);

            $club->delete();

            return response()->json([
                "status" => 1,
                "message" => "Club Deleted Successfully"
            ]);

        }else{
            return response()->json([
                "status" => 0,
                "message" => "Club Not Found"
            ], 404);
        }

        
    }
}
