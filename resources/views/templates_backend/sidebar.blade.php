<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a href="{{route("home")}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        @if (Auth::user()->permission == 1)
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-clipboard"></i> <span>Kategori</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("category.index") }}">List Kategori</a></li>
                <li><a class="nav-link" href="{{ route("category.create") }}">Create Kategori</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->permission == 1)
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book-open"></i> <span>Buku</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("book.index") }}">List Buku</a></li>
                <li><a class="nav-link" href="{{ route("book.dipinjam") }}">List Buku Dipinjam</a></li>
                <li><a class="nav-link" href="{{ route("book.nonaktive") }}">List Buku Non-Aktive</a></li>
                <li><a class="nav-link" href="{{ route("book.create") }}">Create Buku</a></li>
                </ul>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book-reader"></i> <span>Peminjaman</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route("peminjaman.index") }}">List Peminjaman</a></li>
            </ul>
        </li>
        @if (Auth::user()->permission == 1)
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("user.index") }}">List User</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->permission == 1)
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chart-area"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("laporan.index") }}">List Laporan</a></li>
                </ul>
            </li>
        @endif
        </ul>
    </aside>
</div>