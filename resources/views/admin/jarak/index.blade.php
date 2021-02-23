@extends('layouts.main')
@section('title', 'Input Jarak')


@push('css')
<style type="text/css">
    #map {
            height: 100%;
            width: 100%;
    }
    .lds-roller {
        display: inline-block;
        position: relative;
        width: 40px;
        height: 40px;
    }
    .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
    }
    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #21a0f0;
        margin: -4px 0 0 -4px;
    }
    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
    }
    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
    }
    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
    }
    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
    }
    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
    }
    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
    }
    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
    }
    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
    }
    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush
@section('content')
<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="navigation"></i></span></span>Input Jarak</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="asal"><strong>Asal</strong></label>
                                        <select class="form-control" name="kecamatan" id="kecamatan">
                                            @foreach($kecamatan as $item)
                                                <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="tujuan"><strong>Tujuan</strong></label>
                                        <select class="form-control" name="data_faskes" id="data_faskes">
                                            @foreach($data_faskes as $item)
                                                <option value="{{ $item->id_faskes }}">{{ $item->nama_faskes }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <!-- loader -->
                <!-- <div id="loader">
                    <div class="lds-roller justify-content-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div> -->
                <!-- loader -->

                <div id="result" class="hk-row">
                    <div class="col-sm-12">
                        <div class="card-group hk-dash-type-2">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <span class="d-block font-15 text-dark font-weight-500">Jarak</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span id="distance" class="d-block display-4 text-dark mb-5">0</span>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <span class="d-block font-15 text-dark font-weight-500">Waktu Tempuh</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span id="duration" class="d-block display-4 text-dark mb-5">0</span>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <input type="hidden" name="id_kecamatan" id="id_kecamatan">
                                            <input type="hidden" name="id_faskes" id="id_faskes">
                                            <input type="hidden" name="result_jarak" id="result_jarak">
                                            <span class="d-block font-15 text-dark font-weight-500">Simpan Ke Database</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="d-block display-4 text-dark mb-5"><button id="simpan" class="btn btn-primary">Save</button></span>
                                    </div>
                                </div>
                            </div>

                            <div id="loader" class="card card-sm">
                                <div class="card-body">
                                    <div>
                                        <span  class="d-block display-4 text-dark mb-5"><div class="lds-roller justify-content-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>

                <div id="map" style="height: 550px"></div>
            </div>
        </div>

        
    </div>        
</div>
<!-- /Container -->
@endsection

@push('js')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPNpyLAPlS77x4m8e3NdunZAx2VcGme6w&callback=initMap&libraries=&v=weekly"
      async>
</script>

<script>
    // $('#result').hide();
    $("#loader").hide();

    function initMap() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: { lat:-5.4286681, lng:105.2006974 },
        });
        directionsRenderer.setMap(map);

        const onChangeHandler = function () {
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        };
        document.getElementById("kecamatan").addEventListener("change", onChangeHandler);
        document.getElementById("data_faskes").addEventListener("change", onChangeHandler);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        var kecamatan = document.getElementById("kecamatan").value
        var data_faskes = document.getElementById("data_faskes").value

        var url = "{{ route('admin.jarak.get_alamat_fakses') }}" + "?id_faskes=" + data_faskes + "&id_kecamatan=" + kecamatan
        
        $.ajax({
            type : "GET",
            url  : url,

            data: {
                id_faskes: data_faskes,
                id_kecamatan: kecamatan
            },
            dataType: "JSON",
            beforeSend: function(){
                $("#loader").show();
            },
            success : function (result) {
                var start = "Kec. " + result.kecamatan.nama_kecamatan + ", Kota Bandar Lampung, Lampung, Indonesia"
                var end = result.faskes.alamat
                directionsService.route(
                    {
                        origin: {
                            query: start,
                        },
                        destination: {
                            query: end,
                        },
                        travelMode: google.maps.TravelMode.DRIVING,
                    },
                    (response, status) => {
                        if (status === "OK") {
                            directionsRenderer.setDirections(response);
                            // console.log(response)
                            document.getElementById("distance").innerHTML = response.routes[0].legs[0].distance.text
                            document.getElementById("duration").innerHTML = response.routes[0].legs[0].duration.text
                            $('#result').show();

                            document.getElementById('id_kecamatan').value = kecamatan
                            document.getElementById('id_faskes').value = data_faskes
                            document.getElementById('result_jarak').value = response.routes[0].legs[0].distance.value
                            $("#loader").hide();

                        } else {
                            window.alert("Directions request failed due to " + status);
                        }
                    }
                );
            },
            error: function (error) {
                alert(error.status + ' - ' + error.statusText)
                $("#loader").hide();
            }
        })
    }

    $(document).ready(function () {
        $('#simpan').on('click', function () {
            var url = "{{ route('admin.jarak.add') }}"

            $.ajax({
                type : "POST",
                url  : url,

                data: {
                    "_token": "{{ csrf_token() }}",
                    id_faskes: document.getElementById('id_faskes').value,
                    id_kecamatan: document.getElementById('id_kecamatan').value,
                    result_jarak: document.getElementById('result_jarak').value
                },
                dataType: "JSON",
                success : function (result) {
                    if (result.status == 'updated') {
                        alert('Update data berhasil! (Data sebelumnya sudah ada)')
                    } else{
                        alert('Insert data berhasil!')
                    }
                },
                error: function (error) {
                    alert(error.status + ' - ' + error.statusText)
                }
            })
        })
    })
</script>
@endpush