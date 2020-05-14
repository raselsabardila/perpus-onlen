@extends('templates_backend.home')

@section("title","User Page")

@section("sub-title","User Page")

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($user2 as $item)
                <div class="col-md-4">
                    <div class="card" style="box-shadow: 0px 0px 5px 3px #dadada">
                        <img class="card-img-top" src="{{ asset("upload_file/$item->foto") }}" alt="Card image cap" height="250px">
                        <div class="card-body">
                        <h5 class="card-title text-center">{{ $item->name }}</h5>
                        <h6 class="text-center" style="opacity:.9;margin-top:-10px">{{ $item->email }}</h6>
                        @if ($item->permission == 1)
                            <div>
                                <span class="badge badge-primary float-right mt-2" style="width: 100%">Admin</span>
                            </div>
                        @else
                        <div>
                            <span class="badge badge-primary float-right mt-2" style="width: 100%">Readers</span>
                        </div>
                        @endif
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h6>Buku Dipinjam</h6></li>
                        @foreach ($peminjaman as $item2)
                            @if ($item->id == $item2->peminjam && $item2->status_peminjaman == 1)
                                <li class="list-group-item">{{ $item2->buku->judul }}</li>
                            @endif
                        @endforeach
                        </ul>
                        @if (Auth::user()->permission == 1)
                            <div class="card-body">
                                <form action="{{ route("user.destroy",$item) }}" method="post">
                                    </a>
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{ $user2->links() }}
    </div>
@endsection