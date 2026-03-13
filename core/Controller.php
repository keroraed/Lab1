<?php

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        include __DIR__ . '/../views/layouts/header.php';
        include $viewFile;
        include __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function abortUnless(bool $condition, string $redirectTo = 'index.php'): void
    {
        if (!$condition) {
            $this->redirect($redirectTo);
        }
    }

    protected function requireAuth(): void
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('index.php?page=login');
        }
    }
}
