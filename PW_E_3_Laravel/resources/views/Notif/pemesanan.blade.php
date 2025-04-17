<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Berhasil </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
</head>
</head>

<body style="background-color:#F0DAA1;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(247, 132, 5, 1);">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"
                style="font-family: Italianno; font-size: 2rem; color: white;">Atma
                Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" style="color: white"
                            href="{{ url('/') }}"><strong>Home</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;"
                            href="{{ url('reservasi') }}"><strong>Reserve</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ url('menu') }}"><strong>Menu</strong></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="{{ url('profile') }}"><i
                                class="bi bi-person-circle"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bi bi-cart-fill" style="color: white;display: inline-block;"
                            href="{{ url('pembayaran') }}"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="text-align:center;margin-top:3%;">
        <h2
            style="display:inline-block; border-bottom: 2px dashed black;text-align;font-size:5vw;font-family:Italianno;">
            Reservations</h2>
    </div>

    <div class="container text-center justify-content-center"
        style="background-color:black;border-radius:100%;width:10vw;height:20vh;background-color:white;margin-top:3%;">
        <i class="bi bi-check-lg justify-content-center" style="font-size:6vw;color:#F0DAA1;margin:0;padding:0;"></i>
    </div>

    <div class="container text-center" style="margin-top:2%;">
        <div class="alert alert-success">
            <p style="font-size:1vw;color:white;"><strong>{{ session('success') }}</strong></p>
        </div>
        <a href="{{ url('menu') }}">
            <button class="btn btn-outline-light" type="submit" style="width:17vw;border-radius:5px;margin-top:5%;">
                <strong>CHOOSE MENU</strong>
            </button>
        </a>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>
