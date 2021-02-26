@extends('layouts.main')
@section('title', 'Tambah Data User')

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
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Tambah User</h4>
        </div>
        <!-- /Title -->
        <section class="hk-sec-wrapper">
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('admin.user.add.do') }}" method="post">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="email">Nama</label>
                            <input class="form-control" name="name"  placeholder="Nama" type="text" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Username</label>
                            <input class="form-control" name="username"  placeholder="Username" type="text" value="{{ old('username') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input class="form-control" name="email"  placeholder="Email" type="text" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="firstName">Role</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach($role as $item)
                                <option value="{{ $item->id }}" @if( old('role_id') == $item->id) selected @endif>{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Password</label>
                            <input class="form-control" name="password"  placeholder="Password" type="password" required>
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
    