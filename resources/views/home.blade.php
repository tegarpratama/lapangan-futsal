@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col text-center">
            <h3>Input lokasi anda </h3>
        </div>
    </div>

    <div class="form-group">
        <label for="address_address">Lokasi</label>
        <input type="text" id="address-input" name="address_address" class="form-control map-input">
        <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
        <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
    </div>
    <div id="address-map-container" style="width:100%;height:400px; ">
        <div style="width: 100%; height: 100%" id="address-map"></div>
    </div>

    <form action="{{ route('user.location') }}" method="POST" id="form">
        @csrf
        <div class="row mt-4">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="latitude" name="lat" id="lat" disabled>
            </div>
            <div class="col-5">
                <input type="text" class="form-control" placeholder="longitude" name="lng" id="lng" disabled>
            </div>
            <div class="col">
                <input type="hidden" name="lathidden" id="lathidden" >
                <input type="hidden" name="lnghidden" id="lnghidden" >
                <button class="btn btn-primary btn-block" type="submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initialize" async defer></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function initialize() {
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            const locationInputs = document.getElementsByClassName("map-input");
            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;

            for (let i = 0; i < locationInputs.length; i++) {
                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -6.346054;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 106.691656;
                $('#lat').val(latitude)
                $('#lng').val(longitude)
                $('#lathidden').val(latitude)
                $('#lnghidden').val(longitude)

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 15
                });

                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                    draggable: true
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                });

                google.maps.event.addListener(marker, 'position_changed', function (){
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                    $('#lathidden').val(lat)
                    $('#lnghidden').val(lng)
                })
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
            $('#lat').val(lat)
            $('#lng').val(lng)
            $('#lathidden').val(lat)
            $('#lnghidden').val(lng)
        }
    </script>
@endpush
