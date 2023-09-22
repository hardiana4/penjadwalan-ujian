<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Jadwal per Prodi</title>
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 12pt;
        }

        th {
            font-weight: normal;
        }

        .tabel {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
        }

        .ketua-image {
        position: absolute;
        display: inline-block;
        margin-top: -55px;
        margin-left: -15px;
        z-index: -1;
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0cm auto;
            margin-bottom: 0.2cm;
            box-shadow: none;
        }

        @page {
            size: A4;
            margin: 2.54cm 2.54cm 2.54cm 2.54cm;
            font-size: 12pt;
        }
    </style>
</head>

<body>
    <page size="A4">
        <div class="page-content">
            <table style="margin-left: 80px;">
                <tr>
                    <td><img src="{{ asset('img/logo-pnc.jpeg') }}" alt="" width="60" style="padding: 5px;">
                    </td>
                    <td style="padding-left: 30px;">
                        @if ($jadwal->jenis === "UTS")
                                        JADWAL UTS TEORI SEMESTER
                                       @if (($smt1 !== null && $smt1->semester === "I (Satu)") ||
                                            ($smt1 === null && $smt2 !== null && $smt2->semester === "III (Tiga)") ||
                                            ($smt1 === null && $smt2 === null && $smt3 !== null && $smt3->semester === "V (Lima)") ||
                                            ($smt1 === null && $smt2 === null && $smt3 === null && $smt4 !== null && $smt4->semester === "VII (Tujuh)"))
                                            GANJIL POLITEKNIK NEGERI CILACAP
                                        @else
                                            GENAP POLITEKNIK NEGERI CILACAP
                                        @endif
                        @else
                                        JADWAL UAS TEORI SEMESTER
                                       @if (($smt1 !== null && $smt1->semester === "I (Satu)") ||
                                            ($smt1 === null && $smt2 !== null && $smt2->semester === "III (Tiga)") ||
                                            ($smt1 === null && $smt2 === null && $smt3 !== null && $smt3->semester === "V (Lima)") ||
                                            ($smt1 === null && $smt2 === null && $smt3 === null && $smt4 !== null && $smt4->semester === "VII (Tujuh)"))
                                        GANJIL POLITEKNIK NEGERI CILACAP
                                        @else
                                            GENAP POLITEKNIK NEGERI CILACAP
                                        @endif
                        @endif
                        <br>TAHUN AKADEMIK {{ $tapel->tahun_pelajaran }}
                        <br>JURUSAN {{ strtoupper($jurusan->nama_prodi) }}
                    </td>
                </tr>
            </table>
            <span style="float: right; margin-right: 60px;"><strong>{{ $jadwal->kode }}</strong></span><br>
            <br>
            <center>
                <table class="tabel">
                    <thead>
                        <tr class="text-center">
                            <th class="tabel" style="width: 2cm; padding: 5px;">Kelas</th>
                            <th class="tabel" style="width: 2.9cm;">Semester</th>
                            <th class="tabel" style="width: 1.65cm;">No.</th>
                            <th class="tabel" style="width: 2.1cm;">Hari</th>
                            <th class="tabel" style="width: 2.7cm;">Tanggal</th>
                            <th class="tabel" style="width: 3cm;">Waktu</th>
                            <th class="tabel" style="width: 8cm;">Mata Kuliah</th>
                            <th class="tabel" style="width: 2cm;">Ruang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no1 = 1;
                        @endphp
                            @foreach ($datakelas1 as $data1)
                            @php
                                $rowspan = $datakelas1
                                ->where('semester', $data1->semester)
                                    ->count();
                                    @endphp
                            <tr>
                                @if ($loop->first)
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {!! implode('<br>', $kelas1->toArray()) !!}
                                    </td>
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {{ $data1->semester }}
                                    </td>
                                    @endif
                                    <td class="tabel" style="text-align: center;">
                                        {{ $no1++ }}</td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data1->hari }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data1->tgl_ujian }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data1->sesi->sesi }}
                                </td>
                                <td class="tabel" >
                                    {{ $data1->matkul->matakuliah }}
                                </td>
                                @if ($loop->first)
                                <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                    {!! implode('<br>', $ruang1->toArray()) !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $no2 = 1;
                        @endphp
                        @foreach ($datakelas2 as $data2)
                            @php
                                $rowspan = $datakelas2
                                    ->where('semester', $data2->semester)
                                    ->count();
                            @endphp
                            <tr>
                                @if ($loop->first)
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {!! implode('<br>', $kelas2->toArray()) !!}
                                    </td>
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {{ $data2->semester }}
                                    </td>
                                    @endif
                                    <td class="tabel" style="text-align: center;">
                                        {{ $no2++ }}</td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data2->hari }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data2->tgl_ujian }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data2->sesi->sesi }}
                                </td>
                                <td class="tabel">
                                    {{ $data2->matkul->matakuliah }}
                                </td>
                                @if ($loop->first)
                                <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                    {!! implode('<br>', $ruang2->toArray()) !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $no3 = 1;
                        @endphp
                        @foreach ($datakelas3 as $data3)
                            @php
                                $rowspan = $datakelas3
                                    ->where('semester', $data3->semester)
                                    ->count();
                            @endphp
                            <tr>
                                @if ($loop->first)
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {!! implode('<br>', $kelas3->toArray()) !!}
                                    </td>
                                    <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                        {{ $data3->semester }}
                                    </td>
                                    @endif
                                    <td class="tabel" style="text-align: center;">
                                        {{ $no3++ }}</td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data3->hari }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data3->tgl_ujian }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data3->sesi->sesi }}
                                </td>
                                <td class="tabel">
                                    {{ $data3->matkul->matakuliah }}
                                </td>
                                @if ($loop->first)
                                <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                    {!! implode('<br>', $ruang3->toArray()) !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $no4 = 1;
                        @endphp
                        @foreach ($datakelas4 as $data4)
                            @php
                                $rowspan = $datakelas4
                                    ->where('semester', $data4->semester)
                                    ->count();
                            @endphp
                            <tr>
                                @if ($loop->first)
                                    <td class="tabel" rowspan="{{ $rowspan }}">
                                        {!! implode('<br>', $kelas4->toArray()) !!}
                                    </td>
                                    <td class="tabel" rowspan="{{ $rowspan }}">
                                        {{ $data4->semester }}
                                    </td>
                                    @endif
                                    <td class="tabel" style="text-align: center;">
                                        {{ $no4++ }}</td>
                                <td class="tabel">
                                    {{ $data4->hari }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data4->tgl_ujian }}
                                </td>
                                <td class="tabel" style="text-align: center;">
                                    {{ $data4->sesi->sesi }}
                                </td>
                                <td class="tabel">
                                    {{ $data4->matkul->matakuliah }}
                                </td>
                                @if ($loop->first)
                                <td class="tabel" rowspan="{{ $rowspan }}" style="text-align: center;">
                                    {!! implode('<br>', $ruang4) !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </center>
            <br>
            <br>
            <table style="float: right; margin-right: 65px;">
                <tr>
                    <td>{{ $ketua->tgl_sah }}</td>
                </tr>
                <tr>
                    <td>Ketua Panitia</td>
                </tr>
                <tr style="text-align: center;">
                    <td height="50px;"></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid; padding-bottom: 0px;">{{ $ketua->user->detail->nama }}</td>
                </tr>
                <tr>
                    <td>{{ $ketua->nip }}</td>
                </tr>
            </table>
            {{-- <table class="tabel">
                    <tr class="tabel">
                        <th class="tabel" width="5%">No.</th>
                        <th class="tabel" width="40%">Pengawas</th>
                        <th class="tabel" width="15%">Ruang</th>
                        <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                        <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                    </tr>
                    <tr>
                        <td class="tabel" style="text-align: center;" rowspan="2">1</td>
                        <td class="tabel">&nbsp;1.</td>
                        <td class="tabel" style="text-align: center;" rowspan="2">1.3</td>
                        <td class="tabel"></td>
                        <td class="tabel"></td>
                    </tr>
                    <tr>
                        <td class="tabel">&nbsp;2.</td>
                        <td class="tabel"></td>
                        <td class="tabel"></td>
                    </tr>
                </table> --}}

        </div>
    </page>
    {{-- <script type="text/javascript">
        window.print();
    </script> --}}
</body>

</html>
