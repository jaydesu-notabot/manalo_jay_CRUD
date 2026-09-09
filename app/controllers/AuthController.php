<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $message = $_SESSION['auth_message'] ?? null;
        unset($_SESSION['auth_message']);
        $this->call->view('login', compact('message'));
    }

    public function authenticate()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = trim((string) ($_POST['username'] ?? ''));
        $password = trim((string) ($_POST['password'] ?? ''));
        if ($username === 'admin' && $password === 'admin') {
            session_regenerate_id(true);
            $_SESSION['authenticated'] = true;
            redirect('/products');
            return;
        }

        $_SESSION['auth_message'] = 'Invalid username or password.';
        redirect('/login');
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();
        redirect('/login');
    }
}
