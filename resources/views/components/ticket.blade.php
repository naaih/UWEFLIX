<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket {
            width: 300px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            margin: auto;
        }

        .ticket h1 {
            text-align: center;
            margin-top: 0;
            color: #000000;
        }

        .ticket p {
            margin: 10px 0;
            color: #555;
        }

        .ticket hr {
            border: none;
            border-top: 1px solid #000000;
            margin: 15px 0;
        }

        .ticket .footer {
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h1>Your Ticket Details:</h1>
        <p><strong>Movie Name:</strong> {{ $show->movie->title }}</p>
        <p><strong>Time:</strong> {{ $show->date->toDayDateTimeString() }}</p>
        <p><strong>Seat Number:</strong> {{ $seatNumber }}</p>
        <p><strong>Price:</strong> {{ $show->price }} {{ config('app.currency') }}</p>
        <hr>
        <p class="footer">Thank you for using UWEFlix</p>
    </div>
</body>

</html>