<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Tidak Ditemukan</title>
    <!-- Logo icon -->
    <link href="{{ asset('img/not-found.png') }}" rel="icon">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        img {
            max-width: 40%;
            height: auto;
            width: auto\9; /* Untuk mendukung Internet Explorer */
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <img src="{{ asset('img/notfound.png') }}" alt="Not Found">
</body>
</html>
