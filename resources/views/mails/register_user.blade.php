<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Service</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

    <table style="max-width: 800px;height: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <tr>
            <td style="background-color: #4CAF50; color: #ffffff; text-align: center; padding: 20px;">
                <h1 style="margin: 0; font-size: 24px;">Welcome, {{ $user->name }}!</h1>
            </td>
        </tr>

        <!-- Body Content -->
        <tr>
            <td style="padding: 20px; text-align: left;">
                <p style="margin: 0 0 10px; font-size: 16px; line-height: 1.5;">
                    Thank you for registering with us. We're thrilled to have you on board! Below are your registration details:
                </p>
                <p style="margin: 0; font-size: 16px; line-height: 1.5;">
                    <strong>Name:</strong> {{ $user->name }}<br>
                    <strong>Email:</strong> {{ $user->email }}
                </p>
                <p style="margin: 20px 0 0; font-size: 16px; line-height: 1.5;">
                    If you have any questions or need assistance, feel free to reach out to us at <a href="mailto:support@example.com" style="color: #4CAF50; text-decoration: none;">support@example.com</a>.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f4f4f4; text-align: center; padding: 15px; font-size: 14px; color: #555;">
                <p style="margin: 0;">&copy; 2025 Your Company. All rights reserved.</p>
                <p style="margin: 5px 0 0;">
                    <a href="#" style="color: #4CAF50; text-decoration: none;">Privacy Policy</a> |
                    <a href="#" style="color: #4CAF50; text-decoration: none;">Terms of Service</a>
                </p>
            </td>
        </tr>
    </table>

</body>
</html>
