<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PKS Monitoring</title>
    <style>
        body {
            margin:     0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #122954ff, #4573c2ff);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            width: 360px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #000;
            font-weight: 600;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            display: block;
        }

        .forgot-password {
            text-align: left;
            margin-top: 12 px;
        }   

        .forgot-password a {
            color: #017cffff;
            text-decoration: none;
            font-size: 13px;
            transition: 0.3s; 
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="font-weight: bold;">Welcome!</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama" required>
            <input type="password" name="password" placeholder="Password" required>
            <p class="forgot-password">
                <a href="/forgot-password">Lupa password?</a>
            </p>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
