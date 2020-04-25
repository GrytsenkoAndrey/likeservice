<main class="container">
    <section class="row">
        <div class="col-xs-12">
            {$infoMsg}
            <form id="loginForm" method="POST" action="/user/login/">
                <div class="form-group">
                    <label for="email">Email (login)</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <input type="submit" class="btn btn-primary" name="sub" value="Login">
                <p onclick="showRegisterForm();">Show Register form</p>
            </form>
            <!-- написание стилей вложением есть дурной тон, но в данном случае для теста -->
            <form id="registerForm" method="POST" action="/user/reg/" style="display:none;">
                <div class="form-group">
                    <label for="regemail">Email (login)</label>
                    <input type="email" class="form-control" id="regemail" name="regemail" required>
                </div>
                <div class="alert alert-warning" id="info" style="display:none;">Пароли отличаются!</div>
                <div class="form-group">
                    <label for="regpassword1">Password</label>
                    <input type="password" class="form-control" id="regpassword1" name="regpassword1" required onchange="comparePass();">
                </div>
                <div class="form-group">
                    <label for="regpassword2">Confirm password</label>
                    <input type="password" class="form-control" id="regpassword2" name="regpassword2" required onchange="comparePass();">
                </div>
                <div class="form-group">
                    <label for="age">Your age</label>
                    <input type="text" class="form-control" id="age" name="age" required>
                </div>
                <input type="submit" class="btn btn-primary" name="subr" value="Register">
                <p onclick="showLoginForm();">Show Login form</p>
            </form>


        </div>
    </section>
</main>