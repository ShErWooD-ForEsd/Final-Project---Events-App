<h2>Admin Login</h2>

<?php if (!empty($login_error)): ?>
    <div></div>
<?php endif; ?>

<form method="post">

        <label>Username</label>
        <input type="text" name="username"><br><br>

        <label>Password</label>
        <input type="password" name="password"><br><br>


    <input type="hidden" name="action" value="login">
    <button>Login</button>
</form>

