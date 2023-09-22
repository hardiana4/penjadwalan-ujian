<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Prodi</title>
    <!-- Logo icon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="page-content">
        @foreach ($dataMahasiswa as $data)
            @php
                $m = $data['mahasiswa'];
                $ruangan = $data['ruangan'];
                $matkul = $data['matkul'];
                $jadwal = $data['jadwal'];
            @endphp
            <div class="row" align="center">
                <table class="tabel">
                    <tr>
                        <td class="tabel " style="width: 47%">
                            <table style="margin: 3px;">
                                <tr>
                                    <td class="text-left">
                                        <img src="{{ asset('/img/logo-pnc.jpeg') }}" width="60"
                                            style="padding-right: 25px;">
                                    </td>
                                    <td class="text-right" style="line-height: 0.6; padding-right: 5px;">
                                        <center>
                                            <span style="font-size: 6pt;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</span><br>
                                            <span style="font-size: 6pt;">RISET, DAN TEKNOLOGI</span><br>
                                            <span style="font-size: 6pt;"><b>POLITEKNIK NEGERI CILACAP</b></span><br>
                                            <span style="font-size: 6pt;">Jalan Dr.Soetomo No.1, Sidakaya-CILACAP 53212
                                                Jawa
                                                Tengah</span><br>
                                            <span style="font-size: 6pt;">Telepon: (0282) 537992, Fax: (0282)
                                                537992</span><br>
                                            <span style="font-size: 6pt;">www.pnc.ac.id. Email:
                                                sekretariat@pnc.ac.id</span>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                            <div style="margin-bottom: 1px;border-top: 0.5px solid black;"></div>
                            <div style="margin-top: 1px;border-top: 0.5px solid black;"></div>
                            <span class="small-text" style="float: right; margin: 5px 20px;">{{ $jadwal->kode }}</span>
                            <br>
                            <center class="text">
                                <span style="font-size: 9pt;"><strong>Kartu Peserta
                                        @if ($jadwal->jenis === 'UTS')
                                            Ujian Tengah Semester
                                            @if (
                                                $m->semester === 'I (Satu)' ||
                                                    $m->semester === 'III (Tiga)' ||
                                                    $m->semester === 'V (Lima)' ||
                                                    $m->semester === 'VII (Tujuh)')
                                                Ganjil
                                            @else
                                                Genap
                                            @endif
                                        @else
                                            Ujian Akhir Semester @if (
                                                $m->semester === 'I (Satu)' ||
                                                    $m->semester === 'III (Tiga)' ||
                                                    $m->semester === 'V (Lima)' ||
                                                    $m->semester === 'VII (Tujuh)')
                                                Ganjil
                                            @else
                                                Genap
                                            @endif
                                        @endif
                                        <br>Tahun Akademik {{ $tapel->tahun_pelajaran }}
                                    </strong></span>
                            </center>
                            <table style="padding: 10px 10px 2px 10px;">
                                <tr class="text">
                                    <td width="25%;"><b>Nama</b></td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid; padding-bottom: 2px;" width="240px;">
                                        {{ strtoupper($m->nama_mahasiswa) }} </td>
                                </tr>
                                <tr class="text">
                                    <td><b>NPM</b></td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid; padding-bottom: 2px;"> {{ $m->npm }}
                                    </td>
                                </tr>
                                <tr class="text">
                                    <td><b>Prodi</b></td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid; padding-bottom: 2px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"> {{ $m->prodi->prodi }}
                                    </td>
                                </tr>
                                <tr class="text">
                                    <td><b>Semester</b></td>
                                    <td>:</td>
                                    <td style="padding-bottom: 2px;">
                                        <span style="border-bottom: 1px solid; display: inline-block; width: 60%;">
                                            {{ $m->semester }} </span>
                                        <span><b>Kelas</b></span>
                                        <span style="border-bottom: 1px solid; display: inline-block; width: 24%;">
                                            {{ $m->kelas }} </span>
                                    </td>
                                </tr>
                                <tr class="text">
                                    <td><b>Ruang</b></td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid; padding-bottom: 2px;">
                                        @if ($ruangan)
                                            {{ $ruangan->ruangan->ruangan }}
                                        @else
                                            <span style="color: red">Ruangan belum dijadwalkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="text">
                                    <td><b>Dosen Wali</b></td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid; padding-bottom: 2px;">
                                        {{ $m->user->detail->nama }} </td>
                                </tr>
                            </table>
                            <table style="float: right; margin: 0px 30px;">
                                <tr>
                                    <td class="ketua-text">{{ $ketua->tgl_sah }}</td>
                                </tr>
                                <tr>
                                    <td class="ketua-text">Ketua Panitia<br><br><br></td>
                                </tr>
                                <tr>
                                    <td class="ketua-text" style="border-bottom: 1px solid; padding-bottom: 0px;">
                                        {{ $ketua->user->detail->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="ketua-text">{{ $ketua->nip }}</td>
                                </tr>
                                <tr class="ketua-image-row" style="text-align: center;">
                                    <td class="ketua-image">
                                        <img src="{{ asset('img/ketua/' . $ketua->ttd) }}" width="45px;" />
                                    </td>
                                </tr>

                            </table>
                        </td>
                        <td class="tabel" style="width: 53%;">
                            <center>
                                <span class="text">
                                    @if ($jadwal->jenis === 'UTS')
                                        <span><b>Jadwal Ujian Tengah Semester (UTS)
                                                @if (
                                                    $m->semester === 'I (Satu)' ||
                                                        $m->semester === 'III (Tiga)' ||
                                                        $m->semester === 'V (Lima)' ||
                                                        $m->semester === 'VII (Tujuh)')
                                                    Ganjil
                                                @else
                                                    Genap
                                                @endif
                                            </b>
                                        </span>
                                    @else
                                        <span><b>Jadwal Ujian Akhir Semester (UAS) @if (
                                            $m->semester === 'I (Satu)' ||
                                                $m->semester === 'III (Tiga)' ||
                                                $m->semester === 'V (Lima)' ||
                                                $m->semester === 'VII (Tujuh)')
                                                    Ganjil
                                                @else
                                                    Genap
                                                @endif
                                            </b></span>
                                    @endif
                                </span>
                            </center>
                            <center>
                                <table class="tabel" style="margin: 0px 5px 0px 5px;">
                                    <thead>
                                        <tr>
                                            <th class="tabel jadwal-text" style="width: 2.49cm;">Hari/Tgl</th>
                                            <th class="tabel jadwal-text" style="width: 1.8cm;">Jam</th>
                                            <th class="tabel jadwal-text" style="width: 4.4cm">Mata Kuliah</th>
                                            <th class="tabel jadwal-text" style="width: 1.26cm">Paraf</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $prevTanggalUjian = null;
                                        @endphp

                                        @foreach ($matkul as $index => $m)
                                            @if ($m->tgl_ujian !== $prevTanggalUjian)
                                                <tr>
                                                    <td class="tabel jadwal-text text-center">{{ $m->hari }}</td>
                                                    <td class="tabel jadwal-text text-center">{{ $m->sesi->sesi }}</td>
                                                    <td class="tabel jadwal-text">{{ $m->matkul->matakuliah }}</td>
                                                    <td class="tabel jadwal-text"></td>
                                                </tr>
                                                @php
                                                    $prevTanggalUjian = $m->tgl_ujian;
                                                @endphp
                                                @if ($index + 1 < count($matkul) && $m->tgl_ujian !== $matkul[$index + 1]->tgl_ujian)
                                                    <tr>
                                                        <td class="tabel jadwal-text text-center">{{ $m->tgl_ujian }}
                                                        </td>
                                                        <td class="tabel jadwal-text text-center"></td>
                                                        <td class="tabel jadwal-text"></td>
                                                        <td class="tabel jadwal-text"></td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr>
                                                    <td class="tabel jadwal-text text-center">{{ $m->tgl_ujian }}</td>
                                                    <td class="tabel jadwal-text text-center">{{ $m->sesi->sesi }}</td>
                                                    <td class="tabel jadwal-text">{{ $m->matkul->matakuliah }}</td>
                                                    <td class="tabel jadwal-text"></td>
                                                </tr>
                                            @endif
                                            {{-- @if ($index + 1 === count($matkul) && $m->tgl_ujian === $prevTanggalUjian)
                                                <tr>
                                                    <td class="tabel jadwal-text text-center">{{ $m->tgl_ujian }}</td>
                                                    <td class="tabel jadwal-text text-center"></td>
                                                    <td class="tabel jadwal-text"></td>
                                                    <td class="tabel jadwal-text"></td>
                                                </tr>
                                            @endif --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </center>
                            <br>
                            <br>
                            <span size="1" class="text" style="font-size: 8px; margin-top: 0px; padding: 5px;">
                                <b>Ketentuan :</b>
                            </span><br>
                            <span size="1" class="text"
                                style="font-size: 8px; margin-top: 0px; padding: 5px;">-
                                Selama
                                mengikuti {{ $jadwal->jenis }} kartu ini harus dibawa</span><br>
                            <span size="1" class="text"
                                style="font-size: 8px; margin-top: 0px; padding: 5px;">-
                                Selama {{ $jadwal->jenis }} berlangsung mahasiswa hadir 10 menit sebelum ujian
                                dimulai</span>
                        </td>
                    </tr>
            </div>
            </table>
            <div class="dashed-line">
            </div>
        @endforeach
    </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
