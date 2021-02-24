@extends('layout.admin.template')
@section('title', 'Tambah Marker')
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- form start -->
                    <form method="POST" action="{{ route('markers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Marker</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" id="marker" placeholder="Masukkan Nama Marker">
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori Marker</label>
                                        <select class="form-control @error('id_kategori') is-invalid @enderror"
                                            name="id_kategori">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
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
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" placeholder="Masukkan Nama Marker">
                                @error('alamat')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div id="somecomponent" style="width: 100%; height: 400px;"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text"
                                            class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                            id="ilat" placeholder="Masukkan Latitude">
                                        @error('latitude')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text"
                                            class="form-control @error('longitude') is-invalid @enderror"
                                            name="longitude" id="ilon" placeholder="Masukkan Longitude">
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

@push('styles')
<script type="text/javascript"
    src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDbGgR7Bl-IlAcTeobZwk8fEk0u6sQRkW0'>
</script>
@endpush

@push('scripts')
<script src="{{ asset('template/') }}/plugins/jquery-locationpicker/src/locationpicker.jquery.js"></script>

<script>
    $('#somecomponent').locationpicker({
        location: {
            latitude: {{ (!empty($data->lat))? $data->lat : -0.019572 }},
            longitude: {{ (!empty($data->lon))? $data->lon : 109.339459 }}       
        },
        radius: 100,
        inputBinding: {
            latitudeInput: $('#ilat'),
            longitudeInput: $('#ilon'),
            // locationNameInput: $('#alamat_kost')
        },
        enableAutocomplete: true,
        autocompleteOptions: {
            // types: ['(cities)'],
            componentRestrictions: {country: 'id'}
        }
    });
</script>

@endpush

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