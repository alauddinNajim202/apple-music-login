<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Apple Music</title>
    <script src="https://js-cdn.music.apple.com/musickit/v1/musickit.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .apple-button {
            display: inline-flex;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .apple-button img {
            width: 20px;
            margin-right: 10px;
        }
        .apple-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login with Apple Music</h1>
        <p>Click the button below to sign in with your Apple ID.</p>
        <button id="loginButton" class="apple-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple Logo">
            Login with Apple Music
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const developerToken = await fetch('/auth/apple-music')
                .then(response => response.json())
                .then(data => data.developerToken);

            MusicKit.configure({
                developerToken: developerToken,
                app: {
                    name: 'Your App Name',
                    build: '1.0.0',
                },
            });

            const music = MusicKit.getInstance();

            document.getElementById('loginButton').addEventListener('click', async () => {
                try {
                    const userToken = await music.authorize();
                    console.log('User Token:', userToken);

                    // Send the user token to your backend
                    fetch('/auth/apple-music/callback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ userToken }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server Response:', data);
                        alert('Logged in successfully!');
                    });
                } catch (error) {
                    console.error('Error during authorization:', error);
                }
            });
        });
    </script>
</body>
</html>
