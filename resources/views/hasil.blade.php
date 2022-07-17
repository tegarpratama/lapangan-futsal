@extends('layouts.app')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/front/css/card.css') }}">
@endpush

@section('content')
    <div class="row mt-3">
        <div class="col text-center">
            <h3>Hasil Akhir</h3>
        </div>
    </div>

    @if ($best)
        <div class="row">
            <div class="col-8">
                <div id="map" style="height:70vh; width: 100%;" class="my-3"></div>
            </div>
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Rute Terbaik :</h5>
                        <p>{{ $best->rute }}</p>
                        <hr>
                        <h5>Jarak Tempuh :</h5>
                        <p>{{ number_format($best->jarak, 3) }} Km</p>
                        <hr>
                        <a class="btn btn-success btn-block" type="button" href={{ route('user.home') }}>Cari Lokasi Lain</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col text-center">
                <h3>List Lapangan Futsal</h3>
            </div>
        </div>

        <div class="row mt-3">
            <?php $char = 'A'; ?>
            @foreach ($futsal as $f)
                @if ($loop->index == 1)
                    <?php $char = 'B'; ?>
                @elseif($loop->index == 2)
                    <?php $char = 'C'; ?>
                @elseif($loop->index == 3)
                    <?php $char = 'D'; ?>
                @endif

                <div class="col-4 mb-3">
                    <div class="card">
                        @if ($f->gambar == null)
                            <img src="{{ url('/assets/front/img/sample.jpg') }}" class="image-card">
                        @else
                            <img src="{{ url('storage/' . $f->gambar) }}" class="image-card">
                        @endif
                        <div class="card-body">
                        <h5 class="card-title">({{ $char }}) {{ $f->nama }}</h5>
                        <p class="card-text">{{ $f->alamat }}</p>
                        <a href={{ route('user.detail', $f->id) }} class="btn btn-success btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <hr>
        <div class="text-center">
            <h4>Opps, anda belum memilih lokasi tempat tinggal anda</h4>
            <a href={{ route('user.home') }} class="btn btn-success mt-2">Pilih Lokasi</a>
        </div>
    @endif
@endsection

@push('script')
    <script script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcm5lRoLzy7GM3H-wG645UzK2uG7Zbnlw&callback=initMap" type="text/javascript"></script>
    <script>
        let map;
        let iconFutsal;
        let iconHome;
        const data = <?php echo json_encode($futsal); ?>

        function initMap() {
            const location = <?php echo json_encode($location); ?>

            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat:+location.latitude, lng: +location.longitude },
                zoom: 14,
                scrollwheel: true,
            });

            new google.maps.Marker({
                position: { lat:+location.latitude, lng: +location.longitude },
                map: map,
                draggable: false
            });

            for (let i = 0; i < data.length; i++) {
                let char
                if (i == 0) {
                    char = 'a'
                } else if (i == 2) {
                    char = 'b'
                } else if (i == 3) {
                    char = 'c'
                } else {
                    char = 'd'
                }

                // iconFutsal = `http://lapangan-futsal.me/assets/front/img/${char}.png`
                iconFutsal = `http://127.0.0.1:8000/assets/front/img/${char}.png`
                new google.maps.Marker({
                    position: { lat: +data[i].latitude, lng: +data[i].longitude },
                    map: map,
                    draggable: false,
                    icon: iconFutsal
                });
            }
        }
    </script>
@endpush
