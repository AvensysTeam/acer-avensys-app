<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User LoggedIn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>User LoggedIn</h1>
    <p>A User Has Just LoggedIn!</p>
    <p>Here is your user identification data:</p>
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Phone: {{ $user->phone }}</li>
        <li>LoggedIn at: {{ now()->format('h:i D-M-Y')}}</li>
    </ul>
    <a href="">Visit his profile</a>
</body>
</html>




