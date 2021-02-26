@extends('layouts.backend.main')
@section('title', 'Tambah Data Kecamatan')

@section('content')
<div class="container mt-xl-50 mt-sm-30 mt-15">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Tambah Kecamatan</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.kecamatan.add.do') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Nama Kecamatan</label>
                            <input class="form-control" name="nama_kecamatan"  placeholder="Nama Kecamatan" type="text" value="{{ old('nama_kecamatan') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="firstName">Kabupaten</label>
                                <select name="id_kabupaten" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach($kabupaten as $item)
                                    <option value="{{ $item->id_kabupaten }}" @if( old('id_kabupaten') == $item->id_kabupaten) selected @endif>{{ $item->nama_kabupaten}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <input class="form-control" id="mapsearch" placeholder="Alamat" name="alamat" type="text" value="{{ old('alamat') }}" required>
                        </div>
                        <hr>
                        <div id="map" style="height: 550px"></div>

                        <div class="row mt-3">
                            <div class="col-md-4 form-group">
                                <label for="lastName">Latitude</label>
                                <input id="latitude" class="form-control" name="latitude" placeholder="Latitude" value="{{ old('latitude') }}" type="text" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Longitude</label>
                                <input id="longitude" class="form-control" name="longitude" placeholder="Longitude" value="{{ old('longitude') }}" type="text" required>
                            </div>
                        </div>

                        <hr>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt6a6dy99jZcyrlIe7OghOsZ0khO1x4O8&libraries=places" async defer> </script>
    <script>
        window.onload = function() {
            var mapOptions = {
                center: new google.maps.LatLng(-5.3971396, 105.2667887),
                zoom: 11.5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: {
                    lat: -5.3971396,
                    lng: 105.2667887
                },
                map: map,
                draggable: true
            });
            var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));

            google.maps.event.addDomListener(searchBox, 'places_changed', function(event) {
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;

                for (i = 0; place = places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);

                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();
                }
                map.fitBounds(bounds);
                map.setZoom(15);
            })


            google.maps.event.addListener(marker, 'drag', function(event) {

                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });

            google.maps.event.addListener(marker, 'click', function(event) {

                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }
    </script>
@endpush