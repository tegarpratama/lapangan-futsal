@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Data Pengguna</h3>
                    </div>
                </div>

                @if (session('status'))
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success text-center text-white mt-2 mb-2" role="alert">
                                <strong>{{ session('status') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table text-center table-bordered mb-4">
                                <thead>
                                    <th style="width: 10%">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th style="width: 10%" class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($user as $k)
                                        <tr>
                                            <td>{{ ($user->currentPage() - 1) * $user->perPage() + $loop->index + 1 }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->email }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm text-white btn-flat" href="{{ route('admin.pengguna.show', $k->id) }}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data pengguna kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
