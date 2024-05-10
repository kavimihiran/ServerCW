<?php

namespace App\Controllers;

class ExampleController extends BaseController
{
    public function testDatabaseConnection()
    {
        // Load the UserModel
        $userModel = new \App\Models\UserModel();

// Check if the database connection is successful
        if ($userModel->db->simpleQuery('SELECT 1') !== false) {
            echo 'Database connected successfully!';

            // Define the dummy data to be inserted
            $data = [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'johndoe@example.com',
                'username' => 'johndoe',
                'password' => password_hash('secret_password', PASSWORD_DEFAULT), // Hash the password for security
                // Add other fields as needed
            ];

            // Insert the data into the users table using the UserModel
            $userModel->insert($data);

            echo 'Data inserted successfully!';
        } else {
            echo 'Database connection failed!';
        }

    }
    public function test()
    {
        // Load the database library
        $db = \Config\Database::connect();

// Check if the database connection is successful
        if ($db->simpleQuery('SELECT 1') !== false) {
            echo 'Hureeeeeee';
        } else {
            echo 'adsasdas';
        }

    }
}
