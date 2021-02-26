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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPNpyLAPlS77x4m8e3NdunZAx2VcGme6w&callback=initMap" async defer></script>
<script>

    var jenis_faskes = document.getElementById('jenis_faskes');
    var jam_buka = document.getElementById('jam_buka');

    jenis_faskes.addEventListener('change', persebaran);
    jam_buka.addEventListener('change', persebaran);


    function persebaran() {
        var id_jenis_faskes =  document.getElementById('jenis_faskes').value;
        var id_jam_buka =  document.getElementById('jam_buka').value;

        $.ajax({
            type : "GET",
            url  : "{{ route('persebaran.list') }}",

            data: {
                id_jenis_faskes: id_jenis_faskes,
                id_jam_buka: id_jam_buka
            },
            dataType: "JSON",
            success : function (result) {
                var mapOptions = {
                    center: new google.maps.LatLng(-5.4286681,105.2006974),
                    zoom: 11,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var infoWindow = new google.maps.InfoWindow();
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                for (i = 0; i < result.length; i++) {
                    var data = result[i];
                    var latnya = data.latitude;
                    var longnya = data.longitude;
            
                    var myLatlng = new google.maps.LatLng(latnya, longnya);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: data.alamat
                    });
                    (function (marker, data) {
                        google.maps.event.addListener(marker, "click", function (e) {
                            infoWindow.setContent('<b>Nama Faskes</b> : ' + data.nama_faskes + '<br> Alamat : ' + data.alamat);
                            infoWindow.open(map, marker);
                        });
                    })(marker, data);
                }
            }
        })
    }

    persebaran()
</script>
@endpush