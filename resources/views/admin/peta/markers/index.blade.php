@extends('layout.admin.template')
@section('title', 'Markers')
@section('body')

<!-- Delete Model -->
<form action="" method="POST" class="remove-record-model">
    @method('delete')
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-hapus">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                        data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Delete Model -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('markers/create') }}" class="btn btn-outline-primary"><i class="nav-icon fas fa-plus"></i> Tambah
                        Marker</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th align="center">Kategori</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Last Modified</th>
                                <th align="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($markers as $marker)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $marker->nama }}</td>
                                <td align="center">
                                    <div class="badge bg-primary">{{ $marker->kategori }}</div>
                                </td>
                                <td>{{ $marker->latitude }}</td>
                                <td>{{ $marker->longitude }}</td>
                                <td>{{ $marker->updated_at->isoFormat('dddd, D MMMM Y') }}</td>
                                <td align="center">
                                    <div class="btn-group" role="group" aria-label="aksi">
                                        <a type="button" class="btn btn-sm btn-warning text-white"><i class="fas fa-eye"></i> Lihat</a>
                                        <a href="{{ url('markers/'.$marker->id.'/edit') }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Ubah</a>
                                        <a class="btn btn-danger btn-sm waves-effect waves-light remove-record"
                                            data-toggle="modal"
                                            data-url="{!! URL::route('markers.delete', $marker->id) !!}"
                                            data-id="{{$marker->id}}" data-target="#custom-width-modal">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Last Modified</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
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

<!-- DataTables  & Plugins -->
<script src="{{ asset('template/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('template/') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('template/') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('template/') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('template/') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", {
            exportOptions: {
            columns: 'th:not(:last-child)'
         }
        }]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
<script>
    $(document).ready(function(){
        // For A Delete Record Popup
        $('.remove-record').click(function() {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            $(".remove-record-model").attr("action",url);
            $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        });

        $('.remove-data-from-delete-form').click(function() {
            $('body').find('.remove-record-model').find( "input" ).remove();
        });
        $('.modal').click(function() {
            // $('body').find('.remove-record-model').find( "input" ).remove();
        });
    });
</script>
<!-- Toastr -->
@if (Session::has('success'))
<script>
    toastr.success('{!! Session::get('success') !!}');
</script>
@endif
@endsection