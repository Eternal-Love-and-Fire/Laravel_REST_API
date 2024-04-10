<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use App\Http\Resources\UserResource;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $page = $request->input('page', 1);

        $users = User::orderBy('registration_timestamp', 'desc')->paginate($count, ['*'], 'page', $page);
        return $this->sendResponse($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|regex:/^\+380[0-9]{9}$/',
            'position_id' => 'required|exists:positions,id',
            'photo' => 'required|image|mimes:jpeg,jpg|max:5120|dimensions:min_width=70,min_height=70',
        ]);

        $validatedData['position'] = Position::where('id', $validatedData['position_id'])->first()->name;
        $validatedData['registration_timestamp'] = now();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
        }

        $user = User::create($validatedData);

        return $this->sendResponse(new UserResource($user), 'User saved in database');
    }

    public function show(Request $request)
    {
        $id = $request->validate([
            'id' => 'required|exists:positions,id',
        ]);

        $user = User::where('id', $id)->first();

        return $this->sendResponse(new UserResource($user), 'User showed perfectly, ye?');
    }
}
