@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Perbarui Profile</h3>
                    </div>
                </div>

                @if (session('status'))
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success text-center text-white mt-2 mb-2" role="alert">
                                <strong>{{ session('status') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.profile.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') ? old('nama') : $profile->nama }}" required>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $profile->email }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongkan jika tidak ingin mengganti password"  required>
                    </div>

                    <button type="submit" class="btn btn-dark btn-flat float-right mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
