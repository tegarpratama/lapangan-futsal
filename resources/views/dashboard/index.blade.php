@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Hallo {{ auth()->guard('admin')->user()->nama }}, <span>Selamat Datang</span></h1>
                        </div>
                    </div>
                </div>
            </div>

            <section id="main-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-star color-warning border-warning"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Admin</div>
                                    <div class="stat-digit">{{ $admin }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-user color-info border-info"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total User</div>
                                    <div class="stat-digit">{{ $user }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-basketball color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Lapangan Futsal</div>
                                    <div class="stat-digit">{{ $futsal }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
