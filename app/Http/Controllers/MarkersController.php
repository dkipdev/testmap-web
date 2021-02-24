<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use App\Models\MarkerCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MarkersController extends Controller
{
    protected $prefix = 'admin.peta.markers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        confLocale();
        $markers = Marker::join('marker_categories', 'markers.id_kategori', '=', 'marker_categories.id')
        ->select('markers.*', 'marker_categories.kategori')
        ->get();

        return view($this->prefix.'index', compact('markers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MarkerCategory::all();
        return view($this->prefix.'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'deskripsi' => 'nullable',
            'alamat' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $marker = Marker::create($request->all());
        if ($marker) {
            return redirect('/markers')->with('success', 'Berhasil menambahkan data marker!');
        } else {
            return redirect('/markers')->with('failed', 'Gagal menambahkan data marker');
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
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'deskripsi' => 'nullable',
            'alamat' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $marker = Marker::findOrfail($id);
        $marker->save($request->all());
        if ($marker) {
            return redirect('/markers')->with('success', 'Berhasil menambahkan data marker!');
        } else {
            return redirect('/markers')->with('failed', 'Gagal menambahkan data marker');
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
        $marker = Marker::findOrFail($id);
        $marker->delete();
        return redirect('markers')->with('success', 'Marker Berhasil Dihapus!');
    }
}
