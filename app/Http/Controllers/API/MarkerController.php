<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $category = $request->input('category');

        if ($id) {
            $marker = Marker::find($id);
            if ($marker) {
                return ResponseFormatter::success(
                    $marker,
                    'Data marker berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data marker tidak ada',
                    404
                );
            }
        }

        if ($name || $category) {
            $marker = Marker::query();
            if ($category) {
                $marker->where('id_kategori', $category);
            }
    
            return ResponseFormatter::success(
                $marker->paginate($limit),
                'Beberapa list marker berhasil diambil'
            );
        } else {
            $marker = Marker::with('details')->get();
            return ResponseFormatter::success(
                $marker,
                'Data list marker berhasil diambil'
            );
        }
    }
}
