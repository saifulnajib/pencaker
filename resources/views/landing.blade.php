<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page dengan Posisi Tengah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 20px;
        }
        
        #gradient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(-45deg, #a8d8ea, #aa96da, #fcbad3, #ffffd2, #96f2a2ff);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        .landing-container {
            text-align: center;
            padding: 2.5rem;
            max-width: 650px;
            width: 100%;
            height: 80%;
            max-height: 700px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #a8d8ea, #aa96da);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        h1 {
            color: #5a6b7a;
            font-weight: 300;
            margin-bottom: 1.5rem;
            font-size: 2.2rem;
        }
        
        .description {
            color: #6a7a89;
            font-size: 1.15rem;
            line-height: 1.7;
            margin-bottom: 2rem;
        }
        
        .login-btn {
            background: linear-gradient(135deg, #a8d8ea, #aa96da);
            color: white;
            border: none;
            padding: 14px 35px;
            font-size: 1.15rem;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 6px 20px rgba(168, 216, 234, 0.4);
            font-weight: 500;
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(168, 216, 234, 0.5);
            color: white;
        }
        
        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #aa96da, #a8d8ea);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }
        
        .login-btn:hover::before {
            opacity: 1;
        }
        
        .features {
            margin-top: 2rem;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .feature {
            flex: 1;
            min-width: 130px;
            margin: 10px;
            padding: 15px 10px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }
        
        .feature:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
        
        .feature i {
            font-size: 2rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #a8d8ea, #aa96da);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .feature p {
            color: #6a7a89;
            font-size: 0.9rem;
            margin: 0;
        }
        
        footer {
            margin-top: auto;
            padding-top: 1.5rem;
            color: #8a99a8;
            font-size: 0.9rem;
        }
        
        /* Animasi untuk logo */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .logo {
            animation: float 5s ease-in-out infinite;
        }
        
        /* Animasi untuk gradien background */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        /* Efek partikel halus */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.5;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            animation: floatParticle 15s infinite linear;
        }
        
        @keyframes floatParticle {
            0% {
                transform: translateY(0) translateX(0);
            }
            25% {
                transform: translateY(-20px) translateX(10px);
            }
            50% {
                transform: translateY(-40px) translateX(0);
            }
            75% {
                transform: translateY(-20px) translateX(-10px);
            }
            100% {
                transform: translateY(0) translateX(0);
            }
        }

        /* Media queries untuk responsivitas */
        @media (max-height: 700px) {
            .landing-container {
                height: auto;
                max-height: none;
                margin: 20px 0;
            }
            
            .content-wrapper {
                padding: 1rem 0;
            }
        }
        
        @media (max-width: 768px) {
            .landing-container {
                padding: 2rem 1.5rem;
                height: auto;
                max-height: none;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .feature {
                min-width: 110px;
                padding: 12px 8px;
            }
            
            .feature i {
                font-size: 1.7rem;
            }
        }
        
        @media (max-width: 480px) {
            .landing-container {
                padding: 1.5rem 1rem;
            }
            
            .logo {
                font-size: 2.8rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .features {
                margin-top: 1.5rem;
            }
            
            .feature {
                min-width: 100px;
                margin: 5px;
                padding: 10px 5px;
            }
            
            .feature i {
                font-size: 1.5rem;
            }
            
            .feature p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div id="gradient-bg"></div>
    <div class="particles" id="particles-container"></div>
    
    <div class="landing-container">
        <div class="content-wrapper">
            <div class="logo">
                <i class="fas fa-cloud"></i>
            </div>
            <h1>Selamat Datang di Aplikasi {{$name}}</h1>
            <p class="description">
                {{$deskripsi}}
            </p>
            <a href="{{route('login')}}" class="btn login-btn">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Akun
            </a>
            
            <div class="features">
                <div class="feature">
                    <i class="fas fa-lock"></i>
                    <p>Keamanan Terjamin</p>
                </div>
                <div class="feature">
                    <i class="fas fa-bolt"></i>
                    <p>Cepat & Responsif</p>
                </div>
                <div class="feature">
                    <i class="fas fa-heart"></i>
                    <p>Ramah Pengguna</p>
                </div>
            </div>
        </div>
        
        <footer>
            &copy; {{$tahun.' '.$copyright}}
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Membuat partikel halus untuk efek tambahan
        function createParticles() {
            const container = document.getElementById('particles-container');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Ukuran dan posisi acak
                const size = Math.random() * 60 + 20;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                
                // Animasi dengan durasi acak
                particle.style.animationDuration = `${Math.random() * 20 + 10}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                container.appendChild(particle);
            }
        }
        
        // Panggil fungsi untuk membuat partikel
        createParticles();
    </script>
</body>
</html>