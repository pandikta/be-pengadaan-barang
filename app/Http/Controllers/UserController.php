<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        if ($user->isEmpty()) {
            $response = [
                'message' => 'Tidak ada data'
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'message' => 'Daftar user',
                'data' => $user
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
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:6'],
            'no_telp' => ['required'],
            'role' => ['required', 'in:admin,gudang'],
            'foto' => 'required',
            'is_active' => ['required', 'numeric']
        ]);

        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //bil validasi berhasil
        try {
            $user = User::create($request->all());
            $response = [
                'message' => 'Data User berhasil ditambahkan',
                'data' => $user
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
        $user = User::findOrFail($id);
        if (is_null($user)) {
            $response = [
                'message' => 'Data tidak ditemukan'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Detail User',
                'data' => $user
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
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:6'],
            'no_telp' => ['required'],
            'role' => ['required', 'in:admin,gudang'],
            'foto' => 'required',
            'is_active' => ['required', 'numeric']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user->update($request->all());
            $response = [
                'message' => 'User Success Updated',
                'data' => $user
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
        $user = User::findOrFail($id);

        try {
            $user->delete();
            $response = [
                'message' => 'User Success Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
