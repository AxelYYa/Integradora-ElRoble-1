<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/globalstyles.css')}}">
    <style>
        
        .background-image {
            position: fixed; 
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('js/images/El roble photo1.jpg') }}");
            background-size: cover;  
            background-position: center; 
            background-repeat: no-repeat; 
            filter: blur(8px); 
            z-index: -1; 
        }

        
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="margin: 0;height: 100vh; overflow: hidden; min-height: 100vh;">
    <div class="background-image"></div>
    <div class="container d-flex justify-content-center content">
        <div class="card shadow-lg border-0 rounded" style="width: 100%; max-width: 400px; background-color: #3a3822f7;">
            <div class="card-body">

                <div class="d-flex justify-content-center mb-3">
                    
                    <img src="{{asset('js\images\El roble.jpg') }}" class="img-login" alt="Descripción de la imagen">
                    
                </div>

                <div class="text-center mb-4">
                    <h5>Restablecimiento de contraseña</h5>
                    <h7>Escribe la nueva contraseña de tu cuenta</h7>
                </div>
                
                <form id="loginForm" action="{{ route('password.update') }}" method="post">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    
                    <div class="form-floating mb-3">
                        <input type="text" id="email" name="email" class="form-control" placeholder="name@example.com" required value="{{session('email')}}" readonly>
                        <label for="email">Correo Electrónico</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="name@example.com" required>
                        <label for="password">Nueva Contraseña</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirma tu contraseña" required>
                        <label for="password_confirmation">Confirma tu contraseña</label>
                    </div>
                    
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn" style="background-color: #af6400b3;">Restablecer Contraseña</button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').onsubmit = function(event) {
            const input = document.getElementById('email').value;
            const email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let isValid = false;

                isValid = email.test(input);


            if (!isValid) {
                event.preventDefault();
                document.getElementById('email').classList.add('is-invalid');
            } else {
                document.getElementById('email').classList.remove('is-invalid');
            }
        };
    </script>
    
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>