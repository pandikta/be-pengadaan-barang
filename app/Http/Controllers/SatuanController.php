<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::get();
        if ($satuan->isEmpty()) {
            $response = [
                'message' => 'Tidak ada data'
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'message' => 'Daftar Satuan Barang',
                'data' => $satuan
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
        //validasi data
        $validator = Validator::make($request->all(), [
            'nama_satuan' => ['required']
        ]);

        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //bil validasi berhasil
        try {
            $satuan = Satuan::create($request->all());
            $response = [
                'message' => 'Data Satuan berhasil ditambahkan',
                'data' => $satuan
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
        $satuan = Satuan::findOrFail($id);
        if (is_null($satuan)) {
            $response = [
                'message' => 'Data tidak ditemukan'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Detail Satuan Barang',
                'data' => $satuan
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
        $satuan = Satuan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_satuan' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $satuan->update($request->all());
            $response = [
                'message' => 'Satuan Updated',
                'data' => $satuan
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
        $satuan = Satuan::findOrFail($id);

        try {
            $satuan->delete();
            $response = [
                'message' => 'Satuan Success Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
