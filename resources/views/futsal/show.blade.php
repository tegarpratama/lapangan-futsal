@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Detail Informasi</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered text-left">
                            <tr>
                                <th>Nama</th>
                                <td class="text-left">{{ $futsal->nama }}</td>
                            </tr>
                            <tr>
                                <th>Rating</th>
                                <td class="text-left">{{ $futsal->rating }}</td>
                            </tr>
                            <tr>
                                <th>User Rating Total</th>
                                <td class="text-left">{{ $futsal->user_ratings_total }}</td>
                            </tr>
                            <tr>
                                <th>Latitude</th>
                                <td class="text-left">{{ $futsal->latitude }}</td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td class="text-left">{{ $futsal->longitude }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td class="text-left">{{ $futsal->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Harga Sewa (per jam)</th>
                                <td class="text-left">@convert($futsal->harga)</td>
                            </tr>
                            <tr>
                                <th>Jam Operasional</th>
                                <td class="text-left">
                                    @foreach ($jam as $j)
                                        {{ $j }}
                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td style="width: 80%">
                                    @if ($futsal->gambar)
                                        <img src="{{ url('storage/' . $futsal->gambar) }}" class="img-fluid">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
