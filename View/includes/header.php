<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Becode - Boiler plate MVC</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8; /* Light gray background */
        }

        header {
            background-color: #ff69b4; /* Pink header background */
            padding: 10px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        li {
            display: inline;
        }

        a {
            text-decoration: none;
            color: #fff; /* White link color */
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            padding-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="index.php?page=articles-index">Articles</a>
            </li>
        </ul>
    </header>