@extends('templates_backend.home')

@section("title","Peminjaman Page")

@section("sub-title","List Buku Pinjaman")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <div class="container">
        <div class="row d-flex text-center">
            @foreach ($book as $item)
                <div class="col-md-4">
                    <div>
                        @if ($item->status_peminjaman == 1)
                            <a href="{{ asset("upload_file") }}/{{ $item->buku->ebook }}">
                                <button class="btn btn-primary" style="background: transparent;position: absolute;margin-top:120px;margin-left:72px;opacity:0;box-shadow:0px 0px 0px 0px;width:100px" type="button" id="btn_baca">Baca Buku</button>
                                </a>
                            <a href="{{ route("peminjaman.kembalikan",$item->buku->id) }}">
                                <button class="btn btn-primary" id="kembali" style="background: transparent;position: absolute;margin-top:190px;margin-left:72px;opacity:0;box-shadow:0px 0px 0px 0px;width:100px" type="button" >Kembalikan</button>
                            </a>
                        @endif
                        @if ($item->status_peminjaman == 0)
                            <button class="btn btn-warning" style="background: transparent;position: absolute;margin-top:150px;margin-left:72px;opacity:1;box-shadow:0px 0px 0px 0px;width:100px" type="button">On Queue</button>
                        @endif
                        @if ($item->status_peminjaman == 2)
                            <button class="btn btn-danger" style="background: transparent;position: absolute;margin-top:150px;margin-left:72px;opacity:1;box-shadow:0px 0px 0px 0px;width:100px" type="button">Declined</button>
                        @endif
                        @if ($item->status_peminjaman == 3)
                            <button class="btn btn-success" style="background: transparent;position: absolute;margin-top:150px;margin-left:72px;opacity:1;box-shadow:0px 0px 0px 0px;width:100px" type="button">Returned</button>
                        @endif
                        <img src="{{ asset("upload_file/") }}/{{ $item->buku->sampul }}" class="rounded" height="350px" alt="" width="auto" id="sampul">
                        <br>
                        <br>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        <center>
            <a href="{{ route("peminjaman.clear",Auth::id()) }}"><button class="btn btn-danger" type="button"><i class="fa fa-trash" aria-hidden="true"></i> Clear History</button></a>
        </center>
        {{ $book->links() }}
    </div>

    <script>
        btn1=document.querySelectorAll("#btn_baca")
        btn2=document.querySelectorAll("#kembali")
        sampul=document.querySelectorAll("#sampul")

        sampul.forEach(element => {
            element.addEventListener("mouseover",()=>{
            btn1.forEach(b=>{
                b.style.opacity="1"
                b.style.transition=".5s"
            })

            btn2.forEach(b2=>{
                b2.style.opacity="1"
                b2.style.transition=".5s"
            })
        })
        });
        sampul.forEach(element => {
            element.addEventListener("mouseleave",()=>{
            btn1.forEach(b=>{
                b.style.opacity="0"
                b.style.transition=".5s"
            })

            btn2.forEach(b2=>{
                b2.style.opacity="0"
                b2.style.transition=".5s"
            })
        })
        });

        btn1.forEach(element => {
            element.addEventListener("mouseover",()=>{
            btn1.forEach(b=>{
                b.style.opacity="1"
            })

            btn2.forEach(b2=>{
                b2.style.opacity="1"
            })
        })
        });

        btn2.forEach(element => {
            element.addEventListener("mouseover",()=>{
            btn1.forEach(b=>{
                b.style.opacity="1"
            })

            btn2.forEach(b2=>{
                b2.style.opacity="1"
            })
        })
        });
    </script>
@endsection