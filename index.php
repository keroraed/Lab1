<?php

declare(strict_types=1);

require_once __DIR__ . '/core/Session.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/UserController.php';

Session::start();

$router = new Router();
$auth   = new AuthController();
$users  = new UserController();

$router->add('login',     '', [$auth,  'login']);
$router->add('logout',    '', [$auth,  'logout']);
$router->add('dashboard', '', [$auth,  'dashboard']);

$router->add('users', '',        [$users, 'index']);
$router->add('users', 'create',  [$users, 'create']);
$router->add('users', 'store',   [$users, 'store']);
$router->add('users', 'view',    [$users, 'show']);
$router->add('users', 'edit',    [$users, 'edit']);
$router->add('users', 'update',  [$users, 'update']);
$router->add('users', 'delete',  [$users, 'delete']);

$router->dispatch();
