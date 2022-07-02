@extends('layouts.back')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="row">
                    <div class="col">
                        <h3>Lapangan Futsal</h3>
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
                                    <th>Rating</th>
                                    <th>User Rating Total</th>
                                    <th style="width: 10%" class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($user as $k)
                                        <tr>
                                            <td>{{ ($user->currentPage() - 1) * $user->perPage() + $loop->index + 1 }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->rating }}</td>
                                            <td>{{ $k->user_ratings_total }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-success btn-sm text-white btn-flat" href="{{ route('admin.futsal.edit', $k->id) }}">
                                                    <i class="ti-plus"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm text-white btn-flat" href="{{ route('admin.futsal.show', $k->id) }}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                {{-- <form action="{{ route('admin.futsal.destroy', $k->id) }}" method="POST" class="delete d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $k->id }}">
                                                    <button onclick="return confirm('Hapus lapangan futsal ini ?');" type="submit" class="btn btn-danger btn-sm btn-flat">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Lapangan futsal kosong</td>
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
