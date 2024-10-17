<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
            text-align: center;
        }
        .code {
            display: inline-block;
            padding: 10px 20px;
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 4px;
            margin: 20px 0;
            
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #999;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset for Needle</h1>
        <p>Your password reset code is:</p>
        <div class="code">{{ $code }}</div>
        <p>If you did not request this code, please ignore this email.</p>
        <div class="footer">
            <p>Needle | <a href="https://yourwebsite.com">Visit our website</a></p>
        </div>
    </div>
</body>
</html>
