@extends('templates_backend.home')

@section("title","Report Page")

@section("sub-title","Report Page")


@section('content')
    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $item => $hasil)
                        <tr>
                            <td>{{ $item+$book->firstitem() }}</td>
                            <td>{{ $hasil->peminjam_buku->email }}</td>
                            <td>{{ $hasil->buku->judul }}</td>
                            @if ($hasil->status_peminjaman == 0)
                                <td>
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                </td>
                            @endif
                            @if ($hasil->status_peminjaman == 1)
                                <td>
                                    <span class="badge badge-success">Dipinjam</span>
                                </td>
                            @endif
                            @if ($hasil->status_peminjaman == 2)
                                <td>
                                    <span class="badge badge-danger">Ditolak</span>
                                </td>
                            @endif
                            @if ($hasil->status_peminjaman == 3)
                                <td>
                                    <span class="badge badge-primary">Dikembalikan</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $book->links() }}
            </div>
        </div>
    </div>
@endsection