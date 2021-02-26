@extends('layouts.backend.main')
@section('title', 'Tambah Data Kabupaten')

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
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Tambah Kabupaten</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.kabupaten.add.do') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Nama Kabupaten</label>
                            <input class="form-control" name="nama_kabupaten"  placeholder="Nama Kabupaten" type="text" value="{{ old('nama_kabupaten') }}" required>
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
    