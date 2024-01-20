<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PembelisController extends Controller
{
    public function index()
    {
        //get all pembelis from Models
        $pembelis = Pembeli::latest()->get();

        //return view with data
        return view('pembelis.index', compact('pembelis'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required|unique:users',
            'password'   => 'required',
            'alamat'     => 'required',
            'tlp'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return response()->json(['errors' => ['email' => ['Email sudah ada']]], 422);
        }

        $nama = $request->input('nama');
        $email        = $request->input('email');
        $password     = $request->input('password');
        $alamat     = $request->input('alamat');
        $tlp     = $request->input('tlp');

        //create user
        $pembeli = Pembeli::create([
            'nama'     => $nama, 
            'email'   => $email,
            'password'  => Hash::make($password),
            'alamat'     => $alamat, 
            'tlp'     => $tlp, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $pembeli  
        ]);
    }

    public function show(pembeli $pembeli)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data pembeli',
            'data'    => $pembeli  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $pembeli
     * @return void
     */
    public function update(Request $request, pembeli $pembeli)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required|unique:users',
            'password'   => 'required',
            'alamat'     => 'required',
            'tlp'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $nama = $request->input('nama');
        $email        = $request->input('email');
        $password     = $request->input('password');
        $alamat     = $request->input('alamat');
        $tlp     = $request->input('tlp');

        //create pembeli
        $pembeli->update([
            'nama'     => $nama, 
            'email'   => $email,
            'password'  => Hash::make($password),
            'alamat'     => $alamat, 
            'tlp'     => $tlp,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $pembeli  
        ]);
    }

    public function destroy($id)
    {
        //delete pembeli by ID
        pembeli::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data pembeli Berhasil Dihapus!.',
        ]); 
    }
}
