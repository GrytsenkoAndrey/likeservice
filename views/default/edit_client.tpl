<main class="container">
    <section class="row">
        <div class="col-xs-12">
            {$infoMsg}
            <form id="loginForm" method="POST" action="/user/edit/">
                <div class="form-group">
                    <label for="email">Email (login)</label>
                    <input type="email" class="form-control" id="email" name="email" value="{$user['email']}">
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
                    <input type="text" class="form-control" id="age" name="age" value="{$user['age']}" required>
                </div>
                <input type="text" hidden value="{$user['id']}" name="id">
                <input type="submit" class="btn btn-primary" name="sub" value="Change">
            </form>

        </div>
    </section>
</main>