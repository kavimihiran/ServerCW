<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            height: 60px;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 550px;
            padding: 14px 16px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .sidebar .logo {
            margin-right: auto;
        }

        .navbar .search-wrapper {
            margin-left: 200px;
            display: flex;
            align-items: center;
        }

        .navbar .search-icon {
            color: white;
            margin-right: 10px;
        }

        .navbar .search-bar {
            width: 500px;
            padding: 10px;
            margin-right: 150px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            display: block;
            text-align: center;
            color: white;
            margin-top: 40px;
        }
        .sidebar img {
            margin-top: -70px;
            margin-bottom: -60px;
            height: 200px;
}

        .sidebar a:hover {
            background-color: #555;
            width: 180px;
        }
        .content-container {
            margin-left: 200px;
            margin-top: 0px;
            padding: 20px;
            width: calc(100% - 200px);
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="search-wrapper">
        <form action="/search" method="GET">
        <input type="text" class="search-bar" name="query" placeholder="Search by tag...">
        <button type="submit">Search</button>
    </form>
    </div>
</div>

<div class="sidebar">
    <img src="/images/logo.png" alt="Your Logo">
    <a href="/questions">Home</a>
    <a href="/myquestions">Questions</a>
    <a href="/profile">Profile</a>
</div>

<div class="content-container">
