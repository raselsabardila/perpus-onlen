@extends('templates_backend.home')

@section("title","Book Borrowed Page")

@section("sub-title","Book Borrowed Page")


@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12"></div>
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Peminjam</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $item => $hasil)
                        <tr>
                            <td>{{ $item+$book->firstitem() }}</td>
                            <td><img src="{{ asset("upload_file") }}/{{ $hasil->buku->sampul }}" width="100px" alt=""></td>
                            <td>{{ $hasil->buku->judul }}</td>
                            <td>{{ $hasil->peminjam_buku->name }}</td>
                            @if ($hasil->status_peminjaman == 1)
                                <td>
                                    <span class="badge badge-success">Accepted</span>
                                </td>
                            @endif
                            @if ($hasil->status_peminjaman == 0)
                                <td>
                                    <span class="badge badge-warning">Queue</span>
                                </td>
                            @endif
                            @if($hasil->status_peminjaman == 2)
                                <td>
                                    <span class="badge badge-danger">Declined</span>
                                </td>
                            @endif
                            @if($hasil->status_peminjaman == 3)
                                <td>
                                    <span class="badge badge-primary">Returned</span>
                                </td>
                            @endif
                            @if ($hasil->status_peminjaman == 0)
                                <td>
                                    <a href="{{ route("peminjaman.setujui",$hasil->id) }}"><button class="btn btn-primary" type="button">Accept</button></a>
                                    <a href="{{ route("peminjaman.tolak",$hasil->id) }}"><button class="btn btn-danger" type="button">Decline</button></a>
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