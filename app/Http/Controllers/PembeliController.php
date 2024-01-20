<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class PembeliController extends Controller
{
    public function index()
    {
        //get all users from Models
        $users = User::latest()->get();

        //return view with data
        return view('pembeli.index', compact('users'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'   => 'required|unique:users',
            'password'   => 'required',
            'alamat'     => 'required',
            'nohp'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return response()->json(['errors' => ['email' => ['Email sudah ada']]], 422);
        }

        $name = $request->input('name');
        $email        = $request->input('email');
        $password     = $request->input('password');
        $alamat     = $request->input('alamat');
        $nohp     = $request->input('nohp');

        //create user
        $user = User::create([
            'name'     => $name, 
            'email'   => $email,
            'password'  => Hash::make($password),
            'alamat'     => $alamat, 
            'nohp'     => $nohp, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $user  
        ]);
    }

    public function show(User $user)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data user',
            'data'    => $user  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'   => 'required',
            'alamat'     => 'required',
            'nohp'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user->update([
            'name'     => $request->name, 
            'email'   => $request->email,
            'alamat'     => $request->alamat, 
            'nohp'     => $request->nohp, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $user  
        ]);
    }

    public function destroy($id)
    {
        //delete user by ID
        User::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data user Berhasil Dihapus!.',
        ]); 
    }
}
