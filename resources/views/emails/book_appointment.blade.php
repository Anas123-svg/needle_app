<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointment Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f2eb;
            margin: 0;
            padding: 0;
            color: #3F2D13;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff8f0;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            color: #3F2D13;
            margin-bottom: 10px;
        }
        .divider {
            width: 60px;
            height: 4px;
            background-color: #C49450;
            margin: 20px auto;
            border-radius: 3px;
        }
        .details {
            font-size: 18px;
            margin: 25px 0;
            line-height: 1.7;
        }
        .label {
            font-weight: bold;
            color: #3F2D13;
        }
        .footer {
            margin-top: 35px;
            font-size: 15px;
            color: #7a5a3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Your Appointment is Confirmed</div>
        <div class="divider"></div>

        <div class="details">
            <p><span class="label">Day:</span> {{ $day }}</p>
            <p><span class="label">Month:</span> {{ $month }}</p>
            <p><span class="label">Year:</span> {{ $year }}</p>
        </div>

        <div class="divider"></div>
        
        <div class="footer">
            Thank you for trusting us with your tattoo session.<br>
            We look forward to seeing you!
        </div>
    </div>
</body>
</html>
