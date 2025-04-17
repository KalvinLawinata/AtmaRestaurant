<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        /* Background image */
        .bg-image {
            background-image: url('{{ asset('image/signup.png') }}');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh; 
        }

        
        .form-container {
            background-color:rgba(240, 218, 161, 1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        
        .input-group .form-control {
            border-radius: 30px;
            padding-left: 40px; 
        }

        .input-group-text {
            border-radius: 30px;
            background-color: #f1f1f1;
        }

        .input-group .icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }


        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }
            .bg-image {
                height: 80vh; 
            }
        }
    </style>
</head>

<body>
    <div class="bg-image d-flex justify-content-center align-items-center">

    
        <div class="form-container">
            <h2 class="text-center mb-4">Login</h2>

            
            <form action="{{ route('user.login') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill" style="background-color:rgba(237, 120, 4, 1);border-color:rgba(237, 120, 4, 1)">Login</button>

                <p class="mt-3 text-center">Dont have an account? <a href="{{ url('sign-up') }}" >Register here</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
