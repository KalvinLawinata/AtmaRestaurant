<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QRIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
                                class="bi bi-person-circle"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bi bi-cart-fill"
                            style="color: white;display: inline-block;"
                            href="{{ url('pembayaran') }}"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h5 style="text-align:center;font-size:3vw;font-family:Italianno">Pembayaran QRIS</h5>
    <hr style="width: 50%; border: 1px solid black; margin: 0 auto;">

    <div class="container d-flex justify-content-center mt-5">
      <div class="card" style="width: auto;border:none;">
        <div class="card-body" style="background-color:#F0DAA1;">
          <div class="d-flex justify-content-between">
            <p class="card-text" style="margin:0;"><strong>Status Pembayaran : </strong></p>
            <p class="card-text" style="margin:0;"><strong>Belum Dibayar</strong></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="card-text" style="margin:0;"><strong>Pesan : </strong></p>
            <p class="card-text" style="margin:0;"><strong>Menunggu Pembayaran</strong></p>
          </div>
          <div style="background-color:transparent;margin-bottom:4%;margin-top:2%;padding:0;padding-bottom:0;max-with:">
              <form action="{{route('history.store')}}" method="POST">
                  @csrf
                  <button type="submit" style="border:none;"><img src="{{asset('image/qris.png')}}" class="card-img-top" alt="..." style="max-width:30rem;min-width:30rem;"></button>
              </form> 
              <br>
          </div>
          <a href="#" class="btn btn-primary" style="width:100%;background-color:#F78405;border:none;border-radius:20px;"><strong>Unduh Kode QR</strong></a>
        </div>
      </div>
    </div>

    
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>