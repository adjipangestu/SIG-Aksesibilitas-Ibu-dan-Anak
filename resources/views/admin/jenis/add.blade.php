@extends('layouts.main')
@section('title', 'Tambah Jenis Fasilitas Kesehatan')


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
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Tambah Jenis Fasilitas Kesehatan</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.jenis_faskes.add.do') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Jenis Fasilitas Kesehatan</label>
                            <input class="form-control" name="jenis_faskes"  placeholder="Jenis Fasilitas Kesehatan" type="text" value="{{ old('jenis_faskes') }}" required>
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
