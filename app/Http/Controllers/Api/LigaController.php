<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liga;
use Validator;

class LigaController extends Controller
{
    public function index()
    {
        $liga = Liga::latest()->get();
        $res = [
            "success" => true,
            "message" => 'Daftar Liga Sepak Bola',
            "data" => $liga,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required|unique:ligas',
            'negara' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try{
            $liga = new liga;
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save(); //required
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di buat',
                'data' => $liga,
            ], 201);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'data tidak ada',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try{
            $liga = Liga::find($id);
            return response()->json([
                'success' => true,
                'message' => 'detail liga',
                'data' => $liga,
            ], 201);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required',
            'negara' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try{
            $liga = Liga::findOrFail($id);
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save(); //required
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di perbarui',
                'data' => $liga,
            ], 201);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    public function destroy($id)
    {
        try{
            $liga = Liga::find($id);
            $liga->delete();
            return response()->json([
                'success' => true,
                'message' => 'data '. $liga->nama_liga . ' berhasil dihapus',
            ], 201);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
}
