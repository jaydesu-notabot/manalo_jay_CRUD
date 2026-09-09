<?php

class ProductAuthMiddleware
{
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['authenticated'])) {
            return $next();
        }

        $_SESSION['auth_message'] = 'Please sign in to manage products.';
        redirect('/login');
        return;
    }
}
