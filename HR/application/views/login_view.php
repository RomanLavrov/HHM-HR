    <div class="login-body">
        <div class="auth_form">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="/HR/login" method="post">

                <div class="form-group <?php echo (!empty($this->username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $this->username; ?>">
                    <span class="help-block"><?php echo $this->username_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $this->password_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <!--TODO Registration Form
            <p>Don't have an account? <a href="/register">Sign up now</a>.</p>
            -->

            </form>
        </div>
    </div>