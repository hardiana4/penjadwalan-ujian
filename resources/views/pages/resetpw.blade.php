<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atur Ulang Kata Sandi</title>
    <!-- Logo icon -->
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
                <div class="forms-wrap">
                    <form action="{{ route('reset') }}" method="post" class="form-masuk" autocomplete="off">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('img/logo-pnc.jpeg') }}" alt="logo-pnc" />
                            <img src="{{ asset('img/logo.png') }}" alt="logo-SIP UJIAN" />
                            <h4>SIP UJIAN</h4>
                        </div>

                        <div class="heading">
                            <h2>Atur Ulang Kata Sandi</h2>
                            <h6>Tidak jadi atur ulang kata sandi?</h6>
                            <a href="{{ route('masuk') }}" class="toggle">Masuk</a>
                        </div>
                        <div class="actual-form">
                                <input type="hidden" name="token" id="token" value="{{ request()->token }}">
                                <input type="hidden" name="email" id="email" value="{{ request()->email }}">
                            <div class="input-wrap">
                                <input type="password" minlength="3" class="input-field" id="pass1" name="password"
                                    autocomplete="off" required />
                                <label for="pass1">Kata Sandi Baru</label>
                                <i class="toggle-password fas fa-eye-slash"
                                    onclick="lihatPassword('pass1', 'toggle-password')"></i>
                            </div>
                            <div class="input-wrap">
                                <input type="password" minlength="3" class="input-field" id="pass2" name="password_confirmation"
                                    autocomplete="off" required />
                                <label for="pass2">Konfirmasi Kata Sandi Baru</label>
                                <i class="toggle-password2 fas fa-eye-slash"
                                    onclick="lihatPassword('pass2', 'toggle-password2')"></i>
                            </div>
                            <input type="submit" value="Atur Ulang Kata Sandi" class="masuk-btn" />
                        </div>
                    </form>
                </div>
                <div class="carousel">
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
