<main class="container">
    <section class="row">
        <div class="col-xs-12">
            <h1>Hello {$activeUser} /{$role}/</h1>
            <a href="/user/logout/">Logout</a>
        </div>
    </section>
    <section class="row">
        <div class="col-xs-12">
            <a href="" onclick="dataPrepare(4); return false;">Like</a><span id="likeCnt"></span>
        </div>
    </section>
</main>