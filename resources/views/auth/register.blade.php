<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pencaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .register-form {
            flex: 1;
            padding: 20px;
        }
        .register-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-image img {
            max-width: 80%;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-form">
            <h2 class="text-dark fw-bold">PENCAKER</h2>
            <p>Pemerintah Kota Tanjungpinang</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Daftar</button>
                <div class="text-center mt-2">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a></p>
                </div>
            </form>
        </div>
        <div class="register-image">
            <img src="/images/reg.jfif" alt="Register Illustration">
        </div>
    </div>
</body>
</html>
