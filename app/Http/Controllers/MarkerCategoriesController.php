<?php

namespace App\Http\Controllers;

use App\Models\MarkerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MarkerCategoriesController extends Controller
{
    public $prefix = 'admin.peta.kategori.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        confLocale();
        $categories = MarkerCategory::all();
        return view($this->prefix . 'index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->prefix . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'file' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048'
            ]
        );
        $kategori = $request->nama;
        $image = $request->file('file');
        $imageName = 'marker-' . time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $markerCategory = new MarkerCategory();
        $markerCategory->kategori = $kategori;
        $markerCategory->icon = $imageName;
        $status = $markerCategory->save();

        if ($status) {
            return redirect('/kategori')->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect('/kategori')->with('failed', 'Gagal menambahkan data');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = MarkerCategory::findOrFail($id);
        return view($this->prefix . 'edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'file' => 'image|mimes:jpeg,jpg,png,webp|max:2048'
            ]
        );
        $kategori = $request->nama;

        $markerCategory = MarkerCategory::findOrFail($request->id);

        $image = $request->file('file');

        //hapus gambar sebelumnya
        if (!is_null($image)) {
            $imageName = 'marker-' . time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $image_path = public_path("/images/" . $markerCategory->icon); // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $markerCategory->icon = $imageName;
        }

        $markerCategory->kategori = $kategori;
        $status = $markerCategory->save();

        if ($status) {
            return redirect('/kategori')->with('success', 'Berhasil mengupdate data');
        } else {
            return redirect('/kategori')->with('failed', 'Gagal mengupdate data');
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
        //
        $kategori = MarkerCategory::findOrFail($id);
        $image_path = public_path("/images/" . $kategori->icon);  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $kategori->delete();
        return redirect('kategori')->with('success', 'Data Berhasil Dihapus!');
    }
}
