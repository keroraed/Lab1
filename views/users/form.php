<?php
$isEdit   = isset($user);
$formAction = $isEdit
    ? 'index.php?page=users&action=update'
    : 'index.php?page=users&action=store';

$countries  = ['Egypt', 'India', 'USA', 'UK', 'Canada'];
$allSkills  = ['PHP', 'MySQL', 'J2SE', 'PostgreSQL'];
$departments = ['IT', 'HR', 'Finance', 'Marketing', 'Operations'];
?>

<h2 class="mb-4"><?= $isEdit ? 'Edit User' : 'Add New User' ?></h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?= $formAction ?>" enctype="multipart/form-data"
      onsubmit="return validateForm()">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$form['id'] ?>">
    <?php endif; ?>

    <div class="row g-3">
        <!-- First Name -->
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control"
                   value="<?= htmlspecialchars($form['first_name']) ?>">
        </div>

        <!-- Last Name -->
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control"
                   value="<?= htmlspecialchars($form['last_name']) ?>">
        </div>

        <!-- Address -->
        <div class="col-12">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($form['address']) ?></textarea>
        </div>

        <!-- Country -->
        <div class="col-md-6">
            <label class="form-label">Country</label>
            <select name="country" class="form-select">
                <option value="">-- Select Country --</option>
                <?php foreach ($countries as $c): ?>
                    <option value="<?= $c ?>" <?= $form['country'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Department -->
        <div class="col-md-6">
            <label class="form-label">Department</label>
            <select name="department" class="form-select">
                <option value="">-- Select Department --</option>
                <?php foreach ($departments as $d): ?>
                    <option value="<?= $d ?>" <?= $form['department'] === $d ? 'selected' : '' ?>><?= $d ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Gender -->
        <div class="col-md-6">
            <label class="form-label d-block">Gender</label>
            <?php foreach (['Male', 'Female'] as $g): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender"
                           value="<?= $g ?>" id="gender_<?= $g ?>"
                           <?= $form['gender'] === $g ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender_<?= $g ?>"><?= $g ?></label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Skills -->
        <div class="col-md-6">
            <label class="form-label d-block">Skills</label>
            <?php foreach ($allSkills as $skill): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]"
                           value="<?= $skill ?>" id="skill_<?= $skill ?>"
                           <?= in_array($skill, (array)$form['skills']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="skill_<?= $skill ?>"><?= $skill ?></label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Username -->
        <div class="col-md-6">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control"
                   value="<?= htmlspecialchars($form['username']) ?>">
        </div>

        <!-- Password -->
        <div class="col-md-6">
            <label class="form-label">
                Password <?= $isEdit ? '<small class="text-muted">(leave blank to keep current)</small>' : '' ?>
            </label>
            <input type="password" name="password" class="form-control">
        </div>

        <!-- Profile Image -->
        <div class="col-12">
            <label class="form-label">Profile Image <small class="text-muted">(JPG/PNG, max 2 MB)</small></label>
            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Update User' : 'Add User' ?>
            </button>
            <a href="index.php?page=users" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </div>
</form>

<script>
function validateForm() {
    const nameRegex = /^[a-zA-Z]+$/;
    const passRegex = /^[a-z0-9_]{8}$/;
    const isEdit    = <?= $isEdit ? 'true' : 'false' ?>;

    const firstName  = document.querySelector('[name=first_name]').value.trim();
    const lastName   = document.querySelector('[name=last_name]').value.trim();
    const address    = document.querySelector('[name=address]').value.trim();
    const country    = document.querySelector('[name=country]').value;
    const department = document.querySelector('[name=department]').value;
    const genders    = document.querySelectorAll('[name=gender]:checked');
    const skills     = document.querySelectorAll('[name="skills[]"]:checked');
    const username   = document.querySelector('[name=username]').value.trim();
    const password   = document.querySelector('[name=password]').value.trim();

    if (!nameRegex.test(firstName))          { alert('First name must contain letters only.');  return false; }
    if (!nameRegex.test(lastName))           { alert('Last name must contain letters only.');   return false; }
    if (!address)                            { alert('Address is required.');                   return false; }
    if (!country)                            { alert('Please select a country.');               return false; }
    if (!department)                         { alert('Please select a department.');            return false; }
    if (genders.length === 0)               { alert('Please select a gender.');               return false; }
    if (skills.length === 0)                { alert('Please select at least one skill.');      return false; }
    if (!username)                           { alert('Username is required.');                  return false; }
    if (!isEdit && !passRegex.test(password))
                                             { alert('Password must be exactly 8 characters (lowercase, digits, underscore).'); return false; }
    if (isEdit && password !== '' && !passRegex.test(password))
                                             { alert('Password must be exactly 8 characters (lowercase, digits, underscore).'); return false; }
    return true;
}
</script>
