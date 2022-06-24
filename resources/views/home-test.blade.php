@extends('layouts.app')

@section('content')

    <div class="content">
        <form action="#" method="post">
            @csrf
            <div class="mapform" >
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                    </div>
                </div>

                <div id="map" style="height:60vh; width: 100%;" class="my-3"></div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpc-W4SSnb8kM3cNDK9MYNCucHZdS7Els&callback=initMap"
                type="text/javascript"></script>
                {{-- MANY MARKER --}}
                {{-- <script>
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: -34.397, lng: 150.644 },
                            zoom: 8,
                            scrollwheel: true,
                        });

                        const uluru = { lat: -34.397, lng: 150.644 };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })

                        const uluru2 = { lat: -34.369, lng: 149.885 };
                        let marker2 = new google.maps.Marker({
                            position: uluru2,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(marker2,'position_changed',
                            function (){
                                let lat = marker2.position.lat()
                                let lng = marker2.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker2.setPosition(pos)
                        })
                    }
                </script> --}}

                <script>
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: -34.397, lng: 150.644 },
                            zoom: 8,
                            scrollwheel: true,
                        });

                        const uluru = { lat: -34.397, lng: 150.644 };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
                    }
                </script>

                {{-- ERROR --}}
                {{-- <script>
                    var map, infoWindow;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: {lat: -6.224, lng: 106.686},
                            zoom: 14
                        });
                        infoWindow = new google.maps.InfoWindow;
                        // console.log(navigator.geolocation)

                        // Try HTML5 geolocation.
                        if (navigator.geolocation) {
                            console.log('ADA')
                            navigator.geolocation.getCurrentPosition((position) => {
                                console.log(position)
                                var pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };


                                infoWindow.setPosition(pos);
                                infoWindow.setContent('Location found.');
                                console.log(infoWindow.position);
                                infoWindow.open(map);
                                map.setCenter(pos);
                            }, function() {
                                handleLocationError(true, infoWindow, map.getCenter());
                            });
                        } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                        }
                    }

                    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                                            'Error: The Geolocation service failed.' :
                                            'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                    }
                </script> --}}

            </div>

            <input type="submit" class="btn btn-primary">
        </form>


    </div>



@endsection
