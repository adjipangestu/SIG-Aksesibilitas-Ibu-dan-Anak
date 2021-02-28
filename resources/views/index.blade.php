@extends('layouts.frontend.main')
@section('title', 'SIG AKIA')
@section('content')		
		
		<!-- Main Content -->
		<div class="hk-pg-wrapper pt-0">
			<!-- Row -->
			<div class="row">
				<div class="col-xl-12">					
					<!-- Utilities Sec -->
					<section class="hk-landing-sec pb-35">
						<div class="container">
							<h2 class="text-center">Selamat Datang di SIG Aksesibilitas Ibu dan Anak</h2>
							<p class="text-center mt-4">SIG Aksesibilitas Ibu dan Anak merupakan sistem informasi berbasis geografis yang menampilkan persebaran dan indeks aksesibilitas fasilitas kesehatan ibu dan anak yang berada di wilayah kota Bandarlampung. Terdapat beberapa jenis fasilitas kesehatan diantaranya sebga berikut ini</p>
							<div class="row mt-50">
								@foreach($jenis_faskes as $item)
								<div class="col-lg-6 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-primary mr-15"><i data-feather="check-circle"></i></span>
											{{ $item->jenis_faskes }}
										</span>
									</h5>
								</div>
								@endforeach
							</div>
						</div>
					</section>
					<!-- /Utilities Sec -->
					<section id="pages_sec" class="hk-landing-sec bg-white pb-65">
						<div class="container">
							<h2 class="text-center">Peta Aksesibilitas Ibu dan Anak</h2>
							<div class="row mt-50">
                                <div class="col-sm">
									<div class="row">
										<div class="col-md-4 form-group">
											<select class="form-control" name="jenis_faskes" id="jenis_faskes">
												<option value="">Semua Fasilitas Kesehatan</option>
												@foreach($jenis_faskes as $item)
													<option value="{{ $item->id_jenis_faskes }}" @if( Request::input('jenis_faskes') == $item->id_jenis_faskes) selected @endif>{{ $item->jenis_faskes }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-4 form-group">
											<select class="form-control" name="jam_buka" id="jam_buka">
												<option value="">Semua Jam Buka</option>
												@foreach($jam_buka as $item)
													<option value="{{ $item->id_jam_buka }}" @if( Request::input('jam_buka') == $item->id_jam_buka) selected @endif>{{ $item->jam_buka }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-4 form-group">
											<button id="cari" class="btn btn-primary">Cari</button>
										</div>
									</div>
                                </div>
                            </div>
							<div class="row mt-50">
                                <div class="col-sm">
									<div class="col-lg-12" id="box-keterangan-kecamatan">
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- Adv Sec -->
					<section class="hk-landing-sec bg-gradient-primary">
						<div class="container">
							<div id="map" style="height: 550px"></div>
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
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPNpyLAPlS77x4m8e3NdunZAx2VcGme6w&callback=initMap&libraries=&v=weekly"
		async defer>
	</script>
	<!-- <script src="assets/data.js"></script> -->
	<script>
		let map;

		function initMap(data) {
			map = new google.maps.Map(document.getElementById("map"), {
				zoom: 11,
				center: { lat:-5.4286681, lng:105.2006974 },
			});

			map.data.setStyle(function(feature) {
				var opacity = 0.8;
				if (data[feature.getProperty('id')] === null) {
					var color = "#ffffff";
				} else {
					var color = data[feature.getProperty('id')].color;
				}

				return /** @type {google.maps.Data.StyleOptions} */ ({
					fillColor: color,
					fillOpacity: opacity,
					strokeColor: color,
					strokeOpacity: opacity,
					strokeWeight: 3
				});
			});

			map.data.addListener('mouseover', function(event) {
				var data_map = data[event.feature.getProperty('id')];
				if (data_map === null) {
					$("#box-keterangan-kecamatan").text("Kecamatan " + event.feature.getProperty('nama_kecamatan'));
				} else {
					$("#box-keterangan-kecamatan").text("Kecamatan " + event.feature.getProperty('nama_kecamatan') + ", Jarak Min : " + data_map.total_min + ", Rata-rata : " + data_map.avg + ", Nilai Index : " + data_map.nilai_akses + ", Jarak terdekat : " + data_map.min);
				}
			});
			
			map.data.loadGeoJson(
				"{{ route('peta.json') }}"
			);
		}

		var jenis_faskes = $('#jenis_faskes').val();
		var jam_buka = $('#jam_buka').val();

		$.ajax({
			type: "GET",
			url: "{{ route('nilai_akses') }}",
			data: {
				jenis_faskes: jenis_faskes,
				jam_buka: jam_buka
			},
			success: function(response) {
				initMap(response);
			}
		});

		$("#cari").click(function(){
			var jenis_faskes = $('#jenis_faskes').val();
			var jam_buka = $('#jam_buka').val();

			$.ajax({
				type: "GET",
				url: "{{ route('nilai_akses') }}",
				data: {
					jenis_faskes: jenis_faskes,
					jam_buka: jam_buka
				},
				success: function(response) {
					initMap(response);
				}
			});
		});
	</script>

@endpush