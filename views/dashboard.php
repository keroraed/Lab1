<div class="text-center py-5">
    <h1>Dashboard</h1>
    <p class="lead">Welcome, <strong><?= htmlspecialchars(Session::get('name')) ?></strong>!
       Logged in as <em><?= htmlspecialchars(Session::get('user')) ?></em>.</p>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="index.php?page=users" class="btn btn-primary">View Users</a>
        <a href="index.php?page=users&action=create" class="btn btn-success">Add New User</a>
        <a href="index.php?page=logout" class="btn btn-danger">Logout</a>
    </div>
</div>
