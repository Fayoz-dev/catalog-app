<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     

    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $req->validate([
            'name'=>['required'],
            'surname'=>['required'],
            'email'=>['email','unique:users,email']
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->surname = $req->surname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->save();

        return response()->json(new UserResource($user),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::find($user);
        if($user){
            return response()->json(new UserResource($user),200);
        }
        return response()->json("Not found user !",404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $user)
    {
        $user = User::find($user);
        if($user){
            $req->validate([
                'name'=>['required'],
                'surname'=>['required'],
                'email'=>['email','unique:users,email']
            ]);

            $user->name = $req->name;
            $user->surname = $req->surname;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->save();
    
            return response()->json(new UserResource($user),200);
        }
        return response()->json("Not found user for update",200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        if($user){
            $user->delete();
            return response()->json("deleted success");
        }

    }
}
