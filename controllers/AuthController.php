<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if (Session::isLoggedIn()) {
            $this->redirect('index.php?page=dashboard');
        }

        $error = '';

        if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $repo = new UserRepository();
            $user = $repo->findByUsername($username);

            if ($user && password_verify($password, $user->password)) {
                Session::set('user',    $user->username);
                Session::set('name',    $user->first_name);
                Session::set('user_id', $user->id);
                $this->redirect('index.php?page=dashboard');
            }

            $error = 'Invalid username or password.';
        }

        $this->render('auth/login', ['error' => $error]);
    }

    public function dashboard(): void
    {
        $this->requireAuth();
        $this->render('dashboard');
    }

    public function logout(): void
    {
        $this->requireAuth();
        Session::destroy();
        $this->redirect('index.php?page=login');
    }
}
