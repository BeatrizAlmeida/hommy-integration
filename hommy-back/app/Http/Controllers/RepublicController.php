<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RepublicRequest;
use App\Republic;
use App\User;
use App\Room;
use App\UserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Republics as RepublicResource;

class RepublicController extends Controller

{
    public function createRepublic(RepublicRequest $request) {
        $republic = new Republic;
        $republic->createRepublic($request);
        return response()->json($republic);
    }

    public function showRepublic($id){
        $republic = Republic::findOrFail($id);
        return response()->json( new RepublicResource($republic));   
    }

    public function listRepublic(Request $request){
        $republic = Republic::query();
        if ($request->name)
            $republic->where('name','LIKE','%'.$request->name.'%');
        if ($request->address)
            $republic->where('address','LIKE','%'.$request->address.'%');
        if($request->comments){
            $republic = Republic::has('comments','>=',$request->comments);
        }
        $search = $republic->get();
        $ids=$search->pluck('id');
        $paginator=Republic::wherein('id',$ids)->paginate(3);
        $republics= RepublicResource::collection($paginator);
        $last = $republics->lastPage();
        return response()->json([$paginator,$last] );
    }

    public function softdeletedRepublics(Request $request){
        $result = Republic::withTrashed()->get();
        return response()->json($result);
    }

    public function updateRepublic(Request $request, $id){
        $republic = Republic::findOrFail($id);
        if($request->name){
            $republic->name = $request->name;
        }

        if($request->address){
            $republic->address = $request->address;
        }

        if($request->city){
            $republic->city = $request->city;
        }
        
        if($request->district){
            $republic->district = $request->district;
        }

        if($request->description){
            $republic->description = $request->description;
        }

        if($request->user_id){
            $republic->user_id = $request->user_id;
        }

        if($request->photo){
            Storage::delete('localPhotos/'. $republic->photo);
            $image=base64_decode($request->photo);
            $filename=uniqid();
            $path=storage_path('/app/localPhotos/'.$filename);
            file_put_contents($path,$image);
            $republic->photo=$path;
        }

        $republic->save();
        return response()->json($republic);
    }


    public function deleteRepublic($id){
        Republic::destroy($id);
        return response()->json(['A república foi deletada com sucesso.']);
    }
    
    public function showOwner($id){
        $republic = Republic::findOrFail($id);
        $user = User::findOrFail($republic->user_id);
        return response()->json($user);
    }

    public function addUser($id, $republic_id)  {
        $user = User::findOrFail($id);
        $republic = Republic::findOrFail($republic_id);
        $republic->user_id = $id;
        $republic->save();
        return response()->json($republic);
    }

    public function removeUser($republic_id) {
        $republic = Republic::findOrFail($republic_id);
        $republic->user_id = NULL;
        $republic->save();
        return response()->json($republic);
    }

    public function getRepublicByName($republicName) {
       return $republic = Republic::where('name', $republicName)->get();
    }

    public function editRepublicByID($republic_id, Request $request) {
        $republic = Republic::findOrFail($republic_id);
        $republic->address = $request->address;
        $republic->save();
        return response()->json($republic);         
    }

    public function locatario($id){
        $republic = Republic::findOrFail($id);
        $locatarios = $republic->userLocatario->get();
        return response()->json($locatarios);
    }

    public function locador($id){
        $republic = Republic::findOrFail($id);
        return response()->json($republic->user);
    }

    public function retornarUsuarios($id){
        $republic = Republic::findOrFail($id);
        return response()->json($republic->users);
    }


}

