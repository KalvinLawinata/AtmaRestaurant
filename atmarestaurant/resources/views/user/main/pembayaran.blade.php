<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
        }

        .grid-container>div {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid black;
            text-align: center;
            width: 32vw;
            border: none;
            background-color: #FA9C14;
            border-radius: 15px;
            color: white;
        }

        .card {
            background-color: #F78405;
            border: none;
            border-radius: 10px;
        }

        .row p {
            margin: 5px;
        }

        .col button {
            border: none;
        }

        .card-body {
            margin: 0px;
        }
        
        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        .toast-success {
            background-color: #28a745;
            color: white;
        }

 
        .toast-error {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body style="background-color:#F0DAA1;font-family:Inter;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(247, 132, 5, 1);">
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
                                class="bi bi-person-circle" style="border-bottom:1px;"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bi bi-cart-fill"
                            style="color: white;display: inline-block; border-bottom: 1px solid white;"
                            href="{{ url('pembayaran') }}"></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="toast-container position-fixed" style="top: 40px; right: 20px; z-index: 1050;">
        <div id="toastMessage" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                
                <strong id="toastTitle" class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="message" class="toast-body">
    </div>
        </div>
    </div>
    <div style="text-align:center;margin-bottom:5%;margin-top:2%;font-family:Italianno;">
        <h1 style="font-size:5vw;">Pembayaran</h1>
    </div>
    <div class="container " style="padding:2px;justify-content:center;">
        <div class="grid-container justify-content-center">
            <div style="padding:3%;">
                <div class="d-flex justify-content-between">
                    <p class="col text-start" style="font-size:1.5vw;"><strong>Your Order</strong></p>
                    <form action="{{route('keranjang.deleteAll')}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="col text-end" style="font-size:1.5vw;background-color:transparent;border:0;color:white" @if($keranjangs->isEmpty()) disabled @endif><strong>Remove All</strong></button>
                    </form>
                </div>
                    @forelse($keranjangs as $item)
                    <div class="card mb-3" >
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($item->menu->gambar_makanan) }}" class="img-fluid rounded-start" alt="..." style="min-width:100%;max-width:100%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-start"style="font-size:1vw;">{{$item->menu->nama}}</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-start"style="font-size:1vw;">Rp. {{$item->menu->harga}}</p>
                                        <form action="{{route('keranjang.delete', $item->id_keranjang)}}" method ="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"class="bi bi-x-circle" style="font-size:2vw;color:red;background-color:transparent;border:0" ></button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-danger">
                        Data menu belum tersedia
                    </div>
                @endforelse
            </div>

            <div style="padding:3%;">
                    <div class="card" style="width: 30vw;">
                        <div class="card-body">
                            <h5 class="card-title text-start" style="font-size:1vw;"><strong>Pesanan</strong></h5>
                            @forelse($keranjangs as $item)
                                <div class="row">
                                    <p class="col card-text text-start" style="font-size:1vw;">{{$item->jumlah_menu}} {{$item->menu->nama}}</p>
                                    <p class="col card-text text-end" style="font-size:1vw;">Rp. {{ number_format($item->jumlah_menu * $item->menu->harga, 0, ',', '.') }}</p>
                                </div>
                                @empty
                                <div class="alert alert-danger">
                                    Data menu belum tersedia
                                </div>
                            @endforelse

                            <hr>
                            <div class="row">
                                <p class="col card-text text-start" style="font-size:1vw;">Subtotal</p>
                                <p class="col card-text text-end" style="font-size:1vw;">Rp. {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>

                            <div class="row">
                                <p class="col card-text text-start" style="font-size:1vw;">Tax (10%)</p>
                                <p class="col card-text text-end" style="font-size:1vw;">Rp. {{ number_format($tax, 0, ',', '.') }}</p>
                            </div>

                            <div class="row">
                                <p class="col card-text text-start" style="font-size:1vw;"><strong>Total</strong></p>
                                <p class="col card-text text-end" style="font-size:1vw;"><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></p>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>


    
    <div class="container mt-5 d-flex justify-content-between" style="max-width:68%;">
        <div>
            <p class="text-start" style="font-size:1vw;"><strong>Pilih Pembayaran</strong></p>
        </div>

        <div>
            
            <div class="container d-flex gap-2">
                <a href="{{url('qris')}}">
                    <button
                        style="width:8vw;height:5vh;border-radius:25px;margin-right:3%;background-color:#F78405;color:white;font-size:0.8vw;border:none;" @if($keranjangs->isEmpty()) disabled @endif>QRIS
                    </button>
                </a>
                <a href="{{url('virtual')}}" >
                    <button
                        style="width:8vw;height:5vh;border-radius:25px;background-color:#F78405;color:white;font-size:0.8vw;text-decoration:none;border:none;" @if($keranjangs->isEmpty()) disabled @endif >Virtual Account
                    </button>
                </a>    
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-center" style="background-color: #F78405; color: #ffffff;margin-top:10%;width:100%;height:100%;">
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @php
        $sessionMessage = session('success') ?? session('error');
    @endphp

    @if ($sessionMessage)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toastMessage = document.getElementById('toastMessage');
                var toastTitle = document.getElementById('toastTitle');
                var message = document.getElementById('message');
                var toast = new bootstrap.Toast(toastMessage);

                // Check if there's a success or error message
                @if (session('success'))
                    toastTitle.innerText = "Success";
                    message.innerText = "{{ session('success') }}";
                    toastMessage.classList.add('toast-success');  
                @elseif (session('error'))
                    toastTitle.innerText = "Error";
                    message.innerText = "{{ session('error') }}";
                    toastMessage.classList.add('toast-error');  // Optional: Add custom class for error
                @endif

                // Show toast
                toast.show();
            });
        </script>
    @endif
</html>
