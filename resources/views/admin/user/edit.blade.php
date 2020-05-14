@extends('templates_backend.home')

@section("title","Edit Page")

@section("sub-title","Edit Page")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <center>
        <img src="{{ asset("upload_file/$user2->foto") }}" class="rounded-circle" width="200px" 
        height="200px"  alt="">
    </center>
    <br>
    <form action="{{ route("user.update",$user2) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("patch")

        <div class="form-group">
            <label for="name">Name : </label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" value="{{ $user2->name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email : </label>
            <input class="form-control @error("email") is-invalid @enderror" type="email" value="{{ $user2->email }}" name="email" readonly>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password : (kosongkan bila tidak akan diganti)</label>
            <input class="form-control @error("password") is-invalid @enderror" type="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="foto">Foto : (kosongkan bila tidak akan diganti)</label>
            <input class="form-control @error("foto") is-invalid @enderror" type="file" name="foto">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Edit Profile</button>
    </form>
@endsection