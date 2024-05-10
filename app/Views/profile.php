<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile Page</title>
    <style>
        .logout-button {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #005f80;
        }
    </style>
</head>
<body>

    <button class="logout-button" onclick="logout()">Logout</button>

    <script>
        function logout() {
            window . location . replace("/user/login");
        }
    </script>
</body>
</html>
