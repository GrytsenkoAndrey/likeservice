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
                    <th scope="col">E-mail</th>
                    <th scope="col">Page info</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                {foreach $rsData as $item}
                <tr>
                    <td>{$item['email']}</td>
                    <td><a href="/like/details/id/{$item['id']}/" title="Like details">{$item['page_info']}</a></td>
                    <td>{$item['quantity']}</td>
                </tr>
                {/foreach}
                </tbody>
            </table>
                {/if}
            {/if}



        </div>
    </section>
</main>