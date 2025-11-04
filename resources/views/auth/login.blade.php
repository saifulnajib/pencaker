<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pencaker</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .login-form {
            flex: 1;
            padding: 20px;
        }
        .login-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-image img {
            max-width: 80%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2 class="text-dark fw-bold">PENCAKER</h2>
            <p>Pemerintah Kota Tanjungpinang</p>
            
            @if(session('success'))
                <script>
                    Swal.fire("Sukses!", "{{ session('success') }}", "success");
                </script>
            @endif
            @if(session('error'))
                <script>
                    Swal.fire("Gagal!", "{{ session('error') }}", "error");
                </script>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Log In</button>
                <!-- <div class="text-center mt-2">
                    <a href="#" class="text-decoration-none">Forgot Password?</a>
                </div> -->
                <!-- <div class="text-center mt-3">
                    <p>Belum punya akun? <a href="{{ route('register') }}" class="text-success">Daftar di sini</a></p>
                </div> -->
            </form>
        </div>
        <div class="login-image">
            <img src="{{asset('login_asset/images/fair.png')}}" alt="User Image">
        </div>
    </div>
</body>
</html>
