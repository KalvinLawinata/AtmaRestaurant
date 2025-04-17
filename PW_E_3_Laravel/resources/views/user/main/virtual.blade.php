<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Virtual Account</title>

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

    <h5 style="text-align:center;font-size:3vw;font-family:Italianno">Pembayaran Virtual Account</h5>
    <hr style="width: 50%; border: 1px solid black; margin: 0 auto;">
    
    <div class="container mt-5" style="width:50%;">
      <div class="container d-flex justify-content-between">
        <p class="card-text" style="margin:0;font-size:1.5vw;"><strong>Status Pembayaran : </strong></p>
        <p class="card-text" style="margin:0;font-size:1.5vw;"><strong>Belum Dibayar</strong></p>
      </div>

      <div class="container d-flex justify-content-between">
        <p class="card-text" style="margin:0;font-size:1.5vw;"><strong>Pesan : </strong></p>
        <p class="card-text" style="margin:0;font-size:1.5vw;"><strong>Menunggu Pembayaran</strong></p>
      </div>
    </div>



  

    <div class="container d-flex justify-content-center" style="margin-top:150px;">
        <p style="font-size:2vw;"><strong>Nomor Pembayaran:</strong></p>
        <div class="d-flex justify-content-between" style="background-color: #F78405;width:40%;border-radius:25px;padding-left:2px;padding-right:2%;margin-left:5%;">
          <p style="font-size:1.5vw;margin-left:8%;color:white;margin-top:10px;" id="VA"> A12345678 </p>
          <form action="{{route('history.store')}}" method="POST">
                  @csrf
                  <button type="submit"  onclick="copyText()" style="border:none;margin-top:6px;background-color:transparent"><i class="bi bi-copy " style="font-size:1.5vw;margin-top:5px;color:white;cursor:pointer;" onclick="copyText()"></i></button>
              </form> 
      
        </div>
        
    </div>

    
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function copyText() {
        const textElement = document.getElementById("VA"); // Pastikan ID sesuai
        const textToCopy = textElement.innerText;

        // Menggunakan API Clipboard
        navigator.clipboard.writeText(textToCopy).then(() => {
          alert("Copied To Clipboard");
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>
</html>