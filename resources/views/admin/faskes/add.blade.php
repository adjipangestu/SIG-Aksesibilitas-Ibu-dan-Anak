@extends('layouts.main')
@section('title', 'Data Faskes')


@push('css')
<!-- select2 CSS -->
<link href="{{ asset ('assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

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
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Tambah Fasilitas Kesehatan</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.faskes.add.do') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Nama Fasilitas Kesehatan</label>
                            <input class="form-control" name="nama_faskes"  placeholder="Nama Fasilitas Kesehatan" type="text" value="{{ old('nama_faskes') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="firstName">Jam Buka</label>
                                <select name="jam_buka" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach($jam_buka as $item)
                                    <option value="{{ $item->id_jam_buka }}" @if( old('jam_buka') == $item->id_jam_buka) selected @endif>{{ $item->jam_buka}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="firstName">Jenis Fasilitas Kesehatan</label>
                                <select name="jenis_faskes" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach($jenis_faskes as $item)
                                    <option value="{{ $item->id_jenis_faskes }}" @if( old('jenis_faskes') == $item->id_jenis_faskes) selected @endif>{{ $item->jenis_faskes }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="lastName">No. Telp</label>
                                <input class="form-control" name="telp" placeholder="No. Telp" value="{{ old('telp') }}" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Tipe RS</label>
                                <input class="form-control" name="type" placeholder="Type RS" value="{{ old('type') }}" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Tahun Terbit</label>
                                <input class="form-control" name="tahun" placeholder="Tahun Terbit" value="{{ old('tahun') }}" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Kelurahan</label>
                            <select name="kelurahan" class="form-control select2" id="" required>
                                <option value="">Pilih</option>
                                @foreach($kelurahan as $item)
                                <option value="{{ $item->id_kelurahan }}" @if( old('kelurahan') == $item->id_kelurahan) selected @endif>{{ $item->nama_kelurahan }}</option>
                                @endforeach
                            </select>
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
                                <input id="lat" class="form-control" name="lat" placeholder="Latitude" value="{{ old('lat') }}" type="text" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Longitude</label>
                                <input id="long" class="form-control" name="long" placeholder="Longitude" value="{{ old('long') }}" type="text" required>
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
    <!-- Select2 JavaScript -->
    <script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/select2-data.js') }}"></script>
    <script>
        window.onload = function() {
            var mapOptions = {
                center: new google.maps.LatLng(-5.3971396, 105.2667887),
                zoom: 11,
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

                    document.getElementById('lat').value = place.geometry.location.lat();
                    document.getElementById('long').value = place.geometry.location.lng();
                }
                map.fitBounds(bounds);
                map.setZoom(15);
            })


            google.maps.event.addListener(marker, 'drag', function(event) {

                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('long').value = event.latLng.lng();
            });

            google.maps.event.addListener(marker, 'click', function(event) {

                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('long').value = event.latLng.lng();
            });
        }
    </script>
@endpush