<!DOCTYPE html>
<html lang="en" style="font-family:Inter;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <style>
        .grid-container {
            display: grid;
            grid-template-areas:
                'm1 m2'
                'm1 m2';
            padding: 10px;
            column-gap: 30px;
            row-gap: 20px;
            margin-top: 10vh;
        }

        .grid-item {
            border: 1px solid rgba(0, 0, 0, 0.8);
            text-align: center;
        }

        .item1 {
            grid-area: m1;
        }

        .item2 {
            grid-area: m2;
        }

        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body style="background-color:#F0DAA1;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F78405;">
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
                        <a class="nav-link" style="color: white;" href="#"><strong>Menu</strong></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="color: white; display: inline-block; border-bottom: 1px solid white;"
                            href="{{ url('profile') }}">
                            <span class="bi bi-person-circle"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bi bi-cart-fill" style="color: white;" href="{{ url('pembayaran') }}"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form action="{{ route('user.updateProfile', $user->id_user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid-container justify-content-center align-content-center">
            <div class="item1">
                <div class="card align-items-center"
                    style="padding:5vh;border-radius:25px;background-color:#F0DAA1;color:white;border:none;">
                    <h1 class="card-title">Edit Profile</h1>
                    <img id="imagePreview" src="{{ asset($user->foto ?? 'user_profile/default.jpeg') }}" class="rounded-circle"
                        style="width:15vw;height:30vh;" alt="...">

                    <div class="card-body text-start">
                        <label for="fotoInput" class="btn btn-warning" style="cursor: pointer;">
                            Upload New Photo
                        </label>
                        <input type="file" name="foto" id="fotoInput" onchange="previewFile()" accept="image/*"
                            style="display: none;">
                    </div>
                </div>

            </div>
            <div class="item2" style="text-align:start;padding-top:6vh;">
                @error('username')
                    <div class="alert alert-danger"> X {{ $message }}</div>
                @enderror

                <p style="padding-left:1vw;margin:0;"><strong>Update Username</strong></p>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                        style="border-radius:50px;width:30vw;padding-left:2vw;" value="{{ $user->username }}" required>
                    <label for="floatingInput" style="padding-left:2vw;">Username</label>
                </div>

                <p style="padding-left:1vw;margin:0;"><strong>Email</strong></p>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="email" placeholder="email@gmail.com"
                        name="email" style="border-radius:50px;width:30vw;padding-left:2vw;"
                        value="{{ $user->email }}" required>
                    <label for="floatingInput" style="padding-left:2vw;">Email</label>
                </div>

                <p style="padding-left:1vw;margin:0;"><strong>Nomor Telepon</strong></p>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="no_telp" placeholder="Nomor telepon"
                        name="no_telp" style="border-radius:50px;width:30vw;padding-left:2vw;"
                        value="{{ $user->no_telp }}" required>
                    <label for="floatingInput" style="padding-left:2vw;">Nomor Telepon</label>
                </div>

                <div>
                    <button class="btn btn-success" type="submit"
                        style="width:10vw;border-radius:25px;background-color: #F78405;;margin-top:3vh;height:5vh;font-size:1vw;border:none;">
                        <strong>Confirm</strong>
                    </button>
                </div>

            </div>
        </div>

    </form>

    <!-- Main Footer -->
    <footer class="main-footer text-center" style="background-color: #F78405; color: #ffffff">
        <div class="row">
            <div class="col text-start ms-4">
                <h1 style="font-family:Italianno">Atma Restaurant</h1>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewFile() {
            const file = document.getElementById('fotoInput').files[0];
            const imagePreview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
