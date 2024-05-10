from datetime import datetime, timedelta
import json
from flask import Flask, request, jsonify , session
import requests
import os
import database_controller as conn
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

app.secret_key = os.urandom(24)

@app.route('/login', methods=['POST'])
def validate_login():
    login_data = request.json
    
    try:
        username = login_data.get('username')
        password = login_data.get('password')

        print("username:", username)
        
        result = conn.validate_user({
            "username": username,
            "password": password
        })

        if result.get("result") == "success":
            # Create a response with a success message
            response = jsonify({"success": True, "message": "User login successful"})
            
            return response
        else:
            return jsonify({"success": False, "message": "Failed to login user"})

    except Exception as e:
        # Handle any errors
        print("Error:", e)
        return jsonify({"error": str(e)}), 400

    return conn.validate_user(login_data["credentials"])

@app.route('/register', methods=['POST'])
def validate_signup():
    register_data = request.json

    print("Received form data:", register_data)

    try:
        firstname = register_data.get('firstname')
        lastname = register_data.get('lastname')
        email = register_data.get('email')
        username = register_data.get('username')
        password = register_data.get('password')

        print("firstname:", firstname)

        result = conn.register_user({
            "firstName": firstname,
            "lastName": lastname,
            "email": email,
            "username": username,
            "password": password
        })

        if result.get("result") == "success":
            return jsonify({"success": True, "message": "User registered successfully"})
        else:
            return jsonify({"success": False, "message": "Failed to register user"})

    except Exception as e:
        print("Error:", e)
        return jsonify({"error": str(e)}), 400


if __name__ == '__main__':
    app.run(debug=True)
