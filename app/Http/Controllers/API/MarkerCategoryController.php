<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\MarkerCategory;
use Illuminate\Http\Request;

class MarkerCategoryController extends Controller
{
    public function all(Request $request) {
        $id  = $request->input('id');
        if ($id) {
            $kategori = MarkerCategory::find($id);
            if ($kategori) {
                return ResponseFormatter::success(
                    $kategori,
                    'Data kategori marker berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori marker tidak ada',
                    404
                );
            }
        }
        $kategori = MarkerCategory::all();
        return ResponseFormatter::success(
            $kategori,
            'Data list kategori marker berhasil diambil'
        );
    }
}
