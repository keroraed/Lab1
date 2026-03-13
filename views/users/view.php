<h2 class="mb-4">User Detail</h2>

<div class="card" style="max-width:600px;">
    <div class="card-body">
        <?php if ($user->image): ?>
            <div class="mb-3 text-center">
                <img src="uploads/<?= htmlspecialchars($user->image) ?>"
                     alt="profile" width="150" height="150"
                     style="border-radius:50%;object-fit:cover;border:3px solid #dee2e6;">
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr><th>First Name</th>  <td><?= htmlspecialchars($user->first_name) ?></td></tr>
            <tr><th>Last Name</th>   <td><?= htmlspecialchars($user->last_name) ?></td></tr>
            <tr><th>Address</th>     <td><?= htmlspecialchars($user->address) ?></td></tr>
            <tr><th>Country</th>     <td><?= htmlspecialchars($user->country) ?></td></tr>
            <tr><th>Gender</th>      <td><?= htmlspecialchars($user->gender) ?></td></tr>
            <tr><th>Skills</th>      <td><?= htmlspecialchars(str_replace('-', ', ', $user->skills)) ?></td></tr>
            <tr><th>Username</th>    <td><?= htmlspecialchars($user->username) ?></td></tr>
            <tr><th>Department</th>  <td><?= htmlspecialchars($user->department) ?></td></tr>
        </table>

        <div class="d-flex gap-2">
            <a href="index.php?page=users&action=edit&id=<?= $user->id ?>" class="btn btn-warning">Edit</a>
            <a href="index.php?page=users" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
