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
        $marker = Marker::findOrFail($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marker = Marker::findOrFail($id);
        $categories = MarkerCategory::all();
        return view($this->prefix.'edit', compact('marker', 'categories'));
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
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'deskripsi' => 'nullable',
            'alamat' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $marker = Marker::findOrfail($request->id);
        $marker->nama = $request->nama;
        $marker->id_kategori = $request->id_kategori;
        $marker->deskripsi = $request->deskripsi;
        $marker->alamat = $request->alamat;
        $marker->latitude = $request->latitude;
        $marker->longitude = $request->longitude;
        $marker->save();
        if ($marker) {
            return redirect('/markers')->with('success', 'Berhasil mengupdate data marker!');
        } else {
            return redirect('/markers')->with('failed', 'Gagal mengupdate data marker');
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
