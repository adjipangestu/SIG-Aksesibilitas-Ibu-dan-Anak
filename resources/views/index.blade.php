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
		async>
	</script>
	<script>
		// Initialize and add the map
		function initMap() {

			const uluru = { lat:-5.375130, lng:105.253640 };

			const map = new google.maps.Map(document.getElementById("map"), {
				zoom: 11,
				center: uluru,
			});

			const marker = new google.maps.Marker({
				position: uluru,
				map: map,
			});
		}
    </script>
@endpush