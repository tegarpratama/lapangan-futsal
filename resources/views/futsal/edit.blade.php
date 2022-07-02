@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Tambah Informasi</h3>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <form action="{{ route('admin.futsal.update', $futsal->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') ? old('nama') : $futsal->nama }}" disabled>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga per jam</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') ? old('harga') : $futsal->harga }}">
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                @if ($futsal->gambar)
                                    <div class="row">
                                        <div class="col-5">
                                            <img src="{{ url('storage/' . $futsal->gambar) }}" class="img-fluid">
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                <input type="file" class="form-control-file" id="gambar" name="gambar">
                                @error('gambar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jam Operasional</label>
                                <textarea name="jam_operasional" id="" cols="60" rows="50" class="form-control" style="height: 200px">{{ old('jam_operasional') ? old('jam_operasional') : $futsal->jam_operasional }}</textarea>
                                @error('jam_operasional')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark btn-flat float-right mt-3">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
