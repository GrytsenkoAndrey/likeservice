<main class="container">
    <section class="row">
        <div class="col-xs-12">
            {$infoMsg}
            <!-- написание стилей вложением есть дурной тон, но в данном случае для теста -->
            <form id="registerForm" method="POST" action="/user/reg/">
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
                <a href="/user/login/">Show Login form</a>
            </form>


        </div>
    </section>
</main>