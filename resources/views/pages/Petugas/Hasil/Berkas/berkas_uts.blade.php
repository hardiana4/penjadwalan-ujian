<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pengambilan Berkas UTS </title>
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        th {
            font-weight: normal;
        }

        .tabel {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
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
            Daftar Pengambilan Berkas
            <br>
             @if ($jadwal->jenis === 'UTS')
                Ujian Tengah Semester
                @if (
                    $jadwal->trmatakuliah->semester === 'I (Satu)' ||
                        $jadwal->trmatakuliah->semester === 'III (Tiga)' ||
                        $jadwal->trmatakuliah->semester === 'V (Lima)' ||
                        $jadwal->trmatakuliah->semester === 'VII (Tujuh)')
                    Ganjil
                @else
                    Genap
                @endif
            @else
                Ujian Akhir Semester @if (
                    $jadwal->trmatakuliah->semester === 'I (Satu)' ||
                        $jadwal->trmatakuliah->semester === 'III (Tiga)' ||
                        $jadwal->trmatakuliah->semester === 'V (Lima)' ||
                        $jadwal->trmatakuliah->semester === 'VII (Tujuh)')
                    Ganjil
                @else
                    Genap
                @endif
            @endif TA {{ $tapel->tahun_pelajaran }}
            <br>
            <br>
            <div class="row">
                <span style="float: right;">Jam ke {{ $data->trmatakuliah->sesi->urutan }}</span>
                <br>
                <span>Hari/Tanggal: {{ $data->trmatakuliah->hari }}, {{ $data->trmatakuliah->tgl_ujian }}</span>
                <span style="float: right;">Waktu: {{ $data->trmatakuliah->sesi->sesi }}</span>
            </div>
            <center>
                <table class="tabel">
                    <thead>
                        <tr class="tabel">
                            <th class="tabel" width="5%">No.</th>
                            <th class="tabel" width="45%">Pengawas</th>
                            <th class="tabel" width="10%">Ruang</th>
                            <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                            <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $count = 0;
                        @endphp
                        @foreach ($ruangan as $r)
                            @if ($count % 18 == 0 && $count != 0)
                    </tbody>
                </table>
            </center>
    </page>
    <page size="A4">
        <div class="page-content">
            <br>
            <br>
            Daftar Pengambilan Berkas
            <br>
            @if ($jadwal->jenis === 'UTS')
                Ujian Tengah Semester
                @if (
                    $jadwal->trmatakuliah->semester === 'I (Satu)' ||
                        $jadwal->trmatakuliah->semester === 'III (Tiga)' ||
                        $jadwal->trmatakuliah->semester === 'V (Lima)' ||
                        $jadwal->trmatakuliah->semester === 'VII (Tujuh)')
                    Ganjil
                @else
                    Genap
                @endif
            @else
                Ujian Akhir Semester @if (
                    $jadwal->trmatakuliah->semester === 'I (Satu)' ||
                        $jadwal->trmatakuliah->semester === 'III (Tiga)' ||
                        $jadwal->trmatakuliah->semester === 'V (Lima)' ||
                        $jadwal->trmatakuliah->semester === 'VII (Tujuh)')
                    Ganjil
                @else
                    Genap
                @endif
            @endif TA {{ $tapel->tahun_pelajaran }}
            <br>
            <br>
            <div class="row">
                <span style="float: right;">Jam ke {{ $data->trmatakuliah->sesi->urutan }}</span>
                <br>
                <span>Hari/Tanggal: {{ $data->trmatakuliah->hari }}, {{ $data->trmatakuliah->tgl_ujian }}</span>
                <span style="float: right;">Waktu: {{ $data->trmatakuliah->sesi->sesi }}</span>
            </div>
            <center>
                <table class="tabel">
                    <thead>
                        <tr class="tabel">
                            <th class="tabel" width="5%">No.</th>
                            <th class="tabel" width="40%">Pengawas</th>
                            <th class="tabel" width="15%">Ruang</th>
                            <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                            <th class="tabel" width="20%">Tanda Tangan Pengambilan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @endif
                        <tr>
                            <td class="tabel" style="text-align: center;" rowspan="2">{{ $no++ }}</td>
                            <td class="tabel">&nbsp;1. {{ $r->pengawas1->detail->nama }}</td>
                            <td class="tabel" style="text-align: center;" rowspan="2">
                                {{ $r->trruangan->ruangan->ruangan }}</td>
                            <td class="tabel"></td>
                            <td class="tabel"></td>
                        </tr>
                        <tr>
                            <td class="tabel">&nbsp;2. {{ $r->pengawas2->detail->nama }}</td>
                            <td class="tabel"></td>
                            <td class="tabel"></td>
                        </tr>
                        @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </center>
        </div>
    </page>
    {{-- <script type="text/javascript">
        window.print();
    </script> --}}
</body>

</html>
