<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Hash;
use App\Models\UserModel;

class Auth extends Controller
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }


    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => ['required' => 'Your full name is required']
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'You must enter a valid email',
                    'is_unique' => 'Email already taken'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have at least 5 characters',
                    'max_length' => 'Password must not exceed 12 characters'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm password is required',
                    'matches' => 'Confirm password must match the password'
                ]
            ]
        ]);

        if (!$validation) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => Hash::make($this->request->getPost('password')),
        ];

        $userModel->save($data);

        return redirect()->to('/')->with('success', 'Registered successfully! Please log in.');
    }

    public function check()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Enter a valid email address'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 5 characters',
                    'max_length' => 'Password must not exceed 12 characters'
                ]
            ]
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            session()->setFlashdata('fail', 'Invalid email or password');
            return redirect()->to('/')->withInput();
        }

        // Save user info in session
        session()->set([
            'loggedUser' => $user['id'],
            'name' => $user['name'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/blog/view')->with('success', 'login successfully!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'You have been logged out.');
    }
}
