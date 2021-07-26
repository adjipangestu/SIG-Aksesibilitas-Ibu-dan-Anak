@extends('layouts.frontend.main')
@section('title', 'SIG AKIA')
@push('css')
    <!-- Data Table CSS -->
    <link href="{{ asset('assets/vendors/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')		
		
		<!-- Main Content -->
		<div class="hk-pg-wrapper pt-0">
			<!-- Row -->
			<div class="row">
				<div class="col-xl-12">					
					<!-- Utilities Sec -->
					<section class="hk-landing-sec pb-35">
						<div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="asal"><strong>Jenis Fasilitas Kesehatan</strong></label>
                                                <select class="form-control" name="jenis_faskes" id="jenis_faskes">
                                                    <option value="">Semua Fasilitas Kesehatan</option>
                                                    @foreach($jenis_faskes as $item)
                                                        <option value="{{ $item->id_jenis_faskes }}">{{ $item->jenis_faskes }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="tujuan"><strong>Jam Buka</strong></label>
                                                <select class="form-control" name="jam_buka" id="jam_buka">
                                                    <option value="">Semua Jam Buka</option>
                                                    @foreach($jam_buka as $item)
                                                        <option value="{{ $item->id_jam_buka }}">{{ $item->jam_buka }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
						</div>
					</section>
					<!-- /Utilities Sec -->
				
					
					<!-- Adv Sec -->
					<section class="hk-landing-sec bg-white">
						<div class="container">
                            <table id="data_faskes" class="table table-hover w-100 display">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Faskes</th>
                                        <th>Lama Jam Buka</th>
                                        <th>No. Telp</th>
                                        <th>Jenis Faskes</th>
                                        <th>Tipe RS</th>
                                        <th>Tahun Terbit</th>
                                        <th>Alamat</th>
                                        <th>Kelurahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
						</div>
					</section>
					<!-- /Adv Sec -->
				</div>
			</div>
			<!-- /Row -->
            
			<!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Pampered by<a href="https://hencework.com/" class="text-dark" target="_blank">Hencework</a> © 2019</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
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
    <!-- Kolom Aksi pada Data Faskes -->
    <script>
        $(document).ready(function() {
            $('#data_faskes').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('faskes.list') }}",
                    type: 'GET',
                    data: function (d) {
                        d.jenis_faskes = $('#jenis_faskes').val();
                        d.jam_buka = $('#jam_buka').val();
                    },

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
                ]
            });
        });

        $('#jenis_faskes').change(function(){
            $('#data_faskes').DataTable().draw();
        });

        $('#jam_buka').change(function(){
            $('#data_faskes').DataTable().draw();
        });
    </script>
@endpush