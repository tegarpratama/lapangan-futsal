<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}">
                        {{-- <img src="{{ asset('assets/front/img/logo.jpeg') }}" style="width: 35%" class="img-fluid"> --}}
                        Loren's Bakery
                    </a>
                </div>
                <li class="label">Main</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a>
                </li>

                <li class="label">Data Master</li>
                <li class="{{ Request::routeIs('admin.roti.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.roti.index') }}"><i class="ti-layout-grid2"></i>Roti</a>
                </li>
                <li class="{{ Request::routeIs('admin.jenis.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.jenis.index') }}"><i class="ti-layout-column3"></i>Jenis Roti</a>
                </li>
                <li class="{{ Request::routeIs('admin.membership.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.membership.index') }}"><i class="ti-medall"></i>Membership</a>
                </li>
                @if (auth()->guard('admin')->user()->role == 'admin')
                    <li class="{{ Request::routeIs('admin.user.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.user.index') }}"><i class="ti-key"></i>User</a>
                    </li>
                @endif
                <li class="{{ Request::routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pelanggan.index') }}"><i class="ti-user"></i>Pelanggan</a>
                </li>

                @if (auth()->guard('admin')->user()->role != 'owner')
                    <li class="label">Pesanan</li>
                    <li class="{{ Request::routeIs('admin.pesanan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pesanan.index') }}"><i class="ti-shopping-cart"></i> Data Pesanan</a>
                    </li>
                @endif
                <li class="label">Profile</li>
                <li class="{{ Request::routeIs('admin.profile.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}"><i class="ti-face-smile"></i>Profile Anda</a>
                </li>
            </ul>
        </div>
    </div>
</div>
