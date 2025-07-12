<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualController extends Controller
{
    /**
     * Menampilkan daftar penjual (dengan paginasi).
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $penjual = Penjual::orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json($penjual, 200);
    }

    /**
     * Menampilkan satu penjual berdasarkan ID.
     */
    public function show($id)
    {
        $penjual = Penjual::find($id);

        if (!$penjual) {
            return response()->json(['message' => 'Penjual tidak ditemukan'], 404);
        }

        return response()->json($penjual, 200);
    }

    /**
     * Menyimpan data penjual baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penjual = Penjual::create($request->only('nama'));

        return response()->json(['message' => 'Penjual berhasil ditambahkan', 'data' => $penjual], 201);
    }

    /**
     * Mengupdate data penjual berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $penjual = Penjual::find($id);

        if (!$penjual) {
            return response()->json(['message' => 'Penjual tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penjual->update($request->only('nama'));

        return response()->json(['message' => 'Penjual berhasil diupdate', 'data' => $penjual], 200);
    }

    /**
     * Menghapus data penjual berdasarkan ID.
     */
    public function destroy($id)
    {
        $penjual = Penjual::find($id);

        if (!$penjual) {
            return response()->json(['message' => 'Penjual tidak ditemukan'], 404);
        }

        $penjual->delete();

        return response()->json(['message' => 'Penjual berhasil dihapus'], 200);
    }
}
