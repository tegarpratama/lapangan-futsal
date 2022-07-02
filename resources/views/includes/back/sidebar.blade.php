<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('assets/back/icon.png') }}" style="width: 35%" class="img-fluid">
                    </a>
                </div>
                <li class="label">Main</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a>
                </li>
                <li class="label">Master</li>
                <li>
                    <a href={{ route('admin.admin.index') }}><i class="ti-star"></i>Admin</a>
                </li>
                <li>
                    <a href="{{ route('admin.futsal.index') }}"><i class="ti-basketball"></i>Lapangan Futsal</a>
                </li>
                <li>
                    <a href={{ route('admin.pengguna.index') }}><i class="ti-user"></i>Pengguna</a>
                </li>
                <li class="label">Profil</li>
                <li>
                    <a href={{ route('admin.profile.index') }}><i class="ti-key"></i>Update Profil</a>
                </li>
            </ul>
        </div>
    </div>
</div>
