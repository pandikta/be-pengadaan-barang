<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_keluar = Barang_keluar::get();
        if ($barang_keluar->isEmpty()) {
            $response = [
                'message' => 'Tidak ada data'
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'message' => 'Daftar barang_keluar',
                'data' => $barang_keluar
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'barang_id' => ['required'],
            'jumlah_keluar' => ['required', 'numeric'],
            'tgl_keluar' => 'required'
        ]);

        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //bil validasi berhasil
        try {
            $barang_keluar = Barang_keluar::create($request->all());
            $response = [
                'message' => 'Data barang keluar berhasil ditambahkan',
                'data' => $barang_keluar
            ];
            return response()->json($response, 200);
            //nampilkan eror message jika gagal
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang_keluar = Barang_keluar::findOrFail($id);
        if (is_null($barang_keluar)) {
            $response = [
                'message' => 'Data tidak ditemukan'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Detail barang keluar',
                'data' => $barang_keluar
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang_keluar = Barang_keluar::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'barang_id' => ['required'],
            'jumlah_keluar' => ['required', 'numeric'],
            'tgl_keluar' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $barang_keluar->update($request->all());
            $response = [
                'message' => 'Success Updated',
                'data' => $barang_keluar
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang_keluar = Barang_keluar::findOrFail($id);

        try {
            $barang_keluar->delete();
            $response = [
                'message' => 'Success Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
