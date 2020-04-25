<main class="container">
    <section class="row">
        <div class="col-xs-12">
            {$infoMsg}
            <p onclick="dataPrepare()">Show page title</p>
            <form id="loginForm" method="POST" action="/login/">
                <div class="form-group">
                    <label for="email">Email (login)</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p id="regRequest" onclick="showRegisterForm();">Show Register form</p>
            </form>

            <!-- написание стилей вложением есть дурной тон, но в данном случае для теста -->
            <form id="registerForm" style="display:none;" method="POST" action="/reg/">
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
                <button type="submit" class="btn btn-primary">Login</button>
                <p id="regLogin" onclick="showLoginForm();">Show Login form</p>
            </form>


        </div>
    </section>
</main>