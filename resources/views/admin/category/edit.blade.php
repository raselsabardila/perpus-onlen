@extends('templates_backend.home')

@section("title","Edit Category Page")

@section("sub-title","Edit Category Page")

@section('content')
    <form action="{{ route("category.update",$category) }}" method="post">
        @csrf
        @method("patch")

        <div class="form-group">
            <label for="nama">Nama Category : </label>
            <input id="nama" class="form-control @error("nama") is-invalid @enderror" type="text" name="nama" value="{{ $category->nama }}">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-block" type="submit">Edit Data</button>
    </form>
@endsection