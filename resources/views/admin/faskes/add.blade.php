@extends('layouts.main')
@section('title', 'Data Faskes')

@section('content')
<div class="container mt-xl-50 mt-sm-30 mt-15">
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
                    <form>
                        <div class="form-group">
                            <label for="email">Nama Fasilitas Kesehatan</label>
                            <input class="form-control" id="nama_faskes" placeholder="Nama Fasilitas Kesehatan" type="text" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="firstName">Jam Buka</label>
                                <select name="jam_buka" class="form-control" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="firstName">Jenis Fasilitas Kesehatan</label>
                                <select name="jenis_faskes" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="lastName">No. Telp</label>
                                <input class="form-control" name="telp" placeholder="No. Telp" value="" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Tipe RS</label>
                                <input class="form-control" name="type" placeholder="Type RS" value="" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Tahun Terbit</label>
                                <input class="form-control" name="tahun" placeholder="Tahun Terbit" value="" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat</label>
                            <input class="form-control" id="mapsearch" placeholder="Alamat" name="alamat" type="text">
                        </div>
                        <div class="form-group">
                            <label for="email">Kelurahan</label>
                            <select name="kelurahan" class="form-control" id="">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <hr>
                        <div id="map" style="height: 550px"></div>

                        <div class="row mt-3">
                            <div class="col-md-4 form-group">
                                <label for="lastName">Latitude</label>
                                <input id="lat" class="form-control" name="lat" placeholder="No. Telp" value="" type="text">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Longitude</label>
                                <input id="long" class="form-control" name="long" placeholder="Type RS" value="" type="text">
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