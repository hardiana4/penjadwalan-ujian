<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    {{-- csrf meta ini digunakan untuk ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; SIP UJIAN</title>
    <!-- Logo icon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('library/jquery-ui-dist/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> --}}

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    @stack('style')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>

<body>
    <!-- Header -->
    <div id="app">
        <div class="main-wrapper">
            @include('sweetalert::alert')
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    {{-- <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script> --}}
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

    <!-- Sweet Alert -->
    {{-- <script src="{{ asset('library/vendor/sweetalert/sweetalert.all.js') }}"></script> --}}

    <!-- JS Libraries -->
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('library/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        $('#table-all').dataTable({
            aLengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
    </script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                iziToast.error({
                    title: "Gagal",
                    message: "{!! $error !!}",
                    position: "topRight"
                });
            @endforeach
        </script>
    @endif
    <script>
        @if (session()->has('success'))
            iziToast.success({
                title: "Berhasil",
                message: "{{ session('success') }}",
                position: "topRight"
            });
        @endif
    </script>
    <script>
        @if (session()->has('warning'))
            iziToast.warning({
                title: "Perhatian",
                message: "{{ session('warning') }}",
                position: "topRight"
            });
        @endif
    </script>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            let number = parseInt(value, 10);

            if (isNaN(number)) {
                number = 0;
            }

            let formattedValue = number.toLocaleString('id-ID');
            formattedValue = 'Rp. ' + (number === 0 ? '0' : formattedValue);

            input.value = formattedValue;
        }
    </script>
    <script>
        // Mendapatkan referensi ke semua elemen input dengan kelas nonAngkaInput
        const inputElements = document.querySelectorAll('.nonAngkaInput');

        // Iterasi melalui setiap elemen input
        inputElements.forEach(function(inputElement) {
            // Mendengarkan event input pada setiap elemen input
            inputElement.addEventListener('input', function(event) {
                // Menghapus karakter angka dari nilai input
                const cleanedValue = event.target.value.replace(/\d/g, '');

                // Memastikan nilai input hanya mengandung karakter non-angka
                if (cleanedValue !== event.target.value) {
                    event.target.value = cleanedValue;
                }
            });
        });
    </script>

</body>

</html>
