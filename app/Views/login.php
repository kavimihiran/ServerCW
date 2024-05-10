<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url('/images/background.png');
            background-size: cover;
            background-position: center;
            margin: 50;
            padding: 50;
            display: flex;
            justify-content: right;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #008CBA;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
            width: 300px;
            height: 300px;
            text-align: center;
            margin-left: 50px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #444444;
            color: whitesmoke;
            border: none;
            border-radius: 3px;
            padding: 10px;
            width: 100%;
            text-decoration-color: black;
            cursor: pointer;
            margin-top: 40px;
        }

        input[type="submit"]:hover {
            background-color: black;
            color: whitesmoke;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="color: #444444;">Login</h2>
        <form id="login-form">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <p id="login-message" style="color: red;"></p>
        <p>Don't have an account? <a href="/user/register" id="signup-link" style="color: darkblue;">Sign Up</a></p>
    </div>
    <script>
        $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();
            console.log("Form data:", formData);
            var registerData = {};

            formData.forEach(function(field) {
            registerData[field.name] = field.value;
            });
            console.log('register data', registerData);
            $.ajax({
                type: 'POST',
                url: '/user/login',
                data: registerData,
                success: function(response) {
                    if (response.success) {
                        $('#login-message').text('Login successful').css('color', 'darkgreen');
                        alert('Login successful!');
                        window . location . replace('/questions');
                    } else {
                        $('#login-message').text('Invalid username or password').css('color', 'red');
                    }
                },
                error: function(xhr, status, error) {
                    $('#login-message').text('Error occurred while logging in').css('color', 'red');
                }
            });
        });
    });
    </script>
</body>
</html>
