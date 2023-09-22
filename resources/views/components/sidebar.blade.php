<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""><img src="{{ asset('img/logo-sip-ujian.png') }}" alt="" height="30px;"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><img src="img/logo.png" alt="" height="30px;"></a>
        </div>
        <ul class="sidebar-menu">
            @if ($user->level == 'admin' || $user->level == 'petugas')
                <li class="{{ Request::is('beranda') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('beranda') }}">
                        <i class="fas fa-fire"></i>
                        <span>Beranda</span></a>
                </li>
            @endif
            @if ($user->level == 'admin')
                <li class="menu-header">Kelola</li>
                <li
                    class="{{ Request::is('prodi') || Request::is('tambah-prodi*') || Request::is('ubah-prodi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('prodi') }}">
                        <i class="fas fa-landmark"></i>
                        <span>Prodi</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'pengguna' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-user-group"></i>
                        <span>Pengguna</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Request::is('pengawas') || Request::is('tambah-pengawas*') || Request::is('ubah-pengawas*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('pengawas') }}">Pengawas
                            </a>
                        </li>
                        <li class="{{ Request::is('petugas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('petugas') }}">Petugas & Keuangan
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'mahasiswa' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-users"></i>
                        <span>Mahasiswa</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Request::is('mahasiswa-D3') || Request::is('tambah-mahasiswa-D3*') || Request::is('ubah-mahasiswaD3*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('mahasiswa-D3') }}">Prodi D3
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('mahasiswa-D4') || Request::is('tambah-mahasiswa-D4*') || Request::is('ubah-mahasiswaD4*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('mahasiswa-D4') }}">Prodi D4
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header">Pelaksanaan</li>
                <li
                    class="{{ Request::is('sesi') || Request::is('tambah-sesi*') || Request::is('ubah-sesi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('sesi') }}">
                        <i class="fas fa-clock"></i>
                        <span>Sesi</span></a>
                </li>
                <li
                    class="{{ Request::is('gedung') || Request::is('tambah-gedung*') || Request::is('ubah-gedung*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('gedung') }}">
                        <i class="fas fa-building"></i>
                        <span>Gedung</span></a>
                </li>
                <li
                    class="{{ Request::is('ruangan') || Request::is('tambah-ruangan*') || Request::is('ubah-ruangan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('ruangan') }}">
                        <i class="fas fa-door-closed"></i>
                        <span>Ruangan</span></a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'matakuliah' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-book"></i>
                        <span>Mata Kuliah</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Request::is('matakuliah-D3') || Request::is('tambah-matakuliah-D3*') || Request::is('ubah-matakuliahD3*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('matakuliah.D3') }}">Prodi D3
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('matakuliah-D4') || Request::is('tambah-matakuliah-D4*') || Request::is('ubah-matakuliahD4*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('matakuliah.D4') }}">Prodi D4
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('ketua-panitia') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/ketua-panitia') }}">
                        <i class="fas fa-user"></i>
                        <span>Ketua Panitia</span></a>
                </li>
                <li class="menu-header">Hasil</li>
                <li class="{{ Request::is('kartu-ujian') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ku') }}"><i class="fas fa-address-card">
                        </i> <span>Kartu Ujian</span>
                    </a>
                </li>
            @elseif ($user->level == 'petugas')
                <li class="menu-header">Penjadwalan</li>
                {{-- <li class="menu-header" style="color: #3876FB;  ">UJIAN TENGAH SEMESTER</li> --}}
                <li class="{{ Request::is('tahun-pelajaran') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('tahun.pelajaran') }}"><i class="fas fa-calendar"></i><span>Tahun Pelajaran</span>
                        </a>
                    </li>
                <li class="nav-item dropdown {{ $type_menu === 'tr_matakuliah' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-book"></i>
                        <span>Mata Kuliah</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Request::is('penjadwalan-matakuliah-D3') || Request::is('tambah-penjadwalan-matakuliah-D3*') || Request::is('ubah-penjadwalan-matakuliah-D3*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('trmatakuliahD3') }}">Prodi D3
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('penjadwalan-matakuliah-D4') || Request::is('tambah-penjadwalan-matakuliah-D4*') || Request::is('ubah-penjadwalan-matakuliah-D4*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('trmatakuliahD4') }}">Prodi D4
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('penjadwalan-ruangan') || Request::is('tambah-penjadwalan-ruangan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('trruangan') }}"><i class="fas fa-door-closed">
                        </i> <span>Ruangan</span>
                    </a>
                </li>
                <li class="menu-header">Jenis Ujian</li>
                <li class="{{ Request::is('penjadwalan-ujian-tengah-semester') || Request::is('tambah-penjadwalan-ujian-tengah-semester*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('trUTS') }}"><i class="fas fa-star-half-stroke">
                        </i> <span>UTS</span>
                    </a>
                </li>
                <li class="{{ Request::is('penjadwalan-ujian-akhir-semester') || Request::is('tambah-penjadwalan-ujian-akhir-semester*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('trUAS') }}"><i class="fas fa-star">
                        </i> <span>UAS</span>
                    </a>
                </li>
            <li class="menu-header">Hasil</li>
             <li class="{{ Request::is('rekap-pengawas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('rekap.pengawas') }}"><i class="fas fa-user-secret">
                </i> <span>Rekap Pengawas</span>
                </a>
            </li>
             <li class="{{ Request::is('cetak-petugas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('cetak.petugas') }}"><i class="fas fa-print">
                </i> <span>Cetak</span>
                </a>
            </li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'cetak' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-print"></i>
                        <span>Cetak</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Request::is('cetak-semester-ganjil') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('cetak.ganjil') }}">Ganjil
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('cetak-semester-genap') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('cetak.genap') }}">Genap
                            </a>
                        </li>
                    </ul>
                </li> --}}
            @elseif ($user->level == 'pengawas')
                <li class="menu-header">Jadwal Mengawasi</li>
                <li class="{{ Request::is('jadwal') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal') }}">
                        <i class="fas fa-binoculars"></i>
                        <span>Jadwal Saya</span></a>
                </li>
                <li class="{{ Request::is('cari-pengganti') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cari.pengganti') }}">
                        <i class="fas fa-repeat"></i>
                        <span>Pencarian Pengganti</span></a>
                </li>
            @elseif ($user->level == 'keuangan')
                <li class="menu-header">Verifikasi</li>
                <li class="{{ Request::is('verifikasi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/verifikasi') }}">
                        <i class="fas fa-cash-register"></i>
                        <span>Mahasiswa</span></a>
                </li>
            @endif
        </ul>

    </aside>
</div>
