<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            {{-- <a href="index.html"><img src="{{ asset('assets/front/img/logo.jpeg') }}" class="img-fluid"></a> --}}
            <h1><a href="{{ route('home') }}">Loren's Bakery</a></h1>
        </div>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="{{ Request::routeIs('roti.*') ? 'active' : '' }} "><a href={{ route('roti.index') }}>Daftar Roti</a></li>
                <li class="{{ Request::routeIs('discount') ? 'active' : '' }} "><a href={{ route('discount') }}>Sedang Diskon</a></li>
                <li class="">
                    <a href="{{
                        Request::routeIs('roti.*') || Request::routeIs('pelanggan.keranjang.*') ||
                        Request::routeIs('pelanggan.pesanan.*') || Request::routeIs('pelanggan.profil.*') ||
                        Request::routeIs('pelanggan.password.*') || Request::routeIs('discount')
                            ? route('home') : '#contact' }}">Kontak</a>
                </li>
                @if (auth()->guard('pelanggan')->user())
                    <li class="{{ Request::routeIs('pelanggan.keranjang.*') ? 'active' : '' }}">
                        <a href="{{ route('pelanggan.keranjang.index') }}">
                            <i class='bx bx-cart bx-sm'></i>
                        </a>
                    </li>
                    <li class="{{ Request::routeIs('pelanggan.pesanan.*') || Request::routeIs('pelanggan.checkout-berhasil.*') || Request::routeIs('pelanggan.checkout.*') || Request::routeIs('pelanggan.konfirmasi-pesanan.*') ? 'active' : '' }}">
                        <a href="{{ route('pelanggan.pesanan.index') }}"><i class='bx bx-shopping-bag bx-sm'></i></a>
                    </li>
                    <li class="drop-down {{ Request::routeIs('pelanggan.profil.*') || Request::routeIs('pelanggan.password.*') ? 'active' : '' }}">
                        <a href="#">{{ auth()->guard('pelanggan')->user()->nama }}</a>
                        <ul>
                            <li><a href="{{ route('pelanggan.profil.index') }}">Profil</a></li>
                            <li><a href="{{ route('pelanggan.password.index') }}">Ubah Password</a></li>
                            <hr>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <span>Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login.index') }}" class="btn btn-primary text-white mx-1">Masuk</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>
