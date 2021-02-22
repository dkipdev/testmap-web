<?php

namespace App\Http\Controllers;

use App\Models\MarkerCategory;
use Illuminate\Http\Request;

class MarkerCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        confLocale();
        $categories = MarkerCategory::all();
        return view('admin.peta.kategori.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.peta.kategori.create');
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
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $markerCategory = new MarkerCategory();
        $markerCategory->kategori = $kategori;
        $markerCategory->icon = $imageName;
        $status = $markerCategory->save();
        
        if($status) {
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
        return view('admin.peta');
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
        //
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
        $kategori->delete();
        return redirect('kategori')->with('success', 'Data Berhasil Dihapus!');
    }
}
