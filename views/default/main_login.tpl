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
                <a href="/user/reg/">Show Register form</a>
            </form>

        </div>
    </section>
</main>