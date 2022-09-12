@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Detail Data Pengguna</h3>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td class="text-center">{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class="text-center">{{ $user->email }}</td>
                            </tr>
                        </table>

                        <div id="map" style="height:70vh; width: 100%;" class="my-3"></div>
                    </div>
                </div>

                <div class="row">
                    <?php $char = 'A'; ?>
                    @foreach ($futsal as $f)
                        @if ($loop->index == 1)
                            <?php $char = 'B'; ?>
                        @elseif($loop->index == 2)
                            <?php $char = 'C'; ?>
                        @elseif($loop->index == 3)
                            <?php $char = 'D'; ?>
                        @endif

                        <div class="col-4">
                            <div class="card">
                                @if (count($f->gambar) > 0)
                                <img src="{{ url('storage/' . $f->gambar[0]->gambar) }}" class="image-card">
                                @else
                                <img src="{{ url('/assets/front/img/sample.jpg') }}" class="image-card">
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
            </div>
        </div>
    </div>
</div>
@endsection


@push('after-script')
    <script script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcm5lRoLzy7GM3H-wG645UzK2uG7Zbnlw&callback=initMap" type="text/javascript"></script>
    <script>
        let map;
        let iconFutsal;
        let iconHome;
        const data = <?php echo json_encode($futsal); ?>

        function initMap() {
            const location = <?php echo json_encode($user); ?>

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

                iconFutsal = `http://lapangan-futsal.me/assets/front/img/${char}.png`
                new google.maps.Marker({
                    position: { lat: +data[i].futsal.latitude, lng: +data[i].futsal.longitude },
                    map: map,
                    draggable: false,
                    icon: iconFutsal
                });
            }
        }
    </script>
@endpush
