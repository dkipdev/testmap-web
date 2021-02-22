@extends('layout.admin.template')
@section('title', 'Markers')
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-outline-primary"><i class="nav-icon fas fa-plus"></i> Tambah
                        Marker</button>
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
                                        <a type="button" class="btn btn-warning"><i class="fas fa-eye"></i> Lihat</a>
                                        <a type="button" class="btn btn-info"><i class="fas fa-edit"></i> Ubah</a>
                                        <a type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                            Delete</a>
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
@endsection