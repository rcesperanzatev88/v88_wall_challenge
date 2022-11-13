<html>
    <head>
        <title>Login/Registration page</title>
        <link rel = "stylesheet" href = "<?= base_url() ?>assets/css/styles.css">
    </head>
    <body>
        <header>
            <h1>LOGIN / REGISTRATION PAGE</h1>
        </header>
        <section>
            <form action = "register" method = "post">
                <div class = "error"><?= $this->session->flashdata('message_register') ?></div>
                <h2>Register</h2>
                <label>Email:</label><input type = "text" id = "email" name = "email">
                <label>First Name:</label><input type = "text" id = "first_name" name = "first_name">
                <label>Last Name:</label><input type = "text" id = "last_name" name = "last_name">
                <label>Password:</label><input type = "password" id = "password" name = "password">
                <label>Confirm Password</label><input type = "password" id = "c_password" name = "c_password">
                <input type ="hidden" class = "csrf" name = "<?= $this->security->get_csrf_token_name(); ?>" value = "<?= $this->security->get_csrf_hash(); ?>">
                <input type = "submit" value = "Register" class = "submit">
            </form>
            <form action = "signin" method = "post">
                <div class = "error"><?= $this->session->flashdata('message_login') ?></div>
                <h2>Login</h2>
                <label>Email:</label><input type = "text" id = "email_login" name = "email_login">
                <label>Password:</label><input type = "password" id = "password_login" name = "password_login">
                <input type ="hidden" class = "csrf" name = "<?= $this->security->get_csrf_token_name(); ?>" value = "<?= $this->security->get_csrf_hash(); ?>">
                <input type = "submit" value = "Login" class = "submit">
            </form>
        </section>
    </body>
</html>