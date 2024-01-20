<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KasirController extends Controller
{
    public function index()
    {
        //get all kasirs from Models
        $kasirs = Kasir::latest()->get();

        //return view with data
        return view('kasir.index', compact('kasirs'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required',
            'telp'     => 'required',
            'alamat'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create kasir
        $kasir = kasir::create([
            'nama'     => $request->nama, 
            'email'   => $request->email,
            'telp'     => $request->telp, 
            'alamat'     => $request->alamat 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $kasir  
        ]);
    }

    public function show(Kasir $kasir)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data kasir',
            'data'    => $kasir  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $kasir
     * @return void
     */
    public function update(Request $request, kasir $kasir)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'alamat'     => 'required',
            'telp'     => 'required',
            'email'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create kasir
        $kasir->update([
            'nama'     => $request->nama, 
            'alamat'     => $request->alamat, 
            'telp'     => $request->telp, 
            'email'   => $request->email
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $kasir  
        ]);
    }

    public function destroy($id)
    {
        //delete kasir by ID
        kasir::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data kasir Berhasil Dihapus!.',
        ]); 
    }
}
