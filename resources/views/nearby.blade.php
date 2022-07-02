@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col text-center">
            <h3>Lapangan Futsal di Daerah Anda</h3>
        </div>
    </div>

    <div id="map" style="height:70vh; width: 100%;" class="my-3"></div>

    <div class="row">
        <div class="col">
            <form action="{{ route('user.calculate') }}" method="POST">
                @csrf
                <input type="hidden" name="myloc" value="{{ json_encode($location) }}" >
                <input type="hidden" name="futsal" value="{{ json_encode($data) }}" >
                <button class="btn btn-success btn-block" type="submit">Prosess Perhitungan Algoritma Hill Climbing</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpc-W4SSnb8kM3cNDK9MYNCucHZdS7Els&callback=initMap" type="text/javascript"></script>
    <script>
        let map;
        let iconFutsal;
        let iconHome;
        const data = <?php echo json_encode($data); ?>

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

                iconFutsal = `http://127.0.0.1:8000/assets/front/img/${char}.png`
                // iconFutsal = `http://lapangan-futsal.me/assets/front/img/${char}.png`
                new google.maps.Marker({
                    position: { lat: +data[i].lat, lng: +data[i].lng },
                    map: map,
                    draggable: false,
                    icon: iconFutsal
                });
            }
        }
    </script>
@endpush
