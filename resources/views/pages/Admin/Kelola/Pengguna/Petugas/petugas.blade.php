@extends('layouts.app')

    @section('title', 'Petugas & Keuangan')

    @push('style')
    
    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Petugas & Keuangan</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Pengguna</div>
                        <div class="breadcrumb-item">Petugas & Keuangan</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Petugas & Keuangan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped"
                                    id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($petugas as $p)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$p->detail->nama}}</td>
                                            <td>{{$p->email}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>   
        @endsection

    @push('scripts')
        <script>
             @if(session()->has('success'))
                iziToast.success({
                    title: "Berhasil",
                    message: "{{session('success')}}",
                    position: "topRight"
                });
            @endif 
            @if(count($errors) > 0)
            $('#ubah_petugas_{{ $p->id }}').modal('show');
            iziToast.error({
                title: "Gagal",
                message: "Silakan cek kembali",
                position: "topRight"
            });
            @endif
        </script>
    @endpush

