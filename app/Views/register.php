<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
        .register-container {
            background-color: #008CBA;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
            width: 300px;
            height: 550px;
            text-align: center;
            margin-left: 50px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
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
    <div class="register-container">
        <h2 style="color: #444444;">Sign Up</h2>
        <form id="register-form">
            <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
            <input type="text" id="lastname" name="lastname" placeholder="Last Name">
            <input type="email" id="email" name="email" placeholder="Email">
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="password2" name="password2" placeholder="Confirm Password"><br>
            <input type="submit" value="Sign Up">
        </form>
        <p id="registration-message" style="color: inherit;"></p>
        <p>Already have an account? <a href="#" id="login-link" style="color: darkblue;">Login</a></p>
    </div>
    <script>
        $(document).ready(function() {
            var RegisterModel = Backbone.Model.extend({
                urlRoot: "http://localhost:5000/register"
            });

            var RegisterForm = Backbone.View.extend({
                el: '#register-form',
                events: {
                    'submit': 'submitForm'
                },
                submitForm: function(e) {
                    e.preventDefault();
                    var formData = {
                        firstname: this.$('#firstname').val(),
                        lastname: this.$('#lastname').val(),
                        email: this.$('#email').val(),
                        username: this.$('#username').val(),
                        password: this.$('#password').val()
                    };
                    var model = new RegisterModel(formData);
                    model.save(null, {
                        success: function(model, response) {
                            if (response.success) {
                                $('#registration-message').text('Registration successful').css('color', 'darkgreen');
                                alert('Registration successful!');
                                window.location.replace('/user/login');
                            } else {
                                $('#registration-message').text('Registration failed: ' + response.message).css('color', 'red');
                            }
                        },
                        error: function(model, xhr, options) {
                            $('#registration-message').text('Error occurred while registering').css('color', 'red');
                        }
                    });
                }
            });
            var registerFormView = new RegisterForm();

            $('#login-link').click(function(e) {
                e.preventDefault();
                // Redirect to login page
                window.location.replace("<?php echo base_url('User/login'); ?>");
            });
        });
    </script>
</body>
</html>
