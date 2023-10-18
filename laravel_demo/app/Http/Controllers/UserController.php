<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index() {
        $data = DB::table('users')->select('id', 'name', 'email', 'phone')
                                    ->get();
        return response($data);
    }

    public function get_user_by_id($id) {
        $data = DB::table('users')->where('id', $id)
                                    ->select('id', 'name', 'email', 'phone')
                                    ->get();
        return response($data);
    }

    public function signup(UserRequest $request) {
        // $data = $request->all();
        $validatedData = $request->validated();
        DB::table('users')->insert([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response($validatedData);
    }
}
