<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public $session;
    public function __construct()
    {
        $this->session = session();
    }
    public function login()
    {
        if ($this->request->getMethod() === 'post') {

            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            $postData = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/login');

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            curl_close($ch);

            if ($response === false) {
                return $this->response->setJSON(['success' => false, 'message' => 'Error connecting to the API']);
            }

            // Decode the JSON response
            $responseData = json_decode($response, true);

            // Check if login was successful
            if (isset($responseData['success']) && $responseData['success'] === true) {
                // Set user data in session
                $sessionData = [
                    'username' => $data['username'],
                    'logged_in' => true,
                ];
                $this->session->set($sessionData);
                return $this->response->setJSON(['success' => true]);

            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Invalid username or password']);
            }
        }

        return view('login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $user = new UserModel();
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            if ($user->save($data)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        }
        return view('register');
    }
    public function logout()
    {
        return view('profile');
    }
}
