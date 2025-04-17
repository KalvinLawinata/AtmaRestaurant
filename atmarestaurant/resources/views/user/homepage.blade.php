<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        /* Style untuk menempatkan konten di tengah */
        .hero-section {
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: left;
            align-items: left;
        }

        .content {
            color: white;
            padding: 5rem;
            padding-top: 30vh;
            text-align: left;
        }

        .content h1 {
            font-size: 2vw;
            margin-bottom: 1rem;
        }

        .grid-container {
            display: grid;
            height: 15vh;
            align-content: center;
            grid-template-columns: auto auto auto;
            gap: 0px;
            background-color: rgba(247, 132, 5, 1);
            padding: 0px;
        }

        .grid-container>div {
            background-color: rgba(247, 132, 5, 1);
            text-align: center;
            padding: 20px 0;
            font-size: 1vw;
        }

        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body stlye="font-family:Inter;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(237, 120, 4, 1);">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}" style="font-family: Italianno; font-size: 2rem; color: white;">Atma
                Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active"
                            style="color: white;text-decoration:underline;text-underline-offset:15px;"
                            href="{{ url('/') }}"><strong>Home</strong></a>
                    </li>
                    @auth('user')
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;"
                                href="{{ url('reservasi') }}"><strong>Reserve</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ url('menu') }}"><strong>Menu</strong></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ url('profile') }}"><i
                                    class="bi bi-person-circle" style="border-bottom:1px;"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link bi bi-cart-fill"
                                style="color: white;display: inline-block; "
                                href="{{ url('pembayaran') }}"></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ url('login') }}"><strong>Login</strong></a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero-section" style="background-image: url('image/homepage.png');">
        <div class="content"
            style="background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 5rem;
                max-width: 50vw;
                padding-top:30vh;
                text-align: left;
                border-radius: 10px;">
            <h1><strong>Good Food,<br>Good Mood</strong></h1>
            <p style="font-size:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultricies erat at
                nisi ultrices vehicula. Donec blandit risus orci, varius vestibulum felis sagittis ac. Vestibulum nec
                vulputate odio, eget rhoncus ex. </p>
            <a href="{{ url('menu') }}">
                <button type="button" class="btn btn-light"
                    style="border-radius:3vw;font-size:2vw;padding-left:3vw;padding-right:3vw;margin-top:2vh"><strong>View
                        Menu</strong></button>
            </a>
        </div>
    </div>

    <div class="hero-section" style="background-image: url('image/homepage2-2.png');background-repeat:no-repeat;">
        <div class="content" style="width:100%;border-radius:0px;text-align:left;display:flex;justify-content:end;">
            <h1 style="margin-right:15vw;margin-top:8vh;font-size:4vw"><strong>With Best <br>Herbs,<br> We Deliver
                    <br>Your Food <br>With Love.</strong></h1>

        </div>
    </div>

    <div class="container-fluid"
        style="background-color: rgba(247, 132, 5, 0.5);width:100%;height:100%;padding-top:15rem;padding-bottom:15rem;">
        <h1 style="text-align:center;color:white">What Our Customer <br> Says About Us</h1>
        <div class="row g-3"style="justify-content:center;align-items:center;padding-top:5rem;">
            <div class="col-12 col-sm-6 col-md-2" style="margin: 0 1rem;">
                <div class="card" style="width: 18rem;border-radius:15px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <img class="rounded-circle" src="{{ asset('image/hansohee.png') }}" alt="Card image cap"
                            style="width:80px;height:80px;object-fit:cover;">
                        <h5 class="card-title" style="margin-left: 15px;">Han Sohee</h5>
                    </div>
                    <div class="card-body" style="text-align:center;">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultricies
                            erat at nisi ultrices vehicula. Donec blandit risus orci, varius vestibulum felis sagittis
                            ac. Vestibulum nec vulputate odio, eget rhoncus ex. </p>
                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-md-2" style="margin: 0 1rem;">
                <div class="card" style="width: 18rem;border-radius:15px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <img class="rounded-circle" src="{{ asset('image/parkjimin.png') }}" alt="Card image cap"
                            style="width:80px;height:80px;object-fit:cover;">
                        <h5 class="card-title" style="margin-left: 15px;">Park Jimin</h5>
                    </div>
                    <div class="card-body" style="text-align:center;">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultricies
                            erat at nisi ultrices vehicula. Donec blandit risus orci, varius vestibulum felis sagittis
                            ac. Vestibulum nec vulputate odio, eget rhoncus ex. </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-2" style="margin: 0 1rem;">
                <div class="card" style="width: 18rem;border-radius:15px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <img class="rounded-circle" src="{{ asset('image/shin.png') }}" alt="Card image cap"
                            style="width:80px;height:80px;object-fit:cover;">
                        <h5 class="card-title" style="margin-left: 15px;">Shin Ryujin</h5>
                    </div>
                    <div class="card-body" style="text-align:center;">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultricies
                            erat at nisi ultrices vehicula. Donec blandit risus orci, varius vestibulum felis sagittis
                            ac. Vestibulum nec vulputate odio, eget rhoncus ex. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer text-center" style="background-color: #F78405; color: #ffffff">
        <div class="row">
            <div class="col text-start ms-4">
                <h1 style="font-family:Italianno;">Atma Restaurant</h1>
                <p>Jl. Babasari, Atma Jaya Yogyakartya, 93401, IND</p>
                <p>+623456789</p>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>
                    <i class="fa-brands fa-instagram fs-2"></i>
                    <span class="fs-4 fw-bold">AtmaRestaurant</span>
                </div>
                <div>
                    <i class="fa-brands fa-square-facebook fs-2"></i>
                    <span class="fs-4 fw-bold">AtmaRestaurantOfficial</span>
                </div>
                <div>
                    <i class="fa-brands fa-twitter fs-2"></i>
                    <span class="fs-4 fw-bold">@AtmaResOff</span>
                </div>
                <div>
                    <i class="fa-brands fa-youtube fs-2"></i>
                    <span class="fs-4 fw-bold">AtmaCook</span>
                </div>
            </div>
            <div class="col text-end">
                <p class="fs-4 fw-bold m-1">Help</p>
                <p class="fs-4 fw-bold m-1">About Us</p>
                <p class="fs-4 fw-bold m-1">Contact Us</p>
                <p class="fs-4 fw-bold m-1">Terms & Conditions</p>
            </div>
        </div>
        <hr class="footer-line">
        <div class="container d-flex flex-column justify-content-center">
            <p>Copyright © 2024 Atma Restaurant.</p>
            <p>All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
