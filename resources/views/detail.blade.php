@extends('layouts.app')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/front/css/card.css') }}">
@endpush

@section('content')
    <div class="row mt-3">
        <div class="col text-center">
            <h3>{{  $futsal->nama }}</h3>
        </div>
    </div>

    <div class="portfolio-details-container mt-3">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @if (count($futsal->gambar) > 0)
                        <div class="row d-flex justify-content-center">
                            @foreach ($futsal->gambar as $g)
                                <div class="col-12 mb-2">
                                    <img src="{{ url('storage/' . $g->gambar) }}" class="img-fluid mx-auto d-block" style="width: 60%">
                                </div>
                            @endforeach
                        </div>
                @else
                <img src="{{ url('/assets/front/img/sample.jpg') }}" class="img-fluid">
                @endif
            </div>
        </div>

        <div class="row mt-4">
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
                        <td class="text-left">
                            @if ($futsal->harga == null)
                                -
                            @else
                                {{ $futsal->harga }}
                            @endif
                        </td>
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
                        <th>Fasilitas</th>
                        <td class="text-left">
                            @foreach ($fasilitas as $j)
                                {{ $j }}
                                <br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Kontak</th>
                        <td class="text-left">{{ $futsal->kontak }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection

