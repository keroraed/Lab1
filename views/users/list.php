<h2 class="mb-4">All Users</h2>

<a href="index.php?page=users&action=create" class="btn btn-success mb-3">+ Add New User</a>

<?php if (empty($users)): ?>
    <div class="alert alert-info">No users found.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Skills</th>
                <th>Username</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $i => $user): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td>
                    <?php if ($user->image): ?>
                        <img src="uploads/<?= htmlspecialchars($user->image) ?>"
                             alt="photo" width="40" height="40"
                             style="border-radius:50%;object-fit:cover;">
                    <?php else: ?>
                        <span class="text-muted">—</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($user->first_name) ?></td>
                <td><?= htmlspecialchars($user->last_name) ?></td>
                <td><?= htmlspecialchars($user->country) ?></td>
                <td><?= htmlspecialchars($user->gender) ?></td>
                <td><?= htmlspecialchars(str_replace('-', ', ', $user->skills)) ?></td>
                <td><?= htmlspecialchars($user->username) ?></td>
                <td><?= htmlspecialchars($user->department) ?></td>
                <td>
                    <a href="index.php?page=users&action=view&id=<?= $user->id ?>"
                       class="btn btn-info btn-sm">View</a>
                    <a href="index.php?page=users&action=edit&id=<?= $user->id ?>"
                       class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?page=users&action=delete&id=<?= $user->id ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
