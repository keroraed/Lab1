<?php

class UserController extends Controller
{
    private UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function index(): void
    {
        $this->requireAuth();
        $users = $this->repo->findAll();
        $this->render('users/list', ['users' => $users]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $errors = [];
        $form   = $this->emptyForm();
        $this->render('users/form', compact('errors', 'form'));
    }

    public function store(): void
    {
        $this->requireAuth();

        [$form, $errors] = $this->validateForm();

        if (empty($errors)) {
            $imageName = $this->handleImageUpload();
            $this->repo->create([
                'first_name' => $form['first_name'],
                'last_name'  => $form['last_name'],
                'address'    => $form['address'],
                'country'    => $form['country'],
                'gender'     => $form['gender'],
                'skills'     => implode('-', $form['skills']),
                'username'   => $form['username'],
                'password'   => $form['password'],
                'department' => $form['department'],
                'image'      => $imageName,
            ]);
            $this->redirect('index.php?page=users');
        }

        $this->render('users/form', compact('errors', 'form'));
    }

    public function show(): void
    {
        $this->requireAuth();
        $id   = (int)($_GET['id'] ?? 0);
        $user = $this->repo->findById($id);
        $this->abortUnless($user !== null, 'index.php?page=users');
        $this->render('users/view', ['user' => $user]);
    }

    public function edit(): void
    {
        $this->requireAuth();
        $id   = (int)($_GET['id'] ?? 0);
        $user = $this->repo->findById($id);
        $this->abortUnless($user !== null, 'index.php?page=users');

        $errors = [];
        $form   = [
            'id'         => $user->id,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'address'    => $user->address,
            'country'    => $user->country,
            'gender'     => $user->gender,
            'skills'     => $user->skillsArray(),
            'username'   => $user->username,
            'password'   => '',
            'department' => $user->department,
        ];

        $this->render('users/form', compact('errors', 'form', 'user'));
    }

    public function update(): void
    {
        $this->requireAuth();

        $id   = (int)($_POST['id'] ?? 0);
        $user = $this->repo->findById($id);
        $this->abortUnless($user !== null, 'index.php?page=users');

        [$form, $errors] = $this->validateForm(true);
        $form['id'] = $id;

        if (empty($errors)) {
            $this->repo->update($id, [
                'first_name' => $form['first_name'],
                'last_name'  => $form['last_name'],
                'address'    => $form['address'],
                'country'    => $form['country'],
                'gender'     => $form['gender'],
                'skills'     => implode('-', $form['skills']),
                'username'   => $form['username'],
                'password'   => $form['password'],
                'department' => $form['department'],
            ]);
            $this->redirect('index.php?page=users');
        }

        $this->render('users/form', compact('errors', 'form', 'user'));
    }

    public function delete(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        $this->repo->delete($id);
        $this->redirect('index.php?page=users');
    }

    private function emptyForm(): array
    {
        return [
            'id'         => null,
            'first_name' => '',
            'last_name'  => '',
            'address'    => '',
            'country'    => '',
            'gender'     => '',
            'skills'     => [],
            'username'   => '',
            'password'   => '',
            'department' => '',
        ];
    }

    private function validateForm(bool $isEdit = false): array
    {
        $form = [
            'id'         => (int)($_POST['id'] ?? 0),
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name'  => trim($_POST['last_name']  ?? ''),
            'address'    => trim($_POST['address']    ?? ''),
            'country'    => trim($_POST['country']    ?? ''),
            'gender'     => trim($_POST['gender']     ?? ''),
            'skills'     => $_POST['skills']          ?? [],
            'username'   => trim($_POST['username']   ?? ''),
            'password'   => trim($_POST['password']   ?? ''),
            'department' => trim($_POST['department'] ?? ''),
        ];

        $errors = [];

        if (!preg_match('/^[a-zA-Z]+$/', $form['first_name'])) {
            $errors[] = 'First name must contain letters only.';
        }
        if (!preg_match('/^[a-zA-Z]+$/', $form['last_name'])) {
            $errors[] = 'Last name must contain letters only.';
        }
        if ($form['address'] === '') {
            $errors[] = 'Address is required.';
        }
        if ($form['country'] === '') {
            $errors[] = 'Please select a country.';
        }
        if ($form['gender'] === '') {
            $errors[] = 'Please select a gender.';
        }
        if (empty($form['skills'])) {
            $errors[] = 'Please select at least one skill.';
        }
        if ($form['username'] === '') {
            $errors[] = 'Username is required.';
        }
        if (!$isEdit && !preg_match('/^[a-z0-9_]{8}$/', $form['password'])) {
            $errors[] = 'Password must be exactly 8 characters (lowercase letters, digits, underscore).';
        }
        if ($isEdit && $form['password'] !== '' && !preg_match('/^[a-z0-9_]{8}$/', $form['password'])) {
            $errors[] = 'Password must be exactly 8 characters (lowercase letters, digits, underscore).';
        }
        if ($form['department'] === '') {
            $errors[] = 'Department is required.';
        }

        return [$form, $errors];
    }

    private function handleImageUpload(): string
    {
        if (empty($_FILES['image']['name'])) {
            return '';
        }

        $config    = require __DIR__ . '/../config/config.php';
        $uploadDir = $config['app']['upload_dir'];
        $maxSize   = $config['app']['max_file_size'];
        $allowed   = ['image/jpeg', 'image/png'];

        $file = $_FILES['image'];

        if (!in_array($file['type'], $allowed, true) || $file['size'] > $maxSize) {
            return '';
        }

        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $uploadDir . $filename);

        return $filename;
    }
}
