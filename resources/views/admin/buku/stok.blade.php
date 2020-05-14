@extends('templates_backend.home')

@section("title","Book Null Stock Page")

@section("sub-title","Book Null Stock Page")


@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline my-2 my-lg-0" method="post" action="{{ route("book.search") }}">
                @csrf
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>

    <br>

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Status Action</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $item => $hasil)
                        <tr>
                            <td>{{ $item+$book->firstitem() }}</td>
                            <td>
                                @if ($hasil->status == 1)
                                    <a href="{{ route("book.status",$hasil->id) }}"><button class="btn btn-warning btn-sm " type="button">Non-Aktifkan</button></a>
                                @else
                                    <a href="{{ route("book.status",$hasil->id) }}"><button class="btn btn-primary btn-sm" type="button">Aktifkan</button></a>
                                @endif
                            </td>
                            <td><img src="{{ asset("upload_file/$hasil->sampul") }}" width="100px" alt=""></td>
                            <td>{{ $hasil->judul }}</td>
                            <td>{{ $hasil->kategori->nama }}</td>
                            <td>{{ $hasil->stok }}</td>
                            <td>{{ $hasil->user->name }}</td>
                            <td>
                                @if ($hasil->status==1)
                                    <span class="badge badge-primary">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Tidak Aktif   </span></span>
                                @endif
                            </td>
                            <td><a href="{{ asset("upload_file/$hasil->ebook") }}">{{ $hasil->ebook }}</a></td>
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