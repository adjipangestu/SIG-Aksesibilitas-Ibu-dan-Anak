@extends('layouts.main')
@section('title', 'Data Faskes')

@push('css')
    <!-- Data Table CSS -->
    <link href="{{ asset('assets/vendors/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Data Fasilitas Kesehatan</h4>
        </div>
        <!-- /Title -->

        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title"><a href="{{ route('admin.faskes.add') }}" class="btn btn-primary">Tambah Data</a></h5>
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <table id="data_faskes" class="table table-hover w-100 display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Fasilitas Kesehatan</th>
                                    <th>Lama Jam Buka</th>
                                    <th>No. Telp</th>
                                    <th>Jenis Fasilitas Kesehatan</th>
                                    <th>Tipe RS</th>
                                    <th>Tahun Terbit</th>
                                    <th>Alamat</th>
                                    <th>Kelurahan</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('js')
    <!-- Data Table JavaScript -->
    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/dataTables-data.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#data_faskes').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                language: { 
                    search: "",
                    searchPlaceholder: "Cari",
                    sLengthMenu: "_MENU_items"
                },
                "bPaginate": true,
                "info":  true,
                "bFilter":  true,
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
                ajax:{
                    url: "{{ route('admin.faskes.list') }}",
                    type: 'GET',
                },
                columns: [
                    { data: 'DT_RowIndex', name:'DT_RowIndex' },
                    { data: 'nama_faskes', name:'nama_faskes' },
                    { data: 'jam_buka', name: 'jam_buka' },
                    { data: 'telp', name: 'telp' },
                    { data: 'jenis_faskes', name: 'jenis_faskes' },
                    { data: 'tipe', name: 'tipe' },
                    { data: 'tahun', name: 'tahun' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'nama_kelurahan', name: 'nama_kelurahan' },
                    { data: 'latitude', name: 'latitude' },
                    { data: 'longitude', name: 'longitude' },
                    { data: 'action', name: 'action' },
                ]
            });
        } );
    </script>
@endpush