<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Apple</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .login-container {
            text-align: center;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .apple-btn {
            display: inline-block;
            padding: 10px 20px;
            background: black;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .apple-btn:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login with Apple</h1>
        <p>Click the button below to sign in with your Apple account.</p>
        <a href="{{ route('login.apple') }}" class="apple-btn">Sign in with Apple</a>
    </div>
</body>
</html>
