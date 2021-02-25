@extends('layouts.main')
@section('title', 'Edit Data Kelurahan')

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
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Edit Kelurahan</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.kelurahan.edit.do', ['id' => $kelurahan->id_kelurahan]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Nama Kelurahan</label>
                            <input class="form-control" name="nama_kelurahan"  placeholder="Nama Kelurahan" type="text" value="{{ $kelurahan->nama_kelurahan }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="firstName">Kecamatan</label>
                                <select name="id_kecamatan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach($kecamatan as $item)
                                    <option value="{{ $item->id_kecamatan }}" @if( $kelurahan->id_kecamatan == $item->id_kecamatan) selected @endif>{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
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
    