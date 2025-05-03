<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your appointment Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #C49450;
            margin: 0;
            padding: 0;
            color: #3F2D13;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px 25px;
            background-color: #C49450;
            border-radius: 10px;
            text-align: center;
        }
        .logo {
            width: 120px;
            margin: 0 auto 25px;
        }
        .logo img {
            width: 100%;
            height: auto;
        }
        h2 {
            font-size: 26px;
            color: #3F2D13;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #3F2D13;
            display: inline-block;
            padding-bottom: 5px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 12px 0;
        }
        .label {
            font-weight: bold;
            color: #3F2D13;
        }
        .value {
            color: #3F2D13;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #ffffff;
        }
        .divider {
            width: 60px;
            height: 4px;
            background-color: #3F2D13;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your appointment has been booked</h2>

        <p><span class="label">Date:</span> <span class="value">{{ $calendar_date }}</span></p>
        <div class="divider"></div>

        <div class="footer">
            Thank you for trusting us with your tattoo session!
        </div>
    </div>
</body>
</html>
