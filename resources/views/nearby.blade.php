@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col text-center">
            <h3>Lapangan Futsal di Daerah Anda</h3>
        </div>
    </div>

    <div id="map" style="height:70vh; width: 100%;" class="my-3"></div>
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
                draggable: true
            });

            for (let i = 0; i < data.length; i++) {
                iconFutsal = "http://lapangan-futsal.me/assets/front/img/futsal2.png"
                new google.maps.Marker({
                    position: { lat: +data[i].lat, lng: +data[i].lng },
                    map: map,
                    draggable: false,
                    icon: iconFutsal
                });
            }
            new google.maps.Marker({
                position: { lat: +data[0].lat, lng: +data[0].lng },
                map: map,
                draggable: true
            });
        }
    </script>
@endpush
