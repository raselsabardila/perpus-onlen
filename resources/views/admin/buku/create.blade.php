@extends('templates_backend.home')

@section("title","Create Book Page")

@section("sub-title","Create Book Page")

@section('content')
    <form action="{{ route("book.store") }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Buku : </label>
            <input id="judul" class="form-control @error("judul") is-invalid @enderror" type="text" name="judul" value="{{ old("judul") }}">
            @error('judul')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="kategori">Kategori Buku : </label>
            <select name="kategori" class="form-control @error("kategori") is-invalid @enderror" id="">
                <option value="">Pilih Kategori</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error('kategori')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan Buku : </label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control @error("keterangan") is-invalid @enderror">{{ old("keterangan") }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sampul">Sampul Buku : </label>
            <input id="sampul" class="form-control @error("sampul") is-invalid @enderror" type="file" name="sampul" value="{{ old("sampul") }}">
            @error('sampul')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ebook">File Buku : </label>
            <input id="ebook" class="form-control @error("ebook") is-invalid @enderror" type="file" name="ebook" value="{{ old("ebook") }}">
            @error('ebook')
                <div class="invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-block" type="submit">Tambah Data</button>
    </form>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'keterangan' );
    </script>
@endsection
