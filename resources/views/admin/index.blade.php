@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>User</h3>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <a href="{{ route('admin.admin.create') }}" class="btn btn-primary btn-flat">
                            Tambah
                        </a>
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
                                            @if ($k->id != auth()->guard('admin')->user()->id)
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-sm text-white btn-flat" href="{{ route('admin.admin.edit', $k->id) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.admin.destroy', $k->id) }}" method="POST" class="delete d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $k->id }}">
                                                        <button onclick="return confirm('Hapus user ini?');" type="submit" class="btn btn-danger btn-sm btn-flat">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-secondary" disabled>It's You</button>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">User kosong</td>
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
