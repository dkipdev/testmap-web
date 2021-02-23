@extends('layout.admin.template')
@section('title', 'Tambah Marker')
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- form start -->
                    <form method="POST" action="{{ url('markers') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Marker</label>
                                        <input type="text" class="form-control" name="nama" id="marker"
                                            placeholder="Masukkan Nama Marker">
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori Marker</label>
                                        <select class="form-control" name="kategori">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi"></textarea>
                                @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    placeholder="Masukkan Nama Marker">
                                @error('alamat')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude"
                                            placeholder="Masukkan Latitude">
                                        @error('latitude')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude"
                                            placeholder="Masukkan Longitude">
                                        @error('longitude')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('/markers') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('script')
<!-- Summernote -->
<script src="{{ asset('template/') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
    // Summernote
    $('#deskripsi').summernote()

  })
</script>
@endsection