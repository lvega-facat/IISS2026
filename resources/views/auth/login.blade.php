<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HumanCore</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #b0c4e8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            width: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: -120px;
            position: relative;
            z-index: 10;
        }

        .logo img {
            max-width: 550px;
            height: auto;
        }

        .login-card {
            background-color: #2a4f8a;
            border-radius: 25px;
            padding: 50px 60px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: none;
            border-radius: 20px;
            background-color: white;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus {
            outline: none;
        }

        .forgot-password {
            text-align: center;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: #d4dce6;
            font-size: 13px;
            text-decoration: none;
        }

        .login-button {
            width: 140px;
            padding: 12px 30px;
            background-color: #b0c4e8;
            color: #1a1a1a;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .login-container {
                gap: 5px;
            }

            .logo img {
                max-width: 350px;
            }

            .logo {
                margin-bottom: -80px;
            }

            .login-card {
                padding: 45px 50px;
                max-width: 100%;
                border-radius: 20px;
            }

            .form-group label {
                font-size: 15px;
            }

            .form-group input {
                padding: 12px 16px;
                font-size: 14px;
            }

            .login-button {
                width: 120px;
                padding: 10px 25px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .logo img {
                max-width: 280px;
            }

            .logo {
                margin-bottom: -60px;
            }

            .login-card {
                padding: 35px 25px;
                max-width: 100%;
                border-radius: 18px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .form-group input {
                padding: 12px 15px;
                font-size: 13px;
                border-radius: 18px;
            }

            .forgot-password {
                margin-bottom: 20px;
            }

            .forgot-password a {
                font-size: 12px;
            }

            .login-button {
                width: 110px;
                padding: 10px 20px;
                font-size: 13px;
                border-radius: 4px;
            }
        }

        @media (max-width: 320px) {
            .logo img {
                max-width: 200px;
            }

            .login-card {
                padding: 30px 20px;
            }

            .form-group input {
                padding: 10px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="HumanCore">
        </div>

        <form class="login-card">
            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="number" id="cedula" name="cedula" placeholder="">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="">
            </div>

            <div class="forgot-password">
                <a href="#">¿Contraseña olvidada?</a>
            </div>

            <button type="submit" class="login-button">Ingresar</button>
        </form>
    </div>
</body>
</html>
