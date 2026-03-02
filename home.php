<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Registration Form</h2>

    <form action="save.php" method="post">
        <p>
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required>
        </p>

        <p>
            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required>
        </p>

        <p>
            <label for="address">Address:</label><br>
            <textarea id="address" name="address" rows="4" cols="30" required></textarea>
        </p>

        <p>
            <label for="country">Country:</label><br>
            <select id="country" name="country" required>
                <option value="">Select Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="Canada">Canada</option>
            </select>
        </p>

        <p>
            Gender:<br>
            <label><input type="radio" name="gender" value="Male" required> Male</label>
            <label><input type="radio" name="gender" value="Female" required> Female</label>
        </p>

        <p>
            Skills:<br>
            <label><input type="checkbox" name="skills[]" value="PHP"> PHP</label>
            <label><input type="checkbox" name="skills[]" value="MySQL"> MySQL</label>
            <label><input type="checkbox" name="skills[]" value="J2SE"> J2SE</label>
            <label><input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL</label>
        </p>

        <p>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required>
        </p>

        <p>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </p>

        <p>
            <label for="department">Department:</label><br>
            <input type="text" id="department" name="department" placeholder="OpenSource" required>
        </p>

        <p>
            Verification Code: <strong>Sh68Sa</strong>
        </p>

        <p>
            <label for="verification_input">Please enter the code shown above:</label><br>
            <input type="text" id="verification_input" name="verification_input" required>
        </p>

        <input type="hidden" name="verification_code" value="Sh68Sa">

        <p>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </p>
    </form>
</body>
</html>