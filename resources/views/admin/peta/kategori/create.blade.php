@extends('layout.admin.template')
@section('title', 'Tambah Kategori Marker')
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- form start -->
                    <form method="POST" action="{{ url('kategori') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control" name="nama" id="inputKategori"
                                    placeholder="Masukkan Nama Kategori">
                                @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Icon Marker</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input"
                                            onchange="previewFile(this)">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    
                                </div>
                                @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                <img id="previewIcon" style="max-width:130px;margin-top:20px;">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
<!-- bs-custom-file-input -->
<script src="{{ asset('template/') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection
<script>
    function previewFile(input) {
        var file =$("input[type=file]").get(0).files[0];
        if(file)
            {
                var reader = new FileReader();
                reader.onload = function() {
                    var dataURL = reader.result;
                    var previewIcon = document.getElementById('previewIcon');
                    previewIcon.src = dataURL;
                    // $('#previewIcon').attr("src", reader.result);
                };
                reader.readAsDataURL(file);
            }
    }
 
</script>