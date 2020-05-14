@extends('templates_backend.home')

@section("title","Create Category Page")

@section("sub-title","Create Category Page")

@section('content')
    <form action="{{ route("category.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Category : </label>
            <input id="nama" class="form-control @error("nama") is-invalid @enderror" type="text" name="nama">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-block" type="submit">Tambah Data</button>
    </form>
@endsection