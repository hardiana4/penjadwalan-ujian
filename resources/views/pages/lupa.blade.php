<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Kata Sandi</title>
    <!-- Logo icon -->
    {{-- <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('css/masuk.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap-lupa">
                    <form action="{{ route('password.email') }}" method="post" autocomplete="off" class="form-lupa">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('img/logo-pnc.jpeg') }}" alt="logo-pnc" />
                            <img src="{{ asset('img/logo.png') }}" alt="logo-SIP UJIAN" />
                            <h4>SIP UJIAN</h4>
                        </div>

                        <div class="heading">
                            <h2>Lupa Kata Sandi</h2>
                            <h6>Anda sudah ingat?</h6>
                            <a href="{{ route('masuk') }}" class="toggle">Masuk</a>
                        </div>
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="email" name="email" class="input-field" autocomplete="off" required />
                                <label for="email">Email</label>
                            </div>

                            <input type="submit" value="Kirim Link Reset Kata Sandi" class="masuk-btn" />
                        </div>
                    </form>
                </div>
                <div class="carousel-lupa">
                    <div class="images-wrapper">
                        <img src="{{ asset('img/pengawas.jpeg') }}" class="image img-1 show" alt="" />
                        <img src="{{ asset('img/kelas.jpeg') }}" class="image img-2" alt="" />
                        <img src="{{ asset('img/jam.jpeg') }}" class="image img-3" alt="" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Susun jadwal dengan cepat</h2>
                                <h2>Cetak kartu dengan tepat</h2>
                                <h2>Lihat jadwal setiap saat</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/masuk.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                iziToast.error({
                    title: "Gagal",
                    message: "{{ $error }}",
                    position: "topRight"
                });
            @endforeach
        </script>
    @endif
</body>

</html>
