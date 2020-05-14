@extends('templates_backend.home')

@section("title","Category Page")

@section("sub-title","Category Page")

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline my-2 my-lg-0" method="post" action="{{ route("category.search") }}">
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
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item => $hasil)
                        <tr>
                            <td>{{ $item+$category->firstitem() }}</td>
                            <td>{{ $hasil->nama }}</td>
                            <td>{{ $hasil->created_at }}</td>
                            <td>
                                <form action="{{ route("category.destroy",$hasil) }}" method="post">
                                    <a href="{{route('category.edit',$hasil)}}"><button class="btn btn-warning" type="button"><i class="fa fa-code" aria-hidden="true"></i></button></a>
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $category->links() }}
            </div>
        </div>
    </div>
@endsection