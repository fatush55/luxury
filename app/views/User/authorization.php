<?php if (!isset($_SESSION['user'])): ?>

    <div class="container messenger_container">
        <div class="row">
            <div class="col col-md-5">
                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col col-sm-6 account-left">
                <form id="login_form" method="post" action="/user/login">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input name="login" type="text" class="form-control" id="login"
                               aria-describedby="emailHelp" placeholder="Enter login" autocomplete="off"
                               value="<?= isset($_SESSION['remember']['login']) ? $_SESSION['remember']['login'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password1">Password</label>
                        <input name="password" type="password" class="form-control" id="password1"
                               placeholder="Password"
                               value="<?= isset($_SESSION['remember']['password']) ? $_SESSION['remember']['password'] : ''; ?>"
                        >
                    </div>

                    <div class="row">
                        <div class="form-group col col-md-7">
                            <input type="checkbox" id="remember" name="checked"
                                <?= isset($_SESSION['remember']['checked']) ? $_SESSION['remember']['checked'] : ''; ?>
                            >
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                        <div class="row" >
                            <button id="login_btn" type="submit" class="btn btn-primary" style="margin-left: 30px;">
                                Login
                            </button>
                            <a id="register" href="/user/register" type="button"
                               class="btn btn-success">SignUp
                            </a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <?php if (!empty($_SESSION['success'])) unset($_SESSION['success']); ?>

<?php else: ?>
    <p></p>
<?php endif; ?>






