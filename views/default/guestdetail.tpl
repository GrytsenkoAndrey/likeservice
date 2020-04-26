<main class="container">
    <section class="row">
        <div class="col-xs-12">
            <h1>Hello {$activeUser} /{$role}/</h1>
            <a href="/user/logout/">Logout</a>

            {if isset($rsData)}
                {if count($rsData) > 0}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">IP</th>
                    <th scope="col">Postal</th>
                    <th scope="col">City</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                {foreach $rsData as $item}
                <tr>
                    <td>{$item['id']}</td>
                    <td>{$item['ip']}</td>
                    <td>{$item['post']}</td>
                    <td>{$item['city']}</td>
                    <td>{$item['country']}</td>
                </tr>
                {/foreach}
                </tbody>
            </table>
                {/if}
            {/if}



        </div>
    </section>
</main>