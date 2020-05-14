@extends('templates_backend.home')

@section("title","Admin Page")

@section('content')
<div class="container">
    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif
    <div class="row">
        @foreach ($book as $item)
            <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 0px 5px 3px #dadada">
                    <img class="card-img-top" src="{{ asset("upload_file/$item->sampul") }}" alt="Card image cap" height="300px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <h6 style="margin-top:-10px">{{ $item->kategori->nama }}</h6>
                        <p class="card-text" style="margin-top: :-12px">{!! $item->keterangan !!}</p>
                        @if ($item->status == 1)
                            <button class="btn btn-warning btn-block" type="button">Aktif</button>
                        @else
                            <button class="btn btn-danger btn-block" type="button">Non-Aktif</button>
                        @endif
                        @if ($item->status == 1)
                            @if ($item->status_peminjaman == 0)
                                <a href="{{ route("peminjaman.pinjam",$item->id) }}" class="btn btn-primary btn-block">Pinjam Buku</a>
                            @else
                                <button class="btn btn-info btn-block" type="button">Dalam Peminjaman</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $book->links() }}
</div>
@endsection
