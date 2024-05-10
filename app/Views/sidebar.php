<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            display: block;
            color: white;
        }

        .sidebar a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#">Home</a>
    <a href="#">Questions</a>
    <a href="#">Profile</a>
</div>

</body>
</html>
